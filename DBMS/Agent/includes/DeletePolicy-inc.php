<?php

if (isset($_POST['submit'])) {
    require '../../database.php';

    $Policy_no = $_POST['Policy_no']; //Not Null

    if (empty($Policy_no)) {
        header("Location: ../ManagePolicy/DeletePolicy.php?error=emptyfields");
        exit();
    } elseif ($Policy_no<=0) {
        header("Location: ../ManagePolicy/DeletePolicy.php?error=invalidCode");
        exit();
    } else {
        $sql = "SELECT * FROM Policy_holder WHERE Policy_no = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../ManagePolicy/DeletePolicy.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "i", $Policy_no);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowCount = mysqli_stmt_num_rows($stmt);

            if ($rowCount<1) {
                header("Location: ../ManagePolicy/DeletePolicy.php?error=Policy_number_Not_Found");
                exit();
            } else {
              $sql = "DELETE FROM Policy_holder WHERE Policy_no = ?";
              $stmt = mysqli_stmt_init($conn);

              if (!mysqli_stmt_prepare($stmt, $sql)) {
                  header("Location: ../ManagePolicy/DeletePolicy.php?error=sqlerror3");
                  exit();
              } else {
                  mysqli_stmt_bind_param($stmt, "i", $Policy_no);
                  mysqli_stmt_execute($stmt);
                  mysqli_stmt_store_result($stmt);
                  $suceess1 = true;
              }

                $sql = "DELETE FROM Policy WHERE Policy_no = ?";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../ManagePolicy/DeletePolicy.php?error=sqlerror2");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "i", $Policy_no);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $suceess2 = true;
                }


                if ($suceess1 && $suceess2) {
                    header("Location: ../ManagePolicy/DeletePolicy.php?success=PolicyDeleted");
                    exit();
                } else {
                    header("Location: ../ManagePolicy/DeletePolicy.php?error=PolicyDelete_Failed");
                    exit();
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
