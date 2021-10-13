<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ONYX</title>
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
    <link rel="stylesheet" href="css/experience_onyx_cinema.css">
    <link rel="stylesheet" href="css/footer.css">
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
        <img src="img/experience/experience_onyx_led_banner.jpeg" class="banner">
        <h1>ONYX Cinema LED Technology</h1>
        <p>
            Powered by the innovation at Samsung Electronics, Onyx is designed to transform the traditional cinema-going
            experience by delivering ultra-sharp high definition content on the silver screen with a futuristic LED
            theatre display.
        </p>
        <div class="feature-description">
            <div >
                <h2>The Cinema of the Future</h2>
                <p>
                    Sensing the need to transcend the outdated projector-based systems that hve been the industry
                    standard over the past 120 years, Samsung is prepared to play a starring role in delivering the most
                    advanced graphics and refined production techniques and defining the "cinema of the future" with its
                    new Cinema LED Technology called "Onyx".<br>
                    By bringing the viual power of LED picture quality to the big screen, Samsung Onyx offers viewers
                    more powerful, compelling and memorable content. Inspired by the gemstone of the same name, the
                    Samsung Onyx brand alludes to the display's ability to showcase cinematic content with true black
                    colors. Backed by brilliant LED picture quality and an infinite contrast ratio, Samsung ONyx ensures
                    movie content like never before.
                </p>
            </div>
            <div class="blank-column"></div>
            <img src="img/experience/onyx/onyx_feature4.png" height="350">
        </div>
        <div class="feature-description">
            <img src="img/experience/onyx/onyx_feature1.png" height="350">
            <div class="blank-column"></div>
            <div >
                <h2>Redefined Black</h2>
                <p>
                    By featuring true black colors, Samsung Onyx VIEW offers viewers the most detail-rich and vivid
                    content environment possible. The Onyx VIEW brings the visual power of LED technology to the theater
                    by delivering HDR supported content and allows for ambient light without degradation of picture
                    quality.
                </p>
            </div>
        </div>
        <div class="feature-description">
            <div >
                <h2>Extreme Reality</h2>
                <p>
                    The 3D version of Samsung Onyx accomplishes the impossible - making 3D cinema content even more
                    vivid and realistic. Featuring high-brightness and industry-leading 3D dimensional depth, this
                    specialised composition brings visual details to the forefront and allows for subtitles to be easier
                    to read.
                </p>
            </div>
            <div class="blank-column"></div>
            <img src="img/experience/onyx/onyx_feature2.png" height="350">
        </div>
        <div class="feature-description">
            <img src="img/experience/onyx/onyx_feature3.png" height="350">
            <div class="blank-column"></div>
            <div >
                <h2>Perfectly Tuned Audio</h2>
                <p>
                    With support from HARMAN Professional's JBL Sculpted Surround technology, the Onyx SOUND expands
                    the audio sweet spot within a given theater, When combined with Samsung's proprietary technology,
                    the end result leaves you with sound that is optimized and perfectly-tuned to fit LED screens.
                </p>
            </div>
        </div>
        <br>
        <h2>Onyx Cinema LED Technology Available at:</h2>
        <ul>
            <li>Dummy</li>
            <li>Dummy</li>
        </ul>
        <br>
    </div>
    <?php include "components/footer.html"; ?>
</div>
</body>
</html>