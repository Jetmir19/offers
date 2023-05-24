<?php
$njesiaID = filter_input(INPUT_GET, "njeId", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$row = getNjesiById($njesiaID) ?? [];

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
} else {
    echo '<tr>
            <td colspan="100%">
                <div class="border text-center p-2"><span class="text-muted">Nuk u gjet asnjë regjistrim.</span></div>
            </td>
        </tr>';
}
?>