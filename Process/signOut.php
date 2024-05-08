<?php
session_start();
$role = $_SESSION['role'];
setcookie('signedinAs'. $role. '', '', time() - 3600, '/');
// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to the login page or any other page
header("Location: ../View/login_signup.php");
exit();
