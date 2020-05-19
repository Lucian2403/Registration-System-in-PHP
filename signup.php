<?php
require "header.php";
?>

    <main class="main-section">
        <h1>Sign Up</h1>
        <?php
            // Show the error in the UI with the $_GET global variables, because this variable is used to get smth from the url
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "emptyfield") {
                    echo '<p class="signupError">Fill in all fields!</p>';
                }
                else if ($_GET['error'] == "invaliduidmail") {
                    echo '<p class="signupError">Invalid Username or E-mail!</p>';
                }
                else if ($_GET['error'] == "passwordcheck") {
                    echo '<p class="signupError">Your passwords do not match!!</p>';
                }
                else if ($_GET['error'] == "usertaken") {
                    echo '<p class="signupError">Username already taken!</p>';
                }
            }
        ?>
        <form class="form-sign_up" action="includes/signup.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username" required>
            <input type="email" name="mail" placeholder="E-mail" required>
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwd-repeat" placeholder="Repeat Password">
            <button class="button" type="submit" name="signup-submit">Sign Up</button>
        </form>
    </main>

<?php
require  "footer.php";