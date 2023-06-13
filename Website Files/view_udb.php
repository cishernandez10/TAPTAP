<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Table with database</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
	<div style="position: absolute; top: 25px; right: 25px;">
		<a href="admin_page.php" style="background-color: #333333; color: white; padding: 10px 15px; text-decoration: none;">Home</a>
	</div>

	<h1 style="color: #333333;">Search Database</h1>
	<form action="" method="POST">
		<label for="search" style="color: #dc143c;">Search:</label>
		<input type="text" id="search" name="search" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
		<button type="submit" style="color: #dc143c;">Submit</button>
	</form>

	<table>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Student ID</th>
			<th>RFID</th>
			<th>department</th>
		</tr>
		<?php
			include 'config.php';

			$search = "";
			if(isset($_POST["search"])){
			    $search = $_POST["search"];
			    $sql = "SELECT uname, uemail, usid, urfid, udepartment FROM user_database WHERE uname LIKE '%{$search}%' OR uemail LIKE '%{$search}%' OR usid LIKE '%{$search}%' OR urfid LIKE '%{$search}%' OR udepartment LIKE '%{$search}%' LIMIT 50";
			}else{
			    $sql = "SELECT uname, uemail, usid, urfid, udepartment FROM user_database LIMIT 50";
			}

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["uname"]. "</td><td>" . $row["uemail"] . "</td><td>"
					. $row["usid"].  "</td><td>" . $row["urfid"] . "</td><td>" . $row["udepartment"] .  "</tr></td>";
				}
			} else {
				echo "<tr><td colspan='5'>0 results</td></tr>";
			}

			$conn->close();
		?>
	</table>
</body>
</html>