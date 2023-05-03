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
requireKonfigurime()
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
        $row = getStafiById((int)$_GET['stid']);
        if ($row) {
        ?>
            <div class="row">
                <div class="col-md-4">
                    <?php
                    if ($row['image']) {
                        echo '<img title="profile-image" class="rounded-circle img-thumbnail" src="' . APP_URL . '/public/uploads/stafi/' . $row["image"] . '">';
                    } else {

                        echo '<img title="profile-image" class="rounded-circle img-thumbnail" src="' . APP_URL . '/public/uploads/stafi/no-profile.png">';
                    }
                    ?>
                </div>

                <div class="col-md-8">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Emri: <strong><?php echo $row['emri'] ?></strong></li>
                        <li class="list-group-item">Mbiemri: <strong><?php echo $row['mbiemri'] ?></strong></li>
                        <li class="list-group-item">Titulli: <strong><?php echo $row['titulli'] ?></strong></li>
                        <li class="list-group-item">Emri përdorues: <strong><?php echo $row['emriperdorues'] ?></strong></li>
                        <li class="list-group-item">Data e punësimit: <strong><?php echo $row['data_punesimit'] ?></strong></li>
                        <li class="list-group-item">A është admin: <strong><?php echo $row['isAdmin'] ?></strong></li>
                        <li class="list-group-item">Koment: <strong><?php echo $row['komment'] ?></strong></li>
                        <li class="list-group-item">Statusi: <strong><?php echo $row['ststatusi'] ?></strong></li>
                        <li class="list-group-item">Data e regjistrimit: <strong><?php echo $row['dateCreated'] ?></strong></li>
                        <li class="list-group-item">Data e ndryshimit: <strong><?php echo $row['dateUpdated'] ?></strong></li>
                    </ul>
                </div>
            </div>
    </div>
<?php
        }
?>

<!-- Iframe Modal Buttons START -->
<!-- <div class="border-top pt-3 mt-4 text-right" id="modal-buttons">
            <button type="button" onclick="window.parent.document.getElementById('closeDataModalx').click()" class="btn btn-secondary">Anulo</button>
        </div> Iframe Modal Buttons END -->

</div> <!-- container END -->


<script src="<?php echo APP_URL; ?>/public/js/jquery-3.4.1.min.js"></script>
<script src="<?php echo APP_URL; ?>/public/js/popper.min.js"></script>
<script src="<?php echo APP_URL; ?>/public/js/bootstrap.min.js"></script>
<script src="<?php echo APP_URL; ?>/app/scripts/modals.js"></script>

</body>
<html>