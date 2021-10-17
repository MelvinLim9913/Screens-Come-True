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
                    <label>Phone Number*: <input type="number" name="booking-number" class="phone-email-box"></label><br><br>
                </div>
                <input class="button" type="submit" value="Check">
            </form>
        </div>
        <div>
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
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                include "dbconnect.php";

                $email = $_POST["booking-email"];
                $phone_number = $_POST["booking-number"];

                $bookingQuery = "
                SELECT Temp1.bookingID, Movie.title, Temp1.startTime, Temp1.price, Temp2.name as cinemaName, GROUP_CONCAT(Temp3.row) AS rows, GROUP_CONCAT(Temp3.col) AS cols, Temp4.quantity as foodQuantity, Temp4.name as foodName, Temp4.price as foodPrice, Temp5.quantity as merchandiseQuantity, Temp5.name as merchandiseName, Temp5.price as merchandisePrice
                FROM Movie, 
                (SELECT Showtime.startTime, Showtime.movieID, Showtime.cinemaHallID, BookingTemp.bookingID, BookingTemp.price
                FROM Showtime, (
                SELECT bookingID, showtimeID, price
                FROM Booking WHERE email = '" . $email . "' AND phone = '" . $phone_number ."'
                ) BookingTemp
                WHERE Showtime.showtimeID = BookingTemp.showtimeID) Temp1,
                (SELECT Cinema.name, Cinema_Hall.cinemaHallID FROM Cinema, Cinema_Hall WHERE Cinema_Hall.cinemaID = Cinema.cinemaID) Temp2, 
                    (SELECT Cinema_Seat.row, Cinema_Seat.col, Showtime_Seat.bookingID 
                        FROM Cinema_Seat, Showtime_Seat 
                        WHERE Cinema_Seat.cinemaSeatID = Showtime_Seat.cinemaSeatID) Temp3, 
                (SELECT Booking.bookingID, FoodTemp.quantity, FoodTemp.name, FoodTemp.price FROM (SELECT Food_Order.bookingID, Food_Order.quantity, Food.name, Food.price FROM Food, Food_Order WHERE Food_Order.foodID = Food.foodID) FoodTemp RIGHT JOIN Booking ON Booking.bookingID = FoodTemp.bookingID) Temp4,
                (SELECT Booking.bookingID, MerchandiseTemp.quantity, MerchandiseTemp.name, MerchandiseTemp.price FROM (SELECT Merchandise_Order.bookingID, Merchandise_Order.quantity, Merchandise.name, Merchandise.price FROM Merchandise, Merchandise_Order WHERE Merchandise_Order.merchandiseID = Merchandise.merchandiseID) MerchandiseTemp RIGHT JOIN Booking ON Booking.bookingID = MerchandiseTemp.bookingID) Temp5
                WHERE Movie.movieID = Temp1.movieID AND 
                Temp2.cinemaHallID = Temp1.cinemaHallID AND
                Temp3.bookingID = Temp1.bookingID AND
                Temp4.bookingID = Temp1.bookingID AND
                Temp5.bookingID = Temp1.bookingID
                GROUP BY bookingID ORDER BY Temp1.startTime DESC;";
                $bookingDetails = $dbcnx->query($bookingQuery);
                if (mysqli_num_rows($bookingDetails) > 0) {
                    while ($row = mysqli_fetch_assoc($bookingDetails)) {

                        // Process Seats using cols and rows
                        $seat_rows = $row["rows"];
                        $seat_col = $row["cols"];
                        $alphabet = range('A', 'Z');
                        $chosen_seat_list = array();
                        foreach ($seat_rows as &$row_idx) {
                            foreach ($seat_col as &$col_idx) {
                                $seat = $alphabet[$row_idx] . $col_idx;
                                array_push($chosen_seat_list, $seat);
                            }
                        }
                        unset($seat);
                        unset($row_idx);
                        unset($col_idx);


                        if ((time()-(60*60*24)) > strtotime($row["startTime"])) {
                            echo'
                            <tr>
                                <td>' . date("Y-m-d", strtotime($row["startTime"])) . '</td>
                                <td>' . date("H:i", strtotime($row["startTime"])) . '</td>
                                <td>' . $row["title"] . '</td>
                                <td>' . $row["cinemaName"] . '</td>
                                <td>' . implode(", ", $chosen_seat_list) . '</td>
                            ';
                                if (!empty($row["foodName"]) && !empty($row["merchandiseName"])) {
                                    echo '
                                <td>' . $row["foodName"] . ' x ' . $row["foodQuantity"] . '<br>' .
                                        $row["merchandiseName"] . ' x ' . $row["merchandiseQuantity"] . '</td>
                                ';
                                } elseif (!empty($row["foodName"])) {
                                    echo '<td>' . $row["foodName"] . ' x ' . $row["foodQuantity"] . '</td>';
                                } elseif (!empty($row["merchandiseName"])) {
                                    echo '<td>' . $row["merchandiseName"] . ' x ' . $row["merchandiseQuantity"] . '</td>';
                                }
                                echo '<td>' . $row["price"] . '</td>';
                        } else {
                            echo'
                            <tr class="disabled">
                                <td>' . date("Y-m-d", strtotime($row["startTime"])) . '</td>
                                <td>' . date("H:i", strtotime($row["startTime"])) . '</td>
                                <td>' . $row["title"] . '</td>
                                <td>' . $row["cinemaName"] . '</td>
                                <td>' . implode(", ", $chosen_seat_list) . '</td>
                            ';
                            if (!empty($row["foodName"]) && !empty($row["merchandiseName"])) {
                                echo '
                                <td>' . $row["foodName"] . ' x ' . $row["foodQuantity"] . '<br>' .
                                    $row["merchandiseName"] . ' x ' . $row["merchandiseQuantity"] . '</td>
                                ';
                            } elseif (!empty($row["foodName"])) {
                                echo '<td>' . $row["foodName"] . ' x ' . $row["foodQuantity"] . '</td>';
                            } elseif (!empty($row["merchandiseName"])) {
                                echo '<td>' . $row["merchandiseName"] . ' x ' . $row["merchandiseQuantity"] . '</td>';
                            }
                            echo '<td>' . $row["price"] . '</td>';
                        }

                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include "components/footer.html"; ?>
</div>
</body>
</html>
