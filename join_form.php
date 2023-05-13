<?php

include 'conn_bdd.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $phone =  $_POST['phone'];
   $age =  $_POST['age'];
   $city = $_POST['city'];
   $email = $_POST['email'];
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'user_photo/'.$image;

   $select = $bdd->query( "SELECT * FROM `connexion` WHERE email = '".$email."' and password = '".$pass."'") or die('query failed');
   $i=0;
   while($row=$select->fetch()){
      $i=1;
   }
   if($i > 0){
      $message[] = 'member already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
         header('location:join.php');
      }elseif($image_size > 2000000){
         $message[] = 'image size is too large!';
         header('location:join.php');
      }else{
         $insert = $bdd->query( "INSERT INTO connexion (full_name,photo,phone,age,city, email, password) VALUES('".$name."','".$image."','".$phone."', '".$age."','".$city."','".$email."', '".$pass."')") or die('query failed');

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header('location:login.php');
         }else{
            $message[] = 'registeration failed!';
         }
      }
   }

}

?>
