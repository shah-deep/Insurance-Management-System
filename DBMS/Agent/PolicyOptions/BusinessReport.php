<?php
 require_once '../header.php';
 require '../../database.php';
 $Agency_code = $_SESSION['sessionId'];
  ?>

 <h1> Business Reports </h1>

<form class="" action="" method="post">
  <button type="submit" name="Yearly"> Yearly Report </button>
  <button type="submit" name="Monthly"> Monthly Report </button>
</form>

 <div class="">
<?php if (isset($_POST['Monthly'])) {  ?>
   <table border="1">
     <tr>
       <th>  Year </th>
       <th>  Month </th>
       <th>  Total Policies </th>
       <th>  Commission  </th>
     </tr>
     <?php
     $sql = "SELECT MONTH(`DOC`) as M, YEAR( `DOC`) as Y, COUNT(DISTINCT `Policy_no`) as Cnt, SUM(`C`) as Sm FROM ( SELECT `Policy_no`,`DOC`, COM(Premium,Term) AS C FROM `policy` WHERE `Agency_code` = '$Agency_code' ) AS T GROUP BY MONTH(`DOC`),YEAR(`DOC`)";
     $result = mysqli_query($conn, $sql);
     $rowCount = mysqli_num_rows($result);
     if ($rowCount>0) {
         while ($row = mysqli_fetch_assoc($result)) {
             ?>
       <tr>
         <td><?php echo $row['Y'] ?></td>
         <td><?php echo $row['M'] ?></td>
         <td><?php echo $row['Cnt'] ?></td>
         <td><?php echo $row['Sm'] ?></td>
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


 <?php
} else {  ?>
    <table border="1">
      <tr>
        <th>  Year </th>
        <th>  Total Policies </th>
        <th>  Commission  </th>
      </tr>
      <?php
      $sql = "SELECT YEAR(`DOC`) as Y, COUNT(DISTINCT `Policy_no`) as Cnt, SUM(`C`) as Sm FROM ( SELECT `Policy_no`,`DOC`, COM(Premium,Term) AS C FROM `policy` WHERE `Agency_code` = '$Agency_code' ) AS T GROUP BY YEAR(`DOC`)";
      $result = mysqli_query($conn, $sql);
      $rowCount = mysqli_num_rows($result);
      if ($rowCount>0) {
          while ($row = mysqli_fetch_assoc($result)) {
              ?>
        <tr>
          <td><?php echo $row['Y'] ?></td>
          <td><?php echo $row['Cnt'] ?></td>
          <td><?php echo $row['Sm'] ?></td>
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

 <?php }

  require_once '../footer.php';
   ?>
