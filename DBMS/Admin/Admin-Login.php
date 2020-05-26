<?php
require_once 'includes/defaultAdmin.php';
require_once 'header.php';
 ?>

<div>
<h1>Admin Login</h1>

<form class="" action="includes/Admin-Login-inc.php" method="post">
  <input type="number" name="Admin_id" placeholder="Admin ID">
  <input type="password" name="password" placeholder="Password">
  <button type="submit" name="submit">Login</button>
</form>

</div>
<br><br>
<button type="button" name="Home"> <a href="../index.php">Home</a> </button>

</body>
</html>
