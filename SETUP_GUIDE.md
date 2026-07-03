# Stitch Smart & RAG Chatbot Setup Guide

Yeh guide **Stitch Smart** web application aur uske **RAG-based Chatbot** ko locally setup aur run karne ke liye banayi gayi hai.

---

## Prerequisites (Zaroori Cheezein)
1. **XAMPP Control Panel** (Apache aur MySQL ke liye)
2. **Python 3.8+** (Chatbot server ke liye)
3. **Google Gemini API Key** (Free key yahan se hasil karen: [Google AI Studio](https://aistudio.google.com/apikey))

---

## Hissa 1: Stitch Smart Web App Setup (PHP / XAMPP)

1. **Project Folder Location:**
   Ensure karen ke aapka project folder XAMPP ke `htdocs` directory mein is path par ho:
   `C:\xampp\htdocs\Stitch-Smart\`

2. **XAMPP Modules Start Karen:**
   * **XAMPP Control Panel** open karen.
   * **Apache** aur **MySQL** ke samne **Start** button par click karen.

3. **Database Import Karen:**
   * Kisi bhi web browser mein [http://localhost/phpmyadmin](http://localhost/phpmyadmin) open karen.
   * Naya database banayein jiska naam **`StitchSmart`** rakhein.
   * Naye database ko select karke **Import** tab par click karen.
   * `Choose File` par click karke is file ko select karen:
     `C:\xampp\htdocs\Stitch-Smart\db\stitchsmart (2).sql`
   * Page ke niche **Import / Go** button par click karke database import mukammal karen.

4. **Environment Configuration (.env):**
   * Root folder (`C:\xampp\htdocs\Stitch-Smart\.env`) mein base database credentials standard default settings ke mutabik set hain:
     * `DB_HOST=localhost`
     * `DB_NAME=StitchSmart`
     * `DB_USER=root`
     * `DB_PASS=`
     * `GOOGLE_API_KEY=` (Aapki Gemini API Key)

5. **Web App Run Karen:**
   * Browser mein is URL par jayein:
     [http://localhost/Stitch-Smart/](http://localhost/Stitch-Smart/)

---

## Hissa 2: Chatbot Setup & Execution (Python / FastAPI)

Chatbot ko run karne ke liye niche diye gaye steps ko follow karen:

1. **Terminal Open Karen aur Chatbot Directory Mein Jayein:**
   Command Prompt (CMD) ya PowerShell open karen aur niche di gayi command likhein:
   ```cmd
   cd C:\xampp\htdocs\Stitch-Smart\FYP-Chatbot\FYP-Chatbot
   ```

2. **Python Virtual Environment Create & Activate Karen:**
   * Virtual environment banayein (agar pehle se nahi bana hua):
     ```cmd
     python -m venv venv
     ```
   * Virtual environment ko activate karen:
     * **Windows Command Prompt (CMD):**
       ```cmd
       venv\Scripts\activate
       ```
     * **Windows PowerShell:**
       ```powershell
       venv\Scripts\activate.ps1
       ```

3. **Dependencies Install Karen:**
   ```cmd
   pip install -r requirements.txt
   ```

4. **API Key Setup (.env):**
   * `FYP-Chatbot/FYP-Chatbot/.env` file ko check karen aur wahan apni real Gemini API key lagayein:
     `GOOGLE_API_KEY=AAPKI_GEMINI_API_KEY`

5. **Chatbot Server Run Karen:**
   ```cmd
   uvicorn app.main:app --reload --port 5000
   ```
   *Chatbot server [http://localhost:5000](http://localhost:5000) par start ho jayega aur auto-reload mode mein chalega.*

6. **Optional (Streamlit Test UI):**
   Agar aap chatbot ko alag se ek interactive interface par test karna chahte hain:
   * Virtual environment active rakhte hue naye terminal mein run karen:
     ```cmd
     streamlit run streamlit_app.py
     ```

---

## Troubleshooting (Masail ka Hal)
* **Port Conflict:** Agar port `5000` pehle se use mein hai toh aap uvicorn command mein port change kar sakte hain (e.g. `--port 8000`) aur root `.env` mein `CHATBOT_API_URL` ko update kar sakte hain.
* **Database Connection Error:** Check karen ke XAMPP mein MySQL active hai aur `.env` mein database name/credentials theek hain.
