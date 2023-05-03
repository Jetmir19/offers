<?php
// Redirect if konfigurime exists
if (getKonfigurime(1) !== null) {
    forceRedirect(APP_URL . '/index.php?page=konfigurime');
    exit;
}

// define variables and set to empty values
$fshati = $komuna = $qyteti = $shteti = $kontakt_person = $mobil = $email = $web = $cmimi_kubik = $cmimi_kycjes = $njesia = $valuta = $tvsh = $tvsh2 = $banka = $xhirollogaria = $tekst = $tekst2 = $logo1 = $logo2 = "";

$fshatiErr = $komunaErr = $qytetiErr = $shtetiErr = $kontakt_personErr = $mobilErr = $emailErr = $webErr = $cmimi_kubikErr = $cmimi_kycjesErr = $njesiaErr = $valutaErr = $tvshErr = $tvsh2Err = $bankaErr = $xhirollogariaErr = $tekstErr = $tekst2Err = $logo1Err = $logo2Err = "";

// Save START
//------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['saveKonfigurime']))
//------------------------------------------------------------
{
    // Disable form resubmission on refresh
    disableFormResubmission();

    $validated = true;

    // Include Validation
    require_once PAGES_PATH . '/konfigurime/includes/konfigurime_validate.php';

    if ($validated === true) {
        // Upload Logo 1
        [$output1, $filename1] = uploadKonfigurimeLogo($_FILES, "logo1", "konfigurime");
        // Upload Logo 2
        [$output2, $filename2] = uploadKonfigurimeLogo($_FILES, "logo2", "konfigurime");

        if ($output1 == "success" || $output1 == null && $output2 == "success" || $output2 == null) {
            $logo1 = $filename1;
            $logo2 = $filename2;

            // Attempt Update query
            $sql = "INSERT INTO konfigurime (konfigurimeID, fshati, komuna, qyteti, shteti, kontakt_person, mobil, email, web, cmimi_kubik, cmimi_kycjes,  njesia, valuta, tvsh, tvsh2, banka, xhirollogaria, tekst, tekst2, logo1, logo2) VALUES (1, '{$fshati}', '{$komuna}', '{$qyteti}', '{$shteti}', '{$kontakt_person}', '{$mobil}', '{$email}', '{$web}', '{$cmimi_kubik}', '{$cmimi_kycjes}',  '{$njesia}', '{$valuta}', '{$tvsh}', '{$tvsh2}', '{$banka}', '{$xhirollogaria}', '{$tekst}', '{$tekst2}', '{$logo1}', '{$logo2}')";

            if ($link->query($sql)) {
                // Save in Historia
                saveHistoria('create', 'konfigurime', 'Regjistruar me sukses.', 'success');
                // $_SESSION['success']= "Regjistruar me sukses.";
                msgModal("success");
                // Enable left menu
                unset($_SESSION["require_konfigurime_style"]);
            } else {
                // Updated Error
                msgModal("error", $link->error);
            }
        } else {
            // Upload errors
            $logo1Err = $output1;
            $logo2Err = $output2;
            $_SESSION['error'] = $logo1Err;
            $_SESSION['error'] = $logo2Err;
        }
    }
} // Save END
?>

<div class="container-fluid">

    <!-- Header Title START -->
    <div class="pt-3 pb-2 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <h2><i class="fas fa-cog fa-fw"></i> Krijo Konfigurimin e Sistemit</h2>
    </div>
    <!-- Header Title END -->

    <!-- Display Session Messages-->
    <?php echo session_message(); ?>

    <section class="card bg-light my-3">
        <header class="card-header">
            <span class="error">* Fusha të detyrueshme</span>
        </header>
        <div class="card-body">

            <form id="konfigurimeNewForm" action="<?php echo APP_URL; ?>/index.php?page=konfigurime_new" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col">
                                <label for="fshati" class="control-label">Fshati</label>
                                <input class="form-control error <?php echo $fshatiErr ? 'is-invalid' : ''; ?>" id="fshati" name="fshati" type="text" value="<?php echo $fshati; ?>">
                                <span id="invalid-feedback" class="invalid-feedback"><?php echo $fshatiErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col">
                                <label for="komuna" class="control-label">Komuna</label>
                                <input class="form-control error <?php echo $komunaErr ? 'is-invalid' : ''; ?>" id="komuna" name="komuna" type="text" value="<?php echo $komuna; ?>">
                                <span id="invalid-feedback" class="invalid-feedback"><?php echo $komunaErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col">
                                <label for="qyteti" class="control-label">Qyteti</label>
                                <input class="form-control error <?php echo $qytetiErr ? 'is-invalid' : ''; ?>" id="qyteti" type="text" name="qyteti" value="<?php echo $qyteti; ?>">
                                <span id="invalid-feedback" class="invalid-feedback"><?php echo $qytetiErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col">
                                <label for="shteti" class="control-label">Shteti</label>
                                <input class="form-control error <?php echo $shtetiErr ? 'is-invalid' : ''; ?>" id="shteti" type="text" name="shteti" value="<?php echo $shteti; ?>">
                                <span id="invalid-feedback" class="invalid-feedback"><?php echo $shtetiErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col">
                                <label for="kontakt_person" class="control-label">Kontakt person</label>
                                <input class="form-control error  <?php echo $kontakt_personErr ? 'is-invalid' : ''; ?>" id="kontakt_person" name="kontakt_person" value="<?php echo $kontakt_person; ?>">
                                <span class="invalid-feedback" id="invalid-feedback"><?php echo $kontakt_personErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col">
                                <label for="mobil" class="control-label">Mobil</label>
                                <input class="form-control error <?php echo $mobilErr ? 'is-invalid' : ''; ?>" id="mobil" name="mobil" value="<?php echo $mobil; ?>">
                                <span class="invalid-feedback" id="invalid-feedback"><?php echo $mobilErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col">
                                <label for="email" class="control-label">Email</label>
                                <input class="form-control error <?php echo $emailErr ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo $email; ?>">
                                <span class="invalid-feedback" id="invalid-feedback"><?php echo $emailErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col">
                                <label for="web" class="control-label">Web</label>
                                <input class="form-control error <?php echo $webErr ? 'is-invalid' : ''; ?>" id="web" name="web" id="web" name="web" value="<?php echo $web; ?>">
                                <span class="invalid-feedback" id="invalid-feedback"><?php echo $webErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col">
                                <label for="cmimi_kubik" class="control-label">Çmimi për kubik</label>
                                <input class="form-control error <?php echo $cmimi_kubikErr ? 'is-invalid' : ''; ?>" id="cmimi_kubik" name="cmimi_kubik" value="<?php echo $cmimi_kubik; ?>">
                                <span class="invalid-feedback" id="invalid-feedback"><?php echo $cmimi_kubikErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col">
                                <label for="cmimi_kycjes" class="control-label">Çmimi i Kyçjes</label>
                                <input class="form-control error <?php echo $cmimi_kycjesErr ? 'is-invalid' : ''; ?>" id="cmimi_kycjes" name="cmimi_kycjes" value="<?php echo $cmimi_kycjes; ?>">
                                <span class="invalid-feedback" id="invalid-feedback"><?php echo $cmimi_kycjesErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col">
                                <label for="njesia" class="control-label">Njësia</label>
                                <input class="form-control error <?php echo $njesiaErr ? 'is-invalid' : ''; ?>" id="njesia" name="njesia" value="<?php echo $njesia; ?>">
                                <span class="invalid-feedback" id="invalid-feedback"><?php echo $njesiaErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col">
                                <label for="valuta" class="control-label">Valuta</label>
                                <input class="form-control error <?php echo $valutaErr ? 'is-invalid' : ''; ?>" id="valuta" name="valuta" value="<?php echo $valuta; ?>">
                                <span class="invalid-feedback" id="invalid-feedback"><?php echo $valutaErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="tvsh" class="control-label">tvsh</label>
                                <input class="form-control error <?php echo $tvshErr ? 'is-invalid' : ''; ?>" id="tvsh" name="tvsh" value="<?php echo $tvsh; ?>">
                                <span class="invalid-feedback" id="invalid-feedback"><?php echo $tvshErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="tvsh2" class="control-label">tvsh2</label>
                                <input class="form-control error <?php echo $tvsh2Err ? 'is-invalid' : ''; ?>" id="tvsh2" name="tvsh2" value="<?php echo $tvsh2; ?>">
                                <span class="invalid-feedback" id="invalid-feedback"><?php echo $tvsh2Err; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="banka" class="control-label">Emri i Bankës</label>
                                <input class="form-control error <?php echo $bankaErr ? 'is-invalid' : ''; ?>" id="banka" name="banka" value="<?php echo $banka; ?>">
                                <span class="invalid-feedback" id="invalid-feedback"><?php echo $bankaErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="xhirollogaria" class="control-label">Zhirollogaria</label>
                                <input class="form-control error <?php echo $xhirollogariaErr ? 'is-invalid' : ''; ?>" id="xhirollogaria" name="xhirollogaria" value="<?php echo $xhirollogaria; ?>">
                                <span class="invalid-feedback" id="invalid-feedback"><?php echo $xhirollogariaErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col">
                                <label for="tekst" class="control-label">Tekst</label>
                                <textarea style="text-align-last: left;" class="form-control <?php echo $tekstErr ? 'is-invalid' : ''; ?>" name="tekst" id="tekst" rows="7"><?php echo $tekst; ?></textarea>
                                <span class="invalid-feedback" id="invalid-feedback"><?php echo $tekstErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col">
                                <label for="tekst2" class="control-label">Tekst 2</label>
                                <textarea style="text-align-last: left;" class="form-control <?php echo $tekst2Err ? 'is-invalid' : ''; ?>" name="tekst2" id="tekst2" rows="2"><?php echo $tekst2; ?></textarea>
                                <span class="invalid-feedback" id="invalid-feedback"><?php echo $tekst2Err; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="logo1" class="control-label">Logo1 e ujësjellesit</label>
                                <input type="file" class="form-control error" id="logo1" name="logo1" style="padding-bottom: 35px;">
                                <span class="help-block text-danger"><?php echo $logo1Err; ?></span>
                                <div id="preview_logo1"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="logo2" class="control-label">Logo2 e ujësjellesit</label>
                                <input type="file" class="form-control error" id="logo2" name="logo2" style="padding-bottom: 35px;">
                                <span class="help-block text-danger"><?php echo $logo2Err; ?></span>
                                <div id="preview_logo2"></div>
                            </div>
                        </div>
                    </div>
                </div> <!-- row END -->

                <!-- Buttons START -->
                <div class="row mt-5">
                    <div class="col text-right">
                        <hr class="mb-2">
                        <button class=" btn btn-success mr-1 px-4" type="submit" name="saveKonfigurime" value="submit">Ruaj</button>
                        <a href="<?= APP_URL . '/'; ?>" class="btn btn-secondary">Anulo</a>
                    </div>
                </div> <!-- Buttons END -->
            </form>

        </div> <!-- card-body END -->
    </section> <!-- card END -->

</div> <!-- container END -->

<script>
    // Preview Images before Upload START
    document.querySelector('#logo1').addEventListener("change", function() {
        var preview1 = document.querySelector('#preview_logo1');
        if (this.files) {
            preview1.innerHTML = "";
            Array.prototype.forEach.call(this.files, function(file) {
                readAndPreviewImage(file, preview1);
            });
        }
    });
    document.querySelector('#logo2').addEventListener("change", function(e) {
        var preview2 = document.querySelector('#preview_logo2');
        if (this.files) {
            preview2.innerHTML = "";
            Array.from(this.files).forEach(file => {
                readAndPreviewImage(file, preview2);
            })
        }
    });
    // Preview Images before Upload END
</script>