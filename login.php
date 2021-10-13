<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="login.js"></script>
    <title>Login / Register</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/header_loginpage.css">

    <style>
        body {
            color: #FFFFFF;
            background-color: #1a1a1a;
        }
        .content {
            padding-top: 100px;
        }
        .incontent {
            height: 500px;
            width: 800px;
            margin: auto;
            background-color: #000000;
        } 
        td {
            width: 400px;
            height: 500px;
            vertical-align: top;
            text-align: left;
        }
        .tab {
            overflow: hidden;
            border: white;
        }
        .tablinks {
            display: block;
            width: 50%;
            color: white;
            padding: 14px 20px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            
        }

            /* Style the buttons that are used to open the tab content */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s; 
             
        }

            /* Change background color of buttons on hover */
        .tab button:hover {
            font-weight: bold;
        }

            /* Create an active/current tablink class */
        .tab button.active {
            color: #EA2127;
            font-weight: bold;
        }

            /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid grey;
            border-top: none;
            border: none;
        }
        form {
            text-align: right;
        }
        input {
            height: 30px;
            width: 205px;
            font-size:12pt;
            border-radius: 5px;
        }
        .tabcontent .button {
            height: 180%;
        }
        hr {
            color: #FFC300;
        }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body onload="document.getElementById('defaultOpen').click();" id="wrapper">
    <?php include "components/header_loginpage.html"; ?>
    <div class="content" >
       
        <div class="incontent">
            <table border="0">
                <tr>
                    <td>
                        <img src="img/header_title.png" alt="title" height="500" width="400" class="title">
                    </td>
                    <td >
                        <div class="rightcontent">
                            <!-- Tab links -->
                            <div class="tab">
                                <button class="tablinks" name="login" type="button" onclick="openTab(event, 'login')">Login</button>
                                <button class="tablinks" name="register" type="button" onclick="openTab(event, 'register')">Register</button>
                                <script>
                                    var url = document.location.toString();
                                    if (url.match('#')) { 
                                        tab = url.split('#')[1];
                                        if (tab == "login") {
                                            document.getElementsByName("login")[0].id = "defaultOpen";
                                        } else {
                                            document.getElementsByName("register")[0].id = "defaultOpen";
                                        }
                                    }
                                </script>
                            </div>
                            <hr>
                            <!-- Tab content -->
                            <div id="login" class="tabcontent">
                                <h1 class="title">Welcome back! <br> </h1>
                                <form action="login.php" method="post" id="formlogin" name="formlogin">
                                    <label for="email">Email:</label>
                                    <input type="text" name="loginemail" id="loginemail" size="30px" required> <br><br>
                                    <label for="password">Password:</label>
                                    <input type="password" name="loginpassword" id="loginpassword" size="30px" required> <br><br>
                                    <input type="submit" value="LOGIN" class="button">
                                </form>
                            </div>
                            
                            <div id="register" class="tabcontent">
                                <h1 class="title">Join Us Today!</h3>
                                <form action="register.php" method="post" id="formregister" name="formregister" onsubmit="return validateForm()">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" id="name" size="30px" required> <br><br>
                                    <label for="email"></label>E-mail:</label>
                                    <input type="email" name="email" id="registeremail" size="30px" required onchange="validateEmail();"> <br><br>
                                    <label for="phone">Phone Number:</label>
                                    <input type="text" name="phone" id="phone" size="30px" required> <br><br>
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" id="registerpassword" size="30px" required onchange="validateValidPassword();"> <br><br>
                                    <label for="confirmpassword">Confirm Password:</label>
                                    <input type="password" name="confirmpassword" id="registerconfirmpassword" size="30px" required onchange="validatePassword();"> <br><br>
                                    <input type="submit" value="REGISTER" id="submitbtn" class="button">
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

        </div>
    </div>

</body>
</html>