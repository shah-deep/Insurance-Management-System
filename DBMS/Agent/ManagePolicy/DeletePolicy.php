<?php
require_once '../header.php';
 ?>
<div class="">
  <h1>Delete Policy from Record</h1>
  <form class="" action="../includes/DeletePolicy-inc.php" method="post">
    <input type="number" name="Policy_no" placeholder="Policy Number" required>
    <input type="submit" name="submit" value="Delete Policy">
  </form>
</div>

 <?php
 require_once '../footer.php';
  ?>
