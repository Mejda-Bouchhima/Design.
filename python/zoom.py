import cv2 as cv
import sys



path = sys.argv[1]

z = sys.argv[2]


img = cv.imread(path)

h, w = img.shape[:2]

res = img[w-int((w/z)*(z-1)):w-int(w/z), h-int((h/z)*(h-1)):h-int(h/z)]


cv.imwrite(path[:-4]+"_zoom.png", res)
print(path[:-4]+"_zoom.png")