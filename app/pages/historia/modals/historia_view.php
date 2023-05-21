<?php
// Global configuration
require_once "../../../config/config.php";

// Database Connection
require_once DB_PATH . '/connect.php';

// Functions
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
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/public/css/main.css">
</head>

<body>

    <div class="container-fluid">

        <?php
        $historiaID = filter_input(INPUT_GET, "hid", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $row = getHistoriaById($historiaID);
        $stafiID = filter_input(INPUT_GET, "sid", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $stafi = getStafiById($stafiID);
        if ($row) {
        ?>
            <div class="row">
                <div class="col">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Stafi: <strong><?php echo $stafi['emri'] . ' ' . $stafi['mbiemri']; ?></strong></li>
                        <li class="list-group-item">Action: <strong><?php echo $row['action'] ?></strong></li>
                        <li class="list-group-item">Module: <strong><?php echo $row['module'] ?></strong></li>
                        <li class="list-group-item">Mesagge: <strong><?php echo $row['message'] ?></strong></li>
                        <li class="list-group-item">Status: <strong><?php echo $row['hstatusi'] ?></strong></li>
                        <li class="list-group-item">Date: <strong><?php echo $row['dateCreated'] ?></strong></li>
                    </ul>
                <?php
            }
                ?>
                </div>
            </div>

    </div> <!-- container END -->

    <script src="<?php echo APP_URL; ?>/public/js/jquery-3.7.0.min.js"></script>
    <script src="<?php echo APP_URL; ?>/public/js/popper.min.js"></script>
    <script src="<?php echo APP_URL; ?>/public/js/bootstrap.min.js"></script>
    <script src="<?php echo APP_URL; ?>/app/scripts/modals.js"></script>

</body>
<html>