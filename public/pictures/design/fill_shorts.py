from PIL import Image, ImageDraw

img = Image.open('c:/xampp/htdocs/Stitch-Smart/public/pictures/design/shorts.png').convert('RGBA')
w, h = img.size
magic = (255, 0, 255, 255)

ImageDraw.floodfill(img, (0, 0), magic, thresh=10)
ImageDraw.floodfill(img, (w-1, 0), magic, thresh=10)
ImageDraw.floodfill(img, (0, h-1), magic, thresh=10)
ImageDraw.floodfill(img, (w-1, h-1), magic, thresh=10)

pixels = img.load()
print('Floodfilled outside')
n_inside = 0

for y in range(h):
    for x in range(w):
        if pixels[x, y] != magic:
            n_inside += 1
            r, g, b, a = pixels[x, y]
            if a < 100:
                pixels[x, y] = (237, 237, 237, 255)
            else:
                pixels[x, y] = (0, 0, 0, 255)
        else:
            pixels[x, y] = (0, 0, 0, 0)

print('Inside px:', n_inside)
img.save('c:/xampp/htdocs/Stitch-Smart/public/pictures/design/empty_shorts.png')
