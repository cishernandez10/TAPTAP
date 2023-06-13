<?php
session_start();
require 'config.php';

if (isset($_POST['submit'])) {

   $uname = mysqli_real_escape_string($conn, $_POST['uname']);
   $uemail = mysqli_real_escape_string($conn, $_POST['uemail']);
   $usid =  mysqli_real_escape_string($conn, $_POST['usid']);
   $urfid =  mysqli_real_escape_string($conn, $_POST['urfid']);
   $udepartment = $_POST['udepartment'];


   $select = " SELECT * FROM user_database WHERE urfid='".$urfid."'";

   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {

      $_SESSION['errorUserExist'] = "true";
      header('location:/register_user.php');
   } else {

         $insert = "INSERT INTO user_database(uname, uemail, usid, urfid, udepartment) VALUES('$uname','$uemail','$usid','$urfid','$udepartment')";
         mysqli_query($conn, $insert);
         $_SESSION['successAddUser'] = "true";
         header('location:/admin_page.php');
      
   }
};
