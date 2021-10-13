<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
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
    <link rel="stylesheet" href="css/movies.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/footer.css">
    <script>
        function openMoviesTab(evt, movieType) {
            let i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace("active", "");
                tablinks[i].className = tablinks[i].className.replace("tablinks-current", "");
            }
            document.getElementById(movieType).style.display = "grid";
            document.getElementById(movieType).style.justifyContent = "space-around";
            evt.currentTarget.className += " active";
            evt.currentTarget.className += " tablinks-current";
        }
    </script>
</head>
<body onload="document.getElementById('defaultOpen').click();">
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
        <div class="tab">
            <a class="tablinks" onclick="openMoviesTab(event, 'nowShowing')" id="defaultOpen">Now Showing</a>&nbsp;&nbsp;&nbsp;
            <a class="tablinks" onclick="openMoviesTab(event, 'comingSoon')">Coming Soon</a>
        </div>
        <hr><br>
        <div id="nowShowing" class="tabcontent">
            <?php

            $servername = "localhost";
            $username = "f32ee";
            $password = "f32ee";
            $dbname = "f32ee";

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $query_now_showing_details = "
                SELECT title, releaseDate, runningTime, genre, language, imagePath 
                FROM `Movie` 
                WHERE releaseDate <= CURRENT_DATE() 
                ORDER BY releaseDate 
                DESC LIMIT 8
                ";
            $movie_details = mysqli_query($conn, $query_now_showing_details);
            $movie_poster_path = "img/movies/";

            while ($row = mysqli_fetch_assoc($movie_details)) {
                echo '
                <div class="movie-posters">
                <div class="movie-posters-container">
                    <img src="img/movies/' . $row["imagePath"]. '.jpg" alt="movie-poster">
                    <div class="overlay">
                        <div class="overlay-text">
                            <a><h4>' . $row["title"]. '</h4></a>
                            <h5>' . $row["language"]. '<br>' . $row["genre"]. '</h5>
                            <br>
                            <a>
                                <div id="pointer">
                                    <h2>&nbsp;Book Now</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <h4>'. $row["title"]. '</h4>
                    <i class="movie-running-time">' . $row["runningTime"] . ' minutes</i>
                </div>
            </div>
                ';
            }
            ?>
        </div>
        <div id="comingSoon" class="tabcontent">
            <?php
            $query_now_showing_details = "
                                        SELECT title, releaseDate, runningTime, genre, language, imagePath 
                                        FROM `Movie` 
                                        WHERE releaseDate > CURRENT_DATE() 
                                        ORDER BY releaseDate 
                                        DESC LIMIT 8
                                        ";
            $movie_details = mysqli_query($conn, $query_now_showing_details);
            $movie_poster_path = "img/movies/";

            while ($row = mysqli_fetch_assoc($movie_details)) {
                echo '
                <div class="movie-posters">
                <div class="movie-posters-container">
                    <img src="img/movies/' . $row["imagePath"]. '.jpg" alt="movie-poster">
                    <div class="overlay">
                        <div class="overlay-text">
                            <a><h4>' . $row["title"]. '</h4></a>
                            <h5>' . $row["language"]. '<br>' . $row["genre"]. '</h5>
                            <br>
                            <a>
                                <div id="pointer">
                                    <h2>&nbsp;Book Now</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <h4>'. $row["title"]. '</h4>
                    <i class="movie-running-time">' . $row["runningTime"] . ' minutes</i>
                </div>
            </div>
                ';
            }
            ?>
        </div>
        <div>
            <a class="view-more-movies">
                <h2>View More Movies</h2> &nbsp;&nbsp;
                <div class="arrow-in-circle"></div>
            </a>
        </div>
    </div>
    <?php include "components/footer.html"; ?>
</div>
</body>
</html>