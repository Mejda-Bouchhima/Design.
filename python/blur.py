import cv2

import sys



path = sys.argv[1]

# read image
src = cv2.imread(path, cv2.IMREAD_UNCHANGED)
 
# apply guassian blur on src image
res = cv2.GaussianBlur(src,(10,10),cv2.BORDER_DEFAULT)
 
cv2.imwrite(path[:-4]+"_blur.png", res)
print(path[:-4]+"_blur.png")