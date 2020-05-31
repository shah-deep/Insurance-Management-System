<?php

require_once '../database.php';

$Admin_id = 12345;
$password = 'xyz';
$Branch_id = 41725;
$Name = 'Admin';

  $sql = "SELECT Admin_id FROM Admin WHERE Admin_id = 12345";
  $result = mysqli_query($conn, $sql);
  $rowCount = mysqli_num_rows($result);

  if ($rowCount<=0) {
      $sql = "INSERT INTO admin(Admin_id, Branch_id, Name, Password) VALUES (?,?,?,?)";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      $hashedPass = password_hash($password, PASSWORD_DEFAULT);
      mysqli_stmt_bind_param($stmt, "iiss", $Admin_id, $Branch_id, $Name, $hashedPass);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
  }
?>
