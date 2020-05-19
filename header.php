<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login System</title>
    <link rel="stylesheet" href="sass/main.css">
</head>
<body>

<header>
    <nav class="navMenu container">
        <a class="navMenu__img-link" href="index.php">
            <img class="navMenu__img-link--img-logo" src="img/logo.png" alt="logoImage">
        </a>
        <ul class="navMenu__menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Portfolio</a></li>
            <li><a href="#">About me</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
<!--        Sign Up form-->
        <div class="navMenu__loginForm">

        <?php
        //check if the user is logged in and deploy a specific message: "You are logged in"
        if(isset($_SESSION['userId'])){
            echo '<form class="navMenu__loginForm__formLogout" action="includes/logout.inc.php" method="post">
                    <button class="navMenu__loginForm__formLogin--btnLogout button" type="submit" name="logout-submit">Logout</button>
                </form>';
        }
        //check if the user is logged out
        else {
            echo '<form class="navMenu__loginForm__formLogin" action="includes/login.inc.php" method="post">
                    <input type="text" name="mailuid" placeholder="Username/E-mail...">
                    <input type="password" name="pwd" placeholder="Password...">
                    <button class="navMenu__loginForm__formLogin--btnLogin button" type="submit" name="login-submit">Login</button>
                </form>
                <a class="navMenu__loginForm__btnSignUp" href="signup.php">Sign up</a>';
            }
        ?>



        </div>
    </nav>
</header>
</body>

</html>