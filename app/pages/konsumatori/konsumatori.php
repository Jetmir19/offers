<?php
// Delete START 
if (isset($_POST['konsumatorDelete'])) {
    // Disable form resubmission on refresh
    disableFormResubmission();

    $id = htmlspecialchars($_POST['konsumatorDelete']);
    // Soft delete klient
    $sql = "UPDATE konsumatoret SET isDeleted = '1' WHERE konsumatorID = '$id'";
    if (mysqli_query($link, $sql)) {

        if (mysqli_query($link, $sql)) {
            // Save in Historia
            saveHistoria('delete', 'konsumatori', 'U fshij me sukses.', 'success');
            // Success
            $_SESSION['success'] = "U fshij me sukses.";
        }
    } else {
        // Update Error
        $_SESSION['error'] = $link->error;
        die("Dicka shkoi keq in query $sql and the error is:" . mysqli_error($link));
    }
} // Delete END 

// Search START
$sql = "SELECT * FROM konsumatoret WHERE isDeleted = 0";

if (isset($_POST['search'])) {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $k_emri = mysqli_real_escape_string($link, $_POST['k_emri']);
    $k_mbiemri = mysqli_real_escape_string($link, $_POST['k_mbiemri']);
    $firma = mysqli_real_escape_string($link, $_POST['firma']);

    // Search by emri and mbiemri
    if ($k_emri != "" && $k_mbiemri != "") {
        $sql .= " AND k_emri = '$k_emri' AND k_mbiemri = '$k_mbiemri'";
    }
    // Search by firma
    if ($firma != "") {
        $sql .= " AND firma = '$firma'";
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
        <h2><i class="fas fa-users"></i>Titulli-Konsumatoret</h2>
        <a href="<?php echo APP_URL; ?>/index.php?page=konsumatori_new" class="btn btn-success">
            <i class="fas fa-plus"></i> Krijo
        </a>
    </div> <!-- Header Title END -->

    <!-- Display Session Messages-->
    <?php echo session_message(); ?>

    <form class="form-group" name="formSearch" id="formSearch" method="POST" action="">
        <fieldset class="form-group">
            <legend class="control-label text-muted">Kerko</legend>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group row">
                        <div class="col">
                            <label for="emri" class="control-label"></label>
                            <input type="text" class="form-control" id="emri" name="k_emri" value="<?= $k_emri ?? ""; ?>" placeholder="Emri">
                            <span id="k_emriErr" class="invalid-feedback">Emri i detyrueshëm.</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group row">
                        <div class="col">
                            <label for="mbiemri" class="control-label"></label>
                            <input type="text" class="form-control" id="k_mbiemri" name="k_mbiemri" value="<?= $k_mbiemri ?? ""; ?>" placeholder="Mbiemri">
                            <span id="mbiemriErr" class="invalid-feedback">Mbiemri i detyrueshëm.</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group row">
                        <div class="col">
                            <label for="firma" class="control-label">Firma</label>
                            <input type="text" class="form-control" id="firma" name="firma" value="<?= $firma ?? ""; ?>" placeholder="Firma">
                            <span id="firmaErr" class="invalid-feedback">Firma i detyrueshëm.</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Search Buttons -->
            <?php showSearchButtons('konsumatori'); ?>
        </fieldset>
    </form>

    <hr>

    <div class="table-responsive mb-3">
        <table class="table table-striped table-sm table-hover">
            <thead class="bg-dark text-light">
                <tr>
                    <th class="text-center">Action</th>
                    <th>Emri dhe Mbiemri</th>
                    <th>Firma</th>
                    <th>Nr. amez</th>
                    <th>Tip. Konsum.</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // emri dhe mbiemri or firma
                        $konsumatorEmri = $row['k_emri'] . ' ' . $row['k_mbiemri'];
                        $konsumatori =  $row['k_emri'] !== "" && $row['k_mbiemri'] !== "" ? $konsumatorEmri : $row['firma'];
                ?>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <!-- view -->
                                    <a class="btn" href='?page=konsumatori_view&id=<?php echo $row['konsumatorID']; ?>'>
                                        <i class="far fa-list-alt fa-lg text-info"></i>
                                    </a>
                                    <!-- edit -->
                                    <a class="btn" href='?page=konsumatori_edit&id=<?php echo $row['konsumatorID']; ?>'>
                                        <i class="far fa-edit fa-lg text-primary"></i>
                                    </a>
                                    <!-- Delete -->
                                    <form class="frmDelete" action="?page=konsumatori&id=<?php echo $row['konsumatorID']; ?>" method="POST">
                                        <input type="hidden" name="konsumatorDelete" value="<?php echo $row['konsumatorID']; ?>">
                                        <button class="btn" type="submit"><i class="far fa-trash-alt fa-lg text-danger"></i></button>
                                    </form>
                                </div>
                            </td>
                            <td><?php echo $row['k_emri'] !== "" && $row['k_mbiemri'] !== "" ?  $row['k_emri'] . " " . $row['k_mbiemri']  : "/"; ?> </td>
                            <td><?php echo $row['firma'] !== "" ? $row['firma'] : "/"; ?></td>
                            <td><?php echo $row['nr_amez']; ?></td>
                            <td><?php echo $row['tip_konsumator']; ?></td>
                        </tr>
                <?php
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
        let inputEmri = document.getElementById('k_emri');
        let inputMbiemri = document.getElementById('k_mbiemri');

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


    // Delete form confirmation
    const frmDelete = document.querySelectorAll('.frmDelete');
    frmDelete.forEach(function(frm) {
        frm.addEventListener('submit', function(e) {
            if (confirm('Jeni të sigurt?')) {
                console.log("Form submited!");
            } else {
                e.preventDefault();
                location.replace("<?php echo APP_URL . '/index.php?page=konsumatori'; ?>");
            }
        });
    });
</script>