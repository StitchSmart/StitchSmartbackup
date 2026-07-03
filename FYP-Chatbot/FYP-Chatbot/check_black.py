import json

with open("data/products.json", "r") as f:
    products = json.load(f)

for p in products:
    if "black" in p.get("name", "").lower():
        print(p.get("name"))
