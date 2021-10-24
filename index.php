<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Screens Come True</title>
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
<body onload="document.getElementById('defaultOpen').click(); populateDate();">
<div id="wrapper">
<?php
    session_start();
    if (isset($_SESSION['userID']))
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
                    <form method="post" action="quicksearch.php">
                        <?php
                        include "dbconnect.php";

                        $queryShowtimeDate = "SELECT DISTINCT date(startTime) AS datelist FROM `Showtime`";
                        $showtimeDate = $dbcnx->query($queryShowtimeDate);

                        $dateToMovieArray = array();

                        $numShowtimeDate = $showtimeDate->num_rows;
                        for ($i=0; $i<$numShowtimeDate; $i++) {
                            $row = $showtimeDate->fetch_assoc();

                            $queryMovie = "SELECT title FROM `Movie` WHERE MovieID IN (SELECT DISTINCT MovieID FROM `Showtime` WHERE date(Showtime.startTime) = '" . $row["datelist"] . "')";
                            $movieList = $dbcnx->query($queryMovie);

                            $numMovieList = $movieList->num_rows;
                            for ($j=0; $j<$numMovieList; $j++) {
                                $row_j = $movieList->fetch_assoc();

                                if (empty($dateToMovieArray[$row["datelist"]])) {
                                    $dateToMovieArray[$row["datelist"]] = array();
                                }
                                array_push($dateToMovieArray[$row["datelist"]], addslashes($row_j["title"]));
                            }
                        }
                        foreach ($dateToMovieArray as $date=>$movieList) {
                            foreach ($movieList as $movie) {
                                $queryCinema = "SELECT name AS location FROM `Cinema` WHERE cinemaID IN
                                                (SELECT DISTINCT cinemaID FROM `Cinema_Hall` WHERE cinemaHallID IN 
                                                (SELECT DISTINCT Showtime.cinemaHallID AS Cinema_Hall FROM `Showtime`, `Movie` 
                                                WHERE date(Showtime.startTime)='" . $date . "'
                                                AND Showtime.movieID = (SELECT movieID From Movie WHERE title='".$movie."')))
                                                ";


                                $cinemaList = $dbcnx->query($queryCinema);

                                $numCinemaList = $cinemaList->num_rows;
                                for ($k=0; $k<$numCinemaList; $k++) {
                                    $row_k = $cinemaList->fetch_assoc();

                                    if (empty($dateToMovieArray[$date][$movie])) {
                                        $dateToMovieArray[$date][$movie] = array();
                                    }
                                    array_push($dateToMovieArray[$date][$movie], $row_k["location"]);
                                }
                            }
                        }
                        foreach($dateToMovieArray as $date=>$movieList) {
                            foreach ($movieList as $movie=>$cinemaList) {
                                foreach ($cinemaList as $cinema) {
                                    $queryShowTime = "SELECT DISTINCT Showtime.startTime AS showtime
                                                      FROM `Showtime`, `Cinema_Hall`, `Cinema`, `Movie`
                                                      WHERE date(Showtime.startTime)='" . $date . "' AND Cinema.name='" . $cinema . "'
                                                      AND Showtime.cinemaHallID IN (SELECT cinemaHallID FROM Cinema_Hall WHERE CinemaID = (SELECT cinemaID FROM Cinema WHERE name='".$cinema."')) 
                                                      AND Showtime.movieID = (SELECT movieID From Movie WHERE title='".$movie."')";
                                    $showTimeList = $dbcnx->query($queryShowTime);

                                    $numShowTimeList = $showTimeList->num_rows;
                                    for ($l=0; $l<$numShowTimeList; $l++) {
                                        $row_l = $showTimeList->fetch_assoc();

                                        if (empty($dateToMovieArray[$date][$movie][$cinema])) {
                                            $dateToMovieArray[$date][$movie][$cinema] = array();
                                        }
                                        array_push($dateToMovieArray[$date][$movie][$cinema], date("H:i", strtotime($row_l["showtime"])));
                                    }
                                }
                            }
                        }
//                        foreach($dateToMovieArray as $date=>$movieList) {
//                            print($date);
//                            foreach ($movieList as $movie=>$cinemaList) {
//                                print(count($movieList));
//                                foreach ($cinemaList as $cinema=>$showtimeList) {
//                                    foreach ($showtimeList as $showtime) {
//                                        print(count($showtimeList));
//                                    }
//                                }
//                            }
//                            break;
//                        }

                        echo "<label><select name='date' id='date' onchange='selectedDate()' class='round' required><option value='' disabled selected>Please Select A Date</option>";
                            foreach($dateToMovieArray as $date=>$movieList) {
                                echo "<option value='" . $date . "'>" . $date . "</option>";
                            }
                        echo "</select></label>";

                        echo "<label><select name='movie' id='movie' onchange='selectedMovie()' required><option value='' disabled selected>Please Select A Movie</option>";
                        echo "</select></label>";

                        echo "<label><select name='cinema' id='cinema' onchange='selectedCinema()' required><option value='' disabled selected>Please Select A Cinema</option>";
                        echo "</select></label>";

                        echo "<label><select name='showtime' id='showtime' required><option value='' disabled selected>Please Select A Showtime</option>";
                        echo "</select></label>";
                        ?>

                        <button type="submit">SHOWTIMES</button>
                    </form>
                </div>
                <button onclick="window.location.href='check_bookings.php'" class="check-booking-button"><img src="img/calendar.svg" alt="logo" height="30px">Check<br>Bookings</button>
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
            $movie_details = $dbcnx->query($query_now_showing_details);
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
            $movie_details = $dbcnx->query($query_now_showing_details);
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
<script>

    var allMoviesObject = <?php echo json_encode($dateToMovieArray, JSON_HEX_APOS); ?>;

    function removeOptions(selectElement) {
        let options = selectElement;
        if (options.length > 1) {
            for(let i = options.length; i >= 1; i--) {
                options.remove(i);
            }
        }
        selectElement.selectedIndex = 0;
    }

    function populateDate() {
        let dates = Object.values(allMoviesObject);
        var dateSelector = document.getElementById("date");

        removeOptions(document.getElementById("movie"));
        removeOptions(document.getElementById("cinema"));
        removeOptions(document.getElementById("showtime"));

        document.getElementById("movie").disabled = true;
        document.getElementById("cinema").disabled = true;
        document.getElementById("showtime").disabled = true;

        dates.forEach((date) => {
            if (typeof date === 'string' || date instanceof String) {
                var opt = document.createElement("option");
                opt.value = date;
                opt.innerHTML = date;
                dateSelector.appendChild(opt);
            }
        })
        document.getElementById("date").selectedIndex = 0;
    }

    function selectedDate() {
        let dateSelected = document.getElementById("date").options[document.getElementById("date").selectedIndex].value;
        console.log(allMoviesObject[dateSelected]);
        let movies = Object.values(allMoviesObject[dateSelected]);

        removeOptions(document.getElementById("movie"));
        removeOptions(document.getElementById("cinema"));
        removeOptions(document.getElementById("showtime"));

        document.getElementById("movie").disabled = false;
        document.getElementById("cinema").disabled = true;
        document.getElementById("showtime").disabled = true;

        var movieSelector = document.getElementById("movie");
        movies.forEach((movie) => {
            if (typeof movie === 'string' || movie instanceof String) {
                var opt = document.createElement("option");
                console.log(movie.replace(/\\/g, ''));
                opt.value = movie
                opt.innerHTML = movie.replace(/\\/g, '');
                movieSelector.appendChild(opt);
            }
        })
        console.log("done");
    }

    function selectedMovie() {
        let dateSelected = document.getElementById("date").options[document.getElementById("date").selectedIndex].value;
        let movieSelected = document.getElementById("movie").options[document.getElementById("movie").selectedIndex].value;
        console.log(movieSelected);

        let cinemas = Object.values(allMoviesObject[dateSelected][movieSelected])

        removeOptions(document.getElementById("cinema"));
        removeOptions(document.getElementById("showtime"));

        document.getElementById("cinema").disabled = false;
        document.getElementById("showtime").disabled = true;

        var cinemaSelector = document.getElementById("cinema");
        cinemas.forEach((cinema) => {
            if (typeof cinema === 'string' || cinema instanceof String) {
                var opt = document.createElement("option");
                opt.value = cinema;
                opt.innerHTML = cinema;
                cinemaSelector.appendChild(opt);
            }
        })
    }

    function selectedCinema() {
        let dateSelected = document.getElementById("date").options[document.getElementById("date").selectedIndex].value;
        let movieSelected = document.getElementById("movie").options[document.getElementById("movie").selectedIndex].value;
        let cinemaSelected = document.getElementById("cinema").options[document.getElementById("cinema").selectedIndex].value;

        let showtimes = Object.values(allMoviesObject[dateSelected][movieSelected][cinemaSelected]);

        removeOptions(document.getElementById("showtime"));

        document.getElementById("showtime").disabled = false;

        var showtimeSelector = document.getElementById("showtime");
        showtimes.forEach((showtime) => {
            if (typeof showtime === 'string' || showtime instanceof String) {
                var opt = document.createElement("option");
                opt.value = showtime;
                opt.innerHTML = showtime;
                showtimeSelector.appendChild(opt);
            }
        })
    }
</script>
</body>
</html>