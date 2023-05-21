<?php

// define variables and set to empty values
$emri = $mbiemri = $titulli = $emriperdorues = $fjalekalimi = $email = $data_punesimit = $image = $isAdmin = $komment = "";
$emri_err = $mbiemri_err = $titulli_err = $emriperdorues_err = $fjalekalimi_err = $email_err = $data_punesimit_err = $image_err = $isAdmin_err = $komment_err = $ststatusi_err = "";

$confirm_fjalekalimi = "";
$confirm_fjalekalimi_err = "";

// Save START
//------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['savestafi']))
//------------------------------------------------------------
{
    // Disable form resubmission on refresh
    disableFormResubmission();

    $validated = true;

    $emri = mysqli_real_escape_string($link, $_POST["emri"]);
    $mbiemri = mysqli_real_escape_string($link, $_POST["mbiemri"]);
    $titulli = mysqli_real_escape_string($link, $_POST["titulli"]);
    $emriperdorues = mysqli_real_escape_string($link, $_POST["emriperdorues"]);
    $fjalekalimi = mysqli_real_escape_string($link, $_POST["fjalekalimi"]);
    $confirm_fjalekalimi = mysqli_real_escape_string($link, $_POST["confirm_fjalekalimi"]);
    $data_punesimit = mysqli_real_escape_string($link, $_POST["data_punesimit"]);
    // checkbox isAdmin
    $isAdmin = isset($_POST['isAdmin']) ? 1 : 0;

    // Include Validation
    require_once PAGES_PATH . '/stafi/includes/stafi_validate.php';

    // Check input errors before inserting in database
    if ($validated === true) {
        // *** Upload Image function ***
        [$output, $filename] = uploadStafiImage($_FILES, "stafi");

        if ($output == "success" || $output == null) {
            $image = $filename;

            try {
                $sql = "INSERT INTO stafi (emri, mbiemri, titulli, emriperdorues, fjalekalimi, email, data_punesimit, image, isAdmin, komment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                if ($stmt = mysqli_prepare($link, $sql)) {
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "ssssssssss", $emri, $mbiemri, $titulli, $emriperdorues, $fjalekalimi, $email, $data_punesimit, $image, $isAdmin, $komment);

                    // Creates a fjalekalimi hash
                    $fjalekalimi = password_hash($fjalekalimi, PASSWORD_DEFAULT);

                    // Attempt to execute the prepared statement
                    mysqli_stmt_execute($stmt);

                    // Save in Historia
                    saveHistoria('create', 'stafi', 'Regjistruar me sukses.', 'success');

                    // $_SESSION['success']= "Regjistruar me sukses.";
                    msgModal("success");

                    // Close statement
                    mysqli_stmt_close($stmt);
                }
            } catch (Exception $e) {
                // Insert Error
                msgModal("error", $e->getMessage());
            }
        } else {
            $image_err = $output;
            setSessionAlert('error', $image_err);
        }
    }
} // Save END
?>

<div class="container-fluid">

    <!-- Header Title START -->
    <div class="pt-3 pb-2 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <h2><i class="fa fa-user fa-fw"></i> Krijo Staf</h2>
    </div> <!-- Header Title END -->

    <!-- Display Session Messages-->
    <?php echo showSessionAlert(); ?>

    <section class="card bg-light my-3">
        <header class="card-header">
            <span class="error">* Fusha të detyrueshme</span>
        </header>
        <div class="card-body">

            <form class="form-group" action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="emri" class="control-label">Emri *</label>
                                <input type="text" class="form-control <?php echo $emri_err ? ' is-invalid' : ''; ?>" id="emri" name="emri" value="<?php echo $emri; ?>">
                                <span id="invalid-feedback" class="invalid-feedback"><?php echo $emri_err; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="mbiemri" class="control-label">Mbiemri *</label>
                                <input type="text" class="form-control <?php echo $mbiemri_err ? ' is-invalid' : ''; ?>" id="mbiemri" name="mbiemri" value="<?php echo $mbiemri; ?>">
                                <span id="invalid-feedback" class="invalid-feedback"><?php echo $mbiemri_err; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="titulli" class="control-label">Titulli *</label>
                                <input type="text" class="form-control <?php echo $titulli_err ? ' is-invalid' : ''; ?>" id="titulli" name="titulli" value="<?php echo $titulli; ?>">
                                <span id="invalid-feedback" class="invalid-feedback"><?php echo $titulli_err; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="emriperdorues" class="control-label">Emri përdorues *</label>
                                <input type="text" class="form-control <?php echo $emriperdorues_err ? ' is-invalid' : ''; ?>" id="emriperdorues" name="emriperdorues" value="<?php echo $emriperdorues; ?>">
                                <span id="invalid-feedback" class="invalid-feedback"><?php echo $emriperdorues_err; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="fjalekalimi" class="control-label">Fjalëkalimi *</label>
                                <input type="text" class="form-control <?php echo $fjalekalimi_err ? ' is-invalid' : ''; ?>" id="fjalekalimi" name="fjalekalimi" value="">
                                <span id="invalid-feedback" class="invalid-feedback"><?php echo $fjalekalimi_err; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="confirm_fjalekalimi" class="control-label">Konfirmo fjalëkalimin *</label>
                                <input type="text" class="form-control <?php echo $confirm_fjalekalimi_err ? ' is-invalid' : ''; ?>" id="confirm_fjalekalimi" name="confirm_fjalekalimi" value="<?php echo $confirm_fjalekalimi; ?>">
                                <span id="invalid-feedback" class="invalid-feedback"><?php echo $confirm_fjalekalimi_err; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="data_punesimit" class="control-label">Data e punësimit *</label>
                                <input type="date" class="form-control <?php echo $data_punesimit_err ? ' is-invalid' : ''; ?>" id="data_punesimit" name="data_punesimit" value="<?php echo $data_punesimit; ?>">
                                <span id="invalid-feedback" class="invalid-feedback"><?php echo $data_punesimit_err; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="image" class="control-label">Foto e profilit</label>
                                <input type="file" class="form-control error" id="image" name="image" style="padding-bottom: 35px;">
                                <span id="invalid-feedback" class="invalid-feedback"><?php echo $image_err; ?></span>
                                <div id="preview_image" class="mt-2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr class="mt-0">
                        <div class="form-group row">
                            <div class="mx-auto px-3">
                                <input type="checkbox" class="xl-chbox" id="isAdmin" name="isAdmin" <?php echo $isAdmin ? "checked" : "" ?>>
                                <label for="isAdmin" class="control-label h5">Admin?</label>
                            </div>
                        </div>
                    </div>
                </div> <!-- row END -->

                <!-- Buttons START -->
                <div class="row mt-5">
                    <div class="col text-right">
                        <hr class="mb-2">
                        <button class="btn btn-success mr-1 px-4" type="submit" name="savestafi">Ruaj</button>
                        <a href="<?= APP_URL . '/index.php?page=stafi'; ?>" class="btn btn-secondary">Anulo</a>
                    </div>
                </div> <!-- Buttons END -->
            </form>

        </div> <!-- card-body END -->
    </section> <!-- card END -->

</div> <!-- container END -->

<script>
    // Preview Images before Upload START
    document.querySelector('#image').addEventListener("change", function() {
        var preview = document.querySelector('#preview_image');
        if (this.files) {
            preview.innerHTML = "";
            Array.prototype.forEach.call(this.files, function(file) {
                readAndPreviewImage(file, preview);
            });
        }
    });
    // Preview Images before Upload END
</script>