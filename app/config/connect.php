<?php
// enable exception error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$GLOBALS['link'] = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// $link = mysqli_connect($host, $user, $passwd, $dbname);

// kirilica support mysql
$GLOBALS['link']->set_charset("utf8");

// Check connection
if ($GLOBALS['link'] === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Define db object as Global variable
define("LINK", $GLOBALS['link']);
