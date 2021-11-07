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
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/footer.css">
    <style>
        body {
            font-size: 14px;
        }
        .step img {
            display: block;
            padding-left: 330px;
        }
        .movie-posters {
            display: block;
            float: left;
            width: 330px;
            
        }
        .movie-details {
            overflow: hidden;
            
        } 
        .movie-details span {
            font-size: 14px;
        }
        .query {
            padding: 10px;
            background-color: #302c2d;
        }
        span.head2 {
            font-size: 24px;
            color: #ffd701;
        }
        span.head3 {
            font-size: 16px;
            color: #ffd701;
        }
        .query table{
            width: 100%;
        }
        .query td {
            height: 30px;
            padding-right: 20px;
        }
        td.view {
            width: 120px;
            font-size: 12px;
            text-align: center;
        }
        .view-seating-plan {
            background-color: #FFFFFF;
            color: #108cff;
            text-align: center;
        }
        .promotions {
            padding: 10px;
        }
        .table-form td{
            padding: 10px;
            text-align: right;
        }
        .container {
            display: inline-block;
            background-color: #302c2d;
            margin: 15px;
            text-align: center;
            border-radius: 15px;
        }
        .card {
            margin: 10px;
        }
        .promotion-details {
            margin: 10px 0px;
        }
        .promotion-details span {
            font-size: 12px;
            display: inline-block;
        }
        .promotion-action button {
            border-radius: 100%;
            height: 40px;
            width: 40px;
            font-weight: bold;
            font-size: 30px;
            text-align: center;
            background-color: #1a1a1a;
            color: #FFFFFF;
        }
        .promotion-action input {
            margin: 0px 10px;
            text-align: center;
            margin-bottom: 10px;
        }
        .table-form input {
            height: 25px;
        }
        .next-btn {
            margin: 30px;
            text-align: center;
        }
        .circle {
            background-color: #FFD60A;
            color: #1a1a1a;
            border-radius: 100%;
            width: 60px;
            height: 60px;
            text-align: center;
            line-height: 60px;
            font-size: 25px;
            font-weight: bold;
            opacity: .1;
        }
        .circle.active {
            opacity: 1;
        }
        .step{
            padding-left: 330px;
            display: flex;
            align-items: center;
            width: calc(100% - 395px);
            margin-left: 30px;
            margin-right: 30px;
        }
        .step-caption {
            padding-left: 330px;
            display: flex;
            justify-content: space-between;
            width: calc(100% - 330px);
        }
        .step-caption h3{
            width: 13%;
            text-align: center;
            text-wrap: normal;
            color: #FFD60A;
            opacity: .1;
        }
        .caption.active {
            opacity: 1;
        }
        .bar {
            width: calc((100% - 150px) / 2);
            height: 10px;
            background-color: #FFD60A;
            color: #1a1a1a;
            opacity: .1;
        }
        .bar.active {
            opacity: 1;
        }
    </style>

    <script>
        function handleBtnPlus(counterid) {
            console.log(counterid);
            document.getElementById("counter" + counterid).value = parseInt(document.getElementById("counter" + counterid).value) + 1;
            return false;
        }
        function handleBtnMinus(counterid) {
            console.log(counterid);
            document.getElementById("counter" + counterid).value = parseInt(document.getElementById("counter" + counterid).value) - 1;
            return false;
        }
    </script>
    
