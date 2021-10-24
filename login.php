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
            padding: 0;
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
        .tablinks-current {
            color: #EA2127;
            font-weight: bold;
        }
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
            height: 60px;
        }
        hr {
            color: #FFC300;
        }
        a{
            text-decoration: none;
        }
        table {
            border-spacing: 0;
        }
    </style>
     <script>
        function openTab(evt, actionType) {
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
            document.getElementById(actionType).style.display = "grid";
            evt.currentTarget.className += " tablinks-current";
        }
    </script>
</head>
<body onload="document.getElementById('defaultOpen').click();">
<div id="wrapper">
    <?php include "components/header_loginpage.html"; ?>
    <div class="content" >
       
        <div class="incontent">
            <table border="0">
                <tr>
                    <td>
                        <img src="img/login-poster.jpg" alt="title" height="500" width="400" class="title">
                    </td>
                    <td style="padding:10px">
                        <div class="rightcontent">
                            <!-- Tab links -->
                            <div class="tab">
                                <button class="tablinks" name="login" type="button" onclick="openTab(event, 'login')" id="defaultOpen">Login</button>
                                <button class="tablinks" name="register" type="button" onclick="openTab(event, 'register')">Register</button>
                            </div>
                            <script>
                                    let urlparams = new URLSearchParams(window.location.search);
                                    let action = urlparams.get('action');
                                    if (action == "register") {
                                        document.getElementsByName("register")[0].id = "defaultOpen";
                                        document.getElementsByName("login")[0].removeAttribute("id");
                                    }
                                    else {
                                        document.getElementsByName("login")[0].id = "defaultOpen";
                                    }
                                </script>
                            <hr>
                            <!-- Tab content -->
                            <div id="login" class="tabcontent">
                                <h2 class="title">Welcome back! <br> </h2>
                                <form action="userlogin.php" method="post" id="formlogin" name="formlogin">
                                    <label for="email">Email:</label>
                                    <input type="text" name="loginemail" id="loginemail" size="30px" required> <br><br>
                                    <label for="password">Password:</label>
                                    <input type="password" autocomplete="on" name="loginpassword" id="loginpassword" size="30px" required> <br><br>
                                    <input type="submit" value="LOGIN" class="button">
                                </form>
                            </div>
                            
                            <div id="register" class="tabcontent">
                                <h2 class="title">Join Us Today!</h2>
                                <form action="register.php" method="post" id="formregister" name="formregister" onsubmit="return validateForm()">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" id="name" size="30px" required> <br><br>
                                    <label for="email"></label>E-mail:</label>
                                    <input type="email" name="email" id="registeremail" size="30px" required onchange="validateEmail();"> <br><br>
                                    <label for="phone">Phone Number:</label>
                                    <input type="text" name="phone" id="phone" size="30px" required> <br><br>
                                    <label for="password">Password:</label>
                                    <input type="password" autocomplete="on" name="password" id="registerpassword" size="30px" required onchange="validateValidPassword();"> <br><br>
                                    <label for="confirmpassword">Confirm Password:</label>
                                    <input type="password" autocomplete="on" name="confirmpassword" id="registerconfirmpassword" size="30px" required onchange="validatePassword();"> <br><br>
                                    <input type="submit" value="REGISTER" id="submitbtn" class="button">
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

        </div>
    </div>
</div>
</body>
</html>