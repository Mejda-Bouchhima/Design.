<?php

include 'conn_bdd.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['update_profile'])){

   $update_name =  $_POST['update_name'];
   $update_email = $_POST['update_email'];
   $update_city = $_POST['update_city'];
   $update_age = $_POST['update_age'];
   $update_phone = $_POST['update_phone'];


   $old_pass = $_POST['old_pass'];
   $update_pass = $_POST['update_pass'];
   $new_pass = $_POST['new_pass'];
   $bdd->query( "UPDATE `connexion` SET full_name = '$update_name', email = '$update_email', city = '$update_city',age = '$update_age', phone = '$update_phone' WHERE id = '$user_id'");

   if(!empty($update_pass) || !empty($new_pass) ){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }else if(!empty($new_pass)) {
         $bdd->query( "UPDATE `connexion` SET password = '$new_pass' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }

   
   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'user_photo/'.$update_image;
   if(!empty($update_image)){
      

      if($update_image_size > 2000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = $bdd->query( "UPDATE `connexion` SET photo = '$update_image' WHERE id = '$user_id'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'image updated succssfully!';
      }
   }else{$message[] = 'Coud not apload the image!';}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <script src="https://kit.fontawesome.com/513d03802a.js" crossorigin="anonymous"></script>


</head>
<body>
<!-- header section starts  -->

<section class="header">

   <a href="home.php" class="logo">Design.</a>

   <nav class="navbar">
      <a href="home_user.php">home</a>
      <a href="profile.php">profile</a>
      <a href="design.php">design</a>
      <a href="home_user.php?logout=true">logout</a>
   </nav>

   <div id="menu-btn" class="fas fa-bars"></div>

</section>

<!-- header section ends -->


<!-- update section starts -->

<section class="booking">

   <h1 class="heading-title">Update your profile</h1>
   <?php
      $select = $bdd->query( "SELECT * FROM `connexion` WHERE id = '$user_id'") or die('query failed');
      $i=0;
      while($row=$select->fetch()){
         $i=1;
         $fetch = $row;
      }
   ?>
   <form action="" method="post" class="book-form" enctype="multipart/form-data">
      <?php
         if(isset($message)){
            foreach($message as $message){
               echo '<p>'.$message.'<p>';
            }
         }
      ?>     
       <div class="flex">
      
      
         <div class="inputBox">
            <span>Full name :</span>
            <input type="text" name="update_name" value="<?php echo $fetch['full_name']; ?>" class="inputBox">         
         </div>
         <div class="inputBox">
            <span>Age :</span>
            <input type="text" name="update_age"  value="<?php echo $fetch['age']; ?>" class="inputBox" required>
         </div>
         <div class="inputBox">
            <span>Phone :</span>
            <input type="text" name="update_phone" value="<?php echo $fetch['phone']; ?>" class="inputBox">
         </div>
         <div class="inputBox">
            <span>City :</span>
            <input type="text" name="update_city" value="<?php echo $fetch['city']; ?>" class="inputBox">
         </div>
         <div class="inputBox">
            <span>Photo :</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="inputBox">
         </div>
         <div class="inputBox">
            <span>Email :</span>
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="inputBox">
         </div>
         
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>old password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="inputBox">
         </div>
         
        
         
         <div class="inputBox">
            <span>New password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="inputBox">
         </div>
         
         
         
         
      
      </div>
      <h3>Nothing to change? <a href="profile.php">go back</a></h3>
      
      <input type="submit" value="update" class="btn" name="update_profile">

   </form>

</section>
<!-- update section ends -->


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