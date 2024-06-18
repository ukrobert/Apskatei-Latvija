<?php
session_start(); 


$_SESSION = array();


session_destroy();


header("Location: ../assets/login.php");
exit(); 
?>