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
        .pop-up-screen {
            position: fixed;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 120%;
            visibility: visible;
            transition: 0.5s;
            backdrop-filter: blur(10px);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .pop-up-box {
            position: relative;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            width: 500px;
            margin: 20px;
            padding: 50px 40px;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgb(0 0 0 / 20%);
            color: black;
        }
        .confirmation-message {
            text-align: center;
        }
        .back-to-home-btn {
            margin-top: 40px;
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
                    $showtimeSeatID = array();
                    
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
                    for ($j=0; $j<count($cinemaSeatID); $j++) {
                        $queryShowtimeSeatID = "SELECT showtimeSeatID FROM Showtime_Seat WHERE cinemaSeatID='".$cinemaSeatID[$j]."' AND showtimeID='".$showtimeID."'";
                        $resultShowtimeSeatID = $dbcnx->query($queryShowtimeSeatID);

                        $num_resultShowtimeSeatID = $resultShowtimeSeatID->num_rows;

                        for ($i=0; $i<$num_resultShowtimeSeatID; $i++) {
                            $row = $resultShowtimeSeatID->fetch_assoc();
                            array_push($showtimeSeatID, $row["showtimeSeatID"]);
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

                    $queryNumOfFood = "SELECT * FROM Food";
                    $resultNumOfFood = $dbcnx->query($queryNumOfFood);

                    $num_resultNumOfFood = $resultNumOfFood->num_rows;

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
                    $promotion_message = "";

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
                                        $promotion_message = $promotion_message.$val.'x '.$promotionSelectedNameArray[$key].' - $'.number_format((float)$promotionSelectedPriceArray[$key]*$val, 2, '.', '')."\r\n";
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
                                <div class="submission">
                                    <form action="'.$_SERVER['PHP_SELF'].'?movieid='.$movieID.'&cinemaid='.$cinemaID.'&cinemahallid='.$cinemaHallID.'&showdate='.$showDate.'&showtime='.$showTime.'" method="post" id="submissionForm">
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
                                                    <td><input type="text" name="phone" size="50" required></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <p>Select payment method</p>
                                        <div class="radio-btn">
                                            <label>
                                                <input type="radio" name="paymentmethod" value="creditcard" required>
                                                Visa/Master Card
                                            </label>
                                            
                                            <label>
                                                <input type="radio" name="paymentmethod" value="paypal">
                                                PayPal
                                            </label>
                                            
                                            <label>
                                                <input type="radio" name="paymentmethod" value="dbs">
                                                DBS PayLah!
                                            </label>
                                        </div>
                                        <div class="next-btn">
                                            <input class="button" id="confirm" type="submit" value="Confirm and Pay">
                                        </div>
                                    </form>
                                </div>';

                                $name = $_POST['name'];
                                $email = $_POST['email'];
                                $phone = $_POST['phone'];
                                $paymentmethod = $_POST['paymentmethod'];


                                if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['paymentmethod'])) {

                                    $available = true;
                                    for ($i=0; $i<count($cinemaSeatID); $i++) {
                                        $querySeatAvailable = "SELECT bookingID FROM Showtime_Seat WHERE showtimeID='".$showtimeID."' AND cinemaSeatID='".$cinemaSeatID[$i]."'";
                                        $resultSeatAvailable= $dbcnx->query($querySeatAvailable);
                
                                        $num_resultSeatAvailable = $resultSeatAvailable->num_rows;
                                        
                                        for ($j=0; $j<$num_resultSeatAvailable; $j++) {
                                            $rowinner = $resultSeatAvailable->fetch_assoc();
                                            if ($rowinner["bookingID"]) {
                                                $available = false;
                                            }
                                        }
                                    }


                                    if ($available) {

                                    $bookingID = uniqid();
                                    if (isset($_SESSION['valid_user']))
                                    {
                                        $insertBooking = "INSERT INTO Booking (bookingID, numberOfSeats, userID, showtimeID, name, email, phone, price) VALUES ('".$bookingID."', '".count($_SESSION['ticket-cart'])."', '".$_SESSION['valid_user']."'".$showtimeID."', '".$name."', '".$email."', '".$phone."', '".(1.5+$ticket_price*count($_SESSION['ticket-cart'])+$promotion_total)."')";
                                        $dbcnx->query($insertBooking);
                                    }
                                    else {
                                        $insertBooking = "INSERT INTO Booking (bookingID, numberOfSeats, showtimeID, name, email, phone, price) VALUES ('".$bookingID."', '".count($_SESSION['ticket-cart'])."', '".$showtimeID."', '".$name."', '".$email."', '".$phone."', '".(1.5+$ticket_price*count($_SESSION['ticket-cart'])+$promotion_total)."')";
                                        $dbcnx->query($insertBooking);
                                    }
                                    
                                    for ($i=0; $i<count($showtimeSeatID); $i++) {
                                        $updateShowtimeSeat = "UPDATE Showtime_Seat SET bookingID='".$bookingID."' WHERE showtimeSeatID='".$showtimeSeatID[$i]."'";
                                        $dbcnx->query($updateShowtimeSeat);
                                    }
                                    
                                    $num_resultNumOfFood;

                                    if (!empty($_SESSION['promotion-cart'])) {
                                        foreach($freqs as $key=>$val){
                                            if ($key < $num_resultNumOfFood) {
                                                # food & beverages
                                                $insertFoodOrder = "INSERT INTO Food_Order (bookingID, foodID, quantity) VALUES ('".$bookingID."', '".($key+1)."', '".$val."')";
                                                $dbcnx->query($insertFoodOrder);
                                            }
                                            else {
                                                # merchandise
                                                $insertMerchandiseOrder = "INSERT INTO Merchandise_Order (bookingID, merchandiseID, quantity) VALUES ('".$bookingID."', '".($key-$num_resultNumOfFood+1)."', '".$val."')";
                                                $dbcnx->query($insertMerchandiseOrder);
                                            }
                                        }
                                    }

                                    $to      = $email;
                                    $subject = 'Screens Come True - Movies Purchase Confirmation';
                                    $message = 'This is an automatically generated meggage. Please do not reply to this address.'
                                                ."\r\n"."\r\n".
                                                'Hi '.$name.', thank you for your purchase!'
                                                ."\r\n".
                                                $movieName
                                                ."\r\n".
                                                date('Y-m-d', strtotime($showDate)).', '.date('H:i', strtotime($showTime))
                                                ."\r\n".
                                                $cinemaName.' Hall '.$cinemaHallName
                                                ."\r\n"."\r\n".
                                                'Seat No(s): '.$rowCol
                                                ."\r\n".
                                                count($_SESSION['ticket-cart']).'x Standard Ticket(s) - $'.number_format((float)$ticket_price*count($_SESSION['ticket-cart']), 2, '.', '')
                                                ."\r\n".
                                                $promotion_message.
                                                'Convenience Fee - $1.50'
                                                ."\r\n".
                                                'Grand Total - $'.number_format((float)(1.5+$ticket_price*count($_SESSION['ticket-cart'])+$promotion_total), 2, '.', '')
                                                ;
                                    $headers = 'From: f32ee@localhost' . "\r\n" .
                                        'Reply-To: f32ee@localhost' . "\r\n" .
                                        'X-Mailer: PHP/' . phpversion();

                                    mail($to, $subject, $message, $headers,'-ff32ee@localhost');
                                    echo ("mail sent to : ".$to);

                                echo '
                                </div>
                            </div>
                        </div>
                    </div> ';

                    echo '
                    <div class="pop-up-screen">
                        <div class="pop-up-box">
                            <div class="confirmation-message">
                                <p>Payment successful.</p>
                                <p>Your Booking Reference ID is '.$bookingID.'.</p>
                                <p>E-ticket(s) and transaction receipt have sent to your email.</p>
                                <p>Enjoy the movie!</p>
                            </div>
                            <div class="back-to-home-btn">
                                <button class="button" type="button" onclick="document.location.href=\'./index.php\'">Back To Home</button>
                            </div>
                        </div>
                    </div>
                    ';}
                    
                    else {
                        echo '
                                </div>
                            </div>
                        </div>
                    </div> ';

                    echo '
                    <div class="pop-up-screen">
                        <div class="pop-up-box">
                            <div class="confirmation-message">
                                <p>The seat(s) chosen have been taken.</p>
                                <p>Please select seats again. Sorry for the inconvenience caused.</p>
                            </div>
                            <div class="back-to-home-btn">
                                <button class="button" type="button" onclick="document.location.href=\'./booking.php?movieid='.$movieID.'&cinemaid='.$cinemaID.'&cinemahallid='.$cinemaHallID.'&showdate='.$showDate.'&showtime='.$showTime.'\'">Back To Seat Selection</button>
                            </div>
                        </div>
                    </div>
                    ';
                     }
                    }
                    
                ?>
               
        </div>
        <?php include "components/footer.html"; ?>
    </div>
</body>
</html>