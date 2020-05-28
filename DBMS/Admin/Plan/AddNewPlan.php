<?php
require_once '../header.php';
 ?>

 <div>

 <h1>Add New Plan</h1>

 <form class="" action="../includes/AddNewPlan-inc.php" method="post">
   <input type="number" name="Plan_no" placeholder="Plan Number">
   <input type="text" name="Name" placeholder="Name">
   <input type="number" name="MMA" placeholder="Maximum Maturity Age">
   <input type="number" name="min_SA" placeholder="Minimum Sum Assured">
   <input type="number" name="max_SA" placeholder="Maximum Sum Assured">
   <input type="number" name="Term" placeholder="Term">
   <input type="number" name="PPT" placeholder="Premium Paying Term">
   <input type="number" name="min_age" placeholder="Minimum Age">
   <input type="number" name="max_age" placeholder="Maximum Age">
   <br><br>
   <button type="submit" name="submit">Add Plan</button>
 </form>

 </div>


 <?php
 require_once '../footer.php';
  ?>
