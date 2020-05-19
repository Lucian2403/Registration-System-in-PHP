<?php
// check if the button Login is pressed
if (isset($_POST['login-submit'])) {

    require 'dbh.inc.php';

    //Login with Email or Username
    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if (empty($mailuid) || empty ($password)) {
        header("Location: ../index.php?error=emptyFields");
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE UsernameID=? OR emailUsers=?;";
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlError");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['pwdUsers']);
                if ($pwdCheck == false) {
                    header("Location: ../index.php?error=wrongPwd");
                    exit();
                }
                else if($pwdCheck == true) {
                    session_start();
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['userUid'] = $row['UsernameID'];

                    header("Location: ../index.php?login=success");
                    exit();
                }
                else {
                    header("Location: ../index.php?error=wrongPwd");
                    exit();
                }
            }
            else {
                header("Location: ../index.php?error=noUser");
                exit();
            }
        }
    }
}

else {
    header("Location: ../index.php");
    exit();
}