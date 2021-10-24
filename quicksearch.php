<?php
include "dbconnect.php";
$date = $_POST["date"];
$movie = $_POST["movie"];
$showtime = $_POST["showtime"];
$cinema = $_POST["cinema"];

$query = 
"SELECT Showtime.cinemaHallID AS cinemaHallID, Showtime.movieID AS movieID, Cinema.cinemaID AS cinemaID 
FROM Showtime, Cinema WHERE Showtime.cinemaHallID IN (SELECT cinemaHallID FROM Cinema_Hall WHERE CinemaID = (SELECT cinemaID FROM Cinema WHERE name='".$cinema."')) 
AND Showtime.startTime='".$date." ".$showtime.":00'
AND Showtime.movieID = (SELECT movieID From Movie WHERE title='".$movie."') 
AND Cinema.cinemaID = (SELECT cinemaID FROM Cinema WHERE name='".$cinema."'); ";



$resultQuery = $dbcnx->query($query);
$numResultQuery = $resultQuery->num_rows;
for ($k=0; $k<$numResultQuery; $k++) {
    $row = $resultQuery->fetch_assoc();
    echo 
        '<script>
            window.location.href="./booking.php?movieid='.$row["movieID"].'&cinemaid='.$row["cinemaID"].'&cinemahallid='.$row["cinemaHallID"].'&showdate='.$date.'&showtime='.$showtime.':00";
        </script>';

}


?>
