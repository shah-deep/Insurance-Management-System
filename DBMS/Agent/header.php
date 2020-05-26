<?php
  session_start();
  require_once 'C:\xampp\htdocs\GitHub\Insurance-Management-System\DBMS\database.php';
  if(!isset($_SESSION['sessionId'])) {
    if(!($_SERVER['REQUEST_URI'] == '/GitHub/Insurance-Management-System/DBMS/Agent/Agent-Login.php')) {
    header('Location: http://localhost/GitHub/Insurance-Management-System/DBMS');
    }
  }
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <header>
      <nav>

      </nav>
    </header>
