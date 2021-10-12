<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <?php
    session_start();
  if (isset($_SESSION['valid_user']))
  {
     ?>
     <script src="components/header_valid_user.js" type="text/javascript" defer></script>
     <?php 
  }
  else {
    ?>
    <script src="components/header.js" type="text/javascript" defer></script>
    <?php
  }
      ?>
    <script src="components/footer.js" type="text/javascript"></script>
    <script src="pages/showModal.js" type="text/javascript"></script>
    <link rel="stylesheet" href="components/button.css">
    <link rel="stylesheet" href="components/color.css">
    <style>
        #wrapper {
            background-color: #1a1a1a;
            color: #FFFFFF;
            min-width: 1000px;
        }
        .content {
            width: 80%;
            min-width: 1000px;
            margin: auto;
        }
        body {
            margin: 0px;
            padding: 0px;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <header-component></header-component>
    <div class="content">
        <h1>Hello World</h1>
        <p>Our main page</p>
        <br>
        <br>
        <br>
        <br>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Soluta hic culpa, aperiam eum neque nulla, fugiat similique voluptas ratione mollitia modi deleniti ut corrupti iure quisquam placeat assumenda aliquid quod.</p>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

    </div>
    <footer-component></footer-component>
</div>
</body>
</html>