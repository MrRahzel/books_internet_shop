<?php
//session_start();
// Use $HTTP_SESSION_VARS with PHP 4.0.6 or less
unset($_SESSION['log']);
unset($_SESSION['id']);
//unset("log"); 
//unset("id"); 
session_destroy();

include("index.php");
?>
