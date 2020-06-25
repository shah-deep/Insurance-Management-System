<?php

if (isset($_POST['submit'])) {
    require '../../database.php';

    $Policy_no = $_POST['Policy_no'];
    $Name = $_POST['Name'];
    $Name = str_replace(' ', '', $Name);
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


    if (empty($Policy_no) || empty($Name)) {
        header("Location: ../ManagePolicy/UpdatePolicy.php?error=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM Policy_holder WHERE Policy_no = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../ManagePolicy/UpdatePolicy.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "i", $Policy_no);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            $sql = "UPDATE policy_holder SET Name = ?, Mobile_no = ?, Email_id = ?, City = ?, Colony = ?, House_no = ?, Pincode = ?, Nominee_name = ?, Nominee_relation = ?, Gender = ?, Occupation = ?, DOB = ?, Edu_ql = ? WHERE Policy_no = ?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../ManagePolicy/UpdatePolicy?error=sqlerror2");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "sissssissssssi", $Name, $Mobile_no, $Email_id, $City, $Colony, $House_no, $Pincode, $Nominee_name, $Nominee_relation, $Gender, $Occupation, $DOB, $Edu_ql, $Policy_no);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);

                header("Location: ../ManagePolicy/UpdatePolicy.php?success=PolicyAdded");
                exit();
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
