<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/header.css">
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
        .submission {
            padding: 10px;
        }
        .table-form td{
            padding: 10px;
            text-align: right;
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
            <br>
            <div class="upper-content">

                <div class="step">
                    <img src="./img/booking-step-2.png" alt="step1">
                </div>
                <br>

                <?php  
                    include "dbconnect.php";
            
                    parse_str($_SERVER['QUERY_STRING'], $output);
                    $movieID = $output['movieid'];
                    $cinemaID = $output['cinemaid'];
                    $cinemaHallID = $output['cinemahallid'];
                    $showDate = $output['showdate'];
                    $showTime = $output['showtime'];
                    $cinemaSeatID = $output['cinemaseatid'];

                    $cinemaSeatID = explode(" ", $cinemaSeatID);

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
                            echo $alphabet[$row["row"]-1].':'.$row["col"];
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

                    $queryBeverage;

                    echo '
                    <div class="submission">
                        <form action="booking_confirmation.php" method="post" id="submissionForm">
                            <div class="promotions">

                                <p>Do you wish to add on any food & beverages or merchandise?</p>
                            </div>
                            
                            <br><br>
                            

                            <div class="particulars">
                                <p>Please enter your particulars</p>
                                <table class="table-form" border="0">
                                    <tr>
                                        <td>Name:</td>
                                        <td><input type="text" name="name" size="50"></td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td> <input type="text" name="email" size="50"></td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number:</td>
                                        <td><input type="text" name="phonenumber" size="50"></td>
                                    </tr>
                                </table>
                                <input id="goback" type="submit" value="Back">
                                <input id="applyNow" type="submit" value="Next">
                            </div>
                        </form>
                    </div>
                    
                    <br><br>';
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