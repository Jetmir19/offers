<?php

// define variables and set to empty values
$konsumatorID = $brendi = $serialnumer = $viti_prodhimit = $vlera_start = $vlera_prez = $vlera_max = $galon = $garancion = $data_montimit = $cmimi_blerjes = $cmimi_shites = "";
$konsumatorIDErr = $brendiErr = $serialnumerErr = $viti_prodhimitErr = $vlera_startErr = $vlera_prezErr = $vlera_maxErr = $galonErr = $garancionErr = $data_montimitErr = $cmimi_blerjesErr = $cmimi_shitesErr = "";

// Save START
//------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['savematesi']))
//------------------------------------------------------------
{
    // Disable form resubmission on refresh / disable navigating back
    disableFormResubmission();

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // die;

    $validated = true;

    $matesiID = mysqli_real_escape_string($link, $_POST['id']);
    $brendi = mysqli_real_escape_string($link, $_POST['brendi']);
    $serialnumer = mysqli_real_escape_string($link, $_POST['serialnumer']);
    $viti_prodhimit = mysqli_real_escape_string($link, $_POST['viti_prodhimit']);
    $vlera_start = mysqli_real_escape_string($link, $_POST['vlera_start']);
    $vlera_prez = mysqli_real_escape_string($link, $_POST['vlera_prez']);
    $vlera_max = mysqli_real_escape_string($link, $_POST['vlera_max']);
    $galon = mysqli_real_escape_string($link, $_POST['galon']);
    $garancion = mysqli_real_escape_string($link, $_POST['garancion']);
    $data_montimit = mysqli_real_escape_string($link, $_POST['data_montimit']);
    $cmimi_blerjes = mysqli_real_escape_string($link, $_POST['cmimi_blerjes']);
    $cmimi_shites = mysqli_real_escape_string($link, $_POST['cmimi_shites']);
    $konsumatorID = mysqli_real_escape_string($link, $_POST['inputKonsumatori']);
    $stafiID = $_SESSION["stafiID"];

    // Include Validation
    require_once PAGES_PATH . '/matesi/includes/matesi_validate.php';

    // Check for serialnumer to avoid duplicate
    $sqlMatesi = "SELECT serialnumer FROM matesi WHERE matesiID != '" . $matesiID . "'";
    if ($result = mysqli_query($link, $sqlMatesi)) {
        while ($foundMatesi = mysqli_fetch_assoc($result)) {
            foreach ($foundMatesi as $regMates) {
                if ($serialnumer == $regMates) {
                    $validated = false;
                    $serialnumerErr = "Ekziston matës me serial numër të njejtë";
                    $_SESSION['error'] = "Ekziston matës me serial numër të njejtë<br>";
                }
            }
        }
    } else {
        die("Diçka shkoi keq in query $sql and the error is:" . mysqli_error($link));
    }

    if ($validated === true) {
        /**
         * TODO: statusi i matesit
         */

        // Attempt insert query execution
        $sql = "UPDATE produktet SET stafiID='$stafiID', brendi='$brendi', serialnumer='$serialnumer', viti_prodhimit='$viti_prodhimit', vlera_start='$vlera_start', vlera_prez='$vlera_prez', vlera_max='$vlera_max', galon='$galon', garancion='$garancion', data_montimit='$data_montimit', cmimi_blerjes='$cmimi_blerjes', cmimi_shites='$cmimi_shites' WHERE matesiID = '$matesiID'";

        if ($link->query($sql)) {
            // Save in Historia
            saveHistoria('edit', 'matësi', 'Regjistruar me sukses.', 'success');
            // $_SESSION['success']= "Regjistruar me sukses.";
            msgModal("success");
        } else {
            msgModal("error", $link->error);
        }
    }
}

