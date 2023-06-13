<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register form</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="form-container">

        <form action="/createUser.php" method="post">
            <h3>User Registration</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                };
            };
            ?>
            <input type="text" name="uname" required placeholder="enter your name">
            <input type="email" name="uemail" required placeholder="enter your email">
            <input type="int" name="usid" required placeholder="enter your student id">
            <input type="varchar" name="urfid" required placeholder="confirm your rfid">
            <select name="udepartment">
                <option value="CCS">College of Computer Studies</option>
                <option value="CAS">College of Arts and Sciences</option>
                <option value="EDUC">College of Education and Criminology</option>
                <option value="CRIM">College of Criminology</option>
                <option value="CEAA">College of Enginnering Architecure and Avitation</option>
                <option value="CBA">College of Business and Accountancy</option>
                <option value="CIHM">College of International Hospitality Manegment</option>
                <option value="CME">College of Maritime Education</option>
                <option value="BE">Basic Education</option>
            </select>
            <input type="submit" name="submit" value="register now" class="form-btn">
            <p><a href="admin_page.php">Main page</a></p>
        </form>

    </div>
    <?php
  
    if (isset($_SESSION['errorUserExist'])) {
        echo "<script>Swal.fire({position:'center',icon:'warning',title:'User Already Exist, Please Try New User',showConfirmButton:false,timer:1000});</script>";
        unset($_SESSION['errorUserExist']);
    }
    ?>
</body>

</html>