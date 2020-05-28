<?php

if (isset($_POST['submit'])) {
    require '../../database.php';

    $Admin_id = $_POST['Admin_id'];
    $password = $_POST['password'];

    if (empty($Admin_id) || empty($password)) {
        header("Location: ../Admin-Login.php");
        exit();
    } else {
        $sql = "SELECT * FROM Admin WHERE Admin_id = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../Admin-Login.php");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "i", $Admin_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $passcheck = password_verify($password, $row['Password']);

                if ($passcheck==false) {
                    header("Location: ../Admin-Login.php");
                    exit();
                } elseif ($passcheck==true) {
                    session_start();
                    $_SESSION['sessionId2'] = $row['Admin_id'];
                    $_SESSION['sessionUser'] = $row['Name'];
                    header("Location: ../AdminMenu.php?success=loggedin");
                    exit();
                } else {
                    header("Location: ../Admin-Login.php");
                    exit();
                }
            } else {
                header("Location: ../Admin-Login.php");
                exit();
            }
        }
    }
} else {
    header("Location: ../Admin/Admin-Login.php?error=AccessForbidden");
    exit();
}
