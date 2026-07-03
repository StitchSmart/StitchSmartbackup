from langchain_core.language_models import LLM
from langchain_core.callbacks import CallbackManagerForLLMRun
from typing import List, Optional, Any
import re

class MockGeminiLLM(LLM):
    """Mock LLM that acts like a smart shopping assistant using the retrieved context."""
    
    model_name: str = "mock-gemini"
    
    @property
    def _llm_type(self) -> str:
        return "mock-gemini"
    
    def _call(
        self,
        prompt: str,
        stop: Optional[List[str]] = None,
        run_manager: Optional[CallbackManagerForLLMRun] = None,
        **kwargs: Any,
    ) -> str:
        """Parse context and user question to generate a deterministic product recommendation."""
        
        # Dump prompt for debugging
        with open("mock_llm_debug.log", "w", encoding="utf-8") as f:
            f.write(prompt)
            
        # 1. Parse products directly from the prompt string using robust block splitting
        products = []
        doc_blocks = re.split(r'-{3,}', prompt)
        for block in doc_blocks:
            if "Product ID:" in block and "Product Name:" in block:
                p = {}
                for line in block.strip().split("\n"):
                    if ":" in line:
                        key, val = line.split(":", 1)
                        p[key.strip().lower()] = val.strip()
                if "product id" in p and "product name" in p:
                    products.append(p)

        # 2. Extract question roughly
        question_display = "your request"
        if "Customer Question:" in prompt:
            try:
                question_display = prompt.split("Customer Question:")[1].split("Helpful")[0].strip()
            except:
                pass
        
        question_lower = question_display.lower()

        # Handle simple greetings
        greetings = ["hi", "hello", "hey", "help", "assist"]
        if any(word == question_lower for word in greetings) or question_lower == "hey!":
            return "👋 Hello! Welcome to Stitch Smart. How can I help you today?"

        # Custom Training Responses (Budget, Shipping, Style Guide)
        if "budget" in question_lower or "cheap" in question_lower or "affordable" in question_lower:
            return "Looking for a budget pick? Our best value items are priced under Rs. 1500. Just ask me to show you 'cheap shirts' or 'budget items'!"
            
        if "policy" in question_lower or "return" in question_lower:
            return "Yes, we do have a return process. Customers can easily return products according to our Return and Refund policy."
        
        if "custom" in question_lower or "design" in question_lower:
            return "YES, we DO offer product customization! Customers can use the 'Design Yourself' feature and place 'Art Orders' to get custom designs."

        if "shipping" in question_lower or "delivery" in question_lower or "track" in question_lower:
            return "📦 **Shipping Info:** We offer fast and reliable shipping across the country! Standard delivery takes 3-5 business days. We also offer Cash on Delivery (COD). Free shipping is available on orders over Rs. 5000!"
            
        if "style" in question_lower or "guide" in question_lower or "fashion" in question_lower or "outfit" in question_lower:
            return "✨ **Style Guide:** Need some style advice? \n- For a casual daytime look, pair our trendy printed t-shirts with comfortable cotton jeans.\n- For a professional setting, check out our classic button-down shirts and formal western dresses.\n- Don't forget to mix and match colors! Black and white are essentials, while a pop of red or blue adds character."
        
        # 3. Smart Filtering based on exact keywords (Colors & Genders)
        filtered_products = []
        for p in products:
            p_text = (p.get("product name", "") + " " + p.get("description", "") + " " + p.get("details", "") + " " + p.get("category", "")).lower()
            
            # Color check
            colors = ["black", "white", "red", "blue", "green", "pink", "purple", "brown", "yellow", "gray", "grey", "peach", "navy"]
            color_mismatch = False
            for color in colors:
                # If user asks for a color, it MUST be in the product text
                if color in question_lower and color not in p_text:
                    color_mismatch = True
                    break
                    
            # Gender/Target check (Strict Inclusive Match)
            gender_mismatch = False
            is_women_query = any(w in question_lower for w in ["girl", "women", "ladies", "female"])
            is_men_query = any(w in question_lower for w in ["boy", "men", "male"])
            is_kid_query = any(w in question_lower for w in ["kid", "child", "children"])
            
            p_has_women = any(w in p_text for w in ["girl", "women", "ladies", "female"])
            p_has_men = any(w in p_text for w in ["boy", "men", "male", "men's", "mens"])
            p_has_kid = any(w in p_text for w in ["kid", "child", "children"])
            
            if is_women_query and not p_has_women:
                gender_mismatch = True
            elif is_men_query and not p_has_men:
                gender_mismatch = True
            elif is_kid_query and not p_has_kid:
                gender_mismatch = True
                        
            # Item Type check
            item_types = ["shirt", "jacket", "dress", "skirt", "pant", "jeans", "top", "t-shirt", "socks"]
            type_mismatch = False
            for item in item_types:
                if item in question_lower and item not in p_text:
                    type_mismatch = True
                    break
                        
            if not color_mismatch and not gender_mismatch and not type_mismatch:
                filtered_products.append(p)
                
        products = filtered_products
        
        # 4. Generate response
        if not products:
            return "I'm sorry, I couldn't find any exact matches for your request in our database. We might be out of stock for this specific item. Could you try asking for something else?"
        
        # Format products
        base_url = "http://localhost/Stitch-Smart/public/"
        response = "Here are the most relevant items I found for you:\n\n"
        
        for p in products:
            pid = p.get("product id", "")
            name = p.get("product name", "Unknown Product")
            price = p.get("price", "N/A")
            cat = p.get("category", "N/A")
            size = p.get("size", "N/A")
            stock = p.get("stock available", "Unknown")
            
            # Format according to prompt instructions
            response += f"**[{name}]({base_url}index.php?page=product_show&id={pid})** — {price}\n"
            response += f"• Category: {cat} | Size: {size} | Stock: {stock}\n\n"
            
        response += "Would you like to know more about any of these items?"
        return response

    async def _acall(
        self,
        prompt: str,
        stop: Optional[List[str]] = None,
        run_manager: Optional[CallbackManagerForLLMRun] = None,
        **kwargs: Any,
    ) -> str:
        return self._call(prompt, stop, run_manager, **kwargs)
