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
if(isset($_POST['like'])){
    $id = $_POST['id'];
    $verif = $bdd->query( "SELECT * FROM `likes` WHERE idphoto = '$id' AND idperson = '$user_id'") or die('query failed');
    $exist = 0;
    while($v = $verif->fetch()) {
        $exist = 1;
    }
    $result = $bdd->query( "SELECT * FROM `likes` WHERE idphoto = '$id'") or die('query failed');
    $stars=0;
    while($row = $result->fetch()) {
        $stars = $stars+1;
    }

    
    if ($exist==1){
        $stars = $stars-"1";
        $bdd->query( "DELETE  FROM `likes` WHERE idphoto = '$id' AND idperson = '$user_id'");
    }else{
        $stars = $stars+"1";
        $bdd->query( "INSERT INTO `likes` (idperson, idphoto) values ('$user_id', '$id')");
    }
    $i = settype($stars,"string");
    
      // Afficher les résultats de chaque ligne
      
    $bdd->query( "UPDATE `catalogue` SET stars = '$stars' WHERE idphoto = '$id'") or die('query failed');
 
    
 }

 if(isset($_GET['send_comment'])){
    $comment = $_GET['cmt'];
    $stars = $_GET['str'];

    $bdd->query( "INSERT INTO comments (idperson, comment, stars) values ('$user_id', '$comment','$stars')");
}
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








<!-- packages section starts  -->

<section class="packages">

   <h1 class="heading-title">Designers Community</h1>

   <div class="box-container">

   <?php
    
            $reponse = $bdd->query('SELECT * FROM catalogue');
            while ($donnees = $reponse->fetch())
            {   $status = $donnees['status'];
                $idph = $donnees['idphoto'];
                if ($status == "public"){

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
                              <div class="icons" >
                                    <span style="margin-right: 2rem; font-weight: bold; font-size: 2.5rem; color:#222;"><?php echo $donnees['stars']; ?></span>
                                    <?php   
                                            $verif = $bdd->query( "SELECT * FROM `likes` WHERE idphoto = '$idph' AND idperson = '$user_id'") or die('query failed');
                                            $exist = 0;
                                            while($v = $verif->fetch()) {
                                                $exist = 1;
                                            }
                                            if($exist == "1"){?>
                                            <i style="  font-size: 3rem; margin-bottom: 2rem; color:#2a38b4;" class="fa-sharp fa-solid fa-heart"></i>
                                            <?php }else{ ?>
                                                <i style="  font-size: 3rem; margin-bottom: 2rem; color:#2a38b4;" class="fa-regular fa-heart"></i>
                                            <?php } ?>
                                    
                              </div>
                              </div>
                            </div>
                            <p> <?php echo $donnees['description']; ?></p>
                        </div>
                        <form style="display: flex; align-items:center; justify-content: flex-end;" action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $donnees['idphoto']; ?>" class="btn">
                            <input style="display: flex; align-items:center; justify-content: flex-end;" type="submit" name="like" value="Like" class="btn">
                        </form>
                    </div>

                    <?php

                }
            }
            $reponse->closeCursor();
        ?>
   </div>

</section>

<!-- packages section ends -->




<section class="booking">
    <form class="book-form" action="" method="get" enctype="multipart/form-data">   
        <div class="flex">                         
                
            <div class="inputBox">
                <span>Rate the app :</span>
                <select style="width: 100%;
                                        padding:1.2rem 1.4rem;
                                        font-size: 1.6rem;*
                                        color:#777;
                                        text-transform: none;
                                        margin-top: 1.5rem;
                                        border:var(--border);" name="str"  required>
                    <option value="1">1</option>
                    <option value="2">2</option> 
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>     
                </select>
            </div>
            <div class="inputBox">
                    <textarea  name="cmt"  rows="5" cols="70" placeholder="Leave us a comment" class="inputBox" ></textarea>
            </div>
        </div>
        <input type="submit" value="send" name="send_comment" class='btn' >

    </form> 
</section>






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