<?php

session_start();
// deleted all the values inside the $_SESSION
session_unset();
// destroy the existing session
session_destroy();

header("Location:../index.php");
