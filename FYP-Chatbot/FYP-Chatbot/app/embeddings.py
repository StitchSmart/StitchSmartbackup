from langchain_google_genai import GoogleGenerativeAIEmbeddings
from app.config import GOOGLE_API_KEY

# Cache the model instance to avoid re-initializing on every request
_embedding_model = None

def get_embedding_model() -> GoogleGenerativeAIEmbeddings:
    """Return a cached Google embedding model."""
    global _embedding_model
    if _embedding_model is None:
        _embedding_model = GoogleGenerativeAIEmbeddings(model="models/text-embedding-004", google_api_key=GOOGLE_API_KEY)
    return _embedding_model
