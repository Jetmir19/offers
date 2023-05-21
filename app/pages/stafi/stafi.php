<?php

// Delete START 
if (isset($_POST['stafiDelete'])) {
    // Disable form resubmission on refresh
    disableFormResubmission();

    $id = htmlspecialchars($_POST['stafiDelete']);
    // Soft delete klient
    $sql = "UPDATE stafi SET isDeleted = '1' WHERE stafiID = '$id'";
    if (mysqli_query($link, $sql)) {
        // // Remove the existing Image
        // if (file_exists(UPLOADS_PATH. "/stafi/" . $img)) {
        //     @unlink(UPLOADS_PATH. "/stafi/" . $img);
        // }

        // Save in Historia
        saveHistoria('delete', 'stafi', 'U fshij me sukses.', 'success');
        // Success
        setSessionAlert('success', 'U fshij me sukses.');
    } else {
        // Delete Error
        msgModal("error", mysqli_error($link));
    }
} // Delete END

// Search START
$sql = "SELECT * FROM stafi WHERE isDeleted = 0";

if (isset($_POST['search'])) {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $emri = htmlspecialchars($_POST['emri']);
    $mbiemri = htmlspecialchars($_POST['mbiemri']);

    // Search by emri and mbiemri
    if ($emri != "" && $mbiemri != "") {
        $sql .= " AND emri = '$emri' AND mbiemri = '$mbiemri'";
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
    <div class="pt-3 pb-2 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <h2><i class="fa fa-user fa-fw"></i> Stafi</h2>
        <a href="<?php echo APP_URL; ?>/index.php?page=stafi_new" class="btn btn-success">
            <i class="fas fa-plus"></i> Krijo
        </a>
    </div> <!-- Header Title END -->

    <!-- Display Session Messages-->
    <?php echo showSessionAlert(); ?>

    <form class="form-group" name="formSearch" id="formSearch" method="POST" action="">
        <fieldset class="form-group">
            <legend class="control-label text-muted">Kërko:</legend>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group row">
                        <div class="col">
                            <label for="emri" class="control-label">Emri</label>
                            <input type="text" class="form-control" id="emri" name="emri" value="<?= $emri ?? ""; ?>" placeholder="Emri">
                            <span id="emriErr" class="invalid-feedback">Emri i detyrueshëm.</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group row">
                        <div class="col">
                            <label for="mbiemri" class="control-label">Mbiemri</label>
                            <input type="text" class="form-control" id="mbiemri" name="mbiemri" value="<?= $mbiemri ?? ""; ?>" placeholder="Mbiemri">
                            <span id="mbiemriErr" class="invalid-feedback">Mbiemri i detyrueshëm.</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Search Buttons -->
            <?php showSearchButtons('stafi'); ?>
        </fieldset>
    </form>

    <hr>

    <div class="table-responsive">
        <table class="table table-striped table-sm table-hover text-center">
            <thead class="bg-dark text-light">
                <tr>
                    <th>Action</th>
                    <th>Fotoja</th>
                    <th>Emri</th>
                    <th>Mbiemri</th>
                    <th>Emri përdorues</th>
                    <th>Titulli</th>
                    <th>Data e punësimit</th>
                    <th>Admin?</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // List all other stafi except admin 
                        if ($row['emriperdorues'] !== "admin") {
                            $stID = $row['stafiID'];
                ?>
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <!-- view -->
                                        <button type="button" class="btn btnStView" data-toggle="modal" data-target="#dataModal" data-btnView="<?= $stID ?>" data-backdrop="static" data-keyboard="false">
                                            <i class="far fa-list-alt fa-lg text-info"></i>
                                        </button>
                                        <!-- edit -->
                                        <a class="btn" href='?page=stafi_edit&id=<?php echo $stID; ?>'>
                                            <i class="far fa-edit fa-lg text-primary"></i>
                                        </a>
                                        <!-- Delete -->
                                        <form class="frmDelete" method="POST">
                                            <input type="hidden" name="stafiDelete" value="<?php echo $stID; ?>">
                                            <input type="hidden" name="imageDelete" value="<?php echo $row['image']; ?>">
                                            <button class="btn" type="submit"><i class="far fa-trash-alt fa-lg text-danger"></i></button>
                                        </form>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <?php
                                    if ($row['image'] && file_exists(APPROOT . "/public/uploads/stafi/" . $row['image'])) {
                                        echo '<img src="' . APP_URL . "/public/uploads/stafi/" . $row['image'] . '" alt="image" width="60px" height="60px">';
                                    } else {
                                        echo '<img src="' . APP_URL . '/public/uploads/stafi/no-profile.png" alt="image" width="60px" height="60px">';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $row['emri']; ?></td>
                                <td><?php echo $row['mbiemri']; ?></td>
                                <td><?php echo $row['emriperdorues']; ?></td>
                                <td><?php echo $row['titulli']; ?></td>
                                <td><?php echo $row['data_punesimit']; ?></td>
                                <td><?php echo $row['isAdmin'] == 1 ? "po" : "jo"; ?></td>
                            </tr>
                <?php
                        }
                    }
                } else {
                    echo '<tr><td colspan="100%">
                            <div class="border text-center p-2"><span class="text-muted">Nuk u gjet asnjë regjistrim.</span></div>
                        </td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

</div> <!-- container END -->

<script>
    // Validation
    document.getElementById('formSearch').addEventListener('submit', (event) => {
        let inputEmri = document.getElementById('emri');
        let inputMbiemri = document.getElementById('mbiemri');

        // Validate emri with mbiemri
        if (inputEmri.value !== "" && inputMbiemri.value === "") {
            event.preventDefault();
            inputMbiemri.classList.add('is-invalid');
        } else {
            inputMbiemri.classList.remove('is-invalid');
        }
        if (inputMbiemri.value !== "" && inputEmri.value === "") {
            event.preventDefault();
            inputEmri.classList.add('is-invalid');
        } else {
            inputEmri.classList.remove('is-invalid');
        }
    });

    // btnStView click
    document.querySelectorAll('.btnStView').forEach(function(el) {
        el.addEventListener('click', function(e) {
            const stid = e.currentTarget.getAttribute('data-btnView');
            const iframePath = "<?php echo APP_URL . '/app/pages/stafi/modals/stafi_view.php' ?>";
            const options = {
                iframePath: `${iframePath}?stid=${stid}`,
                headerText: 'Profili Stafit',
                btnActionShow: false
            };
            // Show modal without action button
            showIframeModal(options);
        });
    });

    // Delete form confirmation
    const frmDelete = document.querySelectorAll('.frmDelete');
    frmDelete.forEach(function(frm) {
        frm.addEventListener('submit', function(e) {
            if (confirm('A jeni i siugrt qe doni te fshini përdoruesin?')) {
                console.log("Form submited!");
            } else {
                e.preventDefault();
                location.replace("<?php echo APP_URL . '/index.php?page=stafi'; ?>");
            }
        });
    });
</script>