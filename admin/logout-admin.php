<?php
// Start the session
session_start();

require_once 'admin/connect.php';

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

if (isset($conn)) {
    $conn->close();
}

// Redirect to the login page after logout
header("Location: login-admin.php");
exit;
?>
