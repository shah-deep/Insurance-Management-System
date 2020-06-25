<?php
require_once '../header.php';
 ?>
<div class="">
  <h1>Delete Policy from Record</h1>
  <form class="" action="../includes/DeletePolicy-inc.php" method="post">
    <input type="number" name="Policy_no" placeholder="Policy Number" min="100000000" max="999999999" required>
    <input type="submit" name="submit"">
  </form>
  <br><br>
  <p> <b>Warning:</b> This will also Delete All Payment_records associated with this Policy_no.</p>
</div>

 <?php
 require_once '../footer.php';
  ?>
