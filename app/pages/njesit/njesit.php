<?php
// Delete START 
if (isset($_POST['njesitDelete'])) {
    // Disable form resubmission on refresh
    disableFormResubmission();

    $njesiID = htmlspecialchars($_POST['njesitDelete']);

    // Soft delete njësia
    $sql = "UPDATE njesit SET isDeleted = '1' WHERE njesiID = '$njesiID'";
    if (mysqli_query($link, $sql)) {
        // Save in Historia
        saveHistoria('delete', 'njesit', 'U fshij me sukses.', 'success');
        // Success
        setSessionAlert('success', 'U fshij me sukses.');
    } else {
        // Delete Error
        msgModal("error", mysqli_error($link));
    }
} // Delete END

// Search START
$sql = "SELECT * FROM njesit WHERE isDeleted = 0";

if (isset($_POST['search'])) {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $emri_njesis = mysqli_real_escape_string($link, $_POST['emri_njesis']);
    $njesia = mysqli_real_escape_string($link, $_POST['njesia']);

    // Search by emri_njesis and njësia
    if ($emri_njesis != "" && $njesia != "") {
        $sql .= " AND emri_njesis = '$emri_njesis' AND njesia = '$njesia'";
    }
}

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
        <h2><i class="fa fa-user fa-fw"></i> Njesit</h2>
        <a href="<?php echo APP_URL; ?>/index.php?page=njesit_new" class="btn btn-success">
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
                            <label for="emri_njesis" class="control-label">Emri i Njësisë</label>
                            <input type="text" class="form-control" id="emri_njesis" name="emri_njesis" value="<?= $emri_njesis ?? ""; ?>" placeholder="emri_njesis">
                            <span id="emri_njesisErr" class="invalid-feedback">Emri njesi i detyrueshëm.</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group row">
                        <div class="col">
                            <label for="njesia" class="control-label">Njësia</label>
                            <input type="text" class="form-control" id="njesia" name="njesia" value="<?= $njesia ?? ""; ?>" placeholder="njesia">
                            <span id="njesiaErr" class="invalid-feedback">Njësia e detyrueshme.</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Search Buttons -->
            <?php showSearchButtons('njesit'); ?>
        </fieldset>
    </form>

    <hr>

    <div class="table-responsive">
        <table class="table table-striped table-sm table-hover text-center">
            <thead class="bg-dark text-light">
                <tr>
                    <th>Action</th>
                    <th>Emri i Njësisë</th>
                    <th>Njësia</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $njeID = $row['njesiID'];
                ?>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <!-- view -->
                                    <button type="button" class="btn btnStView" data-toggle="modal" data-target="#dataModal" data-btnView="<?= $njeID ?>" data-backdrop="static" data-keyboard="false">
                                        <i class="far fa-list-alt fa-lg text-info"></i>
                                    </button>
                                    <!-- edit -->
                                    <a class="btn" href='?page=njesit_edit&id=<?php echo $njeID; ?>'>
                                        <i class="far fa-edit fa-lg text-primary"></i>
                                    </a>
                                    <!-- Delete -->
                                    <form class="frmDelete" method="POST">
                                        <input type="hidden" name="njesitDelete" value="<?php echo $njeID; ?>">
                                        <button class="btn" type="submit"><i class="far fa-trash-alt fa-lg text-danger"></i></button>
                                    </form>
                                </div>
                            </td>
                            <td><?php echo $row['emri_njesis']; ?></td>
                            <td><?php echo $row['njesia']; ?></td>
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
    // Validation
    document.getElementById('formSearch').addEventListener('submit', (event) => {
        let inputEmriNjesis = document.getElementById('emri_njesis');
        let inputNjesia = document.getElementById('njesia');

        // Validate emri with mbiemri
        if (inputEmriNjesis.value !== "" && inputNjesia.value === "") {
            event.preventDefault();
            inputNjesia.classList.add('is-invalid');
        } else {
            inputNjesia.classList.remove('is-invalid');
        }
        if (inputNjesia.value !== "" && inputEmriNjesis.value === "") {
            event.preventDefault();
            inputEmriNjesis.classList.add('is-invalid');
        } else {
            inputEmriNjesis.classList.remove('is-invalid');
        }
    });

    // btnStView click
    document.querySelectorAll('.btnStView').forEach(function(el) {
        el.addEventListener('click', function(e) {
            const njeID = e.currentTarget.getAttribute('data-btnView');
            const iframePath = "<?php echo APP_URL . '/app/pages/njesit/modals/njesit_view.php' ?>";
            const options = {
                iframePath: `${iframePath}?njeID=${njeID}`,
                headerText: 'Njesi View',
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
                location.replace("<?php echo APP_URL . '/index.php?page=njesit'; ?>");
            }
        });
    });
</script>