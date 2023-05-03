<?php
// Global configuration
require_once "../../config/config.php";

//destroy the session
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("Location: " . APP_URL . "/login");
exit;
