<?php

// Delete START 
if (isset($_POST['produktetDelete'])) {
    // Disable form resubmission on refresh
    disableFormResubmission();

    $id = htmlspecialchars($_POST['produktetDelete']);
    $sql = "UPDATE produktet SET isDeleted = '1' WHERE produktetID = '$id'";
    if (mysqli_query($link, $sql)) {
        // Save in Historia
        saveHistoria('delete', 'produktet', 'U fshij me sukses.', 'success');
        // Success
        setSessionAlert('success', 'U fshij me sukses.');
    } else {
        // Update Error
        setSessionAlert('error', $link->error);
        die("Error:" . mysqli_error($link));
    }
} // Delete END

// Search START
$sql = "SELECT * FROM produktet WHERE isDeleted = 0";

if (isset($_POST['search'])) {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $emriProduktit = mysqli_real_escape_string($link, $_POST['emriProduktit']);
    $cat_produktet = mysqli_real_escape_string($link, $_POST['cat_produktet']);

    // Search by emriProduktit
    if ($emriProduktit != "") {
        $sql .= " AND emriProduktit = '$emriProduktit'";
    }
    // Search by nr_amez
    if ($cat_produktet != "") {
        $sql .= " AND cat_produktet = '$cat_produktet'";
    }
}

// Order by dateCreated as default
$sql .= " ORDER BY dateCreated DESC";

// Results
$result = $link->query($sql);

// No results found Modal
if ($result && $result->num_rows < 1) {
    msgModal("error", "Të dhënat nuk mund të gjenden!");
} // Search END
?>

<div class="container-fluid">

    <!-- Header Title START -->
    <div class="pt-3 pb-2 mb-3 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <h2><i class="fab fa-product-hunt fa-fw"></i> Produktet</h2>
        <a href="<?php echo APP_URL; ?>/index.php?page=produktet_new" class="btn btn-success">
            <i class="fas fa-plus"></i> Krijo
        </a>
    </div> <!-- Header Title END -->

    <!-- Display Session Messages-->
    <?php echo showSessionAlert(); ?>

    <form class="form-group" name="formSearch" id="formSearch" method="POST" action="" method="post">
        <fieldset class="form-group">
            <legend class="control-label text-muted">Kërko:</legend>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group row">
                        <div class="col">
                            <label for="serial" class="control-label">cat_produktet</label>
                            <input type="text" class="form-control" id="cat_produktet" name="cat_produktet" value="<?= $cat_produktet ?? ""; ?>" placeholder="cat_produktet">
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group row">
                        <div class="col">
                            <label for="emriProduktit" class="control-label">Emri i produktit</label>
                            <input type="text" class="form-control" id="emriProduktit" name="emriProduktit" value="<?= $emriProduktit ?? ""; ?>" placeholder="Emri i produkit">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Search Buttons -->
            <?php showSearchButtons('produktet'); ?>
        </fieldset>
    </form>

    <hr>

    <div class="table-responsive mb-3">
        <table class="table table-striped table-sm table-hover">
            <thead class="bg-dark text-light">
                <tr>
                    <th class="text-center">Action</th>
                    <!-- <th>Barkodi</th> -->
                    <th>Emri i prod.</th>
                    <th>Pershrkimi</th>
                    <th>Çmimi blerës</th>
                    <th>Çmimi shitës</th>
                    <th>Sasia kritike</th>
                    <th class="text-center">Statusi</th>
                    <th>Data e krijimit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $poID = $row['produktetID'];
                        $pstatusi = $row['pstatusi'];
                        if ($pstatusi == 'aktiv') {
                            $pstatusi = '<i class="fas fa-circle fa-lg text-success align-middle"></i> ';
                        } else {
                            $pstatusi = '<i class="fas fa-circle fa-lg text-danger align-middle"></i> ';
                        }
                ?>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <!-- edit -->
                                    <a class="btn" href='?page=produktet_edit&id=<?php echo $poID; ?>'>
                                        <i class="far fa-edit fa-lg text-primary"></i>
                                    </a>
                                    <!-- Delete -->
                                    <form class="frmDelete" action="?page=produktet" method="POST">
                                        <input type="hidden" name="produktetDelete" value="<?php echo $row['produktetID']; ?>">
                                        <button class="btn" type="submit"><i class="far fa-trash-alt fa-lg text-danger"></i></button>
                                    </form>
                                </div>
                            </td>
                            <!-- <td><?php echo $row['barkod']; ?></td> -->
                            <td><?php echo $row['emriProduktit']; ?></td>
                            <td><?php echo $row['pershkrimiProdukit']; ?></td>
                            <td><?php echo $row['cmimiBleres']; ?></td>
                            <td><?php echo $row['cmimiShites']; ?></td>
                            <td><?php echo $row['sasiakritike']; ?></td>
                            <td class="text-center"><?php echo $pstatusi; ?></td>
                            <td><?php echo $row['dateCreated']; ?></td>

                        </tr>
                <?php
                    }
                } else {
                    echo '<tr>
                            <td colspan="100%">
                                <div class="border text-center p-2"><span class="text-muted">Nuk u gjet asnjë regjistrim.</span></div>
                            </td>
                        </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

</div> <!-- container END -->

<script>
    // Delete form confirmation
    const frmDelete = document.querySelectorAll('.frmDelete');
    frmDelete.forEach(function(frm) {
        frm.addEventListener('submit', function(e) {
            if (confirm('A jeni të sigurt?')) {
                console.log("Form submited!");
            } else {
                e.preventDefault();
                location.replace("<?php echo APP_URL . '/index.php?page=produktet'; ?>");
            }
        });
    });
</script>