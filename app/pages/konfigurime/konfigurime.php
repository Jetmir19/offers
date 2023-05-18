<?php
// define variables and set to empty values
$fshati = $komuna = $qyteti = $shteti = $kontakt_person = $mobil = $email = $web  = $njesia = $valuta = $tvsh = $tvsh2 = $banka = $xhirollogaria = $tekst = $tekst2 = $logo1 = $logo2 = "";

$fshatiErr = $komunaErr = $qytetiErr = $shtetiErr = $kontakt_personErr = $mobilErr = $emailErr = $webErr  =  $njesiaErr = $valutaErr = $tvshErr = $tvsh2Err = $bankaErr = $xhirollogariaErr = $tekstErr = $tekst2Err = $logo1Err = $logo2Err = "";

// Save START
//------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['saveKonfigurime']))
//------------------------------------------------------------
{
    // Disable form resubmission on refresh / disable navigating back
    disableFormResubmission();

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // die;

    $validated = true;

    // Include Validation
    require_once PAGES_PATH . '/konfigurime/includes/konfigurime_validate.php';

    if ($validated === true) {
        // Upload Logo 1
        [$output1, $filename1] = uploadKonfigurimeLogo($_FILES, "logo1", "konfigurime");
        // Upload Logo 2
        [$output2, $filename2] = uploadKonfigurimeLogo($_FILES, "logo2", "konfigurime");

        if ($output1 == "success" || $output1 == null && $output2 == "success" || $output2 == null) {
            // Get konfigurime by ID
            $row = getKonfigurime(1);

            // If - user does not upload logo1 get the existing one
            if ($output1 == null) {
                $logo1 = $row['logo1'];
            } else {
                // Else - upload the new image
                $logo1 = $filename1;
            }

            // If - user does not upload logo2 get the existing one
            if ($output2 == null) {
                $logo2 = $row['logo2'];
            } else {
                // Else - upload the new image
                $logo2 = $filename2;
            }

            // Attempt Update query
            $sql = "UPDATE konfigurime SET fshati='$fshati', komuna='$komuna', qyteti='$qyteti', shteti='$shteti', kontakt_person='$kontakt_person', mobil='$mobil', email='$email', web='$web',    njesia='$njesia', valuta='$valuta', tvsh='$tvsh', tvsh2='$tvsh2', banka='$banka', xhirollogaria='$xhirollogaria', tekst='$tekst', tekst2='$tekst2', logo1='$logo1', logo2='$logo2' WHERE konfigurimeID=1";

            if ($link->query($sql)) {
                // Save in Historia
                saveHistoria('edit', 'konfigurime', 'Regjistruar me sukses.', 'success');
                // $_SESSION['success']= "Regjistruar me sukses.";
                msgModal("success");
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

// Get konfigurime by ID
$row = getKonfigurime(1);
if ($row) {
?>
    <div class="container-fluid">

        <!-- Header Title START -->
        <div class="pt-3 pb-2 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <h2><i class="fas fa-cog fa-fw"></i> Konfigurimi i Sistemit</h2>
        </div>
        <!-- Header Title END -->

        <!-- Display Session Messages-->
        <?php echo session_message(); ?>

        <section class="card bg-light my-3">
            <header class="card-header">
                <span class="error">* Fusha të detyrueshme</span>
            </header>
            <div class="card-body">

                <form id="konfigurimeForm" action="<?php echo APP_URL; ?>/index.php?page=konfigurime" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="fshati" class="control-label">Fshati</label>
                                    <input class="form-control error <?php echo $fshatiErr ? 'is-invalid' : ''; ?>" id="fshati" name="fshati" type="text" value="<?php echo $row['fshati'] ?>">
                                    <span id="invalid-feedback" class="invalid-feedback"><?php echo $fshatiErr; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="komuna" class="control-label">Komuna</label>
                                    <input class="form-control error <?php echo $komunaErr ? 'is-invalid' : ''; ?>" id="komuna" name="komuna" type="text" value="<?php echo $row['komuna'] ?>">
                                    <span id="invalid-feedback" class="invalid-feedback"><?php echo $komunaErr; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="qyteti" class="control-label">Qyteti</label>
                                    <input class="form-control error <?php echo $qytetiErr ? 'is-invalid' : ''; ?>" id="qyteti" type="text" name="qyteti" value="<?php echo $row['qyteti'] ?>">
                                    <span id="invalid-feedback" class="invalid-feedback"><?php echo $qytetiErr; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="shteti" class="control-label">Shteti</label>
                                    <input class="form-control error <?php echo $shtetiErr ? 'is-invalid' : ''; ?>" id="shteti" type="text" name="shteti" value="<?php echo $row['shteti'] ?>">
                                    <span id="invalid-feedback" class="invalid-feedback"><?php echo $shtetiErr; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="kontakt_person" class="control-label">Kontakt person</label>
                                    <input class="form-control error  <?php echo $kontakt_personErr ? 'is-invalid' : ''; ?>" id="kontakt_person" name="kontakt_person" value="<?php echo $row['kontakt_person'] ?>">
                                    <span class="invalid-feedback" id="invalid-feedback"><?php echo $kontakt_personErr; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="mobil" class="control-label">Mobil</label>
                                    <input class="form-control error <?php echo $mobilErr ? 'is-invalid' : ''; ?>" id="mobil" name="mobil" value="<?php echo $row['mobil'] ?>">
                                    <span class="invalid-feedback" id="invalid-feedback"><?php echo $mobilErr; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="email" class="control-label">Email</label>
                                    <input class="form-control error <?php echo $emailErr ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo $row['email'] ?>">
                                    <span class="invalid-feedback" id="invalid-feedback"><?php echo $emailErr; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="web" class="control-label">Web</label>
                                    <input class="form-control error <?php echo $webErr ? 'is-invalid' : ''; ?>" id="web" name="web" id="web" name="web" value="<?php echo $row['web'] ?>">
                                    <span class="invalid-feedback" id="invalid-feedback"><?php echo $webErr; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="njesia" class="control-label">Njësia</label>
                                    <input class="form-control error <?php echo $njesiaErr ? 'is-invalid' : ''; ?>" id="njesia" name="njesia" value="<?php echo $row['njesia'] ?>">
                                    <span class="invalid-feedback" id="invalid-feedback"><?php echo $njesiaErr; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="valuta" class="control-label">Valuta</label>
                                    <input class="form-control error <?php echo $valutaErr ? 'is-invalid' : ''; ?>" id="valuta" name="valuta" value="<?php echo $row['valuta'] ?>">
                                    <span class="invalid-feedback" id="invalid-feedback"><?php echo $valutaErr; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="tvsh" class="control-label">tvsh</label>
                                    <input class="form-control error <?php echo $tvshErr ? 'is-invalid' : ''; ?>" id="tvsh" name="tvsh" value="<?php echo $row['tvsh'] ?>">
                                    <span class="invalid-feedback" id="invalid-feedback"><?php echo $tvshErr; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="tvsh2" class="control-label">tvsh2</label>
                                    <input class="form-control error <?php echo $tvsh2Err ? 'is-invalid' : ''; ?>" id="tvsh2" name="tvsh2" value="<?php echo $row['tvsh2'] ?>">
                                    <span class="invalid-feedback" id="invalid-feedback"><?php echo $tvsh2Err; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="banka" class="control-label">Emri i Bankës</label>
                                    <input class="form-control error <?php echo $bankaErr ? 'is-invalid' : ''; ?>" id="banka" name="banka" value="<?php echo $row['banka'] ?>">
                                    <span class="invalid-feedback" id="invalid-feedback"><?php echo $bankaErr; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="xhirollogaria" class="control-label">Zhirollogaria</label>
                                    <input class="form-control error <?php echo $xhirollogariaErr ? 'is-invalid' : ''; ?>" id="xhirollogaria" name="xhirollogaria" value="<?php echo $row['xhirollogaria'] ?>">
                                    <span class="invalid-feedback" id="invalid-feedback"><?php echo $xhirollogariaErr; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="tekst" class="control-label">Tekst</label>
                                    <textarea style="text-align-last: left;" class="form-control <?php echo $tekstErr ? 'is-invalid' : ''; ?>" name="tekst" id="tekst" rows="8"><?php echo $row['tekst']; ?></textarea>
                                    <span class="invalid-feedback" id="invalid-feedback"><?php echo $tekstErr; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="tekst2" class="control-label">Tekst 2</label>
                                    <textarea style="text-align-last: left;" class="form-control <?php echo $tekst2Err ? 'is-invalid' : ''; ?>" name="tekst2" id="tekst2" rows="2"><?php echo $row['tekst2']; ?></textarea>
                                    <span class="invalid-feedback" id="invalid-feedback"><?php echo $tekst2Err; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="logo1" class="control-label">Logo1</label>
                                    <input type="file" class="form-control error" id="logo1" name="logo1" style="padding-bottom: 35px;">
                                    <span class="help-block text-danger"><?php echo $logo1Err; ?></span>
                                    <div id="preview_logo1">
                                        <img class="mt-2" src="<?php echo APP_URL . "/public/uploads/konfigurime/" . $row['logo1']; ?>" alt="logo1" width="120px" height="80px">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="logo2" class="control-label">Logo2</label>
                                    <input type="file" class="form-control error" id="logo2" name="logo2" style="padding-bottom: 35px;">
                                    <span class="help-block text-danger"><?php echo $logo2Err; ?></span>
                                    <div id="preview_logo2">
                                        <img class="mt-2" src="<?php echo APP_URL . "/public/uploads/konfigurime/" . $row['logo2']; ?>" alt="logo2" width="120px" height="80px">
                                    </div>
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

<?php
} else {
    msgBox(
        '<h5>Konfigurimi i sistemit është i domosdoshëm!</h5>',
        '/index.php?page=konfigurime_new',
        'Krijo Konfigurim'
    );
}
?>

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