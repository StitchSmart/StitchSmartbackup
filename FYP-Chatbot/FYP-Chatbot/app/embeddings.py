from langchain_huggingface import HuggingFaceEmbeddings

# Cache the model instance to avoid re-initializing on every request
_embedding_model = None

def get_embedding_model():
    """Return a cached HuggingFace embedding model."""
    global _embedding_model
    if _embedding_model is None:
        _embedding_model = HuggingFaceEmbeddings(model_name="all-MiniLM-L6-v2")
    return _embedding_model
