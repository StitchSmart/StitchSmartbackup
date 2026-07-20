import os
import sys
import re
from typing import List, Any
sys.path.append(r"c:\xampp\htdocs\Stitch-Smart\FYP-Chatbot\FYP-Chatbot")

from dotenv import load_dotenv
load_dotenv(r"c:\xampp\htdocs\Stitch-Smart\FYP-Chatbot\FYP-Chatbot\.env")

from langchain_community.vectorstores import FAISS
from langchain_core.documents import Document
from app.embeddings import get_embedding_model

class CustomFAISSRetriever:
    def __init__(self, faiss_store: FAISS, k: int = 4):
        self.store = faiss_store
        self.k = k

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

        # If price filter is specified
        if max_price is not None or min_price is not None or exact_price is not None:
            # fetch more documents to ensure we have candidates to filter
            # Langchain FAISS similarity_search_with_score fetches based on dense embeddings.
            results = self.store.similarity_search_with_score(query, k=30)
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
                
        # If no filter or filter resulted in 0 matches (fallback)
        results = self.store.similarity_search_with_score(query, k=self.k)
        # return top k
        return [doc for doc, score in results]

if __name__ == "__main__":
    docs = [
        Document(page_content="Cheap shirt", metadata={"price": 500, "id": "1"}),
        Document(page_content="Expensive shirt", metadata={"price": 3500, "id": "2"}),
        Document(page_content="Medium shirt", metadata={"price": 1500, "id": "3"})
    ]
    emb = get_embedding_model()
    store = FAISS.from_documents(docs, emb)
    retriever = CustomFAISSRetriever(store, k=2)
    
    print("Under 1000:")
    res = retriever.invoke("shirts under 1000")
    for r in res:
        print(f"{r.page_content} - {r.metadata['price']}")
        
    print("Above 2000:")
    res = retriever.invoke("shirts above 2000")
    for r in res:
        print(f"{r.page_content} - {r.metadata['price']}")
