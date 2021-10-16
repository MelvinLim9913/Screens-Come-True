<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DBOX</title>
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
        object {
            width: 70px;
            height: 70px;
        }
        object:hover {
            fill: red;
            color: red;
        }
        .tab {
            overflow: hidden;
            display: flex;
            justify-content: center;
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
            box-shadow: 0px 0px 15px 5px #ffffff;
            border-radius: 50%;
        }
    </style>
    <script>
        window.onload=function() {
            // Get the Object by ID
            var a = document.getElementById("svgObject");
            // Get the SVG document inside the Object tag
            var svgDoc = a.contentDocument;
            // Get one of the SVG items by ID;
            var svgItem = svgDoc.getElementById("svgItem");
            // Set the colour to something else
            a.setAttribute("fill", "lime");
        };
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
            <a href="../index.php" class="other-page-breadcrumb">Home</a> /
            <strong class="current-page-breadcrumb">Promotions</strong>
        </p>
        <br>
        <div class="tab">
            <a class="tablinks" onclick="openPromoTab(event, 'food')" id="defaultOpen">
                <div class="icon-container">
                    <img src="img/promotion/cutlery.png" alt="logo">
                </div>
            </a>&nbsp;&nbsp;&nbsp;
            <a class="tablinks" onclick="openPromoTab(event, 'merchandise')">
                <div class="icon-container">
                    <img src="img/promotion/bag.png" alt="logo">
                </div>
            </a>
        </div>
    </div>
    <?php include "components/footer.html"; ?>
</div>
</body>
</html>
