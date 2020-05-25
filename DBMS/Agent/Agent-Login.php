<?php
require_once 'header.php';
 ?>

<div>

<h1>Log in</h1>


<form class="" action="includes/Agent-Login-inc.php" method="post">
  <input type="number" name="Agency_code" placeholder="Agency Code">
  <input type="password" name="password" placeholder="Password">
  <button type="submit" name="submit">Login</button>
</form>
<p>
  No account? <a href="Agent-Register.php">Register Here!</a>
</p>
</div>

</body>
</html>
