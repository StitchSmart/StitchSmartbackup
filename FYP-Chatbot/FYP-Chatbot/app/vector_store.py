import json
import os
import math
import pickle
from typing import List, Any
from langchain_core.documents import Document
from app.config import PRODUCTS_JSON_PATH, FAISS_INDEX_DIR, RETRIEVER_TOP_K
import re

CAT_MAP = {
    "58": "Men's Shirts & T-Shirts",
    "57": "Women's Shirts & T-Shirts",
    "64": "Kids' Shirts",
    "65": "Kids - Girls' Outfits",
    "66": "Kids - Infants & Socks",
    "60": "Men's Winter Wear & Jackets",
    "59": "Men's Pants & Jeans",
    "61": "Women's Dresses & Western Wear",
    "63": "Women's Skirts",
    "62": "Women's Tops"
}

SYNONYM_MAP = {
    "58": "men mens male boy shirts tshirts tops casual formal",
    "57": "women womens ladies female girl shirts tshirts tops casual formal",
    "64": "kid kids child children boy girl shirts tshirts tops casual",
    "65": "girl girls kid kids child children outfit dress frock suit",
    "66": "infant baby kid kids child children socks accessories set new born",
    "60": "men mens male boy jacket sweater winter wear hoodie coat upper",
    "59": "men mens male boy pant trousers jeans denim bottoms lowers",
    "61": "women womens ladies female dress gown western wear one piece",
    "63": "women womens ladies female skirt bottoms lowers casual formal",
    "62": "women womens ladies female girl top blouse casual formal"
}

def get_mapped_cat(product: dict) -> str:
    p = {k.lower(): v for k, v in product.items()}
    cat_id = str(p.get('parent_cat', ''))
    mapped_cat = CAT_MAP.get(cat_id, str(p.get('category', 'N/A')))
    if mapped_cat == "N/A" or not mapped_cat or mapped_cat == "None":
        name_lower = str(p.get('name', '')).lower()
        if any(w in name_lower for w in ["girl", "women", "lady", "skirt", "blouse", "frock"]):
            mapped_cat = "Women's Dresses & Tops"
        elif any(w in name_lower for w in ["kid", "baby", "child", "infant", "dinosaur"]):
            mapped_cat = "Kids' Collection"
        elif any(w in name_lower for w in ["men", "boy", "pent", "jeans"]):
            mapped_cat = "Men's Apparel"
        else:
            mapped_cat = "Premium Apparel"
    return mapped_cat

def _product_to_text(product: dict) -> str:
    """Flatten a single product dict into a rich textual representation."""
    p = {k.lower(): v for k, v in product.items()}
    cat_id = str(p.get('parent_cat', ''))
    mapped_cat = get_mapped_cat(product)
    synonyms = SYNONYM_MAP.get(cat_id, "")
    
    lines = [
        f"Product ID: {p.get('id', 'N/A')}",
        f"Product Name: {p.get('name', 'N/A')}",
        f"Article Number: {p.get('article_number', 'N/A')}",
        f"Category: {mapped_cat}",
        f"Search Keywords: {synonyms} {mapped_cat.lower()}",
        f"Price: Rs. {p.get('price', 'N/A')}",
        f"Size: {p.get('size', 'N/A')}",
        f"Fabric Type: {p.get('fabric_type', 'N/A')}",
        f"Design: {p.get('designing', 'N/A')}",
        f"Description: {p.get('description', 'N/A')}",
        f"Details: {p.get('details', 'N/A')}",
        f"Image URL: {p.get('image_url', '')}",
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
            "category": get_mapped_cat(product),
            "category_id": str(product.get("parent_cat", "")),
            "price": product.get("price"),
            "size": product.get("size"),
            "image_url": product.get("image_url", ""),
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
                query_lower = query.lower()
                
                max_price = None
                min_price = None
                exact_price = None
                
                max_match = re.search(r'(?:below|under|less\s*than|less|cheaper\s*than|cheaper|smaller\s*than|smaller|lower\s*than|lower|within|upto|up\s*to|max|at\s*most|<|sasta|sasti|under\s*rs\.?|below\s*rs\.?)\s*(?:rs\.?|pkr|rupees)?\s*(\d+)', query_lower)
                if max_match:
                    try:
                        max_price = float(max_match.group(1))
                    except:
                        pass
                        
                min_match = re.search(r'(?:above|greater\s*than|greater|more\s*than|more|higher\s*than|higher|min|at\s*least|>|mehenga|above\s*rs\.?|greater\s*than\s*rs\.?)\s*(?:rs\.?|pkr|rupees)?\s*(\d+)', query_lower)
                if min_match:
                    try:
                        min_price = float(min_match.group(1))
                    except:
                        pass

                if max_price is None and min_price is None:
                    num_match = re.search(r'(?:exact|around|price|rs\.?|pkr|rupees|budget|range)?\s*(\d{3,5})(?:\s*(?:pkr|rs|rupees|ki|wale|ka|ke|mein|m|me))?', query_lower)
                    if num_match:
                        try:
                            val = float(num_match.group(1))
                            if 100 <= val <= 100000:
                                exact_price = val
                        except:
                            pass

                # If price filter is specified, check ALL documents and sort by similarity score
                if max_price is not None or min_price is not None or exact_price is not None:
                    results = store.similarity_search_with_score(query, k=len(store.documents))
                    filtered_docs = []
                    for doc, score in results:
                        try:
                            price = float(doc.metadata.get("price", 0))
                        except:
                            price = 0.0
                            
                        if max_price is not None and price > max_price:
                            continue
                        if min_price is not None and price < min_price:
                            continue
                        if exact_price is not None:
                            if any(w in query_lower for w in ["exact", "only", "not more", "not less", "same", "strictly"]):
                                if abs(price - exact_price) > 5:
                                    continue
                            else:
                                if price < exact_price * 0.85 or price > exact_price * 1.05:
                                    continue
                        filtered_docs.append(doc)
                        
                    if filtered_docs:
                        return filtered_docs[:10]
                        
                results = store.similarity_search_with_score(query, k=k)
                non_zero = [doc for doc, score in results if score > 0.0]
                return non_zero if non_zero else [doc for doc, score in results[:2]]
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
            "category": get_mapped_cat(product),
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
