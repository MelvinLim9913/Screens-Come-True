<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Check Your Bookings</title>
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
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/button.css">
    <style>
        .check-booking-component {
            border-radius: 15px;
            background: dimgrey;
            padding: 10px;
        }
        .check-booking-component h1 {
            text-align: center;
        }
        .check-booking-component .button {
            text-align: center;
            display: block;
            margin-right: 5px;
            margin-left: auto;
        }
        .phone-email-box {
            width: 50%;
            height: 30px;
        }
        .input-area {
            display: flex;
            justify-content: space-between;
        }
        .booking-table th {
            border-bottom: 1px solid #364043;
            color: #E2B842;
            font-size: 0.85em;
            font-weight: 600;
            padding: 1em 1em;
            text-align: left;
        }
        td {
            color: #fff;
            font-weight: 400;
            padding: 0.65em 1em;
        }
        .disabled td {
            color: #4F5F64;
        }
        tbody tr {
            transition: background 0.25s ease;
        }
        tbody tr:hover {
            background: slategrey;
        }
        .booking-table {
            background: black;
            border-radius: 0.25em;
            border-collapse: collapse;
            text-align: left;
            width: 100%;
        }
    </style>
    <script>
    </script>
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
        <p>
            <a href="index.php" class="other-page-breadcrumb">Home</a> /
            <strong class="current-page-breadcrumb">Check Bookings</strong>
        </p>
        <br>
        <div class="check-booking-component">
            <h1>
                Check your bookings
            </h1>
            <hr>
            <form method="post">
                <div class="input-area">
                    <label>Email Address*: <input type="email" name="booking-email" class="phone-email-box"></label>
                    <label>Phone Number*: <input type="text" name="booking-number" class="phone-email-box"></label><br><br>
                </div>
                <input class="button" type="submit" value="Check">
            </form>
        </div>
        
                <?php
                include "dbconnect.php";

                $email = $_POST["booking-email"];
                $phone_number = $_POST["booking-number"];

                if (isset($email) && isset($phone_number)) {

        echo '<div>
            <h2>Your Bookings</h2>
            <table class="booking-table">
                <thead class="booking-table-headers">
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Movie</th>
                        <th>Cinema</th>
                        <th>Seat No.</th>
                        <th>Add-Ons</th>
                        <th>Total</th>
                        <th>Booking Ref</th>
                    </tr>
                </thead>
                <tbody>';

                    $bookingIDArray = array();
                    $bookingIDToShowtimeID = array();
                    $bookingIDToTotalPrice = array();

                    $queryBookingID = "SELECT bookingID, showtimeID, price FROM Booking WHERE email='".$email."' AND phone='".$phone_number."'";
                    $resultBookingID = $dbcnx->query($queryBookingID);

                    $num_resultBookingID = $resultBookingID->num_rows;

                    for ($i=0; $i <$num_resultBookingID; $i++) {
                        $row = $resultBookingID->fetch_assoc();
                        array_push($bookingIDArray, $row["bookingID"]);
                        $bookingIDToShowtimeID[$row["bookingID"]] = $row["showtimeID"];
                        $bookingIDToTotalPrice[$row["bookingID"]] = $row["price"];
                    }

                    $bookingIDToFoodOrder = array();
                    $bookingIDToMerchandiseOrder = array();

                    for ($j=0; $j<count($bookingIDArray); $j++) {
                        $queryFoodOrder = "SELECT Food.name AS name, Food_Order.quantity AS quantity FROM Food_Order, Food WHERE Food_Order.foodID = Food.id AND Food_Order.bookingID='".$bookingIDArray[$j]."'";
                        $resultFoodOrder = $dbcnx->query($queryFoodOrder);

                        $num_resultFoodOrder = $resultFoodOrder->num_rows;

                        for ($i=0; $i <$num_resultFoodOrder; $i++) {
                            $row = $resultFoodOrder->fetch_assoc();
                            $bookingIDToFoodOrder[$bookingIDArray[$j]] = $row["name"].' x'.$row["quantity"];
                        }

                        $queryMerchandiseOrder = "SELECT Merchandise.name AS name, Merchandise_Order.quantity AS quantity FROM Merchandise_Order, Merchandise WHERE Merchandise_Order.merchandiseID = Merchandise.id AND Merchandise_Order.bookingID='".$bookingIDArray[$j]."'";
                        $resultMerchandiseOrder = $dbcnx->query($queryMerchandiseOrder);

                        $num_resultMerchandiseOrder = $resultMerchandiseOrder->num_rows;

                        for ($i=0; $i <$num_resultMerchandiseOrder; $i++) {
                            $row = $resultMerchandiseOrder->fetch_assoc();
                            $bookingIDToMerchandiseOrder[$bookingIDArray[$j]] = $row["name"].' x'.$row["quantity"];
                        }
                        
                        $querySeat = "SELECT Cinema_Seat.row AS row, Cinema_Seat.col AS col FROM Cinema_Seat, Showtime_Seat WHERE Cinema_Seat.cinemaSeatID = Showtime_Seat.cinemaSeatID AND Showtime_Seat.bookingID='".$bookingIDArray[$j]."'";
                        $resultSeat = $dbcnx->query($querySeat);

                        $num_resultSeat = $resultSeat->num_rows;
                        $bookingIDToSeat = array();

                        $alphabet = range('A', 'Z');
                        for ($i=0; $i <$num_resultSeat; $i++) {
                            $row = $resultSeat->fetch_assoc();
                            $bookingIDToSeat[$bookingIDArray[$j]] = $bookingIDToSeat[$bookingIDArray[$j]].$alphabet[$row["row"]-1].':'.$row["col"].' ';
                        }


                        $currShowtimeID = $bookingIDToShowtimeID[$bookingIDArray[$j]];

                        $queryShowTime = "SELECT Showtime.startTime AS startTime, Movie.title AS title, Cinema_Hall.name AS hallname, Cinema.name AS cinemaname FROM Showtime, Movie, Cinema, Cinema_Hall WHERE Showtime.showtimeID='".$currShowtimeID."' AND Showtime.cinemaHallID = Cinema_Hall.cinemaHallID AND Showtime.movieID = Movie.movieID AND Cinema.cinemaID = Cinema_Hall.cinemaID";
                        $resultShowTime = $dbcnx->query($queryShowTime);

                        $num_resultShowTime = $resultShowTime->num_rows;

                        for ($i=0; $i <$num_resultShowTime; $i++) {
                            $row = $resultShowTime->fetch_assoc();

                            echo '<tr>
                                <td>'.date('Y-m-d', strtotime($row["startTime"])).'</td>
                                <td>'.date('H:i', strtotime($row["startTime"])).'</td>
                                <td>'.$row["title"].'</td>
                                <td>'.$row["cinemaname"].', Hall '.$row["hallname"].'</td>
                                <td>'.$bookingIDToSeat[$bookingIDArray[$j]].'</td>';
                            if (empty($bookingIDToFoodOrder[$bookingIDArray[$j]]) && empty($bookingIDToMerchandiseOrder[$bookingIDArray[$j]])){
                                echo '<td> - </td>';
                            }
                            else{
                                echo '<td>'.$bookingIDToFoodOrder[$bookingIDArray[$j]]."\r\n".$bookingIDToMerchandiseOrder[$bookingIDArray[$j]].'</td>';
                            }
                                
                                echo '<td>$'.$bookingIDToTotalPrice[$bookingIDArray[$j]].'</td>
                                <td>'.$bookingIDArray[$j].'</td>



                            </tr>';
                            
                        }
                        
                    }
                    echo'
                    </tbody>
            </table>
        </div>';
                }
                ?>
                
    </div>
    <?php include "components/footer.html"; ?>
</div>
</body>
</html>
