<?php

if (isset($_POST['submit'])) {
    require '../../database.php';
    session_start();
    $Policy_no = $_SESSION['Policy_no']; //Not Null

    // Holder Details
    $Name = $_POST['Name'];
    $Mobile_no = $_POST['Mobile_no'];
    $Email_id = $_POST['Email_id'];
    $City = $_POST['City'];
    $Colony = $_POST['Colony'];
    $House_no = $_POST['House_no'];
    $Pincode = $_POST['Pincode'];
    $Nominee_name = $_POST['Nominee_name'];
    $Nominee_relation = $_POST['Nominee_relation'];
    $Gender = $_POST['Gender'];
    $Occupation = $_POST['Occupation'];
    $Edu_ql = $_POST['Edu_ql'];
    $DOB = $_POST['DOB'];
    //  Policy Details
    $Plan_no = $_SESSION['Plan_no'];
    $Agency_code = $_SESSION['Agency_code'];
    $Premium = $_SESSION['Premium'];
    $DOC = $_SESSION['DOC'];
    $FUP = $_SESSION['FUP'];
    $Mode = $_SESSION['Mode'];
    $SA = $_SESSION['SA'];
    $Term = $_SESSION['Term'];
    $PPT = $_SESSION['PPT'];
    $Age = $_SESSION['Age'];


    if (empty($Policy_no) || empty($Name) || empty($Plan_no) || empty($Agency_code)) {
        header("Location: ../ManagePolicy/AddNewPolicyHolder.php?error=emptyfields");
        exit();
    } elseif ($Policy_no<=0 || $Agency_code<=0 || $Plan_no<=0) {
        header("Location: ../ManagePolicy/AddNewPolicyHolder.php?error=invalidCode");
        exit();
    } else {

        $sql = "SELECT * FROM Policy_holder WHERE Policy_no = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../ManagePolicy/AddNewPolicyHolder.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "i", $Policy_no);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowCount = mysqli_stmt_num_rows($stmt);

            if ($rowCount>0) {
                header("Location: ../ManagePolicy/AddNewPolicyHolder.php?error=Policy_number_NotAvailable");
                exit();
            } else {
                $sql = "INSERT INTO Policy(Policy_no,Plan_no,Agency_code,Premium,DOC,FUP,Mode,SA,Term,PPT) VALUES (?,?,?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../ManagePolicy/AddNewPolicyHolder.php?error=sqlerror3");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "iiiisssiii", $Policy_no, $Plan_no, $Agency_code, $Premium, $DOC, $FUP, $Mode, $SA, $Term, $PPT);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    //print_r($stmt);
                    $success1 = true;
                }
                $sql = "INSERT INTO Policy_holder(Policy_no,Name,Mobile_no,Email_id,City,Colony,House_no,Pincode,Nominee_name,Nominee_relation,Gender,Occupation,DOB,Edu_ql) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../ManagePolicy/AddNewPolicyHolder.php?error=sqlerror2");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "isissssissssss", $Policy_no, $Name, $Mobile_no, $Email_id, $City, $Colony, $House_no, $Pincode, $Nominee_name, $Nominee_relation, $Gender, $Occupation, $DOB, $Edu_ql);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    //print_r($stmt);
                    $success2 = true;
                }

                if ($success1 && $success2) {
                    unset($_SESSION['Policy_no']);
                    unset($_SESSION['Plan_no']);
                    unset($_SESSION['Agency_code']);
                    unset($_SESSION['Premium']);
                    unset($_SESSION['DOC']);
                    unset($_SESSION['FUP']);
                    unset($_SESSION['Mode']);
                    unset($_SESSION['SA']);
                    unset($_SESSION['Term']);
                    unset($_SESSION['PPT']);
                    unset($_SESSION['Age']);

                    $sql = "SELECT * FROM Policy_holder WHERE Policy_no = ?";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $sql);
                    mysqli_stmt_bind_param($stmt, "i", $Policy_no);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $rowCount = mysqli_stmt_num_rows($stmt);
                    if ($rowCount>0) {
                    header("Location: ../ManagePolicy/ManagePolicy.php?success=PolicyAdded");
                    exit();
                    } else {
                      $sql = "SELECT * FROM Policy WHERE Policy_no = ?";
                      $stmt = mysqli_stmt_init($conn);
                      mysqli_stmt_prepare($stmt, $sql);
                      mysqli_stmt_bind_param($stmt, "i", $Policy_no);
                      mysqli_stmt_execute($stmt);
                      mysqli_stmt_store_result($stmt);
                      $rowCount = mysqli_stmt_num_rows($stmt);
                      if ($rowCount>0) {
                        $sql = "DELETE FROM Policy WHERE Policy_no = ?";
                        mysqli_stmt_prepare($stmt, $sql);
                        mysqli_stmt_bind_param($stmt, "i", $Policy_no);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                      }
                      header("Location: ../ManagePolicy/ManagePolicy.php?error=PolicyAdd_Failed");
                      exit();
                    }
                } else {
                    header("Location: ../ManagePolicy/AddNewPolicyHolder.php?error=PolicyAdd_Failed");
                    exit();
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
} else {
  echo "Session Variable not set";
}
