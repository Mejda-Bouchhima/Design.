<?php

include 'conn_bdd.php';
session_start();

if(isset($_POST['submit'])){

   $email =$_POST['email'];
   $pass = $_POST['password'];

   $select = $bdd->query("SELECT * FROM connexion WHERE email = '".$email."' AND password = '".$pass."'");

   $i=0;
   while($row=$select->fetch()){
      $i=1;
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['user_name'] = $row['full_name'];
      header('location:home_user.php');
   }
   if($i > 0){
   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

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

<!-- form login starts -->
<section class="booking">
<h1 class="heading-title">Login Now</h1>
<form action="" method="post" class="book-form">

   <div class="flex">
   <?php
   if(isset($message)){
      foreach($message as $message){
         echo '<div class="message">'.$message.'</div>';
      }
   }
   ?>
      <div class="inputBox">
         <input type="email" name="email" placeholder="enter email" class="inputBox" required>
      </div>
      <div class="inputBox">
      <input type="password" name="password" placeholder="enter password" class="inputBox" required>
      </div>
      <input type="submit" name="submit" value="login now" class="btn">
      <h3>don't have an account? <a href="join.php">join now</a></h3>

   </div>
</form>
</section>

<!-- Form login ends -->

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
</body>
</html>