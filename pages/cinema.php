<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Cinema</title>
    <script src="../components/header.js" type="text/javascript" defer></script>
    <link rel="stylesheet" href="../components/color.css">
    <script src="../components/footer.js" type="text/javascript"></script>
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
    <header-component></header-component>
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
    <footer-component></footer-component>
</div>
</body>
</html>