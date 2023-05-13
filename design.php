<?php
header("Access-Control-Allow-Origin: *");

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

if(isset($_POST['submit'])){

   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'design/'.$image;
   $time = getdate();
   $m = $time["minutes"];
   $s = $time["seconds"];
   $insert = $bdd->query( "INSERT INTO `design`(origin,result,idperson,m,s) VALUES('".$image_folder."','".$image_folder."','".$user_id."','".$m."','".$s."')") or die('query failed');
   if($insert){
      move_uploaded_file($image_tmp_name, $image_folder);
      $message[] = 'registered successfully!';
      header('location:design.php');
   }else{
      $message[] = 'upload failed!';
   }
   
}
if(isset($_GET['undo'])){
      $select1 = $bdd->query( "SELECT MAX(m) as maxm FROM design WHERE idperson= '".$user_id."' ");
      $i=0;
      while($row=$select1->fetch()){
         $i=1;
         $m=$row['maxm'];
      }
      $select2 = $bdd->query( "SELECT MAX(s) as maxs FROM design WHERE idperson='".$user_id."' and m = '".$m."'  ") or die('query failed');
      $i=0;
      while($row=$select2->fetch()){
         $i=1;
         $s=$row['maxs'];
      }
      $select3 = $bdd->query( "SELECT * FROM design WHERE idperson='".$user_id."' and m = '".$m."' and s= '".$s."'") or die('query failed');
      $i=0;
      while($row=$select3->fetch()){
         $i=1;
         $id=$row['id'];
      }
      $bdd->query( "DELETE FROM design WHERE id ='".$id."' ") or die('query failed');
}
if(isset($_GET['cancal'])){
   $select1 = $bdd->query( "SELECT MAX(m) as maxm FROM design WHERE idperson= '".$user_id."' ");
      $i=0;
      while($row=$select1->fetch()){
         $i=1;
         $m=$row['maxm'];
      }
      $select2 = $bdd->query( "SELECT MAX(s) as maxs FROM design WHERE idperson='".$user_id."' and m = '".$m."'  ") or die('query failed');
      $i=0;
      while($row=$select2->fetch()){
         $i=1;
         $s=$row['maxs'];
      }
      $select3 = $bdd->query( "SELECT * FROM design WHERE idperson='".$user_id."' and m = '".$m."' and s= '".$s."'") or die('query failed');
      $i=0;
      while($row=$select3->fetch()){
         $i=1;
         $origin=$row['origin'];
      }
      
      $bdd->query( "DELETE FROM design WHERE origin='".$origin."' ") or die('query failed');
}
if(isset($_GET['thr'])){

   $select1 = $bdd->query( "SELECT MAX(m) as maxm FROM design WHERE idperson= '".$user_id."' ");
      $i=0;
      while($row=$select1->fetch()){
         $i=1;
         $m=$row['maxm'];
      }
      $select2 = $bdd->query( "SELECT MAX(s) as maxs FROM design WHERE idperson='".$user_id."' and m = '".$m."'  ") or die('query failed');
      $i=0;
      while($row=$select2->fetch()){
         $i=1;
         $s=$row['maxs'];
      }
      $select3 = $bdd->query( "SELECT result, origin FROM design WHERE idperson='".$user_id."' and m = '".$m."' and s= '".$s."'") or die('query failed');
      $i=0;
      while($row=$select3->fetch()){
         $i=1;
         $origin=$row['result'];
         $firstorigin=$row['origin'];

      }
      $seuil=$_GET['thrvalue'];
      /*echo $seuil;*/
      $command = escapeshellcmd("python python/thr.py ".$origin." ".$seuil);
      $r=exec( $command, $result, $return_var );
      /*echo $origin." ";
      print_r($result[0]);
      echo $r." ";*/
      $time = getdate();
      $m = $time["minutes"];
      $s = $time["seconds"];
      $insert = $bdd->query( "INSERT INTO `design`(origin,result,fonction,idperson,m,s) VALUES('".$firstorigin."','".$r."','thresholding','".$user_id."','".$m."','".$s."')") or die('query failed');
}


if(isset($_GET['zoom'])){

   $select1 = $bdd->query( "SELECT MAX(m) as maxm FROM design WHERE idperson= '".$user_id."' ");
      $i=0;
      while($row=$select1->fetch()){
         $i=1;
         $m=$row['maxm'];
      }
      $select2 = $bdd->query( "SELECT MAX(s) as maxs FROM design WHERE idperson='".$user_id."' and m = '".$m."'  ") or die('query failed');
      $i=0;
      while($row=$select2->fetch()){
         $i=1;
         $s=$row['maxs'];
      }
      $select3 = $bdd->query( "SELECT result, origin FROM design WHERE idperson='".$user_id."' and m = '".$m."' and s= '".$s."'") or die('query failed');
      $i=0;
      while($row=$select3->fetch()){
         $i=1;
         $origin=$row['result'];
         $firstorigin=$row['origin'];

      }
      $zval=$_GET['zoomvalue'];
      /*echo $seuil;*/
      $command = escapeshellcmd("python python/zoom.py ".$origin." ".$zval);
      $r=exec( $command, $result, $return_var );
      /*echo $origin." ";
      print_r($result[0]);
      echo $r." ";*/
      $time = getdate();
      $m = $time["minutes"];
      $s = $time["seconds"];
      $insert = $bdd->query( "INSERT INTO `design`(origin,result,fonction,idperson,m,s) VALUES('".$firstorigin."','".$r."','zoom','".$user_id."','".$m."','".$s."')") or die('query failed');
}


