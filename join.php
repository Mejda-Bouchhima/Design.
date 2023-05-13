<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>join</title>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->

<section class="header">

   <a href="home.php" class="logo">Design.</a>

   <nav class="navbar">
      <a href="home.php">home</a>
      <a href="join.php">join</a>
      <a href="login.php">login</a>
   </nav>

   <div id="menu-btn" class="fas fa-bars"></div>

</section>

<!-- header section ends -->

<div class="heading" style="background:url(images/header-bg-3.png) no-repeat">
   <h1>join now</h1>
</div>

<!-- booking section starts  -->

<section class="booking">

   <h1 class="heading-title">Welcom!</h1>

   <form action="join_form.php" method="post" class="book-form" enctype="multipart/form-data">

      <div class="flex">
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
         <div class="inputBox">
            <span>Full name :</span>
            <input type="text" name="name"  class="inputBox" required>
         </div>
         <div class="inputBox">
            <span>Email :</span>
            <input type="email" name="email" class="inputBox" required>
         </div>
         
         <div class="inputBox">
            <span>Phone :</span>
            <input type="text" name="phone"  class="inputBox" required>
         </div>
         
         
         <div class="inputBox">
            <span>Password :</span>
            <input type="password" name="password"  class="inputBox" required>
         </div>
         
         <div class="inputBox">
            <span>Age :</span>
            <input type="text" name="age"  class="inputBox" required>
         </div>
         
         <div class="inputBox">
            <span>Confirm password :</span>
            <input type="password" name="cpassword"  class="inputBox" required>
         </div>
         <div class="inputBox">
            <span>Photo :</span>
            <input type="file" name="image" class="inputBox" accept="image/jpg, image/jpeg, image/png">
         </div>
         <div class="inputBox">
            <span>City :</span>
            <select style="width: 100%;
                                       padding:1.2rem 1.4rem;
                                       font-size: 1.6rem;*
                                       color:#777;
                                       text-transform: none;
                                       margin-top: 1.5rem;
                                       border:var(--border);" name="city"  required>
                  <option value="sfax">Sfax</option>
                  <option value="tunis">Tunis</option> 
                  <option value="nabel">Nabel</option>
                  <option value="kairouan">Kairouan</option>
                  <option value="Sidi bouzid">sidi bouzid</option>   
                  <option value="tataouine">Tataouine</option>
                  <option value="gafsa">Gafsa</option> 
                  <option value="mednine">Mednine</option>
                  <option value="hamamet">Hamamet</option>   
                  <option value="sousse">Sousse</option> 
                  <option value="mistir">Mistir</option>
                  <option value="gebes">Gebes</option>   
                  <option value="jendouba">Jendouba</option>
                  <option value="touzer">Touzer</option> 
                  <option value="cass">3Licence</option>
            </select>
         </div>
         
         
      
      </div>
      <h3>already have an account? <a href="login.php">login now</a></h3>
      
      <input type="submit" value="submit" class="btn" name="submit">

   </form>

</section>

<!-- booking section ends -->

















<!-- footer section starts  -->

<section class="footer">

   <div class="box-container">

      <div class="box">
         <h3>quick links</h3>
         <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
         <a href="join.php"> <i class="fas fa-angle-right"></i> join</a>
         <a href="login.php"> <i class="fas fa-angle-right"></i> login</a>

      </div>

      <div class="box">
         <h3>extra links</h3>
         <a href="#"> <i class="fas fa-angle-right"></i> ask questions</a>
         <a href="home.php#about"> <i class="fas fa-angle-right"></i> about us</a>
         <a href="#"> <i class="fas fa-angle-right"></i> privacy policy</a>
         <a href="home.php#services"> <i class="fas fa-angle-right"></i> terms of use</a>
      </div>

      <div class="box">
         <h3>contact info</h3>
         <a href="#"> <i class="fas fa-phone"></i> +216 28 207 907 </a>
         <a href="mailto:mejda.bouchhima@ieee.org"> <i class="fas fa-envelope"></i> mejda.bouchhima@ieee.org </a>
         <a href="#"> <i class="fas fa-map"></i> sfax, tunisia - 3062 </a>
      </div>

      <div class="box">
         <h3>follow us</h3>
         <a href="https://www.facebook.com/mejda.bouchhima"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="https://www.linkedin.com/in/mejda-bouchhima-646873220/"> <i class="fab fa-linkedin"></i> linkedin </a>
      </div>

   </div>

   <div class="credit"> created by <span>ms. Mejda Bouchhima</span> | all rights reserved! </div>

</section>

<!-- footer section ends -->









<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>