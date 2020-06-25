<?php
require_once '../header.php';
 ?>

<h1>Add New Policy</h1>
  <div class="">
    <form class="" action="../includes/AddNewPolicy-inc.php" method="post">
        <input type="number" name="Policy_no" placeholder="Policy No. (9 digit)" min="100000000" max="999999999" style="width: 155px;" required>
        <input type="number" name="Plan_no" placeholder="Plan No. (3 digit)" min="100" max="999" style="width: 150px;" required> <br> <br>
        <input type="number" name="Premium" placeholder="Premium" required>
        <input type="number" name="Term" placeholder="Term" required>
        <input type="number" name="PPT" placeholder="Premium Paying Term">
        <input type="number" name="SA" placeholder="Sum Assured" required>
        <input type="number" name="Age" placeholder="Policy Holder's Age" required>
        <select name="Mode" required>
             <option value="" selected disabled>Select Mode</option>
             <option value="yearly">Yearly</option>
             <option value="halfly">Half-Yearly</option>
             <option value="monthly">Monthly</option>
             <option value="quartely">Quartely</option>
             <option value="single premium">Single Premium</option>
        </select>
        <br><br>
        <h7> Date of Commencement:</h7>
        <input type="date" name="DOC" placeholder="Date Of Commencement" required>
        <h7> First Unpaid Payment:</h7>
        <input type="date" name="FUP" placeholder="First Unpaid Payment">
        <br> <br>
        <button type="submit" name="submit">Add Policy</button>

    </form>
  </div>

<?php
require_once '../footer.php';
 ?>
