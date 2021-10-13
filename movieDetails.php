<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
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
    <link rel="stylesheet" href="css/movieDetails.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/footer.css">
    <script>
        function getDate(selectedDate) {
            console.log(selectedDate);
            let allDates = document.getElementsByName('showdates');
            Array.prototype.forEach.call(allDates, (item) => item.removeAttribute('class'));
            let elementDate= document.getElementById(selectedDate);
            elementDate.setAttribute('class', 'active');
        }
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
        <?php
            include "dbconnect.php";
            
            parse_str($_SERVER['QUERY_STRING'], $output);
            $movieID = $output['movieid'];
            $showDate = $output['showdate'];

            $queryMovieDetails = "SELECT * FROM Movie WHERE movieID='".$movieID."'";
            $resultMovieDetails = $dbcnx->query($queryMovieDetails);

            $num_resultMovieDetails = $resultMovieDetails->num_rows;

            for ($i=0; $i <$num_resultMovieDetails; $i++) {
                $row = $resultMovieDetails->fetch_assoc();
                echo '
                    <h2>'.$row["title"].'</h2>
                    <div class="movie-content"> 
                        <div class="movie-posters">
                            <img src="img/movies/' . $row["imagePath"]. '.jpg" alt="movie-poster" width="300" height="400">
                        </div>
                        <div class="movie-details">
                            <h4>Details</h4>
                            <table class="table-1" border="0">
                                <tr>
                                    <td class="details-title">Cast:</td>
                                    <td class="details-description">'.$row["cast"].'</td>
                                </tr>
                                <tr>
                                    <td class="details-title">Director:</td>
                                    <td class="details-description">'.$row["director"].'</td>
                                </tr>
                            </table>
                            
                            <table class="table-2" border="0">
                                <tr>
                                    <td class="details-title">Release:</td>
                                    <td class="details-description">'.$row["releaseDate"].'</td>
                                </tr>
                                <tr>
                                    <td class="details-title">Running Time:</td>
                                    <td class="details-description">'.$row["runningTime"].'</td>
                                </tr>
                                <tr>
                                    <td class="details-title">Genre:</td>
                                    <td class="details-description">'.$row["genre"].'</td>
                                </tr>
                                <tr>
                                    <td class="details-title">Language:</td>
                                    <td class="details-description">'.$row["language"].'</td>
                                </tr>    
                            </table>
                            
                            <div>
                                <br>
                                <h4>Synopsis</h4>
                                <p class="details-description">'.$row["synopsis"].'</p>
                            </div>

                        </div>
                    </div>';
                }    
        ?>
        <div class="date-content">
            <table border="0">
                <tr>
                    <?php
                        $queryIfNowShowing = "SELECT * FROM Movie WHERE movieID='".$movieID."' AND releaseDate <= '2021-10-18'";
                        $resultIfNowShowing = $dbcnx->query($queryIfNowShowing);

                        if ($resultIfNowShowing->num_rows >0 ) {
                            $queryShowtimesDates = "SELECT DISTINCT DATE(startTime) As datelist FROM Showtime;";
                            $resultShowtimesDates = $dbcnx->query($queryShowtimesDates);
    
                            $num_resultShowtimesDates = $resultShowtimesDates->num_rows;
                            for ($i=0; $i <$num_resultShowtimesDates; $i++) {
                                $row = $resultShowtimesDates->fetch_assoc();
                                echo '<td id="'.$row["datelist"].'" name="showdates">
                                        <a href="'.$_SERVER['PHP_SELF'].'?movieid='.$movieID.'&showdate='.$row["datelist"].'">
                                            <div style="height:100%;width:100%">
                                                '.date('D', strtotime($row["datelist"])).'<br>'.date('j M Y', strtotime($row["datelist"])).'
                                            </div>
                                        </a>
                                    </td>';
                            }
                        }
                        
                        ?>
                    <script>
                        let urlparams = new URLSearchParams(window.location.search);
                        let showDate = urlparams.get('showdate');
                        let elementDate= document.getElementById(showDate);
                        elementDate.setAttribute('class', 'active');
                    </script>
                </tr>
            </table>
        </div>
        <br>
        <div class="showtimes-content">
            <table border="0">

                <?php
                    if ($resultIfNowShowing->num_rows >0 ) {
                        $queryMovieShowtimes = "SELECT cinemaHallID, startTime FROM Showtime WHERE movieID='".$movieID."' and DATE(startTime)='".$showDate."' GROUP BY 1, 2";
                        $resultMovieShowtimes = $dbcnx->query($queryMovieShowtimes);
                        $cinemaID;
                        $showTimeList = array_fill(1, 8, array());

                        $num_resultMovieShowtimes = $resultMovieShowtimes->num_rows;
                        for ($i=0; $i <$num_resultMovieShowtimes; $i++) {
                            $row = $resultMovieShowtimes->fetch_assoc();

                            $cinemaHallId = $row["cinemaHallID"];
                            $queryCinemaID = "SELECT cinemaID FROM Cinema_Hall WHERE cinemaHallID='".$cinemaHallId."'";
                            $resultCinemaID = $dbcnx->query($queryCinemaID);
                            $cinemaID;

                            $num_resultCinemaID = $resultCinemaID->num_rows;
                            for ($j=0; $j <$num_resultCinemaID; $j++) {
                                $rowinner = $resultCinemaID->fetch_assoc();
                                $cinemaID = $rowinner["cinemaID"];
                                array_push($showTimeList[$cinemaID], date('G:i', strtotime($row["startTime"])));
                            }
                        }

                        $num_showTimeList = count($showTimeList)+1;
                        for ($i=1; $i<$num_showTimeList; $i++) {
                            $col = count($showTimeList[$i]);
                            $cinemaName;
            
                            $queryCinemaName = "SELECT name FROM Cinema WHERE cinemaID='".$i."'";
                            $resultCinemaName = $dbcnx->query($queryCinemaName);

                            $num_resultCinemaName = $resultCinemaName->num_rows;
                            for ($k=0; $k <$num_resultCinemaName; $k++) {
                                $row = $resultCinemaName->fetch_assoc();
                                $cinemaName = $row["name"];
                            }
                            echo '<tr>
                                    <td><h3>'.$cinemaName.'</h3></td>
                                    <td>
                                        <ul>';
                            
                            for ($j=0; $j<$col; $j++) {
                                echo '<a href="./booking.php?movieid='.$movieID.'&cinemaid='.$i.'&showdate='.$showDate.' '.$showTimeList[$i][$j].':00"><li>'.$showTimeList[$i][$j].'</li></a>';
                            }
                                    
                            echo       '</ul>
                                    </td>
                                </tr>';
                        }
                    }
                ?>
            </table>
        </div>
    </div>
    <br><br>
    <?php include "components/footer.html"; ?>
</div>
</body>
</html>