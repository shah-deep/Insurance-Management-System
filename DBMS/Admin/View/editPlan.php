<?php
require_once '../header.php';
require '../../database.php';

$plan_no = $_GET['Plan_no'];
$name = $_GET['Name'];

$sql = "SELECT * FROM Plan WHERE Plan_no = $plan_no AND Name = '$name'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount>0) {
        $row = mysqli_fetch_assoc($result); ?>

<form action = "../includes/changePlan-inc.php" method = "post">
	<input hidden name="Plan_no" value="<?php echo $row['Plan_no'] ?>">
   Name:<input type="text" name="Name" placeholder="Name" value = "<?php echo $row['Name'] ?>" required>
   MMA:<input type="number" name="MMA" placeholder="Maximum Maturity Age" value="<?php echo $row['MMA'] ?>" required>
   MinSA:<input type="number" name="min_SA" placeholder="Minimum Sum Assured" value="<?php echo $row['min_SA'] ?>" required>
   MaxSA:<input type="number" name="max_SA" placeholder="Maximum Sum Assured" value="<?php echo $row['max_SA'] ?>">
   MinAge:<input type="number" name="min_age" placeholder="Minimum Age" value="<?php echo $row['min_age'] ?>" required>
   MaxAge:<input type="number" name="max_age" placeholder="Maximum Age" value="<?php echo $row['max_age'] ?>" required>
   <br><br>
   <h7>   Mode:  </h7>
   <input type="checkbox" name="Mode_Yearly" <?php if ($row['MODE_YEARLY']==1) {
            echo 'checked';
        } ?> value=1>
   <label for="Mode_Yearly">Yearly</label>
   <input type="checkbox" name="Mode_Halfly" <?php if ($row['MODE_HALFLY']==1) {
            echo 'checked';
        } ?> value=1>
   <label for="Mode_Halfly">Halfly</label>
   <input type="checkbox" name="Mode_Quartely" <?php if ($row['MODE_QUARTELY']==1) {
            echo 'checked';
        } ?> value=1>
   <label for="Mode_Quartely">Quartely</label>
   <input type="checkbox" name="Mode_Monthly" <?php if ($row['MODE_MONTHLY']==1) {
            echo 'checked';
        } ?> value=1>
   <label for="Mode_Monthly">Monthly</label>
   <input type="checkbox" name="Mode_Single" <?php if ($row['MODE_SINGLE']==1) {
            echo 'checked';
        } ?> value=1>
   <label for="Mode_Single">Single Premium</label>
   <br><br>
   <h7>   Type of Term:  </h7>
   <input type="radio" id="Range" name="Type_term" <?php if ($row['Type_term']==0) {
            echo 'checked';
        } ?> value=0>
   <label for="Range">Range</label>
   <input type="radio" id="Specific" name="Type_term" <?php if ($row['Type_term']==1) {
            echo 'checked';
        } ?> value=1>
   <label for="Specific">Specific</label>
   <br><br>
   <table>
     <tr>
       <td><h7> Term: </h7></td>
       <td><input type="number" name="T1" value="<?php echo $row['T1']?>" required></td>
       <td><input type="number" name="T2" value="<?php echo $row['T2']?>" required></td>
       <td><input type="number" name="T3" value="<?php echo $row['T3']?>" ></td>
       <td><input type="number" name="T4" value="<?php echo $row['T4']?>" ></td>
     </tr>

     <tr>
       <td><h7> Premium Paying Term: </h7></td>
       <td><input type="number" name="P1" value="<?php echo $row['P1']?>"></td>
       <td><input type="number" name="P2" value="<?php echo $row['P2']?>"></td>
       <td><input type="number" name="P3" value="<?php echo $row['P3']?>"></td>
       <td><input type="number" name="P4" value="<?php echo $row['P4']?>"></td>
     </tr>
   </table>

   <br><br>
   <button type="submit" name="submit">Update Plan</button>
</form>

 <?php
    } else {
        header("Location: ../View/ViewPlan.php?error=Plan_Does_Not_Exist");
        exit();
    }
 require_once '../footer.php';
  ?>
