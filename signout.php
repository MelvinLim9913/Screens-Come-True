<?php
  session_start();
  
  // store to test if they *were* logged in
  $old_user = $_SESSION['userID'];  
  unset($_SESSION['userID']);
  session_destroy();
  echo '<script>
        window.location.href="index.php";
    </script>';
?>