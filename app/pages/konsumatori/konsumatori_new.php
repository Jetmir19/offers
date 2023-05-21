<?php

// define variables and set to empty values
$k_emri = $k_mbiemri = $firma = $nr_amez = $tip_konsumator = $rruga = $fshati =  $komuna = $qyteti =  $shteti = $adresa_perkohshme = $mobil = $email = "";
$konsumator_codeErr = $k_emriErr = $firmaErr = $mbiemriErr = $nr_amez = $tip_konsumatorErr = $rrugaErr =  $fshatiErr = $qytetiErr = $shtetiErr = $adresa_perkohshmeErr = $mobilErr =  $emailErr = "";

// Unique code
$konsumator_code = date("His") . '' . rand(1, 9999);

// Save START
//------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['saveKonsumatori']))
//------------------------------------------------------------
{
    // Disable form resubmission on refresh
    disableFormResubmission();

    $validated = true;

    $stafiID = $_SESSION["stafiID"];
    $k_emri = isset($_POST['k_emri']) ? mysqli_real_escape_string($link, $_POST['k_emri']) : null;
    $k_mbiemri = isset($_POST['k_mbiemri']) ? mysqli_real_escape_string($link, $_POST['k_mbiemri']) : null;
    $firma = isset($_POST['firma']) ? mysqli_real_escape_string($link, $_POST['firma']) : null;
    $nr_amez = mysqli_real_escape_string($link, $_POST['nr_amez']);
    $tip_konsumator = $tip_konsumator ? mysqli_real_escape_string($link, $_POST['tip_konsumator']) : "";
    $rruga = mysqli_real_escape_string($link, $_POST['rruga']);
    $fshati = mysqli_real_escape_string($link, $_POST['fshati']);
    $komuna = mysqli_real_escape_string($link, $_POST['komuna']);
    $qyteti = mysqli_real_escape_string($link, $_POST['qyteti']);
    $shteti = mysqli_real_escape_string($link, $_POST['shteti']);
    $adresa_perkohshme = mysqli_real_escape_string($link, $_POST['adresa_perkohshme']);
    $mobil = mysqli_real_escape_string($link, $_POST['mobil']);
    $email = mysqli_real_escape_string($link, $_POST['email']);

    // Include Validation
    require_once PAGES_PATH . '/konsumatori/includes/konsumatori_validate.php';

    // Check for Numër amëz to avoid duplicate
    $sqlConsCheck = mysqli_query($link, "SELECT * FROM konsumatoret WHERE nr_amez='$nr_amez'");
    if (!$sqlConsCheck) {
        die('Error: ' . mysqli_error($link));
    }
    if (mysqli_num_rows($sqlConsCheck) > 0) {
        $validated = false;
        setSessionAlert('error', 'Ekziston konsumator me Numër amëz të njëjtë');
    }

    if ($validated === true) {
        // Attempt insert query execution
        $sql = "INSERT INTO konsumatoret (konsumator_code, stafiID, emri, mbiemri, firma, nr_amez, tip_konsumator, rruga, fshati, komuna, qyteti, shteti, adresa_perkohshme, mobil, email) VALUES ('{$konsumator_code}','{$stafiID}','{$k_emri}', '{$mbiemri}', '{$firma}', '{$nr_amez}', '{$tip_konsumator}', '{$rruga}', '{$fshati}', '{$komuna}', '{$qyteti}', '{$shteti}','{$adresa_perkohshme}', '{$mobil}', '{$email}')";

        if ($link->query($sql)) {
            // Save in Historia
            saveHistoria('create', 'konsumatori', 'Regjistruar me sukses.', 'success');
            // $_SESSION['success'] = "Regjistruar me sukses.";
            msgModal("success");

            // CLEAR FIELDS
            $konsumator_code = $k_emri = $k_mbiemri = $firma = $nr_amez = $tip_konsumator = $rruga = $fshati = $komuna = $qyteti = $shteti = $adresa_perkohshme = $mobil = $email = "";
        } else {
            msgModal("error", $link->error);
        }
    }
} // Save END
?>

<div class="container-fluid">

    <!-- Header Title START -->
    <div class="pt-3 pb-2 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <h2><i class="fas fa-users fa-fw"></i><?php echo $lang['Titulli_krijo_konsumator'] ?? "Krijo Konsumator: "; ?></h2>
    </div> <!-- Header Title END -->

    <!-- Display Session Messages-->
    <?php echo showSessionAlert(); ?>

    <section class="card my-3">
        <header class="card-header">
            <span class="error"><?php echo $lang['Fusha_te_detyrueshme'] ?? "* Fusha të detyrueshme"; ?></span>
        </header>
        <div class="card-body">

            <form id="klient-form" class="form-group" action="<?php echo APP_URL; ?>/index.php?page=konsumatori_new" method="POST">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="px-3 pt-3 pb-2 border border-<?php echo $tip_konsumatorErr ? 'danger' : ''; ?>">
                            <span class="mr-3"> <?php echo $lang['Tip_konsumatori'] ?? "Tip konsumatori: "; ?></span>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="Person fizik" id="Person_fizik" name="tip_konsumator" <?php echo $tip_konsumator == "Person fizik" ? " checked" : ""; ?>>
                                <?php echo $lang['Person_fizik'] ?? "Person fizik"; ?>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="Person juridik" id="Person_juridik" name="tip_konsumator" <?php echo $tip_konsumator == "Person juridik" ? "checked" : ""; ?>>
                                <?php echo $lang['Person_juridik'] ?? "Person juridik"; ?>
                            </div>
                            <div class="text-danger mt-2"><?php echo $tip_konsumatorErr; ?></div>
                        </div>
                    </div>
                    <div class="col-md-6" id="emri_div">
                        <div class="form-group row">
                            <div class="col">
                                <label for="emri" class="control-label"><?php echo $lang['k_Emri'] ?? "Emri *" ?></label>
                                <input type="text" class="form-control <?php echo $k_emriErr ? ' is-invalid' : ''; ?>" id="emri" name="emri" value="<?php echo $k_emri; ?>">
                                <span id="invalid-feedback" class="invalid-feedback"><?php echo $k_emriErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" id="mbiemri_div">
                        <div class="form-group row">
                            <div class="col">
                                <label for="mbiemri" class="control-label">Mbiemri *</label>
                                <input type="text" class="form-control <?php echo $mbiemriErr ? ' is-invalid' : ''; ?>" id="mbiemri" name="mbiemri" value="<?php echo $k_mbiemri; ?>">
                                <span class="invalid-feedback"><?php echo $mbiemriErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-none" id="firma_div">
                        <div class="form-group row">
                            <div class="col">
                                <label for="firma" class="control-label"><?php echo $lang['Firma'] ?? "Firma *"; ?></label>
                                <input type="text" class="form-control <?php echo $firmaErr ? ' is-invalid' : ''; ?>" id="firma" name="firma" value="<?php echo $firma; ?>">
                                <span class="invalid-feedback"><?php echo $firmaErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="nr_amez" class="control-label"><?php echo $lang['Nr_amez'] ?? "Numri Amëz *"; ?></label>
                                <input type="number" class="form-control <?php echo $nr_amezErr ? ' is-invalid' : ''; ?>" name="nr_amez" value="<?php echo $nr_amez; ?>">
                                <span class="invalid-feedback"><?php echo $nr_amezErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="rruga" class="control-label"><?php echo $lang['Rruga'] ?? "Rruga *"; ?></label>
                                <input type="text" class="form-control <?php echo $rrugaErr ? ' is-invalid' : ''; ?>" name="rruga" value="<?php echo $rruga; ?>">
                                <span class="invalid-feedback"><?php echo $rrugaErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col">
                                <label for="fshati" class="control-label"><?php echo $lang['Fshati'] ?? "Fshati *"; ?></label>
                                <input type="text" class="form-control <?php echo $fshatiErr ? ' is-invalid' : ''; ?>" name="fshati" value="<?php echo $fshati; ?>">
                                <span class="invalid-feedback"><?php echo $fshatiErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col">
                                <label for="komuna" class="control-label"><?php echo $lang['Komuna'] ?? "Komuna *"; ?></label>
                                <input type="text" class="form-control <?php echo $komunaErr ? ' is-invalid' : ''; ?>" name="komuna" value="<?php echo $komuna; ?>">
                                <span class="invalid-feedback"><?php echo $komunaErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col">
                                <label for="qyteti" class="control-label"><?php echo $lang['Qyteti'] ?? "Qyteti *"; ?></label>
                                <input type="text" class="form-control <?php echo $qytetiErr ? ' is-invalid' : ''; ?>" name="qyteti" value="<?php echo $qyteti; ?>">
                                <span class="invalid-feedback"><?php echo $qytetiErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col">
                                <label for="konsumator_code" class="control-label"><?php echo $lang['Kodi'] ?? "Kodi";  ?></label>
                                <input type="text" class="form-control <?php echo $konsumator_codeErr ? ' is-invalid' : ''; ?>" name="konsumator_code" value="<?php echo $konsumator_code; ?>" disabled>
                                <span class="invalid-feedback"><?php echo $konsumator_codeErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="shteti" class="control-label"><?php echo $lang['Shteti'] ?? "Shteti";  ?></label>
                                <input type="text" class="form-control <?php echo $shtetiErr ? ' is-invalid' : ''; ?>" name="shteti" value="<?php echo $shteti; ?>">
                                <span class="invalid-feedback"><?php echo $shtetiErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="adresa_perkohshme" class="control-label"><?php echo $lang['Adresa_perkohshme'] ?? "Adresa e perkohshme"; ?></label>
                                <input type="text" class="form-control <?php echo $adresa_perkohshmeErr ? ' is-invalid' : ''; ?>" name="adresa_perkohshme" value="<?php echo $adresa_perkohshme; ?>">
                                <span class="invalid-feedback"><?php echo $adresa_perkohshmeErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="mobil" class="control-label"><?php echo $lang['Mobil'] ?? "Mobil"; ?></label>
                                <input type="text" class="form-control <?php echo $mobilErr ? ' is-invalid' : ''; ?>" name="mobil" value="<?php echo $mobil; ?>">
                                <span class="invalid-feedback"><?php echo $mobilErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="email" class="control-label"><?php echo $lang['Email'] ?? "Email"; ?></label>
                                <input type="text" class="form-control <?php echo $emailErr ? ' is-invalid' : ''; ?>" name="email" value="<?php echo $email; ?>">
                                <span class="invalid-feedback"><?php echo $emailErr; ?></span>
                            </div>
                        </div>
                    </div>
                </div> <!-- row END -->

                <!-- Buttons START -->
                <div class="row mt-5">
                    <div class="col text-right">
                        <hr class="mb-2">
                        <button class="btn btn-success mr-1 px-4 mb-2" type="submit" name="saveKonsumatori">Ruaj</button>
                        <a href="<?= APP_URL . '/index.php?page=konsumatori'; ?>" class="btn btn-secondary mb-2">Anulo</a>
                    </div>
                </div> <!-- Buttons END -->
            </form>

        </div> <!-- card-body END -->
    </section> <!-- card END -->
</div> <!-- container END -->

<script>
    // Toggle Firma, Emri dhe mbiemri Inputs
    window.addEventListener("DOMContentLoaded", function(event) {
        const emri_div = document.getElementById('emri_div')
        const emri_input = document.getElementById('k_emri');
        const mbiemri_div = document.getElementById('mbiemri_div')
        const mbiemri_input = document.getElementById('k_mbiemri');
        const firma_div = document.getElementById('firma_div');
        const firma_input = document.getElementById('firma');

        firma_input.disabled = true;

        document.querySelector('#Person_fizik').onchange = function(e) {
            emri_div.style.display = 'block';
            emri_input.disabled = false;
            mbiemri_div.style.display = 'block';
            mbiemri_input.disabled = false;
            firma_div.classList.add('d-none');
            firma_input.value = "";
            firma_input.disabled = true;
        }
        document.querySelector('#Person_juridik').onchange = function(e) {
            emri_div.style.display = 'none';
            emri_input.value = "";
            emri_input.disabled = true;
            mbiemri_div.style.display = 'none';
            mbiemri_input.value = "";
            mbiemri_input.disabled = true;
            firma_div.classList.remove('d-none');
            firma_input.disabled = false;
        }

        if (document.querySelector('#Person_juridik').checked) {
            emri_div.style.display = 'none';
            emri_input.value = "";
            emri_input.disabled = true;
            mbiemri_div.style.display = 'none';
            mbiemri_input.value = "";
            mbiemri_input.disabled = true;
            firma_div.classList.remove('d-none');
            firma_input.disabled = false;
        }
    });
</script>