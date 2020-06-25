<?php
require_once 'header.php';
 ?>

<div>

<h1>Admin Register</h1>

<form class="" action="includes/Admin-register-inc.php" method="post">
  <input type="number" name="Admin_id" placeholder="Admin_id (5 digit)" min="10000" max="99999" style="width: 130px;" required>
  <input type="password" name="password" placeholder="Password" required>
  <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
  <input type="number" name="Branch_id" placeholder="Branch_id (5 digit)" min="10000" max="99999" style="width: 140px;" required>
  <input type="text" name="Name" placeholder="Name" required>
  <input type="number" name="Mobile_no" placeholder="Mobile Number" min="5000000000" max="9999999999" required>
  <input type="email" name="Email_id" placeholder="E-mail" required>
  <input type="text" name="Designation" placeholder="Designation">
  <input type="text" name="City" placeholder="City"><br><br>
  <h7>Date of Birth:</h7>
  <input type="date" name="DOB" placeholder="Date of Birth"><br><br>
  <button type="submit" name="submit">Register</button>
</form>

</div>

<?php
require_once 'footer.php';
 ?>
