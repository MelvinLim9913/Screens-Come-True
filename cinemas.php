<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Cinema</title>
    <?php
    session_start();
    if (isset($_SESSION['userID']))
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
    <link rel="stylesheet" href="css/cinemas.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<div id="wrapper">
    <?php
        if (isset($_SESSION['userID']))
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
        <br>
        <h2>Our Cinemas</h2>
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
                    echo '<tr><td><a href="./cinemasDetails.php?cinemaid='.$row["cinemaID"].'&showdate=2021-10-11">
                            <div style="height:100%;width:100%;padding-top:22px;">
                                Screens Come True, ' . $row["name"] . '
                            </div>
                        </a></td></tr>';
                }
                echo '</table>
                ';
                ?>
            </div>
            <div class="experience-thumbnail">
                <div class="thumbnail-container">
                    <div>
                        <a href="experience_dbox.php">
                            <img src="img/experience/thumbnail/thumbnail_dbox.jpg">
                            <div class="more-info">
                                <h2>More Info >></h2>
                            </div>
                        </a>
                    </div>
                    <h5>DBOX</h5>
                </div>
                <div class="thumbnail-container">
                    <div>
                        <a href="experience_dolby_atmos.php">
                            <img src="img/experience/thumbnail/thumbnail_dolby_atmos.jpg">
                            <div class="more-info">
                                <h2>More Info >></h2>
                            </div>
                        </a>
                    </div>
                    <h5>Dolby Atmos</h5>
                </div>
                <div class="thumbnail-container">
                    <div>
                        <a href="experience_imax.php">
                            <img src="img/experience/thumbnail/thumbnail_imax.jpg">
                            <div class="more-info">
                                <h2>More Info >></h2>
                            </div>
                        </a>
                    </div>
                    <h5>IMAX</h5>
                </div>
                <div class="thumbnail-container">
                    <div>
                        <a href="experience_onyx_cinema.php">
                            <img src="img/experience/thumbnail/thumbnail_onyx_led.jpg">
                            <div class="more-info">
                                <h2>More Info >></h2>
                            </div>
                        </a>
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