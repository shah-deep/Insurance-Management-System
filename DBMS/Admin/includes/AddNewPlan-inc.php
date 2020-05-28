<?php

if (isset($_POST['submit'])) {
  require '../../database.php';

  $Plan_no = $_POST['Plan_no'];
  $Name = $_POST['Name'];
  $MMA = $_POST['MMA'];
  $min_SA = $_POST['min_SA'];
  $max_SA = $_POST['max_SA'];
  $Term = $_POST['Term'];
  $PPT = $_POST['PPT'];
  $min_age = $_POST['min_age'];
  $max_age = $_POST['max_age'];

  if (empty($Plan_no) || empty($Name)) {
    header("Location: ../Plan/AddNewPlan.php?error=emptyfields");
    exit();
  } elseif ($Plan_no<=0) {
    header("Location: ../Plan/AddNewPlan.php?error=invalidAgencyCode");
    exit();
  }

  else {
    $sql = "SELECT Plan_no FROM Plan WHERE Plan_no = ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../Plan/AddNewPlan.php?error=sqlerror1");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt,"i",$Plan_no);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $rowCount = mysqli_stmt_num_rows($stmt);

      if($rowCount>0){
        header("Location: ../Plan/AddNewPlan.php?error=Plan_no_Already_Taken");
        exit();
      } else {
          $sql = "INSERT INTO plan(Plan_no, Name, MMA, min_SA, max_SA, Term, PPT, min_age, max_age) VALUES (?,?,?,?,?,?,?,?,?)";
          $stmt = mysqli_stmt_init($conn);
          if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../Plan/AddNewPlan.php?error=sqlerror2");
            exit();
          } else {
            mysqli_stmt_bind_param($stmt,"isiiiiiii",$Plan_no,$Name,$MMA,$min_SA,$max_SA,$Term,$PPT,$min_age,$max_age);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            header("Location: ../Plan/AddNewPlan.php?success=registered");
            exit();
          }
      }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }


}

 ?>
