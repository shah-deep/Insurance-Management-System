<?php
require_once '../header.php';
require '../../database.php';
 ?>

<div class="">
  <h1> Agency List </h1>
  <table>
    <tr>
      <th>|  Agency Code</th>
      <th>|  Branch ID</th>
      <th>|  Name</th>
      <th>|  Admin ID</th>
      <th>|  Mobile Number</th>
      <th>|  Email ID</th>
      <th>|  Date Of Birth</th>
      <th>|  Designation</th>
      <th>|  Address  |</th>
    </tr>
    <?php
    $sql = "SELECT * FROM Agent";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount>0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
      <tr>
        <td>|<?php echo $row['Agency_code'] ?></td>
        <td>|<?php echo $row['Branch_id'] ?></td>
        <td>|<?php echo $row['Name'] ?></td>
        <td>|<?php echo $row['Admin_id'] ?></td>
        <td>|<?php echo $row['Mobile_no'] ?></td>
        <td>|<?php echo $row['Email_id'] ?></td>
        <td>|<?php echo $row['DOB'] ?></td>
        <td>|<?php echo $row['Designation'] ?></td>
        <td>|<?php echo $row['Address'] ?>  |</td>
      </tr>
  <?php
        }
    } else {
        echo "No results found";
    }
 ?>
  </table>
</div>

 <?php
 require_once '../footer.php';
  ?>
