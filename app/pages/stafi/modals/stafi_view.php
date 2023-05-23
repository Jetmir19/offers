<?php
$row = getStafiById((int)$_GET['stid']) ?? [];

if (count($row) > 0) {
?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <?php
                if ($row['image'] && file_exists(APPROOT . "/public/uploads/stafi/" . $row['image'])) {
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