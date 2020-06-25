<?php
require_once '../header.php';
 ?>

<div class="">
  <h1>Add Payment Record</h1>

  <form class="" action="../includes/AddPaymentRecord-inc.php" method="post">
    <input type="number" name="Policy_no" placeholder="Policy Number (9 digit)" min="100000000" max="999999999" style="width: 165px;">
    <select name="Mode" required>
         <option value="" selected disabled>Mode of Payment</option>
         <option value="Cash">Cash</option>
         <option value="Other">Other</option>
    </select>
    <input type="number" name="Amount" placeholder="Amount">
    <br> <br>
    <button type="submit" name="submit" style="margin-left: 325px;">Add Payment Record</button>
    <br> <br> <br>
    <button name=""><a href="ShowRecordBook.php"> Show Record Book </a></button>
  </form>
</div>

 <?php
 require_once '../footer.php';
  ?>
