#!/bin/zsh
# StitchSmart Local Development Startup Script for macOS
echo "===================================================="
echo "      Starting StitchSmart Servers on macOS         "
echo "===================================================="

# Get project root folder
ROOT_DIR="$(cd "$(dirname "$0")/.." && pwd)"
cd "$ROOT_DIR"

# 1. Start PHP Web Server on Port 8000 (if not already running)
if lsof -i :8000 >/dev/null 2>&1; then
    echo "✔ PHP Web Server is already running on http://localhost:8000"
else
    echo "🚀 Starting PHP Web Server on port 8000..."
    /Applications/xampp/xamppfiles/bin/php -S 0.0.0.0:8000 router.php > /dev/null 2>&1 &
    echo "✔ PHP Web Server started at http://localhost:8000"
fi

# 2. Setup and Start Python FastAPI Chatbot on Port 5000
echo "🚀 Setting up Python AI Chatbot on port 5000..."
cd "$ROOT_DIR/FYP-Chatbot/FYP-Chatbot"

if [ ! -d "venv" ]; then
    echo "Creating Python virtual environment using Python 3.10..."
    if [ -x "/usr/local/bin/python3.10" ]; then
        /usr/local/bin/python3.10 -m venv venv
    elif command -v python3.11 >/dev/null 2>&1; then
        python3.11 -m venv venv
    elif command -v python3.10 >/dev/null 2>&1; then
        python3.10 -m venv venv
    else
        python3 -m venv venv
    fi
fi

source venv/bin/activate
echo "Checking dependencies..."
pip install -q --upgrade pip
pip install -q -r requirements.txt

# Check if port 5000 is running
if lsof -i :5000 >/dev/null 2>&1; then
    echo "✔ Python Chatbot server is already running on http://localhost:5000"
else
    echo "Starting Uvicorn Server on port 5000..."
    uvicorn app.main:app --host 0.0.0.0 --port 5000 > /dev/null 2>&1 &
    echo "✔ Python AI Chatbot started at http://localhost:5000"
fi

echo "===================================================="
echo " 🌐 StitchSmart Store:   http://localhost:8000      "
echo " 🤖 AI Chatbot API/UI:   http://localhost:5000      "
echo "===================================================="
