<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DOLBY ATMOS</title>
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
    <link rel="stylesheet" href="css/experience_dolby_atmos.css">
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
        <img src="img/experience/experience_dolby_atmos_banner.jpg" class="banner">
        <h1>Dolby Atmos</h1>
        <p>
            The Dolby Atmos is the most significant development in cinema audio since surround sound, taking a unique
            layered approach to sound design. It redefines the cinema expereince by offering content creators new ways
            to tell their stories. This sound platform preserves the director's intent in each scene on what you hear in
            the theatre accurately to reflect the filmmaker's vision and ensure an immersive movie experience possible.
        </p>
        <br>
        <h2>Benefits of Dolby Atmos</h2>
        <ul>
            <li>Delivers a powerful and dramatic new cinema sound listening experience</li>
            <li>Allows sounds to move around the theatre to create dynamic effects</li>
            <li>Reproduces a natutal and lifelike audio experience that perfectly matches the story</li>
            <li>Adds overhead speakers for the most realistic effects you've ever heard</li>
            <li>Reflects the artist's original intent, regardless of theatre setup</li>
            <li>Employs up to 64 speakers to heighten the realism and impact of every scene</li>
            <li>Dolby Atmos is a revolutionary new audio platform tha tvastly expands the artistic palette
            available during content creation, simplifies distribution and enables dramatic cinema-sound experiences</li>
        </ul>
        <h2>Dolby Atmos is available at:</h2>
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