<?php
$historiaID = filter_input(INPUT_GET, "hid", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$stafiID = filter_input(INPUT_GET, "stid", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$stafi = getStafiById($stafiID) ?? [];
$row = getHistoriaById($historiaID) ?? [];

if (count($row) > 0) {
?>

    <div class="container-fluid">
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
            </div>
        </div>
    </div>

<?php
} else {
    echo '<tr>
            <td colspan="100%">
                <div class="border text-center p-2"><span class="text-muted">Nuk u gjet asnjë regjistrim.</span></div>
            </td>
        </tr>';
}
?>