<?php
require_once 'header.php';
 ?>

<div>

<h1>Admin Register</h1>

<form class="" action="includes/Admin-register-inc.php" method="post">
  <input type="number" name="Admin_id" placeholder="Admin_id">
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
require_once 'footer.php';
 ?>
