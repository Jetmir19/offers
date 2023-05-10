<?php
ob_start();
session_start();

//------------------------------------------------------------
// Error Reporting
//------------------------------------------------------------
error_reporting(E_ALL); // Just for Develop
ini_set('ignore_repeated_errors', TRUE); // always use TRUE
ini_set('display_errors', TRUE); // Error/Exception display, use FALSE only in production
ini_set('log_errors', TRUE); // Error/Exception file logging engine.
ini_set('error_log', dirname(__DIR__) . '/error.log'); // Logging file path

// Set the new timezone
date_default_timezone_set('Europe/Skopje');

//-------------------------------------------------------
// Database Connection
//-------------------------------------------------------
define('DB_HOST', 'localhost');
define('DB_NAME', 'ewins');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASS', '123456');

//-------------------------------------------------------
// APP Absolute URL
//-------------------------------------------------------
defined('APP_URL')
    or define('APP_URL', 'http://localhost/offers');

// APP Absolute PATH
defined('APPROOT')
    or define('APPROOT', dirname(dirname(__DIR__)));

/* app PATH */
defined('APP_PATH')
    or define('APP_PATH', APPROOT . '/app');

/* public PATH */
defined('PUBLIC_PATH')
    or define('PUBLIC_PATH', APPROOT . '/public');

/* uploads PATH */
defined('UPLOADS_PATH')
    or define('UPLOADS_PATH', PUBLIC_PATH . '/uploads');

// pages PATH
defined('PAGES_PATH')
    or define('PAGES_PATH', APP_PATH . '/pages');

// database PATH
defined('DB_PATH')
    or define('DB_PATH', APP_PATH . '/config');

/* library PATH */
defined('LIBRARY_PATH')
    or define('LIBRARY_PATH', APP_PATH . '/library');

/* library PATH */
defined('APP_VERSION')
    or define('APP_VERSION', '1.0.0');



/* Static Admin (hidden admin) */
// Username: jetmir1
// password: jetmir1