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
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
        }
        .seating-plan hr {
            height: 5px;
            color: #a0a0a0;
            background-color: #a0a0a0;
        }
        .seating-plan {
            text-align: center;
        }
        .seating-plan {
            background-color: #1a1a1a;
        }
        .seating-plan img {
            padding: 4px 2px;
        }
        .seat-sold {
            padding-left: 3px;
            padding-right: 4.5px;
        }
        .legend {
            padding: 20px 0px;
            padding-right: 20px
        }
        .legend img {
            padding-left: 20px;
            padding-right: 10px;
        }
        select {
            height: 30px;
            width: 150px;
            border-radius: 5px;
            text-indent: 10px;
        }
        .ticket-table table{
            width: 100%;
            text-align: left;
            margin-bottom: 20px;
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
        .next-btn {
            margin-bottom: 20px;
        }
    </style>
    <!-- <script>
        function selectSeat(cinemaSeatID) {

            movieID = urlparams.get('movieid');
            cinemaID = urlparams.get('cinemaid');
            cinemaHallID = urlparams.get('cinemahallid');
            showDate = urlparams.get('showdate');
            showTime = urlparams.get('showtime');

            console.log(cinemaSeatID);
            if (document.getElementById(cinemaSeatID).src == "http://192.168.56.2/f32ee/Screens-Come-True/img/seat-selected.png") {
                document.getElementById(cinemaSeatID).src="./img/seat-available.png"
                document.getElementById(cinemaSeatID).removeAttribute("class");
            } else {
                document.getElementById(cinemaSeatID).src="./img/seat-selected.png"
                document.getElementById(cinemaSeatID).setAttribute('class', 'selected');
            }
            if (document.getElementsByClassName("selected")) {
                var selectedClass = document.getElementsByClassName("selected");
                var selectedID = ''
                var selectedName = ''
                for (var i=0; i<selectedClass.length; i++) {
                    selectedID += selectedClass[i].id + ' ';
                    selectedName += selectedClass[i].name + ' ';
                    console.log(selectedID)
                    console.log(selectedName)
                }
                
                var no_selected = document.getElementsByClassName("selected").length;
                if (no_selected != 0) {
                    document.getElementById('no-seat-selected').innerHTML="<h2>Selected: " + selectedName + "</h2>";
                    document.getElementById('next-btn').innerHTML="<button class=\"button\" onclick=\"location.href='./booking_particulars.php?movieid=" + movieID + "&cinemaid=" + cinemaID + "&cinemahallid=" + cinemaHallID + "&showdate=" + showDate + "&showtime=" + showTime + "&cinemaseatid=" + selectedID +"'\"=>Next</button><br><br>";
                } else {
                    document.getElementById('no-seat-selected').innerHTML="";
                }
                
            }
        }
    </script> -->
</head>
<body>
    <div id="wrapper">
        <?php
            session_start();
            //unset($_SESSION['ticket-cart']);
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
                    <img src="./img/booking-step-1.png" alt="step1">
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

                    if (!isset($_SESSION['ticket-cart'])){
                        $_SESSION['ticket-cart'] = array();
                    }
                    if (isset($_GET['buy'])) {
                        if (($key = array_search($_GET['buy'], $_SESSION['ticket-cart'])) !== false) {

                        } else {
                            $_SESSION['ticket-cart'][] = $_GET['buy'];
                        }
                    }
                    else if (isset($_GET['drop'])) {
                        if (($key = array_search($_GET['drop'], $_SESSION['ticket-cart'])) !== false) {
                            unset($_SESSION['ticket-cart'][$key]);
                        }
                    } else {
                        unset($_SESSION['ticket-cart']);
                        $_SESSION['ticket-cart'] = array();
                    }
                    
                    $movieName;
                    $movieImagePath;
                    $cinemaName;
                    $cinemaHallName;
                    $showDateTime;

                    if ($showDate && !$cinemaHallID) {
                        $showDateTime = $showDate.' '.$showTime;
                        $querySelectedCinemaHallID = "SELECT cinemaHallID FROM Showtime WHERE movieID='".$movieID."' and startTime='".$showDateTime."'and cinemaHallID IN 
                                            (SELECT cinemaHallID FROM Cinema_Hall WHERE cinemaID='".$cinemaID."')";

                        $resultSelectedCinemaHallID = $dbcnx->query($querySelectedCinemaHallID);
                        $num_resultSelectedCinemaHallID = $resultSelectedCinemaHallID->num_rows;

                        for ($i=0; $i<$num_resultSelectedCinemaHallID; $i++) {
                            $row = $resultSelectedCinemaHallID->fetch_assoc();
                            $cinemaHallID = $row["cinemaHallID"];
                        }

                    }
                    
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


                    echo '<div class="movie-content">
                            <div class="movie-posters">
                                <img src="img/movies/'.$movieImagePath.'.jpg" alt="movie-poster" width="300" height="400">
                            </div>
                            <div class="movie-details">
                            <div class="query">
                                <br><br>
                                ';
                            if ($cinemaHallID) {
                                echo '<span>You have selected &nbsp;</span><span class="head2">'.$movieName.'</span><span>&nbsp; at &nbsp;</span><span class="head2">'.$cinemaName.'</span><span>&nbsp; Cinema Hall &nbsp;</span><span class="head2">'.$cinemaHallName.'</span>
                                ';
                            }
                            echo '<hr><br>
                            <table border="0">
                                <tr>
                                    <td>Cinemas:</td>
                                    <td>Date:</td>
                                    <td>Time:</td>
                                    <td></td>
                                </tr>';
                    
                    $cinemaIDToCinemaNameArray;

                    $queryCinemaHallID = "SELECT DISTINCT cinemaHallID FROM Showtime WHERE movieID='".$movieID."'";
                    $resultCinemaHallID = $dbcnx->query($queryCinemaHallID);

                    $num_resultCinemaHallID = $resultCinemaHallID->num_rows;

                    for ($i=0; $i<$num_resultCinemaHallID; $i++) {
                        $row = $resultCinemaHallID->fetch_assoc();
                        
                        $queryCinemaID = "SELECT DISTINCT cinemaID FROM Cinema_Hall WHERE cinemaHallID='".$row["cinemaHallID"]."'";
                        $resultCinemaID = $dbcnx->query($queryCinemaID);
    
                        $num_resultCinemaID = $resultCinemaID->num_rows;

                        for ($j=0; $j<$num_resultCinemaID; $j++) {
                            $rowinner = $resultCinemaID->fetch_assoc();

                            $queryCinemaName = "SELECT DISTINCT name FROM Cinema WHERE cinemaID='".$rowinner["cinemaID"]."'";
                            $resultCinemaName = $dbcnx->query($queryCinemaName);
        
                            $num_resultCinemaName = $resultCinemaName->num_rows;
        
                            for ($k=0; $k<$num_resultCinemaName; $k++) {
                                $rowinnerinner = $resultCinemaName->fetch_assoc();
                                $cinemaIDToCinemaNameArray[$rowinner["cinemaID"]] = $rowinnerinner["name"];
                            }
                        }
                    }

                    echo '
                        <tr>
                            <td>
                                <select name="cinema" id="cinema-option" onchange="location = this.value;">
                                    <option value="'.$_SERVER['PHP_SELF'].'?movieid='.$movieID.'" selected>
                                        <div style="height:100%;width:100%">
                                            Select a Cinema
                                        </div>
                                    </option>';
                                
                                for ($i=1; $i<count($cinemaIDToCinemaNameArray)+1; $i++) {
                                    echo '
                                        <option value="'.$_SERVER['PHP_SELF'].'?movieid='.$movieID.'&cinemaid='.$i.'">
                                            <div style="height:100%;width:100%">
                                                '.$cinemaIDToCinemaNameArray[$i].'
                                            </div>
                                        </option>';
                                    }
                            echo '</td>';
                            ?>
                    <script>
                        let urlparams = new URLSearchParams(window.location.search);
                        let movieID = urlparams.get('movieID');
                        let cinemaID = urlparams.get('cinemaid');
                        if (cinemaID) {
                            document.getElementById('cinema-option').getElementsByTagName('option')[cinemaID].selected = 'selected';
                        }
                    </script>

                    <?php

                    $cinemaShowDateToCinemaShowTimeArray = array();
                    $cinemaShowDateArray = array();

                    $queryCinemaHallIDList = "SELECT cinemaHallID FROM Cinema_Hall WHERE cinemaID='".$cinemaID."'";
                    $resultCinemaHallIDList = $dbcnx->query($queryCinemaHallIDList);

                    $num_resultCinemaHallIDList = $resultCinemaHallIDList->num_rows;

                    for ($i=0; $i<$num_resultCinemaHallIDList; $i++) {
                        $row = $resultCinemaHallIDList->fetch_assoc();
                        
                        $queryShowTime = "SELECT startTime FROM Showtime WHERE movieID='".$movieID."' AND cinemaHallID='".$row["cinemaHallID"]."'";
                        $resultShowTime = $dbcnx->query($queryShowTime);

                        $num_resultShowTime = $resultShowTime->num_rows;

                        for ($j=0; $j<$num_resultShowTime; $j++) {
                            $rowinner = $resultShowTime->fetch_assoc();
                            
                            if (empty($cinemaShowDateToCinemaShowTimeArray[date('Y-m-d', strtotime($rowinner["startTime"]))])) {
                                $cinemaShowDateToCinemaShowTimeArray[date('Y-m-d', strtotime($rowinner["startTime"]))] = array();
                                array_push($cinemaShowDateArray, date('Y-m-d', strtotime($rowinner["startTime"])));
                            }
                            array_push($cinemaShowDateToCinemaShowTimeArray[date('Y-m-d', strtotime($rowinner["startTime"]))], date('H:i', strtotime($rowinner["startTime"])));
                        }
                    }             
                    
                    echo '
                        <td>
                            <select name="date-option" id="date-option" onchange="location = this.value;">
                                <option value="'.$_SERVER['PHP_SELF'].'?movieid='.$movieID.'&cinemaid='.$cinemaID.'" selected>
                                    <div style="height:100%;width:100%" id="">
                                        Select date
                                    </div>
                                </option>';
                                for ($i=0; $i<count($cinemaShowDateArray); $i++) {
                                    echo
                                    '<option value="'.$_SERVER['PHP_SELF'].'?movieid='.$movieID.'&cinemaid='.$cinemaID.'&showdate='.$cinemaShowDateArray[$i].'">
                                            <div style="height:100%;width:100%" id="">
                                                '.$cinemaShowDateArray[$i].'
                                            </div>
                                    </option>';
                                }

                        echo '</td>'
                    ?>
                    <script>
                        let showDate = urlparams.get('showdate');
                        let cinemaHallID = urlparams.get('cinemahallid');
                        if (showDate) {
                            var dateList = document.getElementById("date-option");
                            for (var i = 0; i < dateList.length; i++) {
                                var option = dateList.options[i];
                                if (option.text == showDate) {
                                    document.getElementById('date-option').getElementsByTagName('option')[i].selected = 'selected';
                                }
                            }
                        }
                    </script>

                    <?php

                    echo '
                        <td>
                            <select name="time-option" id="time-option" onchange="location = this.value;">
                                <option value="'.$_SERVER['PHP_SELF'].'?movieid='.$movieID.'&cinemaid='.$cinemaID.'&showdate='.$showDate.'" selected>
                                    <div style="height:100%;width:100%" id="">
                                        Select time
                                    </div>
                            </option>';

    
                            $currTime = $cinemaShowDateToCinemaShowTimeArray[$showDate];
                            for ($j=0; $j<count($currTime); $j++) {
                                echo '
                                <option value="'.$_SERVER['PHP_SELF'].'?movieid='.$movieID.'&cinemaid='.$cinemaID.'&showdate='.$showDate.'&showtime='.$currTime[$j].':00">
                                    <div style="height:100%;width:100%" id="">
                                        '.$currTime[$j].'
                                    </div>
                                </option>';
                                
                            }
                    
                    
                            echo'
                                </td>';
                            
                            
                            echo '
                            <td class="view">
                                <a href="'.$_SERVER['PHP_SELF'].'?movieid='.$movieID.'&cinemaid='.$cinemaID.'&cinemahallid='.$cinemaHallID.'&showdate='.$showDate.'&showtime='.$showTime.'">
                                    <div style="height:90%;width:100%" class="view-seating-plan">
                                        <p>View Seating Plan</p>
                                    </div>
                                </a>
                            </td>';
                        

                        echo '</tr>
                        </table>
                    </div><br><br>';
                    
                    ?>
                        

                    <script>
                        let showTime = urlparams.get('showtime');
                        if (showTime) {
                            var timeList = document.getElementById("time-option");
                            for (var i = 0; i < timeList.length; i++) {
                                var optionTime = timeList.options[i];
                                if ((optionTime.text)+':00' == showTime) {
                                    document.getElementById('time-option').getElementsByTagName('option')[i].selected = 'selected';
                                }
                            }
                        }
                    </script>


                    <?php
                        if ($movieID && $cinemaID && $output['cinemahallid'] && $showDate && $showTime) {
                            echo '
                            <div class="seating-plan">
                            <hr>
                            Screen
                            <br>
                            <br>';
                        
                        $showtimeID;
                        $cinemaSeatIDArray = array();   # array of cinemaSeatID (1-48)
                        $cinemaSeatIDRowColArray = array();     #array of key->array(value), cinemaSeatID -> array(row, col)
                        $rowCol = array();              # array[row] = col
                        $occupiedSeat = array();        # array of occuppied cinemaSeatID
                        $getCinemaSeatID = array();     # array[row][col] = cinemaSeatID
                        
                        $showDateTime = $showDate.' '.$showTime;
                        $queryShowTimeID = "SELECT showtimeID FROM Showtime WHERE movieID='".$movieID."' AND startTime='".$showDateTime."' AND cinemaHallID='".$cinemaHallID."'";
                        $resultShowTimeID = $dbcnx->query($queryShowTimeID);

                        $num_resultShowTimeID = $resultShowTimeID->num_rows;

                        for ($i=0; $i<$num_resultShowTimeID; $i++) {
                            $row = $resultShowTimeID->fetch_assoc();
                            $showtimeID = $row["showtimeID"];
                        }

                        $queryCinemaSeatIDArray = "SELECT cinemaSeatID, row, col FROM Cinema_Seat WHERE cinemaHallID='".$cinemaHallID."'";
                        $resultCinemaSeatIDArray = $dbcnx->query($queryCinemaSeatIDArray);

                        $num_resultCinemaSeatIDArray = $resultCinemaSeatIDArray->num_rows;

                        for ($i=0; $i<$num_resultCinemaSeatIDArray; $i++) {
                            $row = $resultCinemaSeatIDArray->fetch_assoc();
                            array_push($cinemaSeatIDArray, $row["cinemaSeatID"]);
                            $cinemaSeatIDRowColArray[$row["cinemaSeatID"]] = array();
                            array_push($cinemaSeatIDRowColArray[$row["cinemaSeatID"]], $row["row"]);
                            array_push($cinemaSeatIDRowColArray[$row["cinemaSeatID"]], $row["col"]);
                            $getCinemaSeatID[$row["row"]][$row["col"]] = $row["cinemaSeatID"];

                            $rowCol[$row["row"]] = $row["col"];
                            
                            $querySeatAvailable = "SELECT bookingID FROM Showtime_Seat WHERE showtimeID='".$showtimeID."' AND cinemaSeatID='".$row["cinemaSeatID"]."'";
                            $resultSeatAvailable= $dbcnx->query($querySeatAvailable);

                            $num_resultSeatAvailable = $resultSeatAvailable->num_rows;
                            
                            for ($j=0; $j<$num_resultSeatAvailable; $j++) {
                                $rowinner = $resultSeatAvailable->fetch_assoc();
                                if ($rowinner["bookingID"]) {
                                    array_push($occupiedSeat, $row["cinemaSeatID"]);
                                }
                            }

                        }

                        $alphabet = range('A', 'Z');
                        for ($i=1; $i<count($rowCol)+1; $i++) {
                            echo '<div>';
                            echo $alphabet[$i-1].'&nbsp;&nbsp;';
                            for ($j=1; $j<=$rowCol[$i]; $j++) {
                                if ($j==3 || $j==7){
                                    echo '&nbsp;&nbsp;';
                                }
                                if (in_array($getCinemaSeatID[$i][$j], $occupiedSeat, TRUE)) {
                                    echo '<span class="seat-sold"><img id="'.$getCinemaSeatID[$i][$j].'" name="'.$alphabet[$i-1].':'.$j.'" src="./img/seat-sold.png" alt="seat-sold" width="25" height="25" ></span>';
                                }
                                else if (in_array($getCinemaSeatID[$i][$j], $_SESSION['ticket-cart'], TRUE)) {
                                    echo '<a href="'.$_SERVER['PHP_SELF'].'?movieid='.$movieID.'&cinemaid='.$cinemaID.'&cinemahallid='.$cinemaHallID.'&showdate='.$showDate.'&showtime='.$showTime.'&drop='.$getCinemaSeatID[$i][$j].'">
                                            <img id="'.$getCinemaSeatID[$i][$j].'" name="'.$alphabet[$i-1].':'.$j.'" src="./img/seat-selected.png" alt="seat-selected" width="25" height="25">
                                        </a>';
                                }
                                else {
                                    echo '<a href="'.$_SERVER['PHP_SELF'].'?movieid='.$movieID.'&cinemaid='.$cinemaID.'&cinemahallid='.$cinemaHallID.'&showdate='.$showDate.'&showtime='.$showTime.'&buy='.$getCinemaSeatID[$i][$j].'">
                                            <img id="'.$getCinemaSeatID[$i][$j].'" name="'.$alphabet[$i-1].':'.$j.'" src="./img/seat-available.png" alt="seat-available" width="25" height="25">
                                        </a>';
                                }
                            }
                            echo '&nbsp;&nbsp;'.$alphabet[$i-1];
                            echo '</div>';
                        }

                        echo '<div class="legend">
                                <img src="./img/seat-available.png" alt="seat-available" width="25" height="25"><span>Available</span>
                                <img src="./img/seat-selected.png" alt="seat-selected" width="25" height="25"><span>Selected</span>
                                <img src="./img/seat-sold.png" alt="seat-sold" width="25" height="25"><span>Sold</span>
                            </div>';
                        

                        $price;
                        $queryPrice = "SELECT price FROM Cinema_Hall WHERE cinemaHallID='".$cinemaHallID."'";
                        $resultPrice = $dbcnx->query($queryPrice);

                        $num_resultPrice = $resultPrice->num_rows;

                        for ($i=0; $i<$num_resultPrice; $i++) {
                            $row = $resultPrice->fetch_assoc();
                            $price = $row["price"];
                        }


                        $selected = $_SESSION['ticket-cart'];

                        if ($selected) {
                                echo '
                                <div class="no-seat-selected" id="no-seat-selected">
                                    <h2>Selected: '.count($selected).'</h2>
                                </div>
                                <br>
                                <div class="ticket-table"> 
                                    <table border="0">
                                        <tr>
                                            <th>Ticket Type</th>
                                            <th>Ticket Price</th>
                                            <th>Qty</th>
                                            <th>Total Amount</th>
                                        </tr>
                                        <tr>
                                            <td>$'.$price.' - Standard Price</td>
                                            <td>$'.$price.'</td>
                                            <td>'.count($selected).'</td>
                                            <td>$'.number_format((float)$price*count($selected), 2, '.', '').'</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Convenience Fee</td>
                                            <td>$1.50</td>
                                            <td>1</td>
                                            <td>$1.50</td>
                                        </tr>
                                        <tr>
                                            <td class="total" colspan="4" align="right">Total: $'.number_format((float)(1.5+$price*count($selected)), 2, '.', '').'</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="next-btn" id="next-btn">
                                    <a href="./booking_addons.php?movieid='.$movieID.'&cinemaid='.$cinemaID.'&cinemahallid='.$cinemaHallID.'&showdate='.$showDate.'&showtime='.$showTime.'">
                                        <button class="button">
                                         Next
                                        </button
                                    </a>
                                </div>
                                
                                ';
                        }
                    
                        }
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