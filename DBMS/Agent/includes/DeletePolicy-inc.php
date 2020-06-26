<?php

if (isset($_POST['submit'])) {
    require '../../database.php';
    session_start();
    $Policy_no = $_POST['Policy_no']; //Not Null
    $Agency_code = $_SESSION['sessionId'];

    if (empty($Policy_no)) {
        header("Location: ../ManagePolicy/DeletePolicy.php?error=emptyfields");
        exit();
    } elseif ($Policy_no<=0) {
        header("Location: ../ManagePolicy/DeletePolicy.php?error=invalidCode");
        exit();
    } else {
        $sql = "SELECT * FROM Policy WHERE Agency_code = $Agency_code AND Policy_no = ?";
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
                    $success1 = true;
                }

                $sql = "DELETE FROM payment_record WHERE Policy_no = ?";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../ManagePolicy/DeletePolicy.php?error=sqlerror2");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "i", $Policy_no);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $success2 = true;
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
                    $success3 = true;
                }


                if ($success1 && $success2 && $success3) {
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
