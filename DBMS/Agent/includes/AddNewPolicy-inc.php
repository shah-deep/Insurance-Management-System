<?php

if (isset($_POST['submit'])) {
    require '../../database.php';

    session_start();
    $Policy_no = $_POST['Policy_no']; //Not Null

    //  Policy Details
    $Plan_no = $_POST['Plan_no'];
    $Agency_code = $_SESSION['sessionId'];
    $Premium = $_POST['Premium'];
    $DOC = $_POST['DOC'];
    $FUP = $_POST['FUP'];
    $Mode = $_POST['Mode'];
    $SA = $_POST['SA'];
    $Term = $_POST['Term'];
    $PPT = $_POST['PPT'];
    $Age = $_POST['Age'];


    if (empty($Policy_no) || empty($Plan_no) || empty($Agency_code)) {
        header("Location: ../ManagePolicy/AddNewPolicy.php?error=emptyfields");
        exit();
    } elseif ($Policy_no<=0 || $Agency_code<=0 || $Plan_no<=0) {
        header("Location: ../ManagePolicy/AddNewPolicy.php?error=invalidCode");
        exit();
    } else {
        $sql = "SELECT * FROM Plan WHERE Plan_no = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../ManagePolicy/AddNewPolicy.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "i", $Plan_no);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $rowCount = mysqli_num_rows($result);

            if ($rowCount>0) {
                $row = mysqli_fetch_assoc($result);
                if (!($Age>=$row['min_age'] && $Age<$row['max_age'])) {
                    header("Location: ../ManagePolicy/AddNewPolicy.php?error=Invalid_Age");
                    exit();
                }

                if ($row['Type_term']==0) {
                    if (!($Term>=$row['T1'] && $Term<=$row['T2'])) {
                        header("Location: ../ManagePolicy/AddNewPolicy.php?error=Invalid_Term1");
                        exit();
                    }
                } else {
                    if (!($Term==$row['T1'] || $Term==$row['T2'] || $Term==$row['T3'] || $Term==$row['T4'])) {
                        header("Location: ../ManagePolicy/AddNewPolicy.php?error=Invalid_Term2");
                        exit();
                    }
                }

                if ($row['P1']==null || $row['P1']==0) {
                    if ($Term != $PPT) {
                        header("Location: ../ManagePolicy/AddNewPolicy.php?error=Term_PPT_Missmatch1");
                        exit();
                    }
                } else {
                    if (!(($Term==$row['T1'] && $PPT==$row['P1']) || ($Term==$row['T2'] && $PPT==$row['P2']) || ($Term==$row['T3'] && $PPT==$row['P3']) || ($Term==$row['T4'] && $PPT==$row['P4']))) {
                        header("Location: ../ManagePolicy/AddNewPolicy.php?error=Term_PPT_Missmatch2");
                        exit();
                    }
                }

                if ($row['MMA'] < ($Term+$Age)) {
                    header("Location: ../ManagePolicy/AddNewPolicy.php?error=Insufficient_MMA");
                    exit();
                }

                if ($row['max_SA']==null || $row['max_SA']==0) {
                    if ($SA<$row['min_SA']) {
                        header("Location: ../ManagePolicy/AddNewPolicy.php?error=Invalid_SA1");
                        exit();
                    }
                } else {
                    if ($SA<$row['min_SA'] || $SA>$row['max_SA']) {
                        header("Location: ../ManagePolicy/AddNewPolicy.php?error=Invalid_SA2");
                        exit();
                    }
                }

                if (($row['MODE_YEARLY']==0 && $Mode=='yearly') || ($row['MODE_HALFLY']==0 && $Mode=='halfly') || ($row['MODE_QUARTELY']==0 && $Mode=='quartely') || ($row['MODE_MONTHLY']==0 && $Mode=='monthly') || ($row['MODE_SINGLE']==0 && $Mode=='single premium')) {
                    header("Location: ../ManagePolicy/AddNewPolicy.php?error=Invalid_Mode");
                    exit();
                }

                $_SESSION['Policy_no'] = $Policy_no;
                $_SESSION['Plan_no'] = $Plan_no;
                $_SESSION['Agency_code'] = $Agency_code;
                $_SESSION['Premium'] = $Premium;
                $_SESSION['DOC'] = $DOC;
                $_SESSION['FUP'] = $FUP;
                $_SESSION['Mode'] = $Mode;
                $_SESSION['SA'] = $SA;
                $_SESSION['Term'] = $Term;
                $_SESSION['PPT'] = $PPT;
                $_SESSION['Age'] = $Age;
            } else {
                header("Location: ../ManagePolicy/AddNewPolicy.php?error=Invalid_Plan_no");
                exit();
            }
        }

        header("Location: ../ManagePolicy/AddNewPolicyHolder.php?success=PolicyValid");
        exit();
    }
}
