<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Cinema</title>
    <?php
    session_start();
    if (isset($_SESSION['valid_user']))
    { ?>
        <link rel="stylesheet" href="css/header_userloginsess.css">
    <?php
    }
    else { ?>
        <link rel="stylesheet" href="css/header.css">
    <?php
    }
    ?>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/footer.css">

    <style>
        ul {
            background-clip: border-box;
            background-color: rgb(38, 38, 38);
            background-origin: padding-box;
            background-size: auto;
            line-height: 20px;
            width: 280px;
            padding: 15px;
        }
        li {
            list-style: none;
            box-sizing: border-box;
        }
        li a {
            background-color: rgb(94, 94, 94);
            background-attachment: scroll;
            background-clip: border-box;
            background-size: auto;
            background-origin: padding-box;
            background-position-x: 0%;
            background-position-y: 0%;
            border-radius: 10px;
            cursor: pointer;
            display: block;
            height: 40px;
            line-height: 40px;
            width: 260px;
            padding: 10px;
            margin-top: 15px;
            margin-bottom: 15px;
        }
        li a:hover {
            color: red;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <?php
        if (isset($_SESSION['valid_user']))
        {
            include "components/header_userloginsess.html";
        }
        else {
            include "components/header.html";
        }
    ?>
    <div class="content">
        <p>
            <a href="../index.php" class="other-page-breadcrumb">Home</a> /
            <strong class="current-page-breadcrumb">Cinemas</strong>
        </p>
        <h1>Our Cinemas</h1>
        <?php
        $servername = "localhost";
        $username = "f32ee";
        $password = "f32ee";
        $dbname = "f32ee";

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query_cinema_list = "
        SELECT name
        FROM
        `Cinema`
        ";
        $cinema_list = mysqli_query($conn, $query_cinema_list);
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($cinema_list)) {
            echo '<li><a>Screens Come True, ' . $row["name"] . '</a>';
        }
        echo '</li>';
        ?>

    </div>
    <?php include "components/footer.html"; ?>
</div>
</body>
</html>