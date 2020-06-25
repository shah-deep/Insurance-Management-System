<?php

if (isset($_POST['submit'])) {
    require '../../database.php';

    $Admin_id = $_POST['Admin_id'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $Branch_id = $_POST['Branch_id'];
    $Name = $_POST['Name'];
    $Mobile_no = $_POST['Mobile_no'];
    $Email_id = $_POST['Email_id'];
    $DOB = $_POST['DOB'];
    $Designation = $_POST['Designation'];
    $City = $_POST['City'];

    if (empty($Admin_id) || empty($password) || empty($confirmPassword) || empty($Name) || empty($Branch_id)) {
        header("Location: ../Admin-Register.php?error=emptyfields");
        exit();
    } elseif ($Admin_id<=0) {
        header("Location: ../Admin-Register.php?error=invalidAgencyCode");
        exit();
    } elseif ($password !== $confirmPassword) {
        header("Location: ../Admin-Register.php?error=passwordsDoNotMatch");
        exit();
    } else {
        $sql = "SELECT Admin_id FROM Admin WHERE Admin_id = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../Admin-Register.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "i", $Admin_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowCount = mysqli_stmt_num_rows($stmt);

            if ($rowCount>0) {
                header("Location: ../Admin-Register.php?error=usernametaken");
                exit();
            } else {
                $sql = "INSERT INTO admin(Admin_id, Branch_id, Name, Mobile_no, Email_id, DOB, Designation, City, Password) VALUES (?,?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../Admin-Register.php?error=sqlerror2");
                    exit();
                } else {
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "iisisssss", $Admin_id, $Branch_id, $Name, $Mobile_no, $Email_id, $DOB, $Designation, $City, $hashedPass);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    header("Location: ../Admin-Register.php?success=registered");
                    exit();
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