// GET Request START
//------------------------------------------------------------
if (isset($_GET['id']))
//------------------------------------------------------------
{
    $matesiID = filter_input(INPUT_GET, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $row = getMatesiById($matesiID);

    if ($row) {
        // check for redirect
        if ($matesiID !== $row['matesiID']) {
            forceRedirect(APP_URL . "/index.php?page=matesi_edit&id=" . $row['matesiID']);
        }

        // emri dhe mbiemri or firma
        $konsumatorEmri = $row['emri'] . ' ' . $row['mbiemri'];
        $konsumatori =  $row['emri'] !== "" && $row['mbiemri'] !== "" ? $konsumatorEmri : $row['firma'];
?>
        <div class="container-fluid">

            <!-- Header Title START -->
            <div class="pt-3 pb-2 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
                <h2><i class="fas fa-faucet fa-fw"></i> Ndrysho Matësin</h2>
            </div>
            <!-- Header Title END -->

            <!-- Display Session Messages-->
            <?php echo session_message(); ?>

            <section class="card my-3">
                <header class="card-header">
                    <span class="error">* Fusha të detyrueshme</span>
                </header>
                <div class="card-body">

                    <form id="form" class="form-group" action="" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="brendi" class="control-label">Brendi *</label>
                                        <input type="text" class="form-control <?php echo $brendiErr ? ' is-invalid' : ''; ?>" id="brendi" name="brendi" value="<?php echo $row['brendi']; ?>">
                                        <span id="invalid-feedback" class="invalid-feedback"><?php echo $brendiErr; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="serialnumer" class="control-label">Serial numër *</label>
                                        <input type="text" class="form-control <?php echo $serialnumerErr ? ' is-invalid' : ''; ?>" id="serialnumer" name="serialnumer" value="<?php echo $row['serialnumer']; ?>">
                                        <span id="invalid-feedback" class="invalid-feedback"><?php echo $serialnumerErr; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="viti_prodhimit" class="control-label">Viti i prodhimit *</label>
                                        <input type="date" class="form-control <?php echo $viti_prodhimitErr ? ' is-invalid' : ''; ?>" id="viti_prodhimit" name="viti_prodhimit" value="<?php echo $row['viti_prodhimit']; ?>">
                                        <span id="invalid-feedback" class="invalid-feedback"><?php echo $viti_prodhimitErr; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="vlera_start" class="control-label">Vlera fillestare *</label>
                                        <input type="number" class="form-control <?php echo $vlera_startErr ? ' is-invalid' : ''; ?>" id="vlera_start" name="vlera_start" value="<?php echo $row['vlera_start']; ?>">
                                        <span class="invalid-feedback"><?php echo $vlera_startErr; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="vlera_max" class="control-label">Vlera maksimale *</label>
                                        <input type="number" class="form-control <?php echo $vlera_maxErr ? ' is-invalid' : ''; ?>" id="vlera_max" name="vlera_max" value="<?php echo $row['vlera_max']; ?>">
                                        <span class="invalid-feedback"><?php echo $vlera_maxErr; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="galon" class="control-label">Nr. i bllombës </label>
                                        <input type="number" class="form-control <?php echo $galonErr ? ' is-invalid' : ''; ?>" id="galon" name="galon" value="<?php echo $row['galon']; ?>">
                                        <span class="invalid-feedback"><?php echo $galonErr; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="garancion" class="control-label">Granacion deri *</label>
                                        <input type="date" class="form-control <?php echo $garancionErr ? ' is-invalid' : ''; ?>" id="garancion" name="garancion" value="<?php echo $row['garancion']; ?>">
                                        <span class="invalid-feedback"><?php echo $garancionErr; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="data_montimit" class="control-label">Data e montimit *</label>
                                        <input type="date" class="form-control <?php echo $data_montimitErr ? ' is-invalid' : ''; ?>" id="data_montimit" name="data_montimit" value="<?php echo $row['data_montimit']; ?>">
                                        <span class="invalid-feedback"><?php echo $data_montimitErr; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="cmimi_blerjes" class="control-label">Çmimi fillestar *</label>
                                        <input type="number" class="form-control <?php echo $cmimi_blerjesErr ? ' is-invalid' : ''; ?>" id="cmimi_blerjes" name="cmimi_blerjes" value="<?php echo $row['cmimi_blerjes']; ?>">
                                        <span class="invalid-feedback"><?php echo $cmimi_blerjesErr; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="cmimi_shites" class="control-label">Çmimi shitjes *</label>
                                        <input type="number" class="form-control <?php echo $cmimi_shitesErr ? ' is-invalid' : ''; ?>" id="cmimi_shites" name="cmimi_shites" value="<?php echo $row['cmimi_shites']; ?>">
                                        <span class="invalid-feedback"><?php echo $cmimi_shitesErr; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="vlera_prez" class="control-label">Vlera prezente *</label>
                                        <input type="number" class="form-control <?php echo $vlera_prezErr ? ' is-invalid' : ''; ?>" id="vlera_prez" name="vlera_prez" value="<?php echo $row['vlera_prez']; ?>">
                                        <span class="invalid-feedback"><?php echo $vlera_prezErr; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="konsumatorID" class="control-label">Konsumatori *</label>
                                        <input type="text" class="form-control <?php echo $konsumatorIDErr ? ' is-invalid' : ''; ?>" id="konsumatorID" name="" value="<?php echo $konsumatori; ?>" disabled>
                                        <span class="invalid-feedback"><?php echo $konsumatorIDErr; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- row END -->

                        <input type="hidden" name="id" value="<?php echo $row['matesiID']; ?>">
                        <input type="hidden" id="inputKonsumatori" name="inputKonsumatori" value="<?php echo $row['konsumatorID']; ?>">

                        <!-- Buttons START -->
                        <div class="row mt-5">
                            <div class="col text-right">
                                <hr class="mb-2">
                                <button class="btn btn-success mr-1 px-4" type="submit" name="savematesi">Ruaj</button>
                                <a href="<?= APP_URL . '/index.php?page=matesi'; ?>" class="btn btn-secondary">Anulo</a>
                            </div>
                        </div> <!-- Buttons END -->
                    </form>

                </div> <!-- card-body END -->
            </section> <!-- card END -->

        </div> <!-- container END -->

<?php
    } else {
        msgBox('Matësi nuk ekziston.', '/index.php?page=matesi', 'error');
    }
} // if GET Request END
else {
    msgBox('Faqja nuk mund të hapet direkt!', '/index.php?page=matesi');
}
?>