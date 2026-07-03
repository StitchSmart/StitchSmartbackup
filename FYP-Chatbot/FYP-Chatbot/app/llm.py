from langchain_google_genai import ChatGoogleGenerativeAI
from app.mock_llm import MockGeminiLLM
from app.config import GOOGLE_API_KEY, LLM_MODEL_NAME, LLM_TEMPERATURE

# Cache LLM instances
_llm_cache = {}

def get_llm(streaming: bool = True):
    """Return a cached Gemini Chat LLM with a fallback to MockGeminiLLM."""
    global _llm_cache
    if streaming not in _llm_cache:
        # 1. Try real Google Gemini model
        real_llm = ChatGoogleGenerativeAI(
            model=LLM_MODEL_NAME,
            google_api_key=GOOGLE_API_KEY,
            temperature=LLM_TEMPERATURE,
            max_retries=0,
            timeout=2.0
        )
        
        # 2. Fallback to mock LLM if quota exceeded or unavailable
        mock_llm = MockGeminiLLM()
        
        fallback_llm = real_llm.with_fallbacks([mock_llm])
        _llm_cache[streaming] = fallback_llm
    
    return _llm_cache[streaming]
