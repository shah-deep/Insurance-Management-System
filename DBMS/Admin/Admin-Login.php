<?php
session_start();
require_once 'C:\xampp\htdocs\Insurance-Management-System\DBMS\database.php';

   if (!isset($_SESSION['sessionId2'])) {
       if (!($_SERVER['REQUEST_URI'] == '/Insurance-Management-System/DBMS/Admin/Admin-Login.php')) {
           header('Location: http://localhost/Insurance-Management-System/DBMS');
       }
   }
  ?>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Insurance Management System</title>
   </head>
   <body>
     <header>
       <nav>

       </nav>
     </header>

<div>
<h1>Admin Login</h1>

<form class="" action="includes/Admin-Login-inc.php" method="post">
  <input type="number" name="Admin_id" placeholder="Admin ID" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit" name="submit">Login</button>
</form>

</div>
<br><br>
<button type="button" name="Home"> <a href="../index.php">Home</a> </button>

</body>
</html>