if(isset($_GET['filter'])){

   $select1 = $bdd->query( "SELECT MAX(m) as maxm FROM design WHERE idperson= '".$user_id."' ");
      $i=0;
      while($row=$select1->fetch()){
         $i=1;
         $m=$row['maxm'];
      }
      $select2 = $bdd->query( "SELECT MAX(s) as maxs FROM design WHERE idperson='".$user_id."' and m = '".$m."'  ") or die('query failed');
      $i=0;
      while($row=$select2->fetch()){
         $i=1;
         $s=$row['maxs'];
      }
      $select3 = $bdd->query( "SELECT result, origin FROM design WHERE idperson='".$user_id."' and m = '".$m."' and s= '".$s."'") or die('query failed');
      $i=0;
      while($row=$select3->fetch()){
         $i=1;
         $origin=$row['result'];
         $firstorigin=$row['origin'];

      }
      $f=$_GET['f'];
      /*echo $seuil;*/
      if ($f =="bw"){
      $command = escapeshellcmd("python python/bw.py ".$origin);}
      else{$command = escapeshellcmd("python python/blur.py ".$origin);}
      $r=exec( $command, $result, $return_var );
      /*echo $origin." ";
      print_r($result[0]);
      echo $r." ";*/
      $time = getdate();
      $m = $time["minutes"];
      $s = $time["seconds"];
      $insert = $bdd->query( "INSERT INTO `design`(origin,result,fonction,idperson,m,s) VALUES('".$firstorigin."','".$r."','filter','".$user_id."','".$m."','".$s."')") or die('query failed');
}

