import urllib.request
import re

print("Fetching pages from localhost server...")

try:
    with urllib.request.urlopen('http://localhost:8000/', timeout=5) as r:
        home_html = r.read().decode('utf-8', errors='ignore')

    with open('standalone.html', 'w', encoding='utf-8') as f:
        f.write(home_html)
    with open('index.html', 'w', encoding='utf-8') as f:
        f.write(home_html)
    print(f"Generated standalone.html & index.html successfully ({len(home_html)} bytes)!")
except Exception as e:
    print("Error:", e)