</head>
<body>
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
        <div class="content">
            <br>
            <div class="upper-content">

                <div class="step">
                    <div class="circle active">1</div>
                    <div class="progress-bar-1 bar active"></div>
                    <div class="circle active">2</div>
                    <div class="progress-bar-2 bar"></div>
                    <div class="circle">3</div>
                </div>
                <div class="step-caption">
                    <h3 class="caption active">Select&nbsp;seats</h3>
                    <h3 class="caption active">Food &<br>Beverage</h3>
                    <h3 class="caption">Payment&nbsp;&<br>Confirmation</h3>
                </div>
                <br>

                <?php  
                    
                    if (!isset($_SESSION['promotion-cart'])){
                        $_SESSION['promotion-cart'] = array();
                    }
                    if (isset($_GET['buy'])) {
                        $_SESSION['promotion-cart'][] = $_GET['buy'];
                    }
                    else if (isset($_GET['drop'])) {
                        if (($key = array_search($_GET['drop'], $_SESSION['promotion-cart'])) !== false) {
                            unset($_SESSION['promotion-cart'][$key]);
                        }
                    } else {
                        unset($_SESSION['promotion-cart']);
                        $_SESSION['promotion-cart'] = array();
                    }
 
                    include "dbconnect.php";
            
                    parse_str($_SERVER['QUERY_STRING'], $output);
                    $movieID = $output['movieid'];
                    $cinemaID = $output['cinemaid'];
                    $cinemaHallID = $output['cinemahallid'];
                    $showDate = $output['showdate'];
                    $showTime = $output['showtime'];

                    $cinemaSeatID = $_SESSION['ticket-cart'];
                    $rowCol = "";
                    
                    $movieName;
                    $movieImagePath;
                    $cinemaName;
                    $cinemaHallName;
                    $showtimeID;
                    
                    $queryMovieDetails = "SELECT title, imagePath FROM Movie WHERE movieID='".$movieID."'";
                    $resultMovieDetails = $dbcnx->query($queryMovieDetails);

                    $num_resultMovieDetails = $resultMovieDetails->num_rows;

                    for ($i=0; $i <$num_resultMovieDetails; $i++) {
                        $row = $resultMovieDetails->fetch_assoc();
                        $movieName = $row["title"];
                        $movieImagePath = $row["imagePath"];
                    }

                    $queryCinemaName = "SELECT name FROM Cinema WHERE cinemaID='".$cinemaID."'";
                    $resultCinemaName = $dbcnx->query($queryCinemaName);

                    $num_resultCinemaName = $resultCinemaName->num_rows;

                    for ($i=0; $i <$num_resultCinemaName; $i++) {
                        $row = $resultCinemaName->fetch_assoc();
                        $cinemaName = $row["name"];
                    }
                    
                    $queryCinemaHallName = "SELECT name FROM Cinema_Hall WHERE cinemaHallID='".$cinemaHallID."'";
                    $resultCinemaHallName = $dbcnx->query($queryCinemaHallName);

                    $num_resultCinemaHallName = $resultCinemaHallName->num_rows;

                    for ($i=0; $i <$num_resultCinemaHallName; $i++) {
                        $row = $resultCinemaHallName->fetch_assoc();
                        $cinemaHallName = $row["name"];
                    }
                    
                    $showDateTime = $showDate.' '.$showTime;
                    $queryShowTimeID = "SELECT showtimeID FROM Showtime WHERE movieID='".$movieID."' AND startTime='".$showDateTime."' AND cinemaHallID='".$cinemaHallID."'";
                    $resultShowTimeID = $dbcnx->query($queryShowTimeID);

                    $num_resultShowTimeID = $resultShowTimeID->num_rows;

                    for ($i=0; $i<$num_resultShowTimeID; $i++) {
                        $row = $resultShowTimeID->fetch_assoc();
                        $showtimeID = $row["showtimeID"];
                    }

                    $alphabet = range('A', 'Z');
                    for ($j=0; $j<count($cinemaSeatID); $j++) {
                        $queryRowCol = "SELECT row, col FROM Cinema_Seat WHERE cinemaSeatID='".$cinemaSeatID[$j]."'";
                        $resultRowCol = $dbcnx->query($queryRowCol);
                        $num_resultRowCol = $resultRowCol->num_rows;

                        for ($i=0; $i <$num_resultRowCol; $i++) {
                            $row = $resultRowCol->fetch_assoc();
                            $rowCol = $rowCol.$alphabet[$row["row"]-1].':'.$row["col"].' ';
                        }
                    }

                    echo '<div class="movie-content">
                            <div class="movie-posters">
                                <img src="img/movies/'.$movieImagePath.'.jpg" alt="movie-poster" width="300" height="400">
                            </div>
                            <div class="movie-details">
                            <div class="query">
                                <br><br>
                                ';
                                echo '<span>You have selected &nbsp;</span><span class="head2">'.$movieName.'</span>
                                ';

                            echo '<hr><br>
                            <table border="0">
                                <tr>
                                    <td>Date: <span class="head3">'.$showDate.'</span></td>
                                    <td>Time: <span class="head3">'.date('H:i', strtotime($showTime)).'</span></td>
                                    <td>Cinema: <span class="head3">'.$cinemaName.'</span></td>
                                </tr>';
                
                    

                    echo '
                        <tr>
                            <td>Hall: <span class="head3">'.$cinemaHallName.'</span></td>
                            <td>Seats Selected: <span class="head3">'.$rowCol.'</span></td>
                            <td></td>
                        </tr>
                        </table>
                    </div>';

                ?>
                
                <?php

                    $queryFoodMerchandise = "SELECT * FROM Food
                                            UNION
                                            SELECT * FROM Merchandise;";
                    $resultFoodMerchandise = $dbcnx->query($queryFoodMerchandise);

                    $num_resultFoodMerchandise = $resultFoodMerchandise->num_rows;

                    

                    $selected_promotion = $_SESSION['promotion-cart'];
                    $freqs = array_count_values($selected_promotion);

                    // <div class="submission">
                    //     <form action="booking_confirmation.php" method="post" id="submissionForm">
                    echo '  <div class="promotions">

                                <p>Do you wish to add on any food & beverages or merchandise?</p>';
                                
                                for ($i=0; $i <$num_resultFoodMerchandise; $i++) {
                                    $row = $resultFoodMerchandise->fetch_assoc();
                                    $freq = 0;
                                    $freq = $freqs[$i];
                                    echo '
                                        <div class="container">
                                            <div class="card">
                                                <div class="promotion-img">
                                                    <img src="./img/promotions/'.$row["imagePath"].'.webp" width="200" height="230">
                                                </div>
                                                <div class="promotion-details">
                                                    <span style="float:left;">'.$row["name"].'</span>
                                                    <span style="float:right;">$'.$row["price"].'</span>
                                                    <br>
                                                </div>
                                                <div class="promotion-action">
                                                    <a href="'.$_SERVER['PHP_SELF'].'?movieid='.$movieID.'&cinemaid='.$cinemaID.'&cinemahallid='.$cinemaHallID.'&showdate='.$showDate.'&showtime='.$showTime.'&drop='.$i.'"><button type="button" id="minuscounter-'.$i.'">-</button></a>
                                                    ';
                                                    if(!$freq) {
                                                        echo '<input name="promotion'.$i.'" type="text" id="counter'.$i.'" value=0 size="10px" disabled>';
                                                    } else {
                                                        echo '<input name="promotion'.$i.'" type="text" id="counter'.$i.'" value='.$freq.' size="10px" disabled>';
                                                    }
                                                    echo '
                                                    <a href="'.$_SERVER['PHP_SELF'].'?movieid='.$movieID.'&cinemaid='.$cinemaID.'&cinemahallid='.$cinemaHallID.'&showdate='.$showDate.'&showtime='.$showTime.'&buy='.$i.'"><button type="button" id="pluscounter+'.$i.'">+</button></a>
                                                </div>


                                            </div>
                                        </div>
                                       

                                    ';
                                }
                                

                        echo'<div class="next-btn" id="next-btn">
                                <a href="./booking_confirmation.php?movieid='.$movieID.'&cinemaid='.$cinemaID.'&cinemahallid='.$cinemaHallID.'&showdate='.$showDate.'&showtime='.$showTime.'">
                                    <button class="button">
                                    Next
                                        </button>
                                </a>
                            </div>
                        
                            </div>
                            <br><br>';
                    //     </form>
                    // </div>
                    
                    echo'<br><br>';
                ?>
                 
            
                    </div>
                    </div>
                </div>
            </div>    
        </div>
        <?php include "components/footer.html"; ?>
    </div>
</body>
</html>