<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Screens Come True</title>
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
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/footer.css">
    <script>
        let slidePosition = 1;
        SlideShow(slidePosition);

        function plusSlides(n) {
            SlideShow(slidePosition += n);
        }

        function currentSlide(n) {
            SlideShow(slidePosition = n)
        }

        function SlideShow(n) {
            let i;
            const slides = document.getElementsByClassName("container");
            const circles = document.getElementsByClassName("circle-dots");
            if (n > slides.length) {slidePosition = 1}
            if (n < 1) {slidePosition = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < circles.length; i++) {
                circles[i].className = circles[i].className.replace(" enable", "")
            }
            slides[slidePosition-1].style.display = "block";
            circles[slidePosition-1].className += " enable";
        }
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
    session_start();
    if (isset($_SESSION['valid_user']))
    {
        include "components/header_userloginsess.html";
    }
    else {
        include "components/header.html";
    }
    ?>
    <div class="pre-content">
        <div>
            <div class="bolt-quicksearch">
                <img src="img/logo_lightning.png" alt="logo">
                <img src="img/logo_lightning.png" alt="logo">
                <img src="img/logo_lightning.png" alt="logo">
                &nbsp;
                <h2>Quick Search</h2>
            </div>
            <div class="quicksearch-selection-bar-with-button">
                <div class="quicksearch-selection-bar">
                    <form>
                        <?php
                        $servername = "localhost";
                        $username = "f32ee";
                        $password = "f32ee";
                        $dbname = "f32ee";

                        $conn = mysqli_connect($servername, $username, $password, $dbname);
                        mysqli_set_charset($conn,"utf8");
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        $query_movie_date = "SELECT DISTINCT releaseDate FROM `Movie` ORDER BY releaseDate ASC";
                        $movie_date = mysqli_query($conn, $query_movie_date);
                        echo "<select>";
                        $counter = 0;
                        while ($row = mysqli_fetch_assoc($movie_date)) {
                            echo "<option>" . $row['releaseDate'] . "</option>";
                            $counter += 1;
                            if ($counter == 7) {
                                break;
                            }
                        }
                        echo "</select>";
                        ?>
                        <label>
                            <select>
                                <option value="" disabled selected>All Movies</option>
                            </select>
                        </label>
                        <label>
                            <select>
                                <option value="" disabled selected>All Theatres</option>
                            </select>
                        </label>
                    </form>
                    <button>SHOWTIMES</button>
                </div>
                <button><img src="" alt="logo">Check Bookings</button>
            </div>
            <br>
            <div class="slideshow-container">
                <div class="container main">
                    <img src="img/slideshow_venom.png" alt="slideshow" style="width: 100%">
                </div>
                <div class="container">
                    <img src="img/slideshow_no_time_to_die.png" alt="slideshow" style="width: 100%">
                </div>
                <div class="container">
                    <img src="img/slideshow_my_country_my_parents.png" alt="slideshow" style="width: 100%">
                </div>
                <a class="previous-photo" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next-photo" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <div style="text-align: center">
                <span class="circle-dots" onclick="currentSlide(1)"></span>
                <span class="circle-dots" onclick="currentSlide(2)"></span>
                <span class="circle-dots" onclick="currentSlide(3)"></span>
            </div>
            <br><br>
        </div>
    </div>
    <div class="content">
        <div class="tab">
            <a class="tablinks" onclick="openMoviesTab(event, 'nowShowing')" id="defaultOpen">Now Showing</a>&nbsp;&nbsp;&nbsp;
            <a class="tablinks" onclick="openMoviesTab(event, 'comingSoon')">Coming Soon</a>
        </div>
        <hr><br>
        <div id="nowShowing" class="tabcontent">
            <?php
            $query_now_showing_details = "
                SELECT title, movieID, releaseDate, runningTime, genre, language, imagePath 
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
                                    <a href="./movieDetails.php?movieid='.$row["movieID"].'&showdate=2021-10-11"><h2>&nbsp;Book Now</h2></a>
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
                                        SELECT title, movieID, releaseDate, runningTime, genre, language, imagePath 
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
                                    <a href="./movieDetails.php?movieid='.$row["movieID"].'&showdate=2021-10-11"><h2>&nbsp;More Info</h2></a>
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
            <a class="view-more-movies" href="./movies.php">
                <h2>View More Movies</h2> &nbsp;&nbsp;
                <div class="arrow-in-circle"></div>
            </a>
        </div>
    </div>
    <?php include "components/footer.html"; ?>
</div>
</body>
</html>