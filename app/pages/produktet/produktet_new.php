<?php
// define variables and set to empty values
$furnitoretID = $njesiID = $cat_produktetID = $barkodi = $emriProduktit = $pershkrimiProdukit = $sasia = $serialnumer = $cmimiBleres = $cmimiShites =  $tvsh1 = $tvsh2 = $garancion_prej = $garancion_deri = $sasiakritike = $pstatusi = $dateCreated = "";
$furnitoretIDErr = $njesiIDErr = $cat_produktetIDErr = $barkodiErr = $emriProduktitErr = $pershkrimiProdukitErr = $sasia = $serialnumerErr =  $cmimiBleresErr = $cmimiShitesErr = $tvsh1Err = $tvsh2Err = $garancion_prejErr = $garancion_deriErr = $sasiakritikeErr = $pstatusiErr = $dateCreatedErr = "";
// Default


// Save START
//------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['saveProduktet']))
//------------------------------------------------------------
{
    // Disable form resubmission on refresh
    disableFormResubmission();

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // die;

    $validated = true;

    $barkodi = mysqli_real_escape_string($link, $_POST['barkodi']);
    $emriProduktit = mysqli_real_escape_string($link, $_POST['emriProduktit']);
    $pershkrimiProdukit = mysqli_real_escape_string($link, $_POST['pershkrimiProdukit']);
    $sasia = mysqli_real_escape_string($link, $_POST['sasia']);
    $serialnumer = mysqli_real_escape_string($link, $_POST['serialnumer']);
    $cmimiBleres = mysqli_real_escape_string($link, $_POST['cmimiBleres']);
    $cmimiShites = mysqli_real_escape_string($link, $_POST['cmimiShites']);
    $tvsh1 = mysqli_real_escape_string($link, $_POST['cmimiShites']);
    $tvsh2 = mysqli_real_escape_string($link, $_POST['tvsh2']);
    $garancion_prej = mysqli_real_escape_string($link, $_POST['garancion_prej']);
    $garancion_deri = mysqli_real_escape_string($link, $_POST['garancion_deri']);
    $sasiakritike = mysqli_real_escape_string($link, $_POST['sasiakritike']);
    $pstatusi = mysqli_real_escape_string($link, $_POST['pstatusi']);
    $furnitoretID = isset($replace_furnitoretID) ? $replace_furnitoretID : mysqli_real_escape_string($link, $_POST['inputFurnitori']);
    $njesiID = isset($replace_njesiID) ? $replace_njesiID : mysqli_real_escape_string($link, $_POST['inputNjesi']);
    $cat_produktetID = isset($replace_cat_produktetID) ? $replace_cat_produktetID : mysqli_real_escape_string($link, $_POST['inputcat_produktet']);
    $stafiID = $_SESSION["stafiID"];

    // Include Validation
    require_once PAGES_PATH . '/produktet/includes/produktet_validate.php';

    // Check if emriProduktit exists
    $sqlTab = mysqli_query($link, "SELECT * FROM produktet WHERE emriProduktit = '" . $emriProduktit . "'");
    if (!$sqlTab) {
        $_SESSION['error'] =  $link->error . "<br>";
    }
    if (mysqli_num_rows($sqlTab) > 0) {
        $validated = false;
        $emriProduktitErr = "Ekziston produkt me emer te njejtë";
        $_SESSION['error'] = $emriProduktitErr . "<br>";
    } else {
        if ($validated === true) {
            try {
                // Start transaction
                $link->begin_transaction();

                // Attempt insert query execution with commit() transaction
                $link->query("INSERT INTO produktet (furnitoretID, njesiID, stafiID, cat_produktetID, barkodi, emriProduktit, pershkrimiProdukit, sasia, serialnumer, cmimiBleres, cmimiShites, tvsh1, tvsh2, garancion_prej, garancion_deri, sasiakritike, pstatusi)
                VALUES ('{$furnitoretID}','{$njesiID}','{$cat_produktetID}','{$stafiID}','{$barkodi}','{$emriProduktit}', '{$pershkrimiProdukit}', '{$sasia}','{$serialnumer}','{$cmimiBleres}','{$cmimiShites}','{$tvsh1}','{$tvsh2}','{$garancion_prej}','{$garancion_deri}','{$sasiakritike}', '{$pstatusi}')");

                // Update old Produkti status to 'inaktiv'
                if (isset($replace_produktetID)) {
                    $link->query("UPDATE produktet SET pstatusi='inaktiv' WHERE produktetID = '{$replace_produktetID}'");
                }

                // Commit changes
                $link->commit();

                if (isset($replace_produktetID)) {
                    // Save in Historia
                    saveHistoria('create', 'produktet', 'Produkti u ndërua me sukses.', 'success');
                    // Show message on the modal
                    $body = '<p>Produkti u ndërua me sukses</p>';
                    $btnok_url = "/index.php?page=produktet";
                    msgModal("success", $body, $btnok_url);
                } else {
                    // Save in Historia
                    saveHistoria('create', 'produktet', 'Regjistruar me sukses.', 'success');
                    // $_SESSION['success']= "Me sukses u regjistrua";
                    msgModal("success", "Me sukses u regjistrua");
                }
            } catch (Exception $e) {
                // Something went wrong. Rollback
                $link->rollback();
                // Show error message on the modal
                msgModal("error", $e->getMessage());
            }
        }
    }
} // Save END
?>

<div class="container-fluid">

    <!-- Header Title START -->
    <div class="pt-3 pb-2 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <h2><i class="fab fa-product-hunt fa-fw"></i>
            <?php echo $replaceTitle ?? 'Krijo Produktet' ?>
        </h2>
    </div> <!-- Header Title END -->

    <!-- Display Session Messages-->
    <?php echo session_message(); ?>

    <section class="card my-3">
        <header class="card-header">
            <span class="error"><?php echo $lang['Fusha_te_detyrueshme'] ?? "* Fusha të detyrueshme"; ?></span>
        </header>
        <div class="card-body">

            <form id="form" class="form-group" action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="barkodi" class="control-label"><?php echo $lang['barkodi'] ?? "Barkodi *"; ?></label>
                                <input type="text" class="form-control <?php echo $barkodiErr ? ' is-invalid' : ''; ?>" id="barkodi" name="barkodi" value="<?php echo $barkodi; ?>">
                                <span id="invalid-feedback" class="invalid-feedback"><?php echo $barkodiErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="emriProduktit" class="control-label"><?php echo $lang['emriProduktit'] ?? "Emri i produktit *"; ?></label>
                                <input type="text" class="form-control <?php echo $emriProduktitErr ? ' is-invalid' : ''; ?>" id="emriProduktit" name="emriProduktit" value="<?php echo $emriProduktit; ?>">
                                <span id="invalid-feedback" class="invalid-feedback"><?php echo $emriProduktitErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="pershkrimiProdukit" class="control-label"><?php echo $lang['pershkrimiProdukit'] ?? "Pershkrimi i produktit *"; ?></label>
                                <input type="text" class="form-control <?php echo $pershkrimiProdukitErr ? ' is-invalid' : ''; ?>" id="pershkrimiProdukit" name="pershkrimiProdukit" value="<?php echo $pershkrimiProdukit; ?>">
                                <span id="invalid-feedback" class="invalid-feedback"><?php echo $pershkrimiProdukitErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="sasia" class="control-label"><?php echo $lang['sasia'] ?? "Sasia*"; ?></label>
                                <input type="text" class="form-control <?php echo $sasiaErr ? ' is-invalid' : ''; ?>" id="sasia" name="sasia" value="<?php echo $sasia; ?>">
                                <span id="invalid-feedback" class="invalid-feedback"><?php echo $sasiaErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="serialnumer" class="control-label"><?php echo $lang['serialnumer'] ?? "Serial numer"; ?></label>
                                <input type="text" class="form-control <?php echo $serialnumerErr ? ' is-invalid' : ''; ?>" id="serialnumer" name="serialnumer" value="<?php echo $serialnumer; ?>">
                                <span id="invalid-feedback" class="invalid-feedback"><?php echo $serialnumerErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="cmimiBleres" class="control-label"><?php echo $lang['cmimiBleres'] ?? "Cmimi bleres*"; ?></label>
                                <input type="number" class="form-control <?php echo $cmimiBleresErr ? ' is-invalid' : ''; ?>" id="cmimiBleres" name="cmimiBleres" value="<?php echo $cmimiBleres; ?>">
                                <span class="invalid-feedback"><?php echo $cmimiBleresErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="cmimiShites" class="control-label"><?php echo $lang['cmimiShitesente'] ?? "Cmimi shites *"; ?></label>
                                <input type="number" class="form-control <?php echo $cmimiShitesErr ? ' is-invalid' : ''; ?>" id="cmimiShites" name="cmimiShites" value="<?php echo $cmimiShites; ?>">
                                <span class="invalid-feedback"><?php echo $cmimiShitesErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="tvsh1" class="control-label"><?php echo $lang['tvsh1'] ?? "tvsh1"; ?></label>
                                <input type="number" class="form-control <?php echo $tvsh1Err ? ' is-invalid' : ''; ?>" id="tvsh1" name="tvsh1" value="<?php echo $tvsh1; ?>">
                                <span class="invalid-feedback"><?php echo $tvsh1Err; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="tvsh2" class="control-label"><?php echo $lang['tvsh2'] ?? "tvsh2"; ?></label>
                                <input type="number" class="form-control <?php echo $tvsh2Err ? ' is-invalid' : ''; ?>" id="tvsh2" name="tvsh2" value="<?php echo $tvsh2; ?>">
                                <span class="invalid-feedback"><?php echo $tvsh2Err; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="garancion_prej" class="control-label"><?php echo $lang['garancion_prej'] ?? "Garancion prej"; ?></label>
                                <input type="date" class="form-control <?php echo $garancion_prejErr ? ' is-invalid' : ''; ?>" id="garancion_prej" name="garancion_prej" value="<?php echo $garancion_prej; ?>">
                                <span class="invalid-feedback"><?php echo $garancion_prejErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="garancion_deri" class="control-label"><?php echo $lang['garancion_deri'] ?? "Garancion deri"; ?></label>
                                <input type="date" class="form-control <?php echo $garancion_deriErr ? ' is-invalid' : ''; ?>" id="garancion_deri" name="garancion_deri" value="<?php echo $garancion_deri; ?>">
                                <span class="invalid-feedback"><?php echo $garancion_deriErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="sasiakritike" class="control-label"><?php echo $lang['sasiakritike'] ?? "Sasia kritike"; ?></label>
                                <input type="number" class="form-control <?php echo $sasiakritikeErr ? ' is-invalid' : ''; ?>" id="sasiakritike" name="sasiakritike" value="<?php echo $sasiakritike; ?>">
                                <span class="invalid-feedback"><?php echo $sasiakritikeErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col">
                                <label for="pstatusi" class="control-label"><?php echo $lang['pstatusi'] ?? "pstatusi"; ?></label>
                                <input type="text" class="form-control <?php echo $pstatusiErr ? ' is-invalid' : ''; ?>" id="pstatusi" name="pstatusi" value="<?php echo $pstatusi; ?>">
                                <span class="invalid-feedback"><?php echo $pstatusiErr; ?></span>
                            </div>
                        </div>
                    </div>


                    <?php
                    if (isset($replace_produktetID)) {
                    ?>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="furnitoretID" class="control-label"><?php echo $lang['furnitoret_list'] ?? "furnitoret *"; ?></label>
                                    <input type="text" class="form-control <?php echo $furnitoretIDErr ? ' is-invalid' : ''; ?>" id="furnitoretID" name="" value="<?php echo $furnitoret; ?>" disabled>
                                    <span class="invalid-feedback"><?php echo $furnitoretIDErr; ?></span>
                                </div>
                            </div>
                            <input type="hidden" id="inputFurnitori" name="inputFurnitori" value="<?php echo $replace_furnitoretID; ?>">
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-md-12">
                            <div class="row mx-0 mt-2 pt-2 border border-<?php echo $furnitoretIDErr ? 'danger' : ''; ?>">
                                <div class="col-md-6">
                                    <label for="dlist" class="control-label"><?php echo $lang['furnitoret_list'] ?? "furnitoret *"; ?></label>
                                    <?php
                                    echo '<datalist id="dlist">';
                                    $furnitoret = getFurnitoret();
                                    foreach ($furnitoret as $furnitori) {
                                        echo "<option value='$furnitori[furnitoretID]'>$furnitori[personKontakt] $furnitori[Kompania]</option>";
                                    }
                                    echo "</datalist>";
                                    ?>
                                    <input list="dlist" id="inputFurnitori" name="inputFurnitori" class="form-control" value="<?php echo $furnitoretID; ?>" autocomplete="off">
                                </div>
                                <!-- furnitoret: emri dhe mbiemri - dynamic -->
                                <div class="col-md-6">
                                    <label for="kompania" class="control-label">&nbsp;</label>
                                    <input type="text" class="form-control" id="kompania" disabled>
                                </div>
                                <div class="text-danger m-3"><?php echo $furnitoretIDErr; ?></div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (isset($replace_produktetID)) {
                    ?>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="njesiID" class="control-label"><?php echo $lang['furnitoret_list'] ?? "njesit*"; ?></label>
                                    <input type="text" class="form-control <?php echo $njesiIDErr ? ' is-invalid' : ''; ?>" id="njesiID" name="" value="<?php echo $njesi; ?>" disabled>
                                    <span class="invalid-feedback"><?php echo $njesiIDErr; ?></span>
                                </div>
                            </div>
                            <input type="hidden" id="inputNjesi" name="inputNjesi" value="<?php echo $replace_njesiID; ?>">
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-md-12">
                            <div class="row mx-0 mt-2 pt-2 border border-<?php echo $njesiIDErr ? 'danger' : ''; ?>">
                                <div class="col-md-6">
                                    <label for="Njlist" class="control-label"><?php echo $lang['Njesite_list'] ?? "Njesite *"; ?></label>
                                    <?php
                                    echo '<datalist id="Njlist">';
                                    $njesit = getNjesit();
                                    foreach ($njesit as $njesia) {
                                        echo "<option value='$njesia[njesiID]'>$njesia[emri_njesis] $njesia[njesia]</option>";
                                    }
                                    echo "</datalist>";
                                    ?>
                                    <input list="Njlist" id="inputNjesi" name="inputNjesi" class="form-control" value="<?php echo $njesiID; ?>" autocomplete="off">
                                </div>
                                <!-- Njesite: emri dhe mbiemri - dynamic -->
                                <div class="col-md-6">
                                    <label for="emri_njesis" class="control-label">&nbsp;</label>
                                    <input type="text" class="form-control" id="emri_njesis" disabled>
                                </div>
                                <div class="text-danger m-3"><?php echo $njesiIDErr; ?></div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (isset($replace_produktetID)) {
                    ?>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="cat_produktetID" class="control-label"><?php echo $lang['furnitoret_list'] ?? "cat_produkt*"; ?></label>
                                    <input type="text" class="form-control <?php echo $cat_produktetIDErr ? ' is-invalid' : ''; ?>" id="cat_produktetID" name="" value="<?php echo $cat_produktetID; ?>" disabled>
                                    <span class="invalid-feedback"><?php echo $cat_produktetIDErr; ?></span>
                                </div>
                            </div>
                            <input type="hidden" id="inputcat_produktet" name="inputcat_produktet" value="<?php echo $replace_cat_produktetID; ?>">
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-md-12">
                            <div class="row mx-0 mt-2 pt-2 border border-<?php echo $cat_produktetIDErr ? 'danger' : ''; ?>">
                                <div class="col-md-6">
                                    <label for="Blist" class="control-label"><?php echo $lang['cat_list'] ?? "Category *"; ?></label>
                                    <?php
                                    echo '<datalist id="Blist">';
                                    $cat = getCat();
                                    foreach ($cat as $cat_produkt) {
                                        echo "<option value='$cat_produkt[cat_produktetID]'>$cat_produkt[emri_cat] $cat_produkt[pershkrimiCat]</option>";
                                    }
                                    echo "</datalist>";
                                    ?>
                                    <input list="Blist" id="inputcat_produktet" name="inputcat_produktet" class="form-control" value="<?php echo $cat_produktetID; ?>" autocomplete="off">
                                </div>
                                <!-- cat_produkt: emri dhe mbiemri - dynamic -->
                                <div class="col-md-6">
                                    <label for="pershkrimiCat" class="control-label">&nbsp;</label>
                                    <input type="text" class="form-control" id="pershkrimiCat" disabled>
                                </div>
                                <div class="text-danger m-3"><?php echo $cat_produktetIDErr; ?></div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div> <!-- row END -->

                <!-- Buttons START -->
                <div class="row mt-5">
                    <div class="col text-right">
                        <hr class="mb-2">
                        <?php
                        if (!isset($replace_produktetID)) { ?>
                            <a href="<?= APP_URL . '/index.php?page=produktet_new'; ?>" class="btn btn-secondary mr-1 mb-2">Krijo furnitori</a>
                        <?php
                        }
                        ?>
                        <button class="btn btn-success mr-1 px-4 mb-2" type="submit" id="saveProduktet" name="saveProduktet">Ruaj</button>
                        <a href="<?= APP_URL . '/index.php?page=produktet'; ?>" class="btn btn-secondary mb-2">Anulo</a>
                    </div>
                </div> <!-- Buttons END -->
            </form>

        </div> <!-- card-body END -->
    </section> <!-- card END -->
</div> <!-- container END -->

<script>
    // Get furnitorii name from the datalist
    window.addEventListener("DOMContentLoaded", function(event) {
        let inputF = document.getElementById("inputFurnitori");
        let inputNj = document.getElementById("inputNjesi");
        let inputB = document.getElementById("inputcat_produktet");
        let optionF = document.getElementById('dlist');
        let optionNj = document.getElementById('Njlist');
        let optionB = document.getElementById('Blist');

        if (optionF != null) {
            setNameInput(inputF.value, optionF.childNodes);

            // onchange
            inputF.onchange = function(el) {
                setNameInput(this.value, optionF.childNodes);
            }
        }

        if (optionNj != null) {
            setNameInputNjesia(inputNj.value, optionNj.childNodes);

            // onchange
            inputNj.onchange = function(el) {
                setNameInputNjesia(this.value, optionNj.childNodes);
            }
        }

        if (optionB != null) {
            setNameinputcat_produktet(inputB.value, optionB.childNodes);

            // onchange
            inputB.onchange = function(el) {
                setNameinputcat_produktet(this.value, optionB.childNodes);
            }
        }
    });

    function setNameInput(val, opt) {
        for (let i = 0; i < opt.length; i++) {
            if (opt[i].value === val) {
                // console.log(opt[i].textContent);
                document.getElementById("kompania").value = opt[i].textContent;
                break;
            }
        }
    }

    function setNameInputNjesia(val, opt) {
        for (let i = 0; i < opt.length; i++) {
            if (opt[i].value === val) {
                // console.log(opt[i].textContent);
                document.getElementById("emri_njesis").value = opt[i].textContent;
                break;
            }
        }
    }

    function setNameinputcat_produktet(val, opt) {
        for (let i = 0; i < opt.length; i++) {
            if (opt[i].value === val) {
                // console.log(opt[i].textContent);
                document.getElementById("pershkrimiCat").value = opt[i].textContent;
                break;
            }
        }
    }
</script>