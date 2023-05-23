<?php
//------------------------------------------------------------
// Sessions
//------------------------------------------------------------
session_name('Offers_SESSION');
// Use SSL/TLS encryption
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_httponly', 1);
// Set session cookie parameters
session_set_cookie_params([
    'secure' => true,
    'httponly' => true,
]);
// Session and Cookie duration
define('SESSION_DURATION', 3600); // the time is in seconds (60min)
define('COOKIE_DURATION', 60 * 60 * 24 * 30); // 30 days
if (session_status() === PHP_SESSION_NONE) {
    ob_start();
    session_start();
}

//------------------------------------------------------------
// Error Reporting
//------------------------------------------------------------
error_reporting(E_ALL); // Just for Develop
ini_set('ignore_repeated_errors', TRUE); // always use TRUE
ini_set('display_errors', TRUE); // Error/Exception display, use FALSE only in production
ini_set('log_errors', TRUE); // Error/Exception file logging engine.
ini_set('error_log', dirname(dirname(__DIR__)) . '/error.log'); // Logging file path

// Set the new timezone
date_default_timezone_set('Europe/Skopje');

//-------------------------------------------------------
// MySQL Database Connection
//-------------------------------------------------------
define('DB_HOST', 'localhost');
define('DB_NAME', 'ewins');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASS', '123456');

//-------------------------------------------------------
// APP
//-------------------------------------------------------
/* APP Absolute URL */
define('APP_URL', 'http://localhost/offers');
/* APP Absolute PATH */
define('APPROOT', dirname(dirname(__DIR__)));
/* app PATH */
define('APP_PATH', APPROOT . '/app');
/* pages PATH */
define('PAGES_PATH', APP_PATH . '/pages');
/* public PATH */
define('PUBLIC_PATH', APPROOT . '/public');
/* uploads PATH */
define('UPLOADS_PATH', PUBLIC_PATH . '/uploads');
// database PATH
define('DB_PATH', APP_PATH . '/config');
/* library PATH */
define('LIBRARY_PATH', APP_PATH . '/library');
/* Version */
define('APP_VERSION', '1.0.0');


//-------------------------------------------------------
// User Admin
//-------------------------------------------------------
// Username: jetmir1
// password: jetmir1