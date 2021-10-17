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
         .cinema-layout-wrapper {
             display: grid;
             grid-template-columns: 300px 1fr;
             margin-top: 30px;
             grid-gap: 150px;
             justify-self: center;
         }
         .cinema-location {
            /*background-clip: border-box;*/
            background-color: rgb(38, 38, 38);
            /*background-origin: padding-box;*/
            margin-top: 0;
            margin-bottom: 0;
            background-size: auto;
            width: 280px;
            padding: 15px;
            box-shadow: 0 0 15px 6px #EA2127;
            display: flex;
            flex-direction: column;
        }
        .cinema-location li {
            list-style: none;
            box-sizing: border-box;
        }
        .cinema-location li a {
            background-color: rgb(94, 94, 94);
            background-attachment: scroll;
            background-clip: border-box;
            background-size: auto;
            background-origin: padding-box;
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
        .experience-thumbnail {
            display: inline-grid;
            grid-template-columns: repeat(2, [col-start] 50%);
            grid-gap: 70px;
            /*margin-left: 100px;*/
            justify-self: center;

        }
        .experience-thumbnail img {
            width: 25vw;
            height: 25vh;
            min-width: 350px;
            min-height: 350px;
            box-shadow: 0px 0px 15px 6px #EA2127;
        }
        .experience-thumbnail .thumbnail-container:hover{
            -webkit-transform: scale(1.1);
            transform: scale(1.1);
        }
        .experience-thumbnail img:hover {
            filter: blur(2px);
            -webkit-filter: blur(2px);
        }
        .thumbnail-container {
            position: relative;
        }
        .thumbnail-container:hover img {
            filter: blur(2px);
            -webkit-filter: blur(2px);
        }
        .more-info {
            position: absolute;
            bottom: 0;
            right: 50px;
            visibility: hidden;
        }
        .thumbnail-container:hover .more-info {
            position: absolute;
            bottom: 0;
            right: 50px;
            visibility: visible;
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
        <div class="cinema-layout-wrapper">
            <div>
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
                SELECT name, cinemaID
                FROM
                `Cinema`
                ";
                $cinema_list = mysqli_query($conn, $query_cinema_list);
                echo "<ul class='cinema-location'>";
                while ($row = mysqli_fetch_assoc($cinema_list)) {
                    echo '<li><a href="./cinemasDetails.php?cinemaid='.$row["cinemaID"].'&showdate=2021-10-11">Screens Come True, ' . $row["name"] . '</a>';
                }
                echo '</li>';
                ?>
            </div>
            <div class="experience-thumbnail">
                <div class="thumbnail-container">
                    <img src="img/experience/thumbnail/thumbnail_dbox.jpg">
                    <div class="more-info"><a href="experience_dbox.php"><h2>More Info>></h2></a></div>
                </div>
                <div class="thumbnail-container">
                    <img src="img/experience/thumbnail/thumbnail_dolby_atmos.jpg">
                    <div class="more-info"><a href="experience_dolby_atmos.php"><h2>More Info>></h2></a></div>
                </div>
                <div class="thumbnail-container">
                    <img src="img/experience/thumbnail/thumbnail_imax.jpg">
                    <div class="more-info"><a href="experience_imax.php"><h2>More Info>></h2></a></div>
                </div>
                <div class="thumbnail-container">
                    <img src="img/experience/thumbnail/thumbnail_onyx_led.jpg">
                    <div class="more-info"><a href="experience_onyx_cinema.php"><h2>More Info>></h2></a></div>
                </div>
            </div>
            <br><br><br>
        </div>
    </div>
    <?php include "components/footer.html"; ?>
</div>
</body>
</html>