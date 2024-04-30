<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

session_start(); 

if (isset($_POST['txtid'], $_POST['txtpwd'])) {
    if (validatelogin($_POST['txtid'], $_POST['txtpwd'])) {
        $_SESSION['id'] = $_POST['txtid']; 
        header("Location: index.php?return=success");
        exit;
    } else {
        unset($_SESSION['id']);
        $_SESSION['message'] = "Login Failed. Please try again."; 
        header("Location: index.php?return=fail");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>