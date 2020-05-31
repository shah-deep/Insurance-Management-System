<?php
require_once '../Admin/header.php';
 ?>

<div>
<h1>Agent Sign-Up</h1>

<form class="" action="includes/Agent-register-inc.php" method="post">
  <input type="number" name="Agency_code" placeholder="Agency_code" required>
  <input type="password" name="password" placeholder="Password" required>
  <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
  <input type="number" name="Branch_id" placeholder="Branch_id" required>
  <input type="text" name="Name" placeholder="Name" required>
  <input type="number" name="Mobile_no" placeholder="Mobile Number" required>
  <input type="email" name="Email_id" placeholder="E-mail" required>
  <input type="text" name="Designation" placeholder="Designation">
  <input type="text" name="Address" placeholder="Address">
  <h7>Date of Birth:</h7>
  <input type="date" name="DOB" placeholder="Date of Birth"><br><br>
  <button type="submit" name="submit">Register</button>
</form>

</div>

<?php
require_once '../Admin/footer.php';
 ?>
