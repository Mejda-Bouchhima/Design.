<?php
header("Access-Control-Allow-Origin: *");
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>profile</title>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <link rel="stylesheet" href="https://pyscript.net/alpha/pyscript.css" />
   <script defer src="https://pyscript.net/alpha/pyscript.js"></script>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <script src="https://kit.fontawesome.com/513d03802a.js" crossorigin="anonymous"></script>


</head>
  <body>

  <img id='output' src="images/image-not-found.png">
   <input class="inputBox" style="height: 60px; width:120px" type="file"accept="image/jpg, image/jpeg, image/png" onchange="openFile(event)" /><br />
   <script>
      var dataURL;
      var openFile = function(file) {
         var input = file.target;
         var reader = new FileReader();
         reader.onload = function(){
            dataURL = reader.result;
            var output = document.getElementById('output');
            output.src = dataURL;
         };
         reader.readAsDataURL(input.files[0]);
         };
    
   </script>
  <!-- thirdparty dependencies added here -->
 <py-env>
    - numpy 
    - matplotlib
    - cv2
  </py-env> 
  <py-script>
import numpy as np
import cv2
import matplotlib.pyplot as plt
"""arr = np.array([1, 2, 3, 4, 5])
plt.plot(arr)
plt"""
img =document.getElementById('output')
org = cv2.imread(img.src)
gray_image = cv2.cvtColor(org, cv2.COLOR_BGR2GRAY)
gray_image.save("imagetest.jpg")
  <py-script>
  </body>
</html>