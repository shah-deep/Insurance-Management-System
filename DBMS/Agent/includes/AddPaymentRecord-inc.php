<?php

if (isset($_POST['submit'])) {
    require '../../database.php';
    
    $Policy_no = $_POST['Policy_no'];
    $Mode = $_POST['Mode'];
    $Amount = $_POST['Amount'];


    if (empty($Policy_no) || empty($Mode) || empty($Amount)) {
        header("Location: ../PremiumPaymentRecord/AddPaymentRecord.php?error=emptyfields");
        exit();
    } elseif ($Policy_no<=0 || $Amount<=0) {
        header("Location: ../PremiumPaymentRecord/AddPaymentRecord.php?error=invalidCode");
        exit();
    } else {
        $sql = "SELECT * FROM Policy WHERE Policy_no = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../PremiumPaymentRecord/AddPaymentRecord.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "i", $Policy_no);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $rowCount = mysqli_stmt_num_rows($result);
            $row = mysqli_fetch_assoc($result);
            if ($rowCount<0) {
                header("Location: ../PremiumPaymentRecord/AddPaymentRecord.php?error=Policy_number_Not_Found");
                exit();
            } elseif ($Amount < $row['Premium']) {
              header("Location: ../PremiumPaymentRecord/AddPaymentRecord.php?error=Insufficient_Amount");
              exit();
            }

            else {
              $sql = "INSERT INTO payment_record(Policy_no,Mode,Amount) VALUES (?,?,?)";
              $stmt = mysqli_stmt_init($conn);

              if (!mysqli_stmt_prepare($stmt, $sql)) {
                  header("Location: ../PremiumPaymentRecord/AddPaymentRecord.php?error=sqlerror3");
                  exit();
              } else {
                  mysqli_stmt_bind_param($stmt, "isi", $Policy_no,$Mode,$Amount);
                  mysqli_stmt_execute($stmt);
                  mysqli_stmt_store_result($stmt);
                  $suceess1 = true;
              }

                $sql = "UPDATE policy SET FUP = SEL(Policy_no) WHERE Policy_no = ?";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../PremiumPaymentRecord/AddPaymentRecord.php?error=sqlerror4");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "i", $Policy_no);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $suceess2 = true;
                }

                $sql = "SELECT FUP FROM policy WHERE Policy_no = ?";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../PremiumPaymentRecord/AddPaymentRecord.php?error=sqlerror5");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "i", $Policy_no);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_assoc($result);
                    $suceess3 = true;
                }

                if ($row['FUP'] == NULL) {
                  $sql = "UPDATE policy SET status=0 WHERE policy_no = ?";
                  $stmt = mysqli_stmt_init($conn);

                  if (!mysqli_stmt_prepare($stmt, $sql)) {
                      header("Location: ../PremiumPaymentRecord/AddPaymentRecord.php?error=sqlerror6");
                      exit();
                  } else {
                      mysqli_stmt_bind_param($stmt, "i", $Policy_no);
                      mysqli_stmt_execute($stmt);
                      mysqli_stmt_store_result($stmt);
                      $suceess4 = true;
                  }
                }

                if ($suceess1 && $suceess2 && $suceess3 && $suceess4) {
                    header("Location: ../PremiumPaymentRecord/AddPaymentRecord.php?success=PolicyAdded");
                    exit();
                } else {
                    header("Location: ../PremiumPaymentRecord/AddPaymentRecord.php?error=PolicyAdd_Failed");
                    exit();
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
?>
