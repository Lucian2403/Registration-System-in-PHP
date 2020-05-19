<?php
require "header.php";

//session_destroy();
?>

<main class="main-section">

    <?php 
        if(isset($_SESSION['userId'])){
            echo '<p class="userStatus">You are logged in!</p>';
        }
        else {
            echo '<p class="userStatus">You are logged out!</p>';
        }
    ?>

</main>

<?php
require  "footer.php";
