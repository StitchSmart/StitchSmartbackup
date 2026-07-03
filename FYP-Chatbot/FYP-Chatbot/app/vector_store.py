import json
import os
import math
import pickle
from typing import List, Any
from langchain_core.documents import Document
from app.config import PRODUCTS_JSON_PATH, FAISS_INDEX_DIR, RETRIEVER_TOP_K
import re

CAT_MAP = {
    "58": "Men Shirt T-Shirt",
    "57": "Women Shirt T-Shirt",
    "64": "Kid Kids Children Shirt",
    "65": "Girl Girls Kid Kids Outfit",
    "66": "Infant Baby Kid Kids Socks Set",
    "60": "Men Jacket Winter Wear",
    "59": "Men Boy Pant Trousers Jeans",
    "61": "Women Dress Western Wear",
    "63": "Women Skirt",
    "62": "Women Girl Top"
}

def _product_to_text(product: dict) -> str:
    """Flatten a single product dict into a rich textual representation."""
    p = {k.lower(): v for k, v in product.items()}
    cat_id = str(p.get('parent_cat', ''))
    mapped_cat = CAT_MAP.get(cat_id, str(p.get('category', 'N/A')))
    
    lines = [
        f"Product ID: {p.get('id', 'N/A')}",
        f"Product Name: {p.get('name', 'N/A')}",
        f"Article Number: {p.get('article_number', 'N/A')}",
        f"Category: {mapped_cat}",
        f"Price: Rs. {p.get('price', 'N/A')}",
        f"Size: {p.get('size', 'N/A')}",
        f"Fabric Type: {p.get('fabric_type', 'N/A')}",
        f"Design: {p.get('designing', 'N/A')}",
        f"Description: {p.get('description', 'N/A')}",
        f"Details: {p.get('details', 'N/A')}",
        f"Stock Available: {p.get('quantity', 0)} units",
        f"Category ID: {cat_id}",
    ]
    return "\n".join(lines)

def _load_products() -> List[Document]:
    """Load products JSON and convert each product into a LangChain Document."""
    with open(PRODUCTS_JSON_PATH, "r", encoding="utf-8") as f:
        products = json.load(f)

    documents: List[Document] = []
    for product in products:
        text = _product_to_text(product)
        metadata = {
            "id": str(product.get("id")),
            "product_name": product.get("name"),
            "category": product.get("category"),
            "category_id": str(product.get("parent_cat", "")),
            "price": product.get("price"),
            "size": product.get("size"),
        }
        documents.append(Document(page_content=text, metadata=metadata))

    return documents

class MockDocstore:
    def __init__(self, documents):
        self._dict = {str(doc.metadata.get('id', i)): doc for i, doc in enumerate(documents)}

class SimpleTFIDFVectorStore:
    def __init__(self, documents: List[Document]):
        self.documents = documents
        self.docstore = MockDocstore(documents)
        
        self.idf = {}
        self.doc_tfidfs = []
        
        def tokenize(text):
            return re.findall(r'\w+', text.lower())
            
        N = len(documents)
        df = {}
        for doc in documents:
            words = tokenize(doc.page_content)
            for w in set(words):
                df[w] = df.get(w, 0) + 1
                
        for w, count in df.items():
            self.idf[w] = math.log(N / (count + 1)) + 1
            
        for doc in documents:
            words = tokenize(doc.page_content)
            tf = {}
            for w in words:
                tf[w] = tf.get(w, 0) + 1
            
            vec = {}
            norm = 0.0
            for w, count in tf.items():
                val = count * self.idf.get(w, 0)
                vec[w] = val
                norm += val * val
            norm = math.sqrt(norm)
            if norm > 0:
                for w in vec:
                    vec[w] /= norm
            self.doc_tfidfs.append(vec)

    def similarity_search_with_score(self, query: str, k: int = 4):
        def tokenize(text):
            return re.findall(r'\w+', text.lower())
            
        words = tokenize(query)
        tf = {}
        for w in words:
            tf[w] = tf.get(w, 0) + 1
            
        vec = {}
        norm = 0.0
        for w, count in tf.items():
            val = count * self.idf.get(w, 0)
            vec[w] = val
            norm += val * val
        norm = math.sqrt(norm)
        if norm > 0:
            for w in vec:
                vec[w] /= norm
                
        results = []
        for i, doc_vec in enumerate(self.doc_tfidfs):
            score = 0.0
            for w, val in vec.items():
                score += val * doc_vec.get(w, 0)
            results.append((self.documents[i], score))
            
        results.sort(key=lambda x: x[1], reverse=True)
        return results[:k]

    def as_retriever(self, search_kwargs=None):
        search_kwargs = search_kwargs or {"k": RETRIEVER_TOP_K}
        k = search_kwargs.get("k", RETRIEVER_TOP_K)
        store = self
        
        class Retriever:
            def invoke(self, query: str):
                results = store.similarity_search_with_score(query, k=k)
                return [doc for doc, score in results]
        return Retriever()

    def save_local(self, path: str):
        os.makedirs(path, exist_ok=True)
        with open(os.path.join(path, "store.pkl"), "wb") as f:
            pickle.dump(self, f)

    @classmethod
    def load_local(cls, path: str):
        with open(os.path.join(path, "store.pkl"), "rb") as f:
            return pickle.load(f)

def create_vector_store_from_data(products: list) -> Any:
    documents: List[Document] = []
    for product in products:
        text = _product_to_text(product)
        metadata = {
            "id": str(product.get("id")),
            "product_name": product.get("name"),
            "category": product.get("category"),
            "category_id": str(product.get("parent_cat", "")),
            "price": product.get("price"),
            "size": product.get("size"),
        }
        documents.append(Document(page_content=text, metadata=metadata))
    
    store = SimpleTFIDFVectorStore(documents)
    store.save_local(FAISS_INDEX_DIR)
    return store

def create_vector_store() -> Any:
    documents = _load_products()
    store = SimpleTFIDFVectorStore(documents)
    store.save_local(FAISS_INDEX_DIR)
    return store

def load_vector_store() -> Any:
    return SimpleTFIDFVectorStore.load_local(FAISS_INDEX_DIR)

def get_retriever(vector_store: Any):
    return vector_store.as_retriever(search_kwargs={"k": RETRIEVER_TOP_K})
