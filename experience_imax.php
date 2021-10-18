<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Imax</title>
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
    <link rel="stylesheet" href="css/experience_imax.css">
    <link rel="stylesheet" href="css/main.css">
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
        <p>
            <a href="index.php" class="other-page-breadcrumb">Home</a> /
            <a href="cinemas.php" class="other-page-breadcrumb">Cinemas</a> /
            <strong class="current-page-breadcrumb">IMAX</strong>
        </p>
        <br>
        <img src="img/experience/experience_imax_banner.jpeg" class="banner" alt="banner">
        <h1>IMAX</h1>
        <p>
            Go beyond the standard cinema experience with IMAX at GSC. Immersive, heart-pounding audio combined with
            crystal-clear images on the largest screens not only brings you closer to the action, but also enables you
            to experience films to the fullest. With IMAX, every element is designed and positioned to exact standards,
            including remote monitoring, real-time system adjustments and custom-designed theatres, to deliver the
            ultimate audio and visual experience.
        </p>
        <div class="feature-description">
            <div>
                <h2>Awe-Inspiring Images</h2>
                <p>
                    IMAX's proprietary state-of-the-art projection system produces up to 50 percent more brightness and 30
                    percent greater contrast than standard cinemas to deliver life-like, crystal-clear images and unrivaled
                    3D brightness and clarity.
                </p>
            </div>
            <div class="blank-column"></div>
            <img src="img/experience/imax/imax_feature1.png" height="350">
        </div>
        <div class="feature-description">
            <img src="img/experience/imax/imax_feature2.png" height="350">
            <div class="blank-column"></div>
            <div>
                <h2>Heart-Pounding Audio</h2>
                <p>IMAX's custom, patented surround sound system is perfectly tuned with laser-precise speaker orientation
                    that ensures every note of the soundtrack and every scuff of a shoe is clearer and more accurate than ever.
                </p>
            </div>
        </div>
        <div class="feature-description">
            <div>
                <h2>As The Filmmakers Intended</h2>
                <p>
                    More and more leading filmmakers are using proprietary IMAX cameras, which are the highest
                    resolution cameras in the world, to project an image that features 10x more resolution than 35mm
                    film. Sequences shot with the IMAX camera will allow filmmakers to present up to 40 percent more of
                    the image with unprecedented crispness, clarity, and colour saturation.
                </p>
            </div>
            <div class="blank-column"></div>
            <img src="img/experience/imax/imax_feature3.jpg" height="350">
        </div>
        <br><br>
        <p>
            IMAX also works closely with the director and technical teams of each film to enhance the most minute detail
            and resolution in every frame in a proprietary digital remastering process called IMAX DMR. Every movie,
            whether filmed with proprietary IMAX cameras or utilizing DMR, has a soundtrack remastered and optimized
            specifically for IMAX.
        </p>
        <br>
    </div>
    <?php include "components/footer.html"; ?>
</div>
</body>
</html>