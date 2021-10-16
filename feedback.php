<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
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
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/footer.css">
    <style>
        form {
            text-align: right;
        }
        hr {
            border: 2px solid #1a1a1a;
            margin: 20px 0px;
        }
        .feedback-form {
            background-color: #302c2d;
            margin: 30px 0;
            padding: 20px 0;
            border-radius: 20px;
            height: 400px;
        }
        .current-page-breadcrumb {
            color: #FFD60A;
        }
        .other-page-breadcrumb {
            color: #FFFFFF;
        }
        .other-page-breadcrumb:visited {
            color: #FFFFFF;
        }
        textarea {
            display: inline-block;
            border: 2px solid #000614;
            border-radius: 5px;
        }
        .feedback-form-headline {
            text-align: center;
            font-weight: bold;
            font-size: 20px;
            margin: 5px 0;
        }
        a {
            text-decoration: None;
        }
        .table-form input {
            height: 25px;
        }
        .table-form {
            padding: 20px;
            margin-left: auto;
            margin-right: auto;
        }
        .table-form td {
            padding: 0 40px 40px 0;
        }
        .next-btn {
            margin: 30px;
            text-align: center;
        }
        .pop-up-screen {
            position: fixed;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 120%;
            visibility: visible;
            transition: 0.5s;
            backdrop-filter: blur(10px);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .pop-up-box {
            position: relative;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            width: 500px;
            margin: 20px;
            padding: 50px 40px;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgb(0 0 0 / 20%);
            color: black;
        }
        .confirmation-message {
            text-align: center;
        }
        .back-to-home-btn {
            margin-top: 40px;
            text-align: center;
        }
    </style>
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
        <p><a href="../index.php" class="other-page-breadcrumb">Home</a> / <strong class="current-page-breadcrumb">Feedback</strong></p>
        <div class="feedback-form">
            <p class="feedback-form-headline">Feedback Form</p>
            <hr><br>
            <form action="feedback.php" method="post">
                <div class="feedback-table">
                    <table class="table-form" border="0">
                        <tr>
                            <td><label for="email-address">Email Address/Phone Number:</label></td>
                            <td><input
                                    type="text"
                                    name="emailAddress"
                                    id="email-address"
                                    placeholder="Please enter your email address or phone number."
                                    size="58.8px"
                                    required
                            ></td>
                        </tr>
                        <tr>
                            <td> <label for="feedback">Feedback:</label></td>
                            <td><textarea
                                        name="feedback"
                                        id="feedback"
                                        rows="10"
                                        cols="50"
                                        required
                                ></textarea></td>
                        </tr>
                    </table>
                </div>
                <div class="next-btn">
                    <input class="button" id="confirm" type="submit" value="Submit">
                </div>
            </form>
        </div>
        
        
        <?php
            $emailAddress = $_POST['emailAddress'];
            $feedback = $_POST['feedback'];

            if (isset($_POST['emailAddress']) && isset($_POST['feedback'])) {
                include "dbconnect.php";
                $insertBooking = "INSERT INTO Feedback (userInfo, feedbackContent) VALUES ('".$emailAddress."', '".$feedback."')";
                $dbcnx->query($insertBooking);
                echo '
                <div class="pop-up-screen">
                    <div class="pop-up-box">
                        <div class="confirmation-message">
                            <p>Your feedback has been received. Our team are looking into it. </p>
                            <p>Thank you!</p>
                        </div>
                        <div class="back-to-home-btn">
                            <button class="button" type="button" onclick="document.location.href=\'./index.php\'">Back To Home</button>
                        </div>
                    </div>
                </div>';
            }

        ?>


    </div>
    <?php include "components/footer.html"; ?>
</div>
</body>
</html>