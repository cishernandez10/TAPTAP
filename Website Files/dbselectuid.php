<?php



$conn = mysqli_connect('localhost','jbwcnczn_coreadmin','taptapadmin0110','jbwcnczn_user_db');






   
/* Get date and time variables
    date_default_timezone_set('Asia/Kolkata');  // for other timezones, refer:- https://www.php.net/manual/en/timezones.asia.php
    $d = date("Y-m-d");
    $t = date("H:i:s");
    
*/
    
if(!empty($_POST['str'])) {
		$uid = trim($_POST['str']);
		
		
// Update your tablename here
	    $sql = "SELECT * FROM user_database WHERE urfid='$uid'"; 
       
// Execute the SQL query
        $result = $conn->query($sql);
        
// Check if there was an error with the query
    if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
        echo  "Match!";
        
        }
    }
    else {
            echo "No Match!";
        } 
// Check if there are any results
   /* if (mysqli_num_rows($result) > 0) {
 
        while($row = $result->fetch_assoc()) {
        echo  $row["uid"] . "<br>";
        }
    } 
        */
}
// Close MySQL connection
$conn->close();
?>
