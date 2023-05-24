<?php
// Delete START 
if (isset($_POST['historiaDelete'])) {
    // Disable form resubmission on refresh
    disableFormResubmission();

    $id = htmlspecialchars($_POST['historiaDelete']);
    // Soft delete klient
    $sql = "UPDATE historia SET isDeleted = '1' WHERE historiaID = '$id'";
    if (mysqli_query($link, $sql)) {
        // Success
        setSessionAlert('success', 'U fshij me sukses.');
    } else {
        die("Error:" . mysqli_error($link));
    }
} // Delete END

// Search START
$sql = "SELECT * FROM historia WHERE isDeleted = 0";

if (isset($_POST['search'])) {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $module = mysqli_real_escape_string($link, $_POST['module']);
    $dateCreated = mysqli_real_escape_string($link, $_POST['dateCreated']);
    // Format date for MySQL
    $dateCreated = date('Y-m-d', strtotime($dateCreated));

    // Search by module
    if ($module != "") {
        $sql .= " AND module = '{$module}'";
    }
    // Search by date
    if ($dateCreated != "" && $dateCreated != "1970-01-01") {
        $sql .= " AND dateCreated = '{$dateCreated}'";
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
        <h2><i class="fas fa-history fa-fw"></i> Historia</h2>
    </div> <!-- Header Title END -->

    <!-- Display Session Messages-->
    <?php echo showSessionAlert(); ?>

    <form class="form-group" name="formSearch" id="formSearch" action="" method="POST">
        <fieldset class="form-group">
            <legend class="control-label text-muted">Kërko:</legend>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group row">
                        <div class="col">
                            <label for="module" class="control-label">Module</label>
                            <input type="text" class="form-control" id="module" name="module" value="<?= $module ?? ""; ?>" placeholder="Module">
                            <span id="moduleErr" class="invalid-feedback"></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group row">
                        <div class="col">
                            <label for="dateCreated" class="control-label">Data</label>
                            <input type="date" class="form-control" id="dateCreated" name="dateCreated" value="<?= $dateCreated ?? ""; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Search Buttons -->
            <?php showSearchButtons('historia'); ?>
        </fieldset>
    </form>

    <hr>

    <div class="table-responsive mb-3">
        <table class="table table-striped table-sm table-hover text-center">
            <thead class="bg-dark text-light">
                <tr>
                    <th>Action</th>
                    <th>Moduli</th>
                    <th>Aksioni</th>
                    <th>Data/Ora</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $hid = $row['historiaID'];
                        $stid = $row['stafiID'];
                ?>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <!-- view -->
                                    <button type="button" class="btn btnHView" data-page="<?= APP_URL . '/index.php?iframe=true&page=historia_view&hid=' . $hid . '&stid=' . $stid ?>">
                                        <i class="far fa-list-alt fa-lg text-info"></i>
                                    </button>
                                    <!-- Delete -->
                                    <form class="frmDelete" action="" method="POST">
                                        <input type="hidden" name="historiaDelete" value="<?php echo $row['historiaID']; ?>">
                                        <button class="btn" type="submit"><i class="far fa-trash-alt fa-lg text-danger"></i></button>
                                    </form>
                                </div>
                            </td>
                            <td><?php echo $row['module']; ?></td>
                            <td><?php echo $row['action']; ?></td>
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
    // btnStView click
    document.querySelectorAll('.btnHView').forEach(function(el) {
        el.addEventListener('click', function(event) {
            const options = {
                iframeUrl: event.currentTarget.getAttribute('data-page'),
                headerText: 'Historia View',
                btnActionShow: false
            };
            // Show iframeModal without action button
            showIframeModal(options);
        });
    });

    // Delete form confirmation
    const frmDelete = document.querySelectorAll('.frmDelete');
    frmDelete.forEach(function(frm) {
        frm.addEventListener('submit', function(event) {
            // Option 1: Native javascript popup
            // if (confirm('Jeni të sigurt?')) {
            //     console.log("Form submited!");
            // } else {
            //     e.preventDefault();
            //     location.replace("<?php echo APP_URL . '/index.php?page=historia'; ?>");
            // }

            // Option 2: Custom Bootstrap Modal
            event.preventDefault();
            // Show confirmModal
            confirmModal(
                'Konfirmim...',
                '<h4>Jeni të sigurt?</h3>',
                function(response) {
                    if (response === 'po') {
                        console.log("po clicked");
                        frm.submit();
                    }
                }
            );
        });
    });
</script>