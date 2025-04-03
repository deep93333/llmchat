import os
import requests
import json
from pathlib import Path

# Zapier webhook
ZAPIER_WEBHOOK = "https://hooks.zapier.com/hooks/catch/20829203/2clbbrw/"

def post_article(file_path):
    # Read markdown content
    with open(file_path, 'r') as f:
        content = f.read()
    
    # Extract title from first line
    title = content.split('\n')[0].replace('# ', '').strip()
    
    # Prepare post data
    post_data = {
        "title": title,
        "content": content,
        "status": "draft"
    }
    
    print(f"\nSending article: {title}")
    print(f"Content length: {len(content)} characters")
    
    # Send to Zapier
    try:
        response = requests.post(
            ZAPIER_WEBHOOK,
            json=post_data,
            headers={'Content-Type': 'application/json'}
        )
        
        print(f"Status Code: {response.status_code}")
        print(f"Response: {response.text}")
        
        if response.status_code == 200:
            print(f"✅ Successfully posted: {title}")
        else:
            print(f"❌ Failed to post {title}: {response.status_code}")
    except Exception as e:
        print(f"❌ Error posting {title}: {str(e)}")

def main():
    # Get all markdown files from articles directory
    markdown_files = sorted(Path('articles').glob('article*.md'))
    
    print(f"Found {len(markdown_files)} articles to post...")
    
    # Post each file
    for file_path in markdown_files:
        post_article(file_path)

if __name__ == "__main__":
    main() 