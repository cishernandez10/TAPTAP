<?php
$mysqli = new mysqli('localhost','jbwcnczn_coreadmin','taptapadmin0110','jbwcnczn_user_db');
if ($_SERVER['REQUEST_METHOD']=="POST") {

    if (!empty($_POST['str']) && !empty($_POST['name'])) {
        $uid = trim($_POST['str']);
        $nem = $_POST['name'];
        $sql = "SELECT * FROM user_database WHERE urfid=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = array();
        while ($row = $result->fetch_assoc()) {
            array_push($user, $row);
        }
        if (!empty($user)) {
            $sql = "Call spUserLogs(?,?,?,?,?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("sisss", $user[0]['uname'], $user[0]['usid'], $user[0]['urfid'],$nem, $user[0]['udepartment']);
            $result = $stmt->execute();
            if ($result) {
                header('Content-Type: application/json; charset=utf-8');
                echo  "Match!";
            } else {
                header("HTTP/1.1 500 Internal Server Error");
                echo 'Failed to create logs';
            }
        } else {

            header('Content-Type: application/json; charset=utf-8');
            echo "No Match!";
        }
    } else {
        header("HTTP/1.1 500 Internal Server Error");
        echo 'Required Paramaters Must Not Be Empty';
    }
} else {
    header("HTTP/1.1 403 Forbidden");
    echo 'Method not allowed';
}