if(isset($_GET['save'])){

   $select1 = $bdd->query( "SELECT MAX(m) as maxm FROM design WHERE idperson= '".$user_id."' ");
      $i=0;
      while($row=$select1->fetch()){
         $i=1;
         $m=$row['maxm'];
      }
      $select2 = $bdd->query( "SELECT MAX(s) as maxs FROM design WHERE idperson='".$user_id."' and m = '".$m."'  ") or die('query failed');
      $i=0;
      while($row=$select2->fetch()){
         $i=1;
         $s=$row['maxs'];
      }
      $select3 = $bdd->query( "SELECT origin,result FROM design WHERE idperson='".$user_id."' and m = '".$m."' and s= '".$s."'") or die('query failed');
      $i=0;
      while($row=$select3->fetch()){
         $i=1;
         $origin=$row['origin'];
         $result=$row['result'];
      }
      $date=getdate();
      $j=$date['mday'];
      $m=$date['mon'];
      $y=$date['year'];
      $date=$j."/".$m."/".$y;
      $description=$_GET['cmt'];
      $r = substr($result, 6, -3)."png";
      $o = substr($origin, 6, -3)."png";
      $insert = $bdd->query( "INSERT INTO catalogue (idperson,adressphoto,adressoriginal,description,date, stars, status) VALUES('".$user_id."','".$r."','".$o."', '".$description."','".$date."', '0','private')") or die('query failed');
      copy($result, "catalogue/".substr($result, 6, -3)."png");
      copy($origin, "catalogue/".substr($origin, 6, -3)."png");

      $bdd->query( "DELETE FROM design WHERE origin='".$origin."' ") or die('query failed');
      
      
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>design</title>

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

 

<section class="about" id="about">
<form action="" method="post" class="book-form" enctype="multipart/form-data">

<div class="flex">
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message">'.$message.'</div>';
   }
}
?>
   <div class="image">
      <?php
      $select1 = $bdd->query( "SELECT MAX(m) as maxm FROM design WHERE idperson= '".$user_id."' ");
      $i=0;
      while($row=$select1->fetch()){
         $i=1;
         $m=$row['maxm'];
      }
      $select2 = $bdd->query( "SELECT MAX(s) as maxs FROM design WHERE idperson='".$user_id."' and m = '".$m."'  ") or die('query failed');
      $i=0;
      while($row=$select2->fetch()){
         $i=1;
         $s=$row['maxs'];
      }
      $select3 = $bdd->query( "SELECT * FROM design WHERE idperson='".$user_id."' and m = '".$m."' and s= '".$s."'") or die('query failed');
      $i=0;
      while($row=$select3->fetch()){
         $i=1;
         $image=$row['result'];
      }
      if (empty($image)){
      ?>
      <img id='output' src="images/image-not-found.png">
      <?php } else{
         ?><img id='output' src="<?php echo $image; ?>"> 
      <?php
      } ?>
   <input class="inputBox" style="height: 60px; width:120px" name="image" type="file"accept="image/jpg, image/jpeg, image/png" onchange="openFile(event)" /><br />
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
   <input type="submit" value="submit" class="btn" name="submit" >
   </div>

      </form>

   <div class="content">
      <!--<h3>Functions</h3>
      <p id="test">make your picture better</p>-->
      <!-- traitement image-->
      <form action="" method="get" class="book-form" enctype="multipart/form-data">
      
      <i style="padding-top:0.5rem; font-size: 3rem; margin-bottom: 2rem; color:var(--dark-bg);" class="fa-solid fa-rotate-left"></i>
      <input type="submit" value="undo" class="btn" name="undo" >
      
      <i style="padding-top:0.5rem; font-size: 3rem; margin-bottom: 2rem; color:var(--dark-bg);" class="fa-solid fa-ban"></i>
      <input type="submit" value="cancal" class="btn" name="cancal" >

      <div class="flex" style="display: flex; flex-wrap: wrap;gap:2rem;">
            
            

            <!--filter-->
            <select id="filter" name="f" style="width: 70%;
                                       padding:1.2rem 1.4rem;
                                       font-size: 1.6rem;
                                       color:#777;
                                       text-transform: none;
                                       margin-top: 1.5rem;
                                       border:var(--border);">
                                       <option style="color:var(--light-black);"value="blur" >Blur</option>
                                       <option style="color:var(--light-black);"value="bw" >Black&White</option>
            </select>
            <input type="submit" style="width: 15rem;
                                          height: 5rem;" value="filter" class="btn" name="filter" >
            <!--translate-->
            <!--<input id="x" style="width: 33.5%;padding:1.2rem 1.4rem;font-size: 1.6rem;color:#777;text-transform: none;margin-top: 1.5rem;border:var(--border);" placeholder="x " type="text" name="zoom"  class="inputBox">
            <input id="y" style="width: 33.5%;padding:1.2rem 1.4rem;font-size: 1.6rem;color:#777;text-transform: none;margin-top: 1.5rem;border:var(--border);" placeholder="y " type="text" name="zoom"  class="inputBox">
            <button id="translate" style="padding:1rem 0.5rem;height: 60px; width:120px; align-items: center; justify-content: center;" class="btn" pys-onClick="translate">translate</button>
      -->
            <!--zoom-->
            <div style="width:70%"class="inputBox">
               <input id="zoom_range" style="width: 100%;
                                          font-size: 1.6rem;
                                          text-transform: none;
                                          margin-top: 1.5rem;
                                          background: #2a38b4;" min="0" max="5" type="range" name="zoomvalue">
               <p style="margin-top:0rem;">Value: <output id="zoom_value" name="zoomvalue"></output></p>
            </div>
            
            <input type="submit" style="width: 15rem;
                                          height: 5rem;" value="zoom" class="btn" name="zoom" >
            <!--thresholding-->
            <div style="width:70%"class="inputBox">
               <input id="thresholding_range" style="width: 100%;
                                          font-size: 1.6rem;
                                          text-transform: none;
                                          margin-top: 1.5rem;
                                          background-color: #2a38b4;" min="0" max="225" type="range" name="thrvalue">
               <p style="margin-top:0rem;">Value: <output id="thresholding_value" ></output></p>
            </div>
            <script>
               const zoom_value = document.querySelector("#zoom_value")
               const zoom_input = document.querySelector("#zoom_range")
               zoom_value.textContent = zoom_input.value
               const thresholding_value = document.querySelector("#thresholding_value")
               const thresholding_input = document.querySelector("#thresholding_range")
               thresholding_value.textContent = thresholding_input.value
               thresholding_input.addEventListener("input", (event) => {
               thresholding_value.textContent = event.target.value
               })
               zoom_input.addEventListener("input", (event) => {
               zoom_value.textContent = event.target.value
               })
               </script>
            <input type="submit" style="width: 15rem;
                                          height: 5rem;" value="threshold" class="btn" name="thr" >
             <!--thresholding ends-->
      </div>

      <!--traitement image ends-->
   
      <div class="flex" style="display: flex; flex-wrap: wrap;gap:2rem;">
            <div class="inputBox">
               <p>Add a description</p>
               <textarea  name="cmt" style="background-color:rgba(204, 202, 202, 0.638);" rows="5" cols="70"  class="inputBox" ></textarea>
            </div>   
            <input type="submit" value="save" class="btn" name="save" >
      </div>
      </form>

   </div>

  
   
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