# Python program to illustrate
# simple thresholding type on an image
	
# organizing imports
import cv2
import numpy as np
import sys



path = sys.argv[1]

s = sys.argv[2]

# path to input image is specified and
# image is loaded with imread command
img = cv2.imread(path)
(retVal, res) = cv2.threshold(img, int(s), 255, cv2.THRESH_BINARY)
cv2.imwrite(path[:-4]+"_thr.png", res)
print(path[:-4]+"_thr.png")
