<?php
require_once '../header.php';
 ?>

 <div>

 <h1>Add New Plan</h1>

 <form class="" action="../includes/AddNewPlan-inc.php" method="post">
   <input type="number" name="Plan_no" placeholder="Plan Number (3 digit)" min="100" max="999" style="width: 150px;" required>
   <input type="text" name="Name" placeholder="Name" required>
   <input type="number" name="MMA" placeholder="Maximum Maturity Age" required>
   <input type="number" name="min_SA" placeholder="Minimum Sum Assured" required>
   <input type="number" name="max_SA" placeholder="Maximum Sum Assured" required>
   <input type="number" name="min_age" placeholder="Minimum Age" required>
   <input type="number" name="max_age" placeholder="Maximum Age" required>
   <br><br>
   <h7>   Mode:  </h7>
   <input type="checkbox" name="Mode_Yearly" value=1>
   <label for="Mode_Yearly">Yearly</label>
   <input type="checkbox" name="Mode_Halfly" value=1>
   <label for="Mode_Halfly">Halfly</label>
   <input type="checkbox" name="Mode_Quartely" value=1>
   <label for="Mode_Quartely">Quartely</label>
   <input type="checkbox" name="Mode_Monthly" value=1>
   <label for="Mode_Monthly">Monthly</label>
   <input type="checkbox" name="Mode_Single" value=1>
   <label for="Mode_Single">Single Premium</label>
   <br><br>
   <h7>   Type of Term:  </h7>
   <input type="radio" id="Range" name="Type_term" value=0 checked>
   <label for="Range">Range</label>
   <input type="radio" id="Specific" name="Type_term" value=1>
   <label for="Specific">Specific</label>
   <br><br>
   <table>
     <tr>
       <td><h7> Term: </h7></td>
       <td><input type="number" name="T1" required></td>
       <td><input type="number" name="T2" required></td>
       <td><input type="number" name="T3"></td>
       <td><input type="number" name="T4"></td>
     </tr>

     <tr>
       <td><h7> Premium Paying Term: </h7></td>
       <td><input type="number" name="P1"></td>
       <td><input type="number" name="P2"></td>
       <td><input type="number" name="P3"></td>
       <td><input type="number" name="P4"></td>
     </tr>
   </table>

   <br><br>
   <button type="submit" name="submit">Add Plan</button>
 </form>

 </div>


 <?php
 require_once '../footer.php';
  ?>
