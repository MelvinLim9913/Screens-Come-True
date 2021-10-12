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
     <script src="../components/header_valid_user.js" type="text/javascript" defer></script>
     <?php 
  }
  else {
    ?>
    <script src="../components/header.js" type="text/javascript" defer></script>
    <?php
  }
      ?>
    <script src="../components/footer.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../components/button.css">
    <link rel="stylesheet" href="../components/color.css">
    <style>
        #wrapper {
            background-color: #1a1a1a;
            color: #FFFFFF;
            min-width: 1000px;
        }
        .content {
            width: 80%;
            min-width: 1000px;
            margin: auto;
        }
        body {
            margin: 0px;
            padding: 0px;
            font-family: Tahoma, Trebuchet MS, serif;
            letter-spacing: 0.05em;
        }
        .tab {
            overflow: hidden;
        }
        .tab a {
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .tab a:hover {
            color: #EA2127;
        }
        .tab a:active {
            font-size: 26px;
            color: #EA2127;
        }
        .tabcontent {
            display: none;
        }
        .movie-posters {
            height:500px;
            width: 250px;
        }
        .movie-posters img {
            height: 350px;
            width: 250px;
        }
        .movie-posters h4 {
            margin: 5px;
        }
        .image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #008CBA;
            overflow: hidden;
            width: 100%;
            height: 0;
            transition: .5s ease;
        }
        .movie-posters img:hover .overlay-text {
            height: 100%;
        }
        .overlay-text {
            color: white;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>
    <script>
        function openMoviesTab(evt, movieType) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace("active", "");
            }
            document.getElementById(movieType).style.display = "block";
            evt.currentTarget.className += " active";
        }

        document.getElementById("defaultOpen").click();
    </script>
</head>
<body onload="document.getElementById('defaultOpen').click();">
<div id="wrapper">
    <header-component></header-component>
    <div class="content">
        <div class="tab">
            <a class="tablinks" onclick="openMoviesTab(event, 'nowShowing')" id="defaultOpen">Now Showing</a>&nbsp;
            <a class="tablinks" onclick="openMoviesTab(event, 'comingSoon')">Coming Soon</a>
        </div>
        <hr><br>
        <div id="nowShowing" class="tabcontent">
            <div class="movie-posters">
                <div class="movie-posters-container">
                    <img src="../img/movies/The_Boss_Baby_Family_Business.jpg" alt="movie-poster">
                    <div class="overlay-text">
                        <h4>English</h4>
                        <h4>Cartoon</h4>
                    </div>
                </div>
                <div>
                    <h4>The Boss Baby Family Business</h4>
                    <i>108 minutes</i>
                </div>
            </div>
        </div>
        <div id="comingSoon" class="tabcontent">
            <h3>Lohha</h3>
            <p>Lohha from the other side.</p>
        </div>
    </div>
    <footer-component></footer-component>
</div>
</body>
</html>