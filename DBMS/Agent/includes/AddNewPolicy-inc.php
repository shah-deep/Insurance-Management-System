<?php

if (isset($_POST['submit'])) {
    require '../../database.php';
    session_start();
    $Policy_no = $_POST['Policy_no']; //Not Null

    // Holder Details
    $Name = $_POST['Name']; //Not Null
    $Email_id = $_POST['Email_id'];
    $DOB = $_POST['DOB'];
    $House_no = $_POST['House_no'];
    $Colony = $_POST['Colony'];
    $City = $_POST['City'];
    $Pincode = $_POST['Pincode'];
  //  $Address =  $House_no.", ".$Colony.", ".$City.", ".$Pincode;
    $Nominee_name = $_POST['Nominee_name'];
    $Nominee_relation = $_POST['Nominee_relation'];
  //  $Nominee = $Nominee_name." ".$Nominee_relation;
    $Height = $_POST['Height'];
    $Weight = $_POST['Weight'];
    $Gender = $_POST['Gender']; // M/F
    $Occupation = $_POST['Occupation'];
    $Edu_ql = $_POST['Edu_ql'];

    //  Policy Details
    $Plan_no = $_POST['Plan_no']; //Not Null
    $Agency_code = $_SESSION['sessionId'];   //$_POST['Agency_code'];   //Not Null
    $Premium = $_POST['Premium'];
    $Commission = $_POST['Commission'];
    $Term = $_POST['Term'];
    $PPT = $_POST['PPT'];
    $SA = $_POST['SA'];
    $Mode = $_POST['Mode'];
    $DOC = $_POST['DOC'];
    $FUP = $_POST['FUP'];

    if (empty($Policy_no) || empty($Name) || empty($Plan_no) || empty($Agency_code)) {
        header("Location: ../ManagePolicy/AddNewPolicy.php?error=emptyfields");
        exit();
    } elseif ($Policy_no<=0 || $Agency_code<=0 || $Plan_no<=0) {
        header("Location: ../ManagePolicy/AddNewPolicy.php?error=invalidCode");
        exit();
    } else {
        $sql = "SELECT * FROM Policy_holder WHERE Policy_no = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../ManagePolicy/AddNewPolicy.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "i", $Policy_no);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowCount = mysqli_stmt_num_rows($stmt);

            if ($rowCount>0) {
                header("Location: ../ManagePolicy/AddNewPolicy.php?error=Policy_number_NotAvailable");
                exit();
            } else {
                $sql = "INSERT INTO Policy_holder(Policy_no,DOB,Pincode,Height,Weight,Name,Email_id,City,Colony,House_no,Nominee_name,Nominee_relation,Gender,Occupation,Edu_ql) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../ManagePolicy/AddNewPolicy.php?error=sqlerror2");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "iiiiissssssssss", $Policy_no, $DOB, $Pincode, $Height, $Weight, $Name, $Email_id, $City, $Colony, $House_no, $Nominee_name, $Nominee_relation, $Gender, $Occupation, $Edu_ql);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $suceess1 = true;
                }
                $sql = "INSERT INTO Policy(Policy_no,Plan_no,Agency_code,Premium,DOC,Commission,SA,FUP,Term,PPT,Mode) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../ManagePolicy/AddNewPolicy.php?error=sqlerror3");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "iiiiiiiiiis", $Policy_no, $Plan_no, $Agency_code, $Premium, $DOC, $Commission, $SA, $FUP, $Term, $PPT, $Mode);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $suceess2 = true;
                }

                if ($suceess1 && $suceess2) {
                    header("Location: ../ManagePolicy/AddNewPolicy.php?success=PolicyAdded");
                    exit();
                } else {
                    header("Location: ../ManagePolicy/AddNewPolicy.php?error=PolicyAdd_Failed");
                    exit();
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
?>
