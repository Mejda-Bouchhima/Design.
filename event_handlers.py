"""import cv2
def image(e):
    img =document.getElementById('output')
    org = cv2.imread(img.src)
    cv2.imshow('image', org)
def noisy(e):
    source =document.getElementById('output')
    img = cv2.imread(source.src)
    median = cv2.medianBlur(img,5)

def gauss(e):
    source =document.getElementById('output')
    img = cv2.imread(source.src)
    gb = cv2.GaussianBlur(img, (3,3), 1,1)
def bilat():
    source =document.getElementById('output')
    img = cv2.imread(source.src)
    gb = cv2.GaussianBlur(img, (3,3), 1,1)
    bilateral = cv2.bilateralFilter(img,9,75,75)

def brightness():
    import PIL
    from PIL import ImageEnhance

    img = PIL.Image.open('wat_pho.png')
    converter = ImageEnhance.Brightness(img)
    img2 = converter.enhance(0.5)
    img3 = converter.enhance(2)


img =document.getElementById('output')
org = cv2.imread(img.src)
gray_image = cv2.cvtColor(org, cv2.COLOR_BGR2GRAY)
gray_image.save("imagetest.jpg")"""
print('hi')