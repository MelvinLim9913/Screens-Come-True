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
<<<<<<< HEAD
=======
        object {
            width: 70px;
            height: 70px;
        }
        object:hover {
            fill: red;
            color: red;
        }
>>>>>>> origin
        .tab {
            overflow: hidden;
            display: flex;
            justify-content: center;
        }
<<<<<<< HEAD
        .tab a img:hover {
            cursor: pointer;
        }
        .tab a h2:hover {
            cursor: pointer;
        }
=======
>>>>>>> origin
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
<<<<<<< HEAD
            border-radius: 50%;
        }
        .tabcontent h2 {

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
        .promotion-gallery img {
            height: 30em;
            width: 20em;
            padding-top: 50px;
            padding-bottom: 50px;
            padding-left: 50px;
            padding-right: 50px;
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
=======
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
>>>>>>> origin
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
<<<<<<< HEAD
            <a href="index.php" class="other-page-breadcrumb">Home</a> /
=======
            <a href="../index.php" class="other-page-breadcrumb">Home</a> /
>>>>>>> origin
            <strong class="current-page-breadcrumb">Promotions</strong>
        </p>
        <br>
        <div class="tab">
<<<<<<< HEAD
            <a class="tablinks" onclick="openPromoTab(event, 'food_beverages')" id="defaultOpen">
                <div class="icon-container">
                    <img src="img/promotion/cutlery.png" alt="logo">
                </div>
                <h2 style="text-align: center">Food & Beverages</h2>
=======
            <a class="tablinks" onclick="openPromoTab(event, 'food')" id="defaultOpen">
                <div class="icon-container">
                    <img src="img/promotion/cutlery.png" alt="logo">
                </div>
>>>>>>> origin
            </a>&nbsp;&nbsp;&nbsp;
            <a class="tablinks" onclick="openPromoTab(event, 'merchandise')">
                <div class="icon-container">
                    <img src="img/promotion/bag.png" alt="logo">
                </div>
<<<<<<< HEAD
                <h2 style="text-align: center">Merchandise</h2>
            </a>
        </div>
        <br><br>
        <div id="food_beverages" class="tabcontent">
            <div class="promotion-gallery">
                <img src="img/promotions/We_Bare_Bears_Combo_A.webp">
                <img src="img/promotions/We_Bare_Bears_Combo_B.webp">
                <img src="img/promotions/We_Bare_Bears_Combo_C.webp">
            </div>
        </div>
        <div id="merchandise" class="tabcontent">
            <div class="promotion-gallery">
                <img src="img/promotions/Minions_Tumbler.webp">
                <img src="img/promotions/We_Bare_Bears_Tumbler.webp">
            </div>
        </div>
    </div>

=======
            </a>
        </div>
    </div>
>>>>>>> origin
    <?php include "components/footer.html"; ?>
</div>
</body>
</html>
