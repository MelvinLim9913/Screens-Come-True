<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Promotion</title>
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
    <link rel="stylesheet" href="css/promotions.css">
    <link rel="stylesheet" href="css/footer.css">

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
    if (isset($_SESSION['userID']))
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
            <a class="tablinks" name="food" onclick="openPromoTab(event, 'food_beverages')" id="defaultOpen">
                <div class="icon-container">
                    <img src="img/promotion/cutlery.png" alt="logo">
                </div>
                <h2 style="text-align: center">Food & Beverages</h2>
            </a>&nbsp;&nbsp;&nbsp;
            <a class="tablinks" name="merchandise" onclick="openPromoTab(event, 'merchandise')">
                <div class="icon-container">
                    <img src="img/promotion/bag.png" alt="logo">
                </div>
                <h2 style="text-align: center">Merchandise</h2>
            </a>
        </div>
        <script>
            let urlparams = new URLSearchParams(window.location.search);
            let action = urlparams.get('action');
            if (action == "merchandise") {
                document.getElementsByName("merchandise")[0].id = "defaultOpen";
                document.getElementsByName("food")[0].removeAttribute("id");
            }
            else {
                document.getElementsByName("food")[0].id = "defaultOpen";
            }
        </script>

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
