<?php
require_once '../header.php';
require '../../database.php';
 ?>
  <h1> View Policy Record </h1>
<div class="">
  <form class="" action="" method="post">
    <label for="AgencySearch">Search Agency Wise:</label>
  <input type="search" name="AgencySearch" placeholder="Agency_code">
  <button type="submit" name="search"> Search </button>
  <br><br>
  <button type="submit" name="AllPolicy"> Show All Policys </button>
  <br><br>
  </form>
</div>

<div class="">
  <table border="1">
    <tr>
      <th> Policy Number </th>
      <th> Plan_no </th>
      <th>  Agency_code </th>
      <th>  Premium </th>
      <th>  Date of Commencement </th>
      <th>  Mode </th>
      <th>  Sum Assured</th>
      <th>  First Unpaid Payment </th>
      <th> Term </th>
      <th> Premium Paying Term </th>
      <th> Status </th>
    </tr>
    <?php
    $Admin_id = $_SESSION['sessionId2'];
    if (isset($_POST['search'])) {
        $Value = $_POST['AgencySearch'];
        $sql = "SELECT * FROM Policy NATURAL join Agent WHERE Admin_id = $Admin_id AND Agency_code = ?";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $Value);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        }
    } else {
        $sql = "SELECT * FROM Policy NATURAL join Agent WHERE Admin_id = $Admin_id";
        $result = mysqli_query($conn, $sql);
    }

    $rowCount = mysqli_num_rows($result);
    if ($rowCount>0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
      <tr>
        <td><?php echo $row['Policy_no'] ?></td>
        <td><?php echo $row['Plan_no'] ?></td>
        <td><?php echo $row['Agency_code'] ?></td>
        <td><?php echo $row['Premium'] ?></td>
        <td><?php echo $row['DOC'] ?></td>
        <td><?php echo $row['Mode'] ?></td>
        <td><?php echo $row['SA'] ?></td>
        <td><?php echo $row['FUP'] ?>  </td>
        <td><?php echo $row['Term'] ?></td>
        <td><?php echo $row['PPT'] ?></td>
        <td><?php if ($row['Status']==1) {
                echo 'Active';
            } else {
                echo 'Deactivated';
            } ?></td>
      </tr>
  <?php
        }
    } else {
        ?> </table> <?php
      echo "No results found"; ?> <table> <?php
    }
 ?>
 </table>
</div>

 <?php
 require_once '../footer.php';
  ?>
