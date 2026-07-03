from app.vector_store import load_vector_store, get_retriever

def test():
    try:
        vs = load_vector_store()
        retriever = get_retriever(vs)
        docs = retriever.invoke("black shirt")
        for i, d in enumerate(docs):
            print(f"--- Doc {i} ---")
            print(d.page_content)
    except Exception as e:
        print("Error:", e)

if __name__ == "__main__":
    test()
