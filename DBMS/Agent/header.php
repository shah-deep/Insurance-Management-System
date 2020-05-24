<?php
  session_start();
  require_once 'C:\xampp\htdocs\DBMS\database.php';
  if(!isset($_SESSION['sessionId'])) {
    if(!($_SERVER['REQUEST_URI'] == '/DBMS/Agent/Agent-Login.php' || $_SERVER['REQUEST_URI'] == '/DBMS/Agent/Agent-Register.php')) {
    header('Location: http://localhost/DBMS');
    }
  }
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <nav>

      </nav>
    </header>
