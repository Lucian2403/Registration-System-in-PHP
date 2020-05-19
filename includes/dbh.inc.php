<?php

// The page to connect the data to database.

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "login_system_tutorial";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

//Check if connection failed
if  (!$conn) {
    //kill the connection
    die("Connection failed: ".mysqli_connect_error());
}