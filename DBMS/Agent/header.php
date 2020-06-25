<?php
  session_start();
  require_once 'C:\xampp\htdocs\Insurance-Management-System\DBMS\database.php';
  if (!isset($_SESSION['sessionId'])) {
      if (!($_SERVER['REQUEST_URI'] == '/Insurance-Management-System/DBMS/Agent/Agent-Login.php')) {
          header('Location: http://localhost/Insurance-Management-System/DBMS');
      }
  }
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>IMS Agent <?php echo $_SESSION['sessionUser']," (",$_SESSION['sessionId'],")"; ?></title>
  </head>
  <body>
    <header>
      <nav>
        <p align='right'>
          <?php if (!($_SERVER['REQUEST_URI'] == '/Insurance-Management-System/DBMS/Agent/MainMenu.php')) { ?>
        <button type="button" name="MainMenu" style="margin-right: 50px;"> <a href="http://localhost/Insurance-Management-System/DBMS/Agent/MainMenu.php"> Agent Menu </a> </button>
        <?php } ?>
        <button type="button" name="logout"> <a href="http://localhost/Insurance-Management-System/DBMS/index.php"> Log out </a> </button>
        </p>
      </nav>
    </header>
