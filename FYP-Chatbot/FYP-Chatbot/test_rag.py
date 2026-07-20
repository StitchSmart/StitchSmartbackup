import asyncio
import sys
sys.path.append(r"c:\xampp\htdocs\Stitch-Smart\FYP-Chatbot\FYP-Chatbot")
from dotenv import load_dotenv
load_dotenv(r"c:\xampp\htdocs\Stitch-Smart\FYP-Chatbot\FYP-Chatbot\.env")
from app.vector_store import load_vector_store
from app.rag_chain import get_rag_response

async def test():
    store = load_vector_store()
    res = await get_rag_response(store, "Show me shirts under 2000", "test-session", base_url="http://localhost/")
    print(res)

asyncio.run(test())
