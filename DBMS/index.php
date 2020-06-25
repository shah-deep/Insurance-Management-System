<?php
session_start();
if (isset($_SESSION['sessionId']) || isset($_SESSION['sessionId2'])) {
    session_unset();
    session_destroy();
    session_set_cookie_params(0);
}
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Insurance Management System</title>
  </head>
  <body>
    <h1><b> Insurance Management System </b></h1>
    <br>
    <div class="">
    <h7>Choose login mode:</h7> <br>
    <button type="button" name=""><a href="Admin/Admin-Login.php"> Admin Mode </a></button>
    <button type="button" name=""><a href="Agent/Agent-Login.php"> Agent Mode </a></button>
    </div>
  </body>
</html>
