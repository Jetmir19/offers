<?php
// Global configuration
require_once "../../config/config.php";

//destroy the session
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destroy the session.
session_unset();
session_destroy();
session_write_close();

// Redirect to login page
header("Location: " . APP_URL . "/login");
exit;
