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
        .booking-table {
            background: #012B39;
            border-radius: 0.25em;
            border-collapse: collapse;
            margin: 1em;
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
                <label>Email Address*: <input type="email" name="booking-email"></label>
                <label>Phone Number*: <input type="number" name="booking-number"></label><br><br>
                <input class="button" type="submit" value="Check">
            </form>
        </div>
        <?php
        include "dbconnect.php";

        $email = $_POST["booking-email"];
        $phone_number = $_POST["booking-number"];

        print($email);
        print($phone_number);
        $bookingQuery = "
        SELECT Showtime.startTime, Movie.title, Cinema.name,  
        FROM `Booking`, `Showtime` WHERE Booking.showtimeID = Showtime.showtimeID";
        $resultBookingQuery = $dbcnx->query($bookingQuery);
        print($row = $resultBookingQuery->fetch_assoc());
        print($resultBookingQuery->num_rows);
        ?>
        <div>
            <h2>Your Bookings</h2>
            <table class="booking-table">
                <thead>
                <tr>Date</tr>
                <tr>Time</tr>
                <tr>Movie</tr>
                <tr>Cinema</tr>
                <tr>Seat No.</tr>
                <tr>Add-Ons</tr>
                <tr>Price</tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <?php include "components/footer.html"; ?>
</div>
</body>
</html>
