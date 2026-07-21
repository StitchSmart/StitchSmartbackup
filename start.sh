#!/bin/bash

# Ensure storage directories exist (will be in the persistent volume if mounted)
mkdir -p /app/storage/products
mkdir -p /app/storage/category
mkdir -p /app/storage/banners
mkdir -p /app/storage/user_designs

# Replace ephemeral folders with symlinks to the persistent storage
rm -rf /app/public/pictures/products
ln -s /app/storage/products /app/public/pictures/products

rm -rf /app/public/pictures/category
ln -s /app/storage/category /app/public/pictures/category

rm -rf /app/public/pictures/banners
ln -s /app/storage/banners /app/public/pictures/banners

rm -rf /app/public/pictures/user_designs
ln -s /app/storage/user_designs /app/public/pictures/user_designs

# Start the Python FastAPI Chatbot in the background
cd FYP-Chatbot/FYP-Chatbot
uvicorn app.main:app --host 127.0.0.1 --port 5000 &

# Start the PHP Web App on the dynamically assigned PORT
cd /app
php -S 0.0.0.0:$PORT router.php
