<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <?php
    session_start();
  if (isset($_SESSION['valid_user']))
  {
     ?>
     <script src="components/header_valid_user.js" type="text/javascript" defer></script>
     <?php 
  }
  else {
    ?>
    <script src="components/header.js" type="text/javascript" defer></script>
    <?php
  }
      ?>
    <script src="components/footer.js" type="text/javascript"></script>
    <link rel="stylesheet" href="components/button.css">
    <link rel="stylesheet" href="components/color.css">
    <style>
        #wrapper {
            background-color: #1a1a1a;
            color: #FFFFFF;
            min-width: 1000px;
        }
        .pre-content {
            width: 100%;
            min-width: 1000px;
            margin: auto;
        }
        .content {
            width: 80%;
            min-width: 1000px;
            margin: auto;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: Tahoma, Trebuchet MS, serif;
            letter-spacing: 0.05em;
        }
        .bolt-quicksearch {
            margin-top: 20px;
            background-color: #000000;
            color: #FFFFFF;
            width: 300px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: auto;
            margin-left: auto;
        }
        .bolt-quicksearch img {
            object-fit: fill;
        }
        .quicksearch-selection-bar-with-button {
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: center;

        }
        .quicksearch-selection-bar {
            width: 700px;
            height: 60px;
            background-color: #ffffff;
            border-radius: 20px;
            padding: 10px 20px;
            margin-right: 20px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        * {box-sizing: border-box}
        .slideshow-container {
            /*max-width: 1000px;*/
            width: 100%;
            position: relative;
            margin: auto;
        }
        .container {
            display: none;
        }
        .main {
            display: block;
        }
        .previous-photo, .next-photo {
            cursor: pointer;
            position: absolute;
            top: 48%;
            width: auto;
            margin-top: -23px;
            padding: 17px;
            color: grey;
            font-weight: bold;
            font-size: 25px;
            transition: 0.4s ease;
            border-radius: 0 5px 5px 0;
            user-select: none;
        }
        .next-photo {
            right: 0;
            border-radius: 4px 0 0 4px;
        }
        .previous-photo:hover, .next-photo:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }
        .circle-dots {
            cursor: pointer;
            height: 16px;
            width: 16px;
            margin: 0 3px;
            background-color: #acc;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.5s ease;
        }
        .enable, .circle-dots:hover {
            background-color: #717161;
        }
        .fade {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 1.4s;
            animation-name: fade;
            animation-duration: 1.4s;
        }
        @-webkit-keyframes fade {
            from {opacity: .5}
            to {opacity: 2}
        }
        @keyframes fade {
            from {opacity: .5}
            to {opacity: 2}
        }
        .tab {
            overflow: hidden;
        }
        .tab a {
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .tab a:hover {
            color: #EA2127;
        }
        .tabcontent {
            display: none;
            flex-wrap: wrap;
            grid-template-columns: repeat(auto-fill, 340px);
        }
        /*.tabcontent::after{*/
        /*    content: '';*/
        /*    width: 340px;*/
        /*    flex: auto;*/
        /*}*/
        .tablinks-current {
            font-size: 30px;
            color: #EA2127;
        }
        hr {
            border: 1px solid #EA2127;
        }
        .movie-posters {
            height:500px;
            width: 300px;
            margin-right: 20px;
            margin-left: 20px;
        }
        .movie-posters img {
            height: 400px;
            width: 300px;
            display: block;
        }
        .movie-posters h4 {
            margin: 5px;
        }
        .movie-posters-container {
            position: relative;
        }
        .movie-posters-container:hover .overlay {
            height: 100%;
        }
        .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(17, 17, 17, 0.85);
            overflow: hidden;
            width: 100%;
            height: 0;
            transition: .5s ease;
        }
        .overlay-text {
            color: white;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 40%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: left;
        }
        #pointer {
            width: 180px;
            height: 60px;
            position: relative;
            background: red;
            display: flex;
            align-items: center;
        }
        #pointer:after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 0;
            border-left: 30px solid transparent;
            border-top: 30px solid transparent;
            border-bottom: 30px solid transparent;
        }
        #pointer:before {
            content: "";
            position: absolute;
            right: -30px;
            bottom: 0;
            width: 0;
            height: 0;
            border-left: 30px solid red;
            border-top: 30px solid transparent;
            border-bottom: 30px solid transparent;
        }
        .movie-running-time {
            color: #8c8c8c;
        }
        .view-more-movies {
            display: flex;
            justify-content: flex-end;
            padding-bottom: 50px;
            align-items: center;
        }
        .arrow-in-circle {
            background: red;
            text-decoration:none; /* Remove that ugly underlining */
            border-radius: 50%;
            display: block;
            height: 80px;
            width: 80px;
        }
        .arrow-in-circle::after {
            content:"\2192";   /* The code for the arrow : see the reference */
            display: block;
            color: white;
            font-weight: bold;
            font-size: 60px; /* Adjust for your needs */
            text-align: center;
        }
    </style>
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

        var nxtButton = document.getElementsByClassName("next-photo");
        setInterval(function() {
            nxtButton.click();
        }, 3000);
        // var slidePosition = 0;
        // SlideShow();
        //
        // function SlideShow() {
        //     var i = 1;
        //     var slides = document.getElementsByClassName("container");
        //     for (i = 0; i < slides.length; i++) {
        //         slides[i].style.display = "none";
        //     }
        //     slidePosition++;
        //     if (slidePosition > slides.length) {slidePosition = 1}
        //     slides[slidePosition-1].style.display = "block";
        //     setTimeout(SlideShow, 2000);
        // }
        function openMoviesTab(evt, movieType) {
            var i, tabcontent, tablinks;
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
    <header-component></header-component>
    <div class="pre-content">
        <div>
            <div class="bolt-quicksearch">
                <img src="img/logo_lightning.png" alt="logo" height="40" width="30">
                <img src="img/logo_lightning.png" alt="logo" height="40" width="30">
                <img src="img/logo_lightning.png" alt="logo" height="40" width="30">
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
                        <select>
                            <option value="" disabled selected>All Theatres</option>
                        </select>
                    </form>
                    <button>SHOWTIMES</button>
                </div>
                <button><img alt="logo">Check Bookings</button>
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
            $query_now_showing_details = "SELECT title, releaseDate, runningTime, genre, language, imagePath FROM `Movie` WHERE releaseDate <= CURRENT_DATE() ORDER BY releaseDate DESC LIMIT 8";
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
<!--            <div class="movie-posters">-->
<!--                <div class="movie-posters-container">-->
<!--                    <img src="img/movies/Antlers.jpg" alt="movie-poster">-->
<!--                    <div class="overlay">-->
<!--                        <div class="overlay-text">-->
<!--                            <a><h4>The Boss Baby Family Business</h4></a>-->
<!--                            <h5>English/Adventure</h5>-->
<!--                            <br>-->
<!--                            <a>-->
<!--                                <div id="pointer">-->
<!--                                    <h2>&nbsp;Book Now</h2>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div>-->
<!--                    <h4>The Boss Baby Family Business</h4>-->
<!--                    <i class="movie-running-time">108 minutes</i>-->
<!--                </div>-->
<!--            </div>-->
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
    <footer-component></footer-component>
</div>
</body>
</html>