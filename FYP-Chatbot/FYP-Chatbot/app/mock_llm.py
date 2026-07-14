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

        question_display = prompt.strip()
        if "Customer Question:" in prompt:
            try:
                question_display = prompt.split("Customer Question:")[1].split("Helpful")[0].strip()
            except:
                pass
        
        question_lower = question_display.lower()

        # Handle greetings and casual intro questions
        q_clean = re.sub(r'[^\w\s]', '', question_lower).strip()
        greetings = {
            "hi", "hello", "hey", "heyy", "heyyy", "hy", "hyy", "hola", "salam", "salaam", "assalamualaikum", "aoa",
            "how are you", "how are you doing", "what is up", "whats up", "whatsup", "hey how are you", "hi how are you",
            "hello how are you", "yr hey how are you", "hy how are you", "kese ho", "kaise ho", "kese hain", "ki haal hai",
            "who are you", "what are you", "what is your name", "who built you", "good morning", "good evening", "good afternoon",
            "help", "assist", "hey there", "hi there", "hello there", "kaise ho yaar", "kese ho yaar", "kese hain aap"
        }
        pattern = r'^(?:yr|yaar|aap|ap|bhai|bro|ji|jee|there|bot|ai|chatbot|stitch\s*smart|dude|man|sir|madam|maam|p|kese|kaise|ho|hain|haal|hai|hy+|hi+|hey+|hello+|salam|salaam|aoa|assalamualaikum|good\s*(?:morning|afternoon|evening)|how\s*are\s*you|doing|what\'?s\s*up|whatsup|who\s*are\s*you|what\s*is\s*your\s*name|help|assist|\s)+$'
        if q_clean in greetings or re.match(pattern, question_lower):
            return "👋 Hello! I am Stitch Smart's AI Assistant. I'm doing great, thank you! How can I help you find the perfect clothing or answer your questions today?"

        # Custom Training Responses (Sizes, Budget, Payment, Shipping, Returns, Customization, Fabric, Contact, Wholesale, Style Guide, Product Types)
        if any(w in question_lower for w in ["kis type", "what type", "kinds of product", "types of product", "type ki", "kis kis type", "kya kya milta", "products kis type"]):
            base_url = "http://localhost/Stitch-Smart/public/"
            return f"👕 **Our Product Categories & Types:** At Stitch Smart, we offer a wide variety of high-quality clothing across multiple categories:\n\n• **Men's Apparel:** Casual Shirts, T-Shirts, Activewear, Winter Wear/Jackets, and Denim Jeans/Pants.\n• **Women's Collection:** Western Dresses, Tops, Skirts, and Co-ord Sets.\n• **Kids & Infants:** Stylish Outfits, T-Shirts, Shorts, and Baby Accessories/Socks.\n• **Custom Design ('Design Yourself'):** Custom printed hoodies, crewnecks, shorts, and shirts made to order!\n\nYou can explore our complete catalog right here:\n**[Browse All Products]({base_url}allproducts)**"

        if "size" in question_lower or "fitting" in question_lower or "measurement" in question_lower or "chart" in question_lower:
            return "📏 **Sizes & Sizing Guide:** We offer a full range of sizes including XS, S, M, L, and XL across our men's, women's, and kids' collections! For infants and babies, we have specialized age-based sizing. Each product card shows the exact stock available per size. If you're unsure about fit, let me know which item you like and I'll check for you!"
            
        if "pay" in question_lower or "cod" in question_lower or "cash on delivery" in question_lower or "card" in question_lower or "method" in question_lower:
            return "💳 **Payment Methods:** We make shopping easy! We accept **Cash on Delivery (COD)** nationwide, as well as secure online payments via Credit/Debit Cards, JazzCash, EasyPaisa, and Direct Bank Transfer."
            
        if "budget" in question_lower or "cheap" in question_lower or "affordable" in question_lower or "discount" in question_lower or "sale" in question_lower:
            return "💰 **Budget & Best Value:** Looking for affordable picks? Our collection starts from as low as Rs. 199 for kids' accessories and socks, with stylish shirts and tops under Rs. 1000! Just tell me your budget (e.g., 'show me items below 1000' or 'smaller 1000') and I'll find the best matches!"
            
        if "policy" in question_lower or "return" in question_lower or "exchange" in question_lower or "refund" in question_lower:
            return "🔄 **Return & Exchange Policy:** We want you to love your wardrobe! We offer a hassle-free **7-day return and exchange policy**. If an item doesn't fit or you're not satisfied, simply ensure it is unworn with original tags attached and reach out to our team for an exchange or refund."
        
        if "custom" in question_lower or "design" in question_lower or "print" in question_lower or "logo" in question_lower or "art order" in question_lower:
            return "🎨 **Customization & Art Orders:** YES! We specialize in custom apparel and printing! You can use our interactive **'Design Yourself'** feature on the website to upload your artwork, logos, or custom text and place an 'Art Order'. Our master tailors will craft it exactly to your specifications!"

        if "shipping" in question_lower or "delivery" in question_lower or "track" in question_lower or "dispatch" in question_lower or "charge" in question_lower:
            return "📦 **Shipping & Delivery:** We offer fast, reliable doorstep shipping nationwide! Standard delivery takes 3-5 business days. Best of all, **Free Shipping** is available on all orders over Rs. 5000!"
            
        if "fabric" in question_lower or "stuff" in question_lower or "material" in question_lower or "cotton" in question_lower or "wash" in question_lower or "quality" in question_lower:
            return "🧵 **Fabric Quality & Care:** At Stitch Smart, we use premium-grade fabrics! Our summer apparel features breathable 100% combed cotton and lawn, while winter wear uses warm fleece, denim, and wool blends. We recommend gentle machine wash in cold water to preserve color and fit."
            
        if "location" in question_lower or "shop" in question_lower or "timing" in question_lower or "contact" in question_lower or "phone" in question_lower or "email" in question_lower or "support" in question_lower:
            return "📍 **Customer Support & Contact:** Our online support team is here for you Mon-Sat from 9:00 AM to 9:00 PM! You can reach us via email at `support@stitchsmart.pk` or call/WhatsApp our helpline for instant assistance."
            
        if "wholesale" in question_lower or "bulk" in question_lower or "uniform" in question_lower or "business" in question_lower:
            return "🤝 **Wholesale & Bulk Orders:** Yes, we cater to corporate orders, school uniforms, event apparel, and boutique wholesale! Contact our corporate team for special volume discounts."
            
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
                        
            # Price check
            price_mismatch = False
            try:
                price_match = re.search(r'(\d+(?:\.\d+)?)', str(p.get("price", "0")))
                p_val = float(price_match.group(1)) if price_match else 0.0
            except:
                p_val = 0.0
                
            max_match = re.search(r'(?:below|under|less\s*than|less|cheaper\s*than|cheaper|smaller\s*than|smaller|lower\s*than|lower|within|upto|up\s*to|max|at\s*most|<|sasta|sasti|under\s*rs\.?|below\s*rs\.?)\s*(?:rs\.?|pkr|rupees)?\s*(\d+)', question_lower)
            if max_match:
                try:
                    if p_val > float(max_match.group(1)):
                        price_mismatch = True
                except:
                    pass
                    
            min_match = re.search(r'(?:above|greater\s*than|greater|more\s*than|more|higher\s*than|higher|min|at\s*least|>|mehenga|above\s*rs\.?|greater\s*than\s*rs\.?)\s*(?:rs\.?|pkr|rupees)?\s*(\d+)', question_lower)
            if min_match:
                try:
                    if p_val < float(min_match.group(1)):
                        price_mismatch = True
                except:
                    pass

            if max_match is None and min_match is None:
                num_match = re.search(r'(?:exact|around|price|rs\.?|pkr|rupees|budget|range)?\s*(\d{3,5})(?:\s*(?:pkr|rs|rupees|ki|wale|ka|ke|mein|m|me))?', question_lower)
                if num_match:
                    try:
                        val = float(num_match.group(1))
                        if 100 <= val <= 100000:
                            if any(w in question_lower for w in ["exact", "only", "not more", "not less", "same", "strictly"]):
                                if abs(p_val - val) > 5:
                                    price_mismatch = True
                            else:
                                if p_val < val * 0.85 or p_val > val * 1.05:
                                    price_mismatch = True
                    except:
                        pass
                        
            if not color_mismatch and not gender_mismatch and not type_mismatch and not price_mismatch:
                filtered_products.append(p)
                
        products = filtered_products
        
        # 4. Generate response
        base_url = "http://localhost/Stitch-Smart/public/"
        if not products:
            return f"I couldn't find an exact product matching your specific request or price criteria in our current catalog right now. However, you can browse all our products directly and pick the perfect item here:\n\n**[Browse All Products]({base_url}allproducts)**"
        
        # Format products
        response = "Here are the most relevant items matching your criteria:\n\n"
        
        for p in products:
            pid = p.get("product id", "")
            name = p.get("product name", "Unknown Product")
            price = p.get("price", "N/A")
            cat = p.get("category", "N/A")
            if cat == "N/A" or not cat or cat == "None":
                name_lower = name.lower()
                if any(w in name_lower for w in ["girl", "women", "lady", "skirt", "blouse", "frock"]):
                    cat = "Women's Dresses & Tops"
                elif any(w in name_lower for w in ["kid", "baby", "child", "infant", "dinosaur"]):
                    cat = "Kids' Collection"
                elif any(w in name_lower for w in ["men", "boy", "pent", "jeans"]):
                    cat = "Men's Apparel"
                else:
                    cat = "Premium Apparel"
            size = p.get("size", "N/A")
            stock = p.get("stock available", "Unknown")
            
            # Format according to prompt instructions
            response += f"**[{name}]({base_url}product_show?id={pid})** — {price}\n"
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
