<?php
require_once '../Admin/header.php';
 ?>

<div>
<h1>Agent Sign-Up</h1>

<form class="" action="includes/Agent-register-inc.php" method="post">
  <input type="number" name="Agency_code" placeholder="Agency_code">
  <input type="password" name="password" placeholder="Password">
  <input type="password" name="confirmPassword" placeholder="Confirm Password">
  <input type="number" name="Branch_id" placeholder="Branch_id">
  <input type="text" name="Name" placeholder="Name">
  <input type="number" name="Mobile_no" placeholder="Mobile Number">
  <input type="email" name="Email_id" placeholder="E-mail">
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
