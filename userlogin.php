<?php
include "dbconnect.php";
session_start();

$email = $_POST['loginemail'];
$password = $_POST['loginpassword'];

$password = md5($password);
$query = "SELECT * FROM User WHERE email='".$email."' and password='".$password."'";

$result = $dbcnx->query($query);
$num_result = $result->num_rows;
if ($result->num_rows > 0 ) {
    for ($i=0; $i<$num_resultPrice; $i++) {
        $row = $result->fetch_assoc();
        $_SESSION['valid_user'] = $row["userID"];
    }
    echo '<script>
        window.location.href="index.php";
    </script>';
} else {
    echo '<script>
        alert("Invalid email or password");
        window.location.href="login.php#login";
    </script>';
}

$dbcnx->close();
?>

                    