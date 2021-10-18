<?php
include "dbconnect.php";
$date = $_POST["date"];
$movie = $_POST["movie"];
$showtime = $_POST["showtime"];
$cinema = $_POST["cinema"];
print($cinema);
print($movie);
print($showtime);
print($date);


$query = "
SELECT Movie.id AS movieID, Cinema.id cinemaID, Cinema_Hall.cinemaHallID AS cinemaHallId
FROM `Movie`, `Cinema`, `Cinema_Hall`
WHERE Showtime.startTime='" . $date . $showtime .":00' AND 
Movie.title='" . $movie . "' AND 
Cinema.name='" . $cinema . "'
";

$resultQuery = $dbcnx->query($query);
$numResultQuery = $resultQuery->num_row;
for ($k=0; $k<$numResultQuery; $k++) {
    $row = $resultQuery->fetch_assoc();
    print($row["movieID"]);
}

?>
