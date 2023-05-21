<?php
// Database Connection
require_once DB_PATH . '/connect.php';

// Functions
require LIBRARY_PATH . '/sessionFunctions.php';
require LIBRARY_PATH . '/dbFunctions.php';
require LIBRARY_PATH . '/helperFunctions.php';
require LIBRARY_PATH . '/uiFunctions.php';

// Require Login
requireLogin();

// Require konfigurime
requireKonfigurime();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>uji2021</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/public/css/bootstrap.min.css">
    <!-- Font awesome icons -->
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/public/css/fontawesome/css/all.min.css">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/public/css/main.css">
</head>

<body>