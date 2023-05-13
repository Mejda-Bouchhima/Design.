<?php 
include 'conn_bdd.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

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

<!-- home section starts  -->

<section class="home">

   <div class="swiper home-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide" style="background:url(images/home-slide1.jpg) no-repeat">
            <div class="content">
               <h3>Details</h3>
               <a href="join.php" class="btn">join now</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/home-slide-2.jpg) no-repeat">
            <div class="content">
               <h3>Bright</h3>
               <a href="join.php" class="btn">join now</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/home-slide3.jpg) no-repeat">
            <div class="content">
               <h3>Black&White</h3>
               <a href="join.php" class="btn">join now</a>
            </div>
         </div>
         
      </div>

      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>

   </div>

</section>

<!-- home section ends -->

<!-- services section starts  -->

<section class="services" id="services">

   <h1 class="heading-title"> our services </h1>

   <div class="box-container">

      <div class="box">
         <h3>seuillage</h3>
      </div>

      <div class="box">
         <h3>light adjustment</h3>
      </div>

      <div class="box">
         <h3>Reframing</h3>
      </div>

      <div class="box">
         <h3>color setting</h3>
      </div>
      

   </div>

</section>

<!-- services section ends -->

<!-- about section starts  -->

<section class="about" id="about">

   <div class="image">
      <img src="images/about-img.jpg" alt="">
   </div>

   <div class="content">
      <h3>why choose us?</h3>
      <p>Discover your skills in design.</p>
      <p>Make beautifull pictures and collect Likes.</p>
      <div class="icons-container">
         <div class="icons">
            <i class="fas fa-map"></i>
            <span>create your catalogue</span>
         </div>
         <div class="icons">
            <i class="fas fa-hand-holding-usd"></i>
            <span>free</span>
         </div>
         
      </div>
   </div>

</section>

<!-- about section ends -->

<!-- reviews section starts  -->

<section class="reviews">

   <h1 class="heading-title"> users reviews </h1>

   <div class="swiper reviews-slider">

      <div class="swiper-wrapper">
      <?php
    
            $reponse = $bdd->query('SELECT * FROM comments');
            
            while ($donnees = $reponse->fetch())

                {
                  

                ?>
                <div class="swiper-slide slide">
                     <div class="stars">
                        <?php $i=0;
                              while($i<$donnees['stars']){
                                 ?>
                                 <i class="fas fa-star"></i>
                                 <?php
                                 $i=$i+1;
                              }?>
                     </div>
                     <p><?php echo $donnees['comment']; ?></p>
                     
                     <?php $id = $donnees['idperson'];
                           $result = $bdd->query("SELECT * FROM `connexion` WHERE id = '$id'");
                           while($row = $result->fetch()) {
                              $photo = $row['photo'];
                              $name = $row['full_name'];
                           }
                           ?>
                              <h3><?php echo $name; ?></h3>
                              <span>designer</span>
                              <?php if (!empty($photo)){?>
                                <img src="user_photo/<?php echo $photo; ?>" alt="">
                              <?php }else{?>
                                 <img src="images/default-avatar.png" alt="">
                              <?php }?>

                </div>
                <?php
                }
            $reponse->closeCursor();
        ?>

         

      </div>

   </div>

</section>

<!-- reviews section ends -->



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
         <a href="#about"> <i class="fas fa-angle-right"></i> about us</a>
         <a href="#"> <i class="fas fa-angle-right"></i> privacy policy</a>
         <a href="#services"> <i class="fas fa-angle-right"></i> terms of use</a>
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