import cv2
import numpy

import sys



path = sys.argv[1]

# read image
src = cv2.imread(path, cv2.IMREAD_UNCHANGED)
 
# apply guassian blur on src image
res = cv2.cvtColor(src, cv2.COLOR_BGR2GRAY)
 
cv2.imwrite(path[:-4]+"_bw.png", res)
print(path[:-4]+"_bw.png")

