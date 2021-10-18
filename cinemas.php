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
             grid-gap: 100px;
             justify-self: center;
         }
         .location-list table td {
             padding: 15px;
             color: white;
             text-align: left;
             height: 45px;
             background-color: #000000;
         }
         .location-list table td a {
             color: white;
         }
         .location-list table td:hover {
             background-color: #EA2127;
             cursor: pointer;
         }
        .experience-thumbnail {
            display: inline-grid;
            grid-template-columns: repeat(2, [col-start] 50%);
            grid-gap: 70px;
            justify-self: center;

        }
        .experience-thumbnail img {
            width: 25vw;
            height: 25vh;
            min-width: 350px;
            min-height: 350px;
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
            bottom: 30px;
            right: 50px;
            visibility: hidden;
        }
        .thumbnail-container:hover .more-info {
            position: absolute;
            bottom: 50px;
            right: 50px;
            visibility: visible;
        }
        .thumbnail-container h5 {
            text-align: center;
            font-size: 20px;
            margin-top 0;
            margin-bottom: 0;
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
            <a href="index.php" class="other-page-breadcrumb">Home</a> /
            <strong class="current-page-breadcrumb">Cinemas</strong>
        </p>
        <h1>Our Cinemas</h1>
        <div class="cinema-layout-wrapper">
            <div class="location-list">
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
                echo "<table>";
                while ($row = mysqli_fetch_assoc($cinema_list)) {
                    echo '<tr><td><a href="./cinemasDetails.php?cinemaid='.$row["cinemaID"].'">Screens Come True, ' . $row["name"] . '</a></td></tr>';
                }
                echo '</table>
                ';
                ?>
            </div>
            <div class="experience-thumbnail">
                <div class="thumbnail-container">
                    <div>
                        <img src="img/experience/thumbnail/thumbnail_dbox.jpg">
                        <div class="more-info"><a href="experience_dbox.php"><h2>More Info >></h2></a></div>
                    </div>
                    <h5>DBOX</h5>
                </div>
                <div class="thumbnail-container">
                    <div>
                        <img src="img/experience/thumbnail/thumbnail_dolby_atmos.jpg">
                        <div class="more-info"><a href="experience_dolby_atmos.php"><h2>More Info >></h2></a></div>
                    </div>
                    <h5>Dolby Atmos</h5>
                </div>
                <div class="thumbnail-container">
                    <div>
                        <img src="img/experience/thumbnail/thumbnail_imax.jpg">
                        <div class="more-info"><a href="experience_imax.php"><h2>More Info >></h2></a></div>
                    </div>
                    <h5>IMAX</h5>
                </div>
                <div class="thumbnail-container">
                    <div>
                        <img src="img/experience/thumbnail/thumbnail_onyx_led.jpg">
                        <div class="more-info"><a href="experience_onyx_cinema.php"><h2>More Info >></h2></a></div>
                    </div>
                    <h5>ONYX LED Technology</h5>
                </div>
            </div>
        </div>
        <br><br><br>
    </div>
    <?php include "components/footer.html"; ?>
</div>
</body>
</html>