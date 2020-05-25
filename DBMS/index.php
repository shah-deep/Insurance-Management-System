<?php
session_start();
if(isset($_SESSION['sessionId'])) {
  session_unset();
  session_destroy();
  session_set_cookie_params(0);
}
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="">
    <h1>Choose login mode</h1>
    <button type="button" name=""><a href="Admin/Admin-Login.php"> Admin Mode </a></button>
    <button type="button" name=""><a href="Agent/Agent-Login.php"> Agent Mode </a></button>
    </div>
  </body>
</html>
