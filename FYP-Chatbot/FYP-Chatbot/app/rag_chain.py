from typing import AsyncGenerator
from app.llm import get_llm
from app.prompts import ECOMMERCE_PROMPT
from app.vector_store import get_retriever

import asyncio
import re

# Shared memory for chat history
chat_histories = {}


def is_greeting_query(q_lower: str) -> bool:
    q_clean = re.sub(r'[^\w\s]', '', q_lower).strip()
    if not q_clean:
        return False
    exacts = {
        "hi", "hello", "hey", "heyy", "heyyy", "hy", "hyy", "hola", "salam", "salaam", "assalamualaikum", "aoa",
        "how are you", "how are you doing", "what is up", "whats up", "whatsup", "hey how are you", "hi how are you",
        "hello how are you", "yr hey how are you", "hy how are you", "kese ho", "kaise ho", "kese hain", "ki haal hai",
        "who are you", "what are you", "what is your name", "who built you", "good morning", "good evening", "good afternoon",
        "help", "assist", "hey there", "hi there", "hello there", "kaise ho yaar", "kese ho yaar", "kese hain aap"
    }
    if q_clean in exacts:
        return True
    pattern = r'^(?:yr|yaar|aap|ap|bhai|bro|ji|jee|there|bot|ai|chatbot|stitch\s*smart|dude|man|sir|madam|maam|p|kese|kaise|ho|hain|haal|hai|hy+|hi+|hey+|hello+|salam|salaam|aoa|assalamualaikum|good\s*(?:morning|afternoon|evening)|how\s*are\s*you|doing|what\'?s\s*up|whatsup|who\s*are\s*you|what\s*is\s*your\s*name|help|assist|\s)+$'
    if re.match(pattern, q_lower):
        return True
    return False


async def get_rag_response(vector_store, query: str, session_id: str, user_id: str = "anonymous", base_url: str = "") -> str:
    """Get a complete RAG response (non-streaming, used by PHP integration)."""
    
    # 1. Management of Session History
    if user_id not in chat_histories:
        chat_histories[user_id] = {}
    
    if session_id not in chat_histories[user_id]:
        chat_histories[user_id][session_id] = []

    history = chat_histories[user_id][session_id]
    query_lower = query.strip().lower()
    
    # Handle greetings instantly without retrieving products
    if is_greeting_query(query_lower):
        reply = "👋 Hello! I am Stitch Smart's AI Assistant. I'm doing great, thank you! How can I help you find the perfect clothing or answer your questions today?"
        chat_histories[user_id][session_id].append((query, reply))
        if len(chat_histories[user_id][session_id]) > 10:
            chat_histories[user_id][session_id] = chat_histories[user_id][session_id][-10:]
        return reply

    # Format chat history for the prompt
    history_str = "No history yet."
    if history:
        history_str = "\n".join([f"Human: {q}\nAI: {a}" for q, a in history])

    # 2. Retrieval
    retriever = get_retriever(vector_store)
    docs = retriever.invoke(query)
    context = "\n---\n".join([doc.page_content for doc in docs])
    if not context:
        context = "No relevant product information found."

    # 3. Final Answer Generation (non-streaming)
    llm = get_llm(streaming=False)
    
    # Format the prompt manually
    prompt_text = ECOMMERCE_PROMPT.format(
        context=context,
        question=query,
        chat_history=history_str,
        base_url=base_url
    )

    try:
        result = await asyncio.wait_for(llm.ainvoke(prompt_text), timeout=55.0)
        full_response = result.content if hasattr(result, 'content') else str(result)
    except asyncio.TimeoutError:
        full_response = "I'm currently experiencing high traffic (API Timeout). Please try again in a few seconds."
    except Exception as e:
        error_msg = str(e).lower()
        if "429" in error_msg or "quota" in error_msg or "resource_exhausted" in error_msg:
            full_response = "I'm currently experiencing high traffic (Rate Limit). Please try again in a few seconds."
        else:
            full_response = "Sorry, I encountered an error. Please try again."

    # Update session history
    chat_histories[user_id][session_id].append((query, full_response))
    if len(chat_histories[user_id][session_id]) > 10:
        chat_histories[user_id][session_id] = chat_histories[user_id][session_id][-10:]

    return full_response


async def stream_rag_response(vector_store, query: str, session_id: str, user_id: str = "anonymous", base_url: str = "") -> AsyncGenerator[str, None]:
    """Stream wrapper - gets full response then yields it (for streaming endpoint compatibility)."""
    response = await get_rag_response(vector_store, query, session_id, user_id, base_url)
    yield response
