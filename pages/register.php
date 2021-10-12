<?php
$servername = "localhost";
$username = "f32ee";
$password = "f32ee";
$dbname = "f32ee";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];

// $hashed_password = password_hash($password, PASSWORD_DEFAULT);
$hashed_password = md5($password);

$checkemail = "SELECT * FROM User WHERE email='".$email."'";
$result = mysqli_query($conn, $checkemail);

if (mysqli_num_rows($result) > 0) {
    echo '<script>
            alert("Email already exist");
            window.location.href="login.html#login";
        </script>';
}
else {
    $sql = "INSERT INTO User (name, email, phone, password) VALUES ('".$name."', '".$email."', '".$phone."', '".$hashed_password."')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['valid_user'] = $email;
        echo '<script>
                window.location.href="../index.html";
            </script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}





mysqli_close($conn);
?>