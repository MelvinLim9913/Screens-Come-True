<?php
include "dbconnect.php";
session_start();

// $servername = "localhost";
// $username = "f32ee";
// $password = "f32ee";
// $dbname = "f32ee";

// // Create connection
// $conn = mysqli_connect($servername, $username, $password, $dbname);
// // Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }


$email = $_POST['loginemail'];
$password = $_POST['loginpassword'];


// $sql = "SELECT password FROM User WHERE email='".$email."'";
// $result = mysqli_query($conn, $sql);

// if (mysqli_num_rows($result) > 0) {
//     while($row = mysqli_fetch_assoc($result)) {
//         if (password_verify($password, $row["password"])) {
//             echo 
//             '<script>
//                 window.location.href="../index.html";
//             </script>';
//         }
//         else {
//             echo
//             '<script>
//                 alert("Incorrect Password");
//                 window.location.href="login.html#login";
//             </script>';
//         }
//     }

$password = md5($password);
$query = "SELECT * FROM User WHERE email='".$email."' and password='".$password."'";

$result = $dbcnx->query($query);
if ($result->num_rows > 0 ) {
    $_SESSION['valid_user'] = $email;
    echo '<script>
        window.location.href="../index.php";
    </script>';
} else {
    echo '<script>
        alert("Invalid email or password");
        window.location.href="login.html#login";
    </script>';
}

$dbcnx->close();
?>