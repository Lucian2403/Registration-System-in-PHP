<?php

if(isset($_POST['signup-submit'])) {

    require 'dbh.inc.php'; //access to $conn

    $username       = $_POST['uid'];
    $email          = $_POST['mail'];
    $password       = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfield&uid=" .$username. "&mail=" .$email);
        exit(); //don't continue the code below this
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidmailuid");
        exit();
    }

    // check the validation of email
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uid=" .$username);
        exit();
    }
    // check if the password is a proper one
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduid&mail=" .$email);
        exit();
    }
    // check if the password are matching each other
    else if ($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheck&uid=" .$username. "&mail=" .$email);
        exit();
    }
    else {
        // check if the username already exists
        $sql = "SELECT UsernameID FROM users WHERE UsernameID =?";
        $stmt = mysqli_stmt_init($conn); // database statement

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else {
            // take the info from the user and later to database with the statement we created above
            mysqli_stmt_bind_param($stmt,"s", $username); // s - String
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=usertaken&mail=" .$email);
                exit();
            }
            else {
                $sql = "INSERT INTO users (UsernameID, emailUsers, pwdUsers) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else {
                    //encrypt the password into random chars
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt,"sss", $username, $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
    }
    // mysqli_stmt_close($stmt);
    // mysqli_close($conn);
}
else {
    header("Location: ../signup.php");
    exit();
}