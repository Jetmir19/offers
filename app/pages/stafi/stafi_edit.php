<?php

// define variables and set to empty values
$emri = $mbiemri = $titulli = $data_punesimit = $image = $data_punesimit = $isAdmin =  $update_emriperdorues = $update_fjalekalimi = $update_confirm_fjalekalimi = "";
$emri_err = $mbiemri_err  = $titulli_err = $data_punesimit_err = $image_err = $data_punesimit_err = $isAdmin_err = $update_emriperdorues_err = $update_fjalekalimi_err = $update_confirm_fjalekalimi_err = "";

// Save START
//------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['savestafi']))
//------------------------------------------------------------
{
    // Disable form resubmission on refresh
    disableFormResubmission();

    $validated = true;

    $stafiID = mysqli_real_escape_string($link, $_POST['stafiID']);
    $emri = mysqli_real_escape_string($link, $_POST["emri"]);
    $mbiemri = mysqli_real_escape_string($link, $_POST["mbiemri"]);
    $titulli = mysqli_real_escape_string($link, $_POST["titulli"]);
    $update_emriperdorues = mysqli_real_escape_string($link, $_POST["update_emriperdorues"]);
    $update_fjalekalimi = mysqli_real_escape_string($link, $_POST["update_fjalekalimi"]);
    $update_confirm_fjalekalimi = mysqli_real_escape_string($link, $_POST["update_confirm_fjalekalimi"]);
    $data_punesimit = mysqli_real_escape_string($link, $_POST["data_punesimit"]);
    // checkbox isAdmin
    $isAdmin = isset($_POST['isAdmin']) ? 1 : 0;

    // Include Validation
    require_once PAGES_PATH . '/stafi/includes/stafi_validate.php';

    // Check input errors before inserting in database
    if ($validated === true) {
        // *** Upload Image function ***
        [$output, $filename] = uploadStafiImage($_FILES, "stafi", $stafiID);

        if ($output == "success" || $output == null) {
            // Get stafi by ID
            $row = getStafiById($stafiID);

            // If - user does not upload image get the existing one
            if ($output == null) {
                $image = $row['image'];
            } else {
                // Else - upload the new image
                $image = $filename;
            }

            // If - user does not change the password get the existing one
            if ($update_fjalekalimi == "") {
                $update_fjalekalimi = $row['fjalekalimi'];
            } else {
                // Creates a fjalekalimi hash
                $update_fjalekalimi = password_hash($update_fjalekalimi, PASSWORD_DEFAULT);
            }

            try {
                $sql = "UPDATE stafi SET emri=?, mbiemri=?, titulli=?, emriperdorues=?, fjalekalimi=?, email=?, data_punesimit=?, image=?, isAdmin=? WHERE stafiID=?";

                if ($stmt = mysqli_prepare($link, $sql)) {
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "sssssssssi", $emri, $mbiemri, $titulli, $update_emriperdorues, $update_fjalekalimi, $email, $data_punesimit, $image, $isAdmin, $stafiID);

                    // // Creates a fjalekalimi hash
                    // $update_fjalekalimi = password_hash($update_fjalekalimi, PASSWORD_DEFAULT);

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

// GET Request START
//------------------------------------------------------------
if (isset($_GET['id']))
//------------------------------------------------------------
{
    $stafiID = filter_input(INPUT_GET, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $row = getStafiById($stafiID);

    if ($row) {
        // check for redirect
        if ($stafiID !== $row['stafiID']) {
            forceRedirect(APP_URL . "/index.php?page=stafi_edit&id=" . $row['stafiID']);
        }
?>
        <div class="container-fluid">

            <!-- Header Title START -->
            <div class="pt-3 pb-2 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
                <h2><i class="fa fa-user fa-fw"></i> Ndrysho Stafin</h2>
            </div>
            <!-- Header Title END -->

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
                                        <input type="text" class="form-control <?php echo $emri_err ? ' is-invalid' : ''; ?>" id="emri" name="emri" value="<?php echo $row['emri'] ?? $emri; ?>">
                                        <span id="invalid-feedback" class="invalid-feedback"><?php echo $emri_err; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="mbiemri" class="control-label">Mbiemri *</label>
                                        <input type="text" class="form-control <?php echo $mbiemri_err ? ' is-invalid' : ''; ?>" id="mbiemri" name="mbiemri" value="<?php echo $row['mbiemri']; ?>">
                                        <span id="invalid-feedback" class="invalid-feedback"><?php echo $mbiemri_err; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="titulli" class="control-label">Titulli *</label>
                                        <input type="text" class="form-control <?php echo $titulli_err ? ' is-invalid' : ''; ?>" id="titulli" name="titulli" value="<?php echo $row['titulli']; ?>">
                                        <span id="invalid-feedback" class="invalid-feedback"><?php echo $titulli_err; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="update_emriperdorues" class="control-label">Emri përdorues *</label>
                                        <input type="text" class="form-control <?php echo $update_emriperdorues_err ? ' is-invalid' : ''; ?>" id="update_emriperdorues" name="update_emriperdorues" value="<?php echo $row['emriperdorues']; ?>">
                                        <span id="invalid-feedback" class="invalid-feedback"><?php echo $update_emriperdorues_err; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="update_fjalekalimi" class="control-label">Fjalëkalimi i ri *</label>
                                        <input type="text" class="form-control <?php echo $update_fjalekalimi_err ? ' is-invalid' : ''; ?>" id="update_fjalekalimi" name="update_fjalekalimi" value="">
                                        <span id="invalid-feedback" class="invalid-feedback"><?php echo $update_fjalekalimi_err; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="update_confirm_fjalekalimi" class="control-label">Konfirmo fjalëkalimin e ri *</label>
                                        <input type="text" class="form-control <?php echo $update_confirm_fjalekalimi_err ? ' is-invalid' : ''; ?>" id="update_confirm_fjalekalimi" name="update_confirm_fjalekalimi" value="">
                                        <span id="invalid-feedback" class="invalid-feedback"><?php echo $update_confirm_fjalekalimi_err; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="data_punesimit" class="control-label">Data e punësimit *</label>
                                        <input type="date" class="form-control <?php echo $data_punesimit_err ? ' is-invalid' : ''; ?>" id="data_punesimit" name="data_punesimit" value="<?php echo $row['data_punesimit']; ?>">
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
                                        <div id="preview_image" class="mt-2">
                                            <?php
                                            if ($row['image'] && file_exists(APPROOT . "/public/uploads/stafi/" . $row['image'])) {
                                                echo '<img src="' . APP_URL . "/public/uploads/stafi/" . $row['image'] . '" alt="image" width="60px" height="60px">';
                                            } else {
                                                echo '<img src="' . APP_URL . '/public/uploads/stafi/no-profile.png" alt="image" width="60px" height="60px">';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr class="mt-0">
                                <div class="form-group row">
                                    <div class="mx-auto px-3">
                                        <input type="checkbox" class="xl-chbox" id="isAdmin" name="isAdmin" <?php echo $row['isAdmin'] == 1 ? "checked" : "" ?>>
                                        <label for="isAdmin" class="control-label h5">Admin?</label>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- row END -->

                        <input type="hidden" name="stafiID" value="<?php echo $row['stafiID']; ?>">

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

<?php
    } else {
        msgBox('Stafi nuk ekziston.', '/index.php?page=stafi', "error");
    }
} // if GET Request END
else {
    msgBox('Faqja nuk mund të hapet direkt!', '/index.php?page=stafi', "error");
}
?>

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