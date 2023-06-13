<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
   
<div class="container">

   <div class="content">
   <img src="images/taptap.png" alt="taptapLogo" style="width:250px;height:250px;">
      <h1>welcome admin <span><?php echo $_SESSION['admin_name'] ?></span>!</h1>
        <p class="amet_text">TAPTAP is an user access system that records the user's utilization wby logging <br>
          their information, which is automatically detected by tapping their IDs.
        <br><br>
          This RFID Technology aims on scanning both previous and current users, <br>
          automating computer power on and off, and user validation through scanning.
      </p>
      <p></p>
      <a href="register_user.php" class="btn">Register User</a>
      <a href="register_form.php" class="btn">Register Admin</a>
      <a href="view_ulogsdb.php" class="btn">View Users Log</a>
      <a href="view_udb.php" class="btn">View Users Database</a>
      <br> <br>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>
    <?php
       if (isset($_SESSION['successAddUser'])) {
        echo "<script>Swal.fire({position:'center',icon:'success',title:'Successfully Added User',showConfirmButton:false,timer:1000});</script>";
        unset($_SESSION['successAddUser']);
    }

    ?>
</body>
</html>