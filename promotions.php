<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Promotion</title>
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
    <style>
        .tab {
            overflow: hidden;
            display: flex;
            justify-content: center;
        }
        .tab a img:hover {
            cursor: pointer;
        }
        .tab a h2:hover {
            cursor: pointer;
        }
        .tab img {
            height: 120px;
            width: 120px;
        }
        .icon-container {
            width: 120px;
            height: 120px;
            margin-top: 30px;
            margin-bottom: 20px;
            margin-left: 100px;
            margin-right: 100px;
            border-radius: 50%;
        }
        .tabcontent {
            display: none;
        }
        .tablinks-current {
            text-shadow: 0 0 10px white;
        }
        .tablinks-current .icon-container {
            box-shadow: 0px 0px 15px 5px #ffffff;
        }
        .promotion-gallery {
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
            padding-top: 20px;
        }
        .image-container {
            padding-top: 50px;
            padding-bottom: 50px;
            padding-left: 50px;
            padding-right: 50px;
        }
        .image-container img {
            height: 30em;
            width: 20em;
        }
        .image-container h4 {
            margin: 5px;
        }
        .image-container i {
            color: #8c8c8c;
        }
    </style>
    <script>
        function openPromoTab(evt, promoType) {
            let i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i ++) {
                tablinks[i].className = tablinks[i].className.replace("active", "");
                tablinks[i].className = tablinks[i].className.replace("tablinks-current", "");
            }
            document.getElementById(promoType).style.display = "grid";
            evt.currentTarget.className += " tablinks-current";
        }
    </script>
</head>
<body onload="document.getElementById('defaultOpen').click();">
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
            <strong class="current-page-breadcrumb">Promotions</strong>
        </p>
        <br>
        <div class="tab">
            <a class="tablinks" onclick="openPromoTab(event, 'food_beverages')" id="defaultOpen">
                <div class="icon-container">
                    <img src="img/promotion/cutlery.png" alt="logo">
                </div>
                <h2 style="text-align: center">Food & Beverages</h2>
            </a>&nbsp;&nbsp;&nbsp;
            <a class="tablinks" onclick="openPromoTab(event, 'merchandise')">
                <div class="icon-container">
                    <img src="img/promotion/bag.png" alt="logo">
                </div>
                <h2 style="text-align: center">Merchandise</h2>
            </a>
        </div>
        <br><br>
        <div id="food_beverages" class="tabcontent">
            <div class="promotion-gallery">
                <?php
                include "dbconnect.php";

                $foodQuery = "
                SELECT name, price, imagePath
                FROM `Food`
                ";
                $resultFoodQuery = $dbcnx->query($foodQuery);

                while ($row = mysqli_fetch_assoc($resultFoodQuery)) {
                    $imgPath = "img/promotions/" . $row["imagePath"] . ".webp";

                    echo '
                    <div class="image-container">
                        <img src="' . $imgPath . '" alt="logo">
                        <h4>' . $row["name"] . '</h4>
                        <i>$' . $row["price"] . '</i>
                    </div>
                    ';
                }
                ?>
            </div>
        </div>
        <div id="merchandise" class="tabcontent">
            <div class="promotion-gallery">
                <?php
                $merchandiseQuery = "
                SELECT name, price, imagePath
                FROM `Merchandise`
                ";
                $resultMerchandiseQuery = $dbcnx->query($merchandiseQuery);

                while ($row = mysqli_fetch_assoc($resultMerchandiseQuery)) {
                    $imgPath = "img/promotions/" . $row["imagePath"] . ".webp";

                    echo '
                    <div class="image-container">
                        <img src="' . $imgPath . '" alt="logo">
                        <h4>' . $row["name"] . '</h4>
                        <i>$' . $row["price"] . '</i>
                    </div>
                    ';
                }
                ?>
            </div>
        </div>
    </div>
    <?php include "components/footer.html"; ?>
</div>
</body>
</html>
