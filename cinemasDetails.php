<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <title>Screens Come True</title>
    <?php
    session_start();
    if (isset($_SESSION['userID']))
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
    <link rel="stylesheet" href="css/cinemaDetails.css">
</head>
<body>
<div id="wrapper">
    <?php
        if (isset($_SESSION["userID"])) {
            include "components/header_userloginsess.html";
        } else {
            include "components/header.html";
        }
    ?>
    <div class="content">
        <?php
            include "dbconnect.php";

            parse_str($_SERVER["QUERY_STRING"], $output);
            $cinemaID = $output["cinemaid"];
            $showDate = $output["showdate"];

            $queryCinemaDetails = "
            SELECT * 
            FROM `Cinema`
            WHERE cinemaID='" . $cinemaID . "'";
            $resultCinemaDetails = $dbcnx->query($queryCinemaDetails);
            $num_resultCinemaDetails = $resultCinemaDetails->num_rows;

//            for ($i = 0; $i < $num_resultCinemaDetails; $i++) {
//                $row = $resultCinemaDetails->fetch_assoc();
            while ($row = mysqli_fetch_assoc($resultCinemaDetails)) {
                echo '
                    <h2>Screens Come True, ' . $row["name"] . '</h2>
                    <div class="cinema-details">
                        <table>
                            <tr>
                                <td class="details-title">Number of Screens:</td>
                                <td class="details-description">' . $row["numberOfScreen"] .'</td>
                            </tr>
                            <tr>
                                <td class="details-title">Address:</td>
                                <td class="details-description">' . $row["address"] . '</td>
                            </tr>
                            <tr>
                                <td class="details-title">Public Transport:</td>
                                <td class="details-description"><span class="transport-tag">MRT</span>' . $row["mrt"] . '<br>
                                <span class="transport-tag">BUS</span>' . $row["bus"] . '</td>
                            </tr>
                        </table>
                    </div>
                ';
            }
        ?>
        
        <div class="date-content">
            <table border="0">
                <tr>
                    <?php
                        $queryIfNowShowing = "SELECT * FROM Movie WHERE releaseDate <= '2021-10-18'";
                        $resultIfNowShowing = $dbcnx->query($queryIfNowShowing);

                        if ($resultIfNowShowing->num_rows >0 ) {
                            $queryShowtimesDates = "SELECT DISTINCT DATE(startTime) As datelist FROM Showtime;";
                            $resultShowtimesDates = $dbcnx->query($queryShowtimesDates);
    
                            $num_resultShowtimesDates = $resultShowtimesDates->num_rows;
                            for ($i=0; $i <$num_resultShowtimesDates; $i++) {
                                $row = $resultShowtimesDates->fetch_assoc();
                                echo '<td id="'.$row["datelist"].'" name="showdates">
                                        <a href="'.$_SERVER['PHP_SELF'].'?cinemaid='.$cinemaID.'&showdate='.$row["datelist"].'">
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
                        
                        $showTimeList = array();
                        $queryCinemaHallID = "SELECT cinemaHallID FROM Cinema_Hall WHERE cinemaID='".$cinemaID."'";
                        $resultCinemaHallID = $dbcnx->query($queryCinemaHallID);

                        $num_resultCinemaHallID = $resultCinemaHallID->num_rows;
                        for ($i=0; $i <$num_resultCinemaHallID; $i++) {
                            $row = $resultCinemaHallID->fetch_assoc();

                            $queryMovieShowtimes = "SELECT movieID, startTime FROM Showtime WHERE cinemaHallID='".$row["cinemaHallID"]."' and DATE(startTime)='".$showDate."' GROUP BY 1, 2";
                            $resultMovieShowtimes = $dbcnx->query($queryMovieShowtimes);

                            $num_resultMovieShowtimes = $resultMovieShowtimes->num_rows;
                            for ($j=0; $j<$num_resultMovieShowtimes; $j++) {
                                $rowinner = $resultMovieShowtimes->fetch_assoc();
                                if (empty($showTimeList[$rowinner["movieID"]])) {
                                    $showTimeList[$rowinner["movieID"]] = array();
                                }
                                array_push($showTimeList[$rowinner["movieID"]], $row["cinemaHallID"]);
                                array_push($showTimeList[$rowinner["movieID"]], date('G:i', strtotime($rowinner["startTime"])));
                            }
                        }

                        foreach($showTimeList as $key=>$val){
                            $queryMovieDetails = "SELECT title, imagePath FROM Movie WHERE movieID='".$key."'";
                            $resultMovieDetails = $dbcnx->query($queryMovieDetails);

                            $num_resultMovieDetails = $resultMovieDetails->num_rows;

                            for ($k=0; $k<$num_resultMovieDetails; $k++) {
                                $row = $resultMovieDetails->fetch_assoc();
                                $movieTitle = $row["title"];
                                $movieImage = $row["imagePath"];
                            }

                            echo '<tr>
                                    <td class="table-poster" rowspan="2"><br><img src="./img/movies/'.$movieImage.'.jpg" width="220" height="300"></td>
                                    <td class="table-movie"><h3>'.$movieTitle.'</h3></td>
                                    
                                </tr>
                                <tr>
                                    <td class="table-showtime">
                                        
                                        <ul>';
                            
                            for ($j=0; $j<count($val); $j=$j+2) {
                                echo '<a href="./booking.php?movieid='.$key.'&cinemaid='.$cinemaID.'&cinemahallid='.$val[$j].'&showdate='.$showDate.'&showtime='.$val[$j+1].':00"><li>'.$val[$j+1].'</li></a>';
                            }
                                    
                            echo       '</ul>
                                    </td>
                                </tr>'
                                ;


                        }
                    }
                ?>
            </table>
        </div>
    </div>
    <?php include "components/footer.html"; ?>
</div>
</body>
</html>
