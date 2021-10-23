<?php
include "dbconnect.php";
$date = $_POST["date"];
$movie = stripcslashes($_POST["movie"]);
$showtime = $_POST["showtime"];
$cinema = $_POST["cinema"];
print($cinema);
print($movie);
print($showtime);
print($date);


$query = "SELECT Showtime.cinemaHallID AS cinemaHallID, Showtime.movieID AS movieID, Cinema.cinemaID AS cinemaID 
FROM Showtime, Cinema WHERE Showtime.cinemaHallID IN (SELECT cinemaHallID FROM Cinema_Hall WHERE CinemaID = (SELECT cinemaID FROM Cinema WHERE name='".$cinema."')) 
AND Showtime.startTime='". $date. " " .$showtime .":00' 
AND Showtime.movieID = (SELECT movieID From Movie WHERE title='".$movie."') 
AND Cinema.cinemaID = (SELECT cinemaID FROM Cinema WHERE name='".$cinema."')";

//"SELECT Showtime.cinemaHallID AS cinemaHallID, Showtime.movieID AS movieID, Cinema.cinemaID AS cinemaID
//FROM Showtime, Cinema WHERE Showtime.cinemaHallID IN (SELECT cinemaHallID FROM Cinema_Hall WHERE CinemaID = (SELECT cinemaID FROM Cinema WHERE name='Jurong Point'))
//AND Showtime.startTime='2021-10-11 10:00:00'
//AND Showtime.movieID = (SELECT movieID From Movie WHERE title='The Boss Baby: Family Business')
//AND Cinema.cinemaID = (SELECT cinemaID FROM Cinema WHERE name='Jurong Point');"

$resultQuery = $dbcnx->query($query);
$numResultQuery = $resultQuery->num_row;
for ($k=0; $k<$numResultQuery; $k++) {
    $row = $resultQuery->fetch_assoc();
    print($row["movieID"]);
}

?>
