<?php

if (isset($_POST['submit'])) {
    require '../../database.php';

    $Agency_code = $_POST['Agency_code'];
    $password = $_POST['password'];

    if (empty($Agency_code) || empty($password)) {
        header("Location: ../Agent-Login.php");
        exit();
    } else {
        $sql = "SELECT * FROM Agent WHERE Agency_code = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../Agent-Login.php");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "i", $Agency_code);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $passcheck = password_verify($password, $row['Password']);

                if ($passcheck==false) {
                    header("Location: ../Agent-Login.php");
                    exit();
                } elseif ($passcheck==true) {
                    session_start();
                    $_SESSION['sessionId'] = $row['Agency_code'];
                    $_SESSION['sessionUser'] = $row['Name'];
                    header("Location: ../MainMenu.php?success=loggedin");
                    exit();
                } else {
                    header("Location: ../Agent-Login.php");
                    exit();
                }
            } else {
                header("Location: ../Agent-Login.php");
                exit();
            }
        }
    }
} else {
    header("Location: ../Agent/Agent-Login.php");
    exit();
}
