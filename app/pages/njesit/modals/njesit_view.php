<?php
$row = getNjesiById((int)$_GET['njeID']) ?? [];

if (count($row) > 0) {
?>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Emri njesis: <strong><?php echo $row['emri_njesis'] ?></strong></li>
                    <li class="list-group-item">Njesia: <strong><?php echo $row['njesia'] ?></strong></li>

                </ul>
            </div>
        </div>
    </div>

<?php
}
?>