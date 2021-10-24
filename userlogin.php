<?php
include "dbconnect.php";
session_start();

$email = $_POST['loginemail'];
$password = $_POST['loginpassword'];

$password = md5($password);
$queryUser = "SELECT * FROM User WHERE email='".$email."' and password='".$password."'";


$result = $dbcnx->query($queryUser);
$num_result = $result->num_rows;
if ($result->num_rows > 0 ) {
    $row = $result->fetch_assoc();
    $_SESSION['userID'] = $row["userID"];
    echo '<script>
        window.location.href="./index.php";
    </script>';
} else {
    echo '<script>
        alert("Invalid email or password");
        window.location.href="./login.php?action=login";
    </script>';
}

$dbcnx->close();
?>

                    