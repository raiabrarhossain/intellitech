import base64
from PIL import Image, ImageDraw

def create_favicon_image(size):
    img = Image.new("RGBA", (size, size), (0, 0, 0, 0))
    draw = ImageDraw.Draw(img)
    
    # Scale factor
    s = size / 64.0
    
    # Outer squircle
    r = int(14 * s)
    draw.rounded_rectangle([int(2*s), int(2*s), int(62*s), int(62*s)], radius=r, fill=(33, 137, 255, 255))
    
    # Inner dark core
    draw.rounded_rectangle([int(12*s), int(12*s), int(52*s), int(52*s)], radius=int(8*s), fill=(10, 18, 38, 255))
    
    # Inner chip accent
    draw.rounded_rectangle([int(18*s), int(18*s), int(46*s), int(46*s)], radius=int(5*s), fill=(255, 255, 255, 255))
    
    # "iT" monogram
    # "i" dot
    draw.ellipse([int(23*s), int(22*s), int(29*s), int(28*s)], fill=(33, 137, 255, 255))
    # "i" stem
    draw.rectangle([int(23*s), int(31*s), int(29*s), int(42*s)], fill=(33, 137, 255, 255))
    # "T" top bar
    draw.rectangle([int(32*s), int(23*s), int(43*s), int(28*s)], fill=(6, 182, 212, 255))
    # "T" stem
    draw.rectangle([int(35.5*s), int(28*s), int(39.5*s), int(42*s)], fill=(6, 182, 212, 255))
    
    # Outer pins / dots
    pin_color = (255, 255, 255, 230)
    dot_r = max(1, int(2.5 * s))
    draw.ellipse([int(6*s), int(6*s), int(6*s) + dot_r, int(6*s) + dot_r], fill=pin_color)
    draw.ellipse([int(54*s), int(6*s), int(54*s) + dot_r, int(6*s) + dot_r], fill=pin_color)
    draw.ellipse([int(6*s), int(54*s), int(6*s) + dot_r, int(54*s) + dot_r], fill=pin_color)
    draw.ellipse([int(54*s), int(54*s), int(54*s) + dot_r, int(54*s) + dot_r], fill=(16, 185, 129, 255)) # green live dot
    
    return img

# Generate images
img16 = create_favicon_image(16)
img32 = create_favicon_image(32)
img48 = create_favicon_image(48)
img64 = create_favicon_image(64)
img180 = create_favicon_image(180)
img192 = create_favicon_image(192)

# Save multi-res ICO
img64.save("favicon.ico", format="ICO", sizes=[(16,16), (32,32), (48,48), (64,64)])
img64.save("assets/images/favicon.ico", format="ICO", sizes=[(16,16), (32,32), (48,48), (64,64)])

# Save PNGs
img32.save("assets/images/favicon-32x32.png", format="PNG")
img192.save("assets/images/favicon-192x192.png", format="PNG")
img180.save("assets/images/apple-touch-icon.png", format="PNG")

# Generate SVG
svg_content = '''<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
  <defs>
    <linearGradient id="itFavGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#2189ff" />
      <stop offset="50%" stop-color="#0284c7" />
      <stop offset="100%" stop-color="#06b6d4" />
    </linearGradient>
  </defs>
  <rect x="2" y="2" width="60" height="60" rx="14" fill="url(#itFavGrad)" />
  <rect x="12" y="12" width="40" height="40" rx="8" fill="#0a1226" />
  <rect x="18" y="18" width="28" height="28" rx="5" fill="#ffffff" />
  <!-- iT Monogram -->
  <circle cx="26" cy="25" r="3" fill="#2189ff" />
  <rect x="23" y="31" width="6" height="11" rx="1.5" fill="#2189ff" />
  <rect x="32" y="23" width="11" height="5" rx="1" fill="#06b6d4" />
  <rect x="35.5" y="28" width="4" height="14" rx="1" fill="#06b6d4" />
  <!-- Live Signal LED -->
  <circle cx="54" cy="54" r="2.5" fill="#10b981" />
  <circle cx="10" cy="10" r="2" fill="#ffffff" opacity="0.8" />
</svg>'''

with open("assets/images/favicon.svg", "w", encoding="utf-8") as f:
    f.write(svg_content)
with open("favicon.svg", "w", encoding="utf-8") as f:
    f.write(svg_content)

# Base64 data URI
b64 = base64.b64encode(svg_content.encode("utf-8")).decode("utf-8")
data_uri = f"data:image/svg+xml;base64,{b64}"
with open("data/favicon_data_uri.txt", "w", encoding="utf-8") as f:
    f.write(data_uri)

print("Generated all favicon assets successfully! Data URI length:", len(data_uri))
