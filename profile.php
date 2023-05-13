<?php

include 'conn_bdd.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:home.php');
}
if(isset($_POST['change_status'])){
   $id = $_POST['id'];
   $result = $bdd->query( "SELECT status FROM `catalogue` WHERE idphoto = '$id'") or die('query failed');
   
   
   
     // Afficher les résultats de chaque ligne
     while($row = $result->fetch()) {
      $status = $row['status'];
     }
   
   if($status == "public") {
       $bdd ->query("UPDATE `catalogue` SET status = 'private' WHERE idphoto = '$id'") or die('query failed'); 
   }else{
       $bdd->query( "UPDATE `catalogue` SET status = 'public' WHERE idphoto = '$id'") or die('query failed');

   }
}
if(isset($_POST['delete'])){
   $id = $_POST['id'];
   $bdd->query( "DELETE FROM `catalogue` WHERE idphoto = '$id'") or die('query failed');
   $bdd->query( "DELETE FROM `likes` WHERE idphoto = '$id'") or die('query failed'); 
   $file = $_POST['adressphoto'];
   if(!empty($file))
   {$status=unlink($file); }
}

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

<!-- profile section starts --> 

<section class="about" id="about">
   <div class="image">
   <?php
            $select = $bdd->query( "SELECT * FROM `connexion` WHERE id = '$user_id'");
            $i=0;
            while($row=$select->fetch()){
               $fetch=$row;
               $i=1;
            }
            if($fetch['photo'] == ''){
               echo '<img src="images/default-avatar.png">';
            }else{
               echo '<img src="user_photo/'.$fetch['photo'].'">';
            }

         ?>
   </div>

   <div class="content">
      <h3><?php echo $fetch['full_name']; ?></h3>
      <p>designer</p>
      <div class="icons-container">
         <div class="icons">
         <i class="fa-solid fa-cake-candles"></i>
         <span><?php echo $fetch['age']; ?></span>
         </div>
         <div class="icons">
         <i class="fa-solid fa-house"></i>
         <span><?php echo $fetch['city']; ?></span>
         </div>
         <div class="icons">
            <i class="fas fa-phone"></i>
            <span><?php echo $fetch['phone']; ?></span>
         </div>
         <div class="icons">
            <i class="fas fa-envelope"></i>
            <span><?php echo $fetch['email']; ?></span>
         </div>  
      </div>
      <a href="update_profile.php" class="btn">update profile</a>
   </div>

</section>
<!-- profile section ends --> 







<!-- packages section starts  -->

<section class="packages">

   <h1 class="heading-title">Your catalogue</h1>
   <a href="design.php" class="btn">add</a>

   <div class="box-container">

   <?php
    
            $reponse = $bdd->query("SELECT * FROM catalogue where idperson='$user_id'");
            
            while ($donnees = $reponse->fetch())

                {

                ?>

                <div class="box">
                    <div class="image">
                        <?php if ($donnees['adressphoto'] != ""){?>
                            <img src="catalogue/<?php echo $donnees['adressphoto']; ?>" alt="">
                        <?php }else{ ?>
                            <img src="images/image-not-found.png" alt="">
                        <?php } ?>
                    </div>
                    <div class="image">
                        <?php if ($donnees['adressoriginal'] != ""){?>
                            <img src="catalogue/<?php echo $donnees['adressoriginal']; ?>" alt="">
                        <?php }else{ ?>
                            <img src="images/image-not-found.png" alt="">
                        <?php } ?>
                    </div>
                    
                    <div class="content">
                        <?php $res = $bdd->query("SELECT full_name FROM connexion WHERE id='".$donnees['idperson']."'");
                            while ($d = $res->fetch())
                                { $name = $d['full_name'];}
                        ?>
                           <div style="display: flex; align-items:center; justify-content: space-between;">
                              <h4 style="font-weight: bold; font-size: 2.5rem; color:#222;"><?php echo $donnees['date']; ?></h4>
                              <h3><?php echo $name; ?></h3>
                              <div class="icons-container">
                              <div class="icons">
                                 <span style="font-weight: bold; font-size: 2.5rem; color:#222;"><?php echo $donnees['stars']; ?></span>
                                 <i style="margin: 2rem; font-size: 3rem; margin-bottom: 2rem; color:#2a38b4;" class="fa-sharp fa-solid fa-heart"></i>
                                 <!--<i class="fa-light fa-heart"></i>-->
                                 
                              </div>
                              </div>
                            </div>

                            
                            
                            <p> <?php echo $donnees['description']; ?></p>
                    </div>
                    <div style="display: flex; align-items:center; justify-content: space-around;" id="form">
                        <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $donnees['idphoto']; ?>" class="btn">
                        <input type="hidden" name="adressphoto" value="catalogue/<?php echo $donnees['adressphoto']; ?>" class="btn">
                        <input type="submit" name="delete" value="Delete" class="btn">
                        </form>
                        
                        <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $donnees['idphoto']; ?>" class="btn">
                        <?php if ($donnees['status']=="public"){?>
                            <input type="submit" name="change_status" value="public" class="btn">
                            <?php 
                            }else{?>
                            <input type="submit" name="change_status" value="private" class="btn">
                            <?php } ?>
                        </form>

                    </div>
                </div>

                <?php

            }
            
            $reponse->closeCursor();
        ?>
   </div>

</section>

<!-- packages section ends -->


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