<?php
$mysqli = new mysqli('localhost','jbwcnczn_coreadmin','taptapadmin0110','jbwcnczn_user_db');
$search = "";
if(isset($_POST["search"])){
    $search = $_POST["search"];
    $sql = "SELECT uname, uemail, usid, urfid,deviceName, udepartment,created_at,status FROM vwUserLogs WHERE uname LIKE '%{$search}%' OR uemail LIKE '%{$search}%' OR usid LIKE '%{$search}%' OR urfid LIKE '%{$search}%' OR deviceName LIKE '%{$search}%' OR udepartment LIKE '%{$search}%' ORDER BY created_at DESC LIMIT 50";
}else{
    $sql = "SELECT uname, uemail, usid, urfid,deviceName, udepartment,created_at,status FROM vwUserLogs ORDER BY created_at DESC LIMIT 50";
}
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$user = array();
while ($row = $result->fetch_assoc()) {
    array_push($user, $row);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Table with database</title>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>register form</title>

        <!-- custom css file link  -->
        <link rel="stylesheet" href="css/style2.css">
    </head>
    <style>
    input[type=text] {
        color: #333333;
    }
</style>
</head>

<body>
	<h1 style="color: #333333;">Search Database</h1>
	<form action="" method="POST">
		<label for="search" style="color: #dc143c;">Search:</label>
		<input type="text" id="search" name="search" value=""<?php echo $search; ?>">
		<button type="submit" style="color: #dc143c;">Submit</button>
	</form>

	<div style="position: absolute; top: 25px; right: 25px;">
		<a href="admin_page.php" style="background-color: #333333; color: white; padding: 10px 15px; text-decoration: none;">Home</a>
	</div>

    <table style="padding: 5% !important;">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Student ID</th>
            <th>Device Name</th>
            <th>RFID</th>
            <th>Department</th>
            <th>Status</th>
            <th>Timestamp</th>
        </tr>
        <?php

        if (!empty($user)) {
            foreach ($user as $u) {
                echo "<tr><td>" . $u["uname"] . "</td><td>" . $u["uemail"] . "</td><td>". $u["usid"] .  "</td><td>" . $u["deviceName"] . "</td><td>" . $u["urfid"] . "</td><td>" . $u["udepartment"] . "</td><td>" . $u["status"] . "</td><td>" . $u["created_at"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        ?>
    </table>
</body>

</html>