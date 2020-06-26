<?php
require_once '../header.php';
require '../../database.php';
 ?>

<div class="">
  <h1> Payment Record Book </h1>
  <table border="1">
    <tr>
      <th>  Policy Number</th>
      <th>  Mode</th>
      <th>  Date & Time</th>
      <th>  Amount</th>
      <th>  Next P.D.</th>
    </tr>
    <?php
    $Agency_code = $_SESSION['sessionId'];
    $sql = "SELECT * FROM policy as p, payment_record as pm WHERE p.Policy_no=pm.Policy_no AND Agency_code = $Agency_code";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount>0) {
        while ($row = mysqli_fetch_assoc($result)) {
            //  print_r($row);
            ?>
      <tr>
        <td><?php echo $row['Policy_no'] ?></td>
        <td><?php echo $row['Mode'] ?></td>
        <td><?php echo $row['Date_Time'] ?></td>
        <td><?php echo $row['Amount'] ?></td>
        <td><?php echo $row['FUP'] ?></td>
      </tr>
  <?php
        }
    } else {
        ?> </table> <?php
      echo "No results found";
    }
 ?>
  </table>
</div>
<br><br>
<button name=""><a href="AddPaymentRecord.php"> Add Payment Record </a></button>

 <?php
 require_once '../footer.php';
  ?>
