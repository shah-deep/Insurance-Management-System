<?php

if (isset($_POST['submit'])) {
  require '../../database.php';

  $Agency_code = $_POST['Agency_code'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  $Branch_id = $_POST['Branch_id'];
  $Name = $_POST['Name'];
  $Mobile_no = $_POST['Mobile_no'];
  $Email_id = $_POST['Email_id'];
  $DOB = $_POST['DOB'];
  $Designation = $_POST['Designation'];
  $Address = $_POST['Address'];

  session_start();
  $Admin_id = $_SESSION['sessionId2'];

  if (empty($Agency_code) || empty($password) || empty($confirmPassword) || empty($Name) || empty($Branch_id) || empty($Admin_id)) {
    header("Location: ../Agent-Register.php?error=emptyfields");
    exit();
  } elseif ($Agency_code<=0) {
    header("Location: ../Agent-Register.php?error=invalidAgencyCode");
    exit();
  } elseif ($password !== $confirmPassword) {
    header("Location: ../Agent-Register.php?error=passwordsDoNotMatch");
    exit();
  }


  else {
    $sql = "SELECT Agency_code FROM Agent WHERE Agency_code = ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../Agent-Register.php?error=sqlerror1");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt,"i",$Agency_code);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $rowCount = mysqli_stmt_num_rows($stmt);

      if($rowCount>0){
        header("Location: ../Agent-Register.php?error=usernametaken");
        exit();
      } else {
          $sql = "INSERT INTO agent(Agency_code, Branch_id, Name, Mobile_no, Email_id, DOB, Designation, Address, Password) VALUES (?,?,?,?,?,?,?,?,?)";
          $stmt = mysqli_stmt_init($conn);
          if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../Agent-Register.php?error=sqlerror2");
            exit();
          } else {
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($stmt,"iisisisss",$Agency_code,$Branch_id,$Name,$Mobile_no,$Email_id,$DOB,$Designation,$Address,$hashedPass);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $suceess1 = true;
          }

          $sql = "INSERT INTO Adm_Agent(Admin_id,Agency_code) VALUES (?,?)";
          $stmt = mysqli_stmt_init($conn);
          if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../Agent-Register.php?error=sqlerror3");
            exit();
          } else {
            mysqli_stmt_bind_param($stmt,"ii",$Admin_id,$Agency_code);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $suceess2 = true;
          }
          if ($suceess1 && $suceess2) {
              header("Location: ../Agent-Register.php?success=registered");
              exit();
          } else {
            header("Location: ../Agent-Register.php?success=register_Failed");
            exit();
          }
      }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }


}

 ?>
