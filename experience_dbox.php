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
    <link rel="stylesheet" href="css/experience_dbox.css">
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
        <img src="img/experience/experience_dbox_banner.jpg" class="banner">
        <h1>D-Box</h1>
        <p>
            After sound and image, D-BOX adds magic to films by introducing a new experience: immersive motion.
            Moviegoers will live the action just as if they were part of the scene that is occurring onscreen.<br><br>
            D-Box's technology is leading edge. After sound and image, D-BOX is the natural evolution of cinema. Much
            like a movie soundtrack, motion effect are created frame-by-frame by their Motion Designers in their
            California Studio, creating the unique patented D-BOX Motion Code.<br><br>
            The signal is then sent to the actuators that act like little robots under your seat. D-BOX is smooth and
            blends perfectly with the sound and image to make your cinematic experience complete. Its motion is
            multilevel; it can allow you to feel the intensity as if you were speeding in a car chase or let you feel
            the subtle movements as if your were by the ocean, feeling the relaxing waves. <br><br>
            The result is an unmatched immersive experience: you will feel as if you are part of the onscreen action
            taking place right before your eyes.
        </p>
        <br>
        <h2>D-BOX seats are available at:</h2>
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