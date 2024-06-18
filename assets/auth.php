<?php
session_start();

if (!isset($_SESSION['Lietotajvards'])) {
    header("Location: ../assets/login.php");
    exit(); 
}
?>
