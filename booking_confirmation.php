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
        .promotions {
            padding: 10px;
        }
        .table-form td{
            padding: 10px;
            text-align: right;
        }
        .ticket-table table{
            width: 100%;
            text-align: left;
            margin: 30px 0px;
        }
        .ticket-table th {
            background-color: #302c2d;
            padding: 20px;
        }
        .ticket-table td {
            background-color: #302c2d;
            padding: 10px 20px;
        }
        .total {
            font-size: 20px;
        }
        .table-form input {
            height: 25px;
        }
        .table-form {
            padding: 20px;
            margin-left: auto;
            margin-right: auto;
        }
        .radio-btn label{
            padding-right: 20px;
        }
        .next-btn {
            margin: 30px;
            text-align: center;
        }
    </style>
</head>
<body>
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
        <div class="content">
            <br>
            <div class="upper-content">

                <div class="step">
                    <img src="./img/booking-step-3.png" alt="step3">
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

                    $promotionSelectedNameArray = array();
                    $promotionSelectedPriceArray = array();
                    $queryFoodMerchandise = "SELECT * FROM Food
                                            UNION
                                            SELECT * FROM Merchandise;";
                    $resultFoodMerchandise = $dbcnx->query($queryFoodMerchandise);

                    $num_resultFoodMerchandise = $resultFoodMerchandise->num_rows;

                    for ($i=0; $i<$num_resultFoodMerchandise; $i++) {
                        $row = $resultFoodMerchandise->fetch_assoc();
                        $promotionSelectedNameArray[$i] = $row["name"];
                        $promotionSelectedPriceArray[$i] = $row["price"];
                    }

                    $selected_promotion = $_SESSION['promotion-cart'];
                    $freqs = array_count_values($selected_promotion);

                    $ticket_price;
                    $queryPrice = "SELECT price FROM Cinema_Hall WHERE cinemaHallID='".$cinemaHallID."'";
                    $resultPrice = $dbcnx->query($queryPrice);

                    $num_resultPrice = $resultPrice->num_rows;

                    for ($i=0; $i<$num_resultPrice; $i++) {
                        $row = $resultPrice->fetch_assoc();
                        $ticket_price = $row["price"];
                    }
                    $promotion_total = 0;
                    // <div class="submission">
                    //     <form action="booking_confirmation.php" method="post" id="submissionForm">

                            echo '
                            <div class="ticket-table"> 
                                <table border="0">
                                    <tr>
                                        <th>Ticket Type</th>
                                        <th>Ticket Price</th>
                                        <th>Qty</th>
                                        <th>Total Amount</th>
                                    </tr>
                                    <tr>
                                        <td>$'.$ticket_price.' - Standard Price</td>
                                        <td>$'.$ticket_price.'</td>
                                        <td>'.count($_SESSION['ticket-cart']).'</td>
                                        <td>$'.number_format((float)$ticket_price*count($_SESSION['ticket-cart']), 2, '.', '').'</td>
                                    </tr>';
                                
                                    
                                if (!empty($_SESSION['promotion-cart'])) {
                                    foreach($freqs as $key=>$val){
                                    $promotion_total = $promotion_total + $promotionSelectedPriceArray[$key]*$val;
                                    echo '<tr>
                                            <td>'.$promotionSelectedNameArray[$key].'</td>
                                            <td>$'.$promotionSelectedPriceArray[$key].'</td>
                                            <td>'.$val.'</td>
                                            <td>$'.number_format((float)$promotionSelectedPriceArray[$key]*$val, 2, '.', '').'</td>
                                        </tr>';
                                    }
                                }
                                
                                echo '<tr>
                                        <td>Convenience Fee</td>
                                        <td>$1.50</td>
                                        <td>1</td>
                                        <td>$1.50</td>
                                    </tr>
                                    <tr>
                                        <td class="total" colspan="4" align="right">Total: $'.number_format((float)(1.5+$ticket_price*count($_SESSION['ticket-cart'])+$promotion_total), 2, '.', '').'</td>
                                    </tr>
                                </table>
                            </div>
                            
                            ';
                            

                                
            
                                echo '
                                <div class="particulars">
                                    <p>Please enter your particulars</p>
                                    <div class="particular-form">
                                        <table class="table-form" border="0">
                                            <tr>
                                                <td>Name:</td>
                                                <td><input type="text" name="name" size="50" required></td>
                                            </tr>
                                            <tr>
                                                <td>Email:</td>
                                                <td><input type="email" name="email" size="50" required></td>
                                            </tr>
                                            <tr>
                                                <td>Phone Number:</td>
                                                <td><input type="text" name="phonenumber" size="50" required></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p>Select payment method</p>
                                    <div class="radio-btn">
                                        <label>
                                            <input type="radio" name="payment-method" value="creditcard" required>
                                            Visa/Master Card
                                        </label>
                                        
                                        <label>
                                            <input type="radio" name="payment-method" value="paypal">
                                            PayPal
                                        </label>
                                        
                                        <label>
                                            <input type="radio" name="payment-method" value="other">
                                            DBS PayLah!
                                        </label>
                                    </div>
                                </div>';
                             
                                

                            echo'<div class="next-btn" id="next-btn">
                                    <a href="./booking_confirmation.php?movieid='.$movieID.'&cinemaid='.$cinemaID.'&cinemahallid='.$cinemaHallID.'&showdate='.$showDate.'&showtime='.$showTime.'">
                                        <button class="button">
                                        Next
                                        </button>
                                    </a>
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