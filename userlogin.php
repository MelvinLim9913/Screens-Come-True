<?php
include "dbconnect.php";
session_start();

$email = $_POST['loginemail'];
$password = $_POST['loginpassword'];

$password = md5($password);
$query = "SELECT * FROM User WHERE email='".$email."' and password='".$password."'";

$result = $dbcnx->query($query);
if ($result->num_rows > 0 ) {
    $_SESSION['valid_user'] = $email;
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