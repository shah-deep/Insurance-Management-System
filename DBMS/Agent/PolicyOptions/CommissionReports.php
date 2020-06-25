<?php
require_once '../header.php';
require '../../database.php';
 ?>

<div class="">
  <h1> My Commission Reports </h1>
  <table border="1">
    <tr>
      <th>  Policy_no</th>
      <th>  Premium</th>
      <th>  Commission</th>

    </tr>

    <?php
    $Agency_code = $_SESSION['sessionId'];
    $sql = "SELECT *, SUM(C) AS S FROM ( SELECT *, COM(Premium,Term) AS C FROM policy) AS T WHERE Agency_code = $Agency_code";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);

        if ($rowCount>0) {
          print_r($result);
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
          <tr>
            <td><?php echo $row['Policy_no'] ?></td>
            <td><?php echo $row['Premium'] ?></td>
            <td><?php echo $row['C'] ?></td>
          </tr>
      <?php
      $TotalCommission = $row['S'];
            }
        }
     ?>
     </table>

     <h4>Total Commission = <b> <?php
     echo $TotalCommission;
      ?> </b> </h4>

</div>

 <?php
 require_once '../footer.php';
  ?>
