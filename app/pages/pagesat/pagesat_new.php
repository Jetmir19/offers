<?php

$konsumatorID = $emriProduktit = $c_konsumatorID = $c_produktID = $produktID = $c_njesiID = $c_emri_produktit = $c_emri_njesis = $c_njesia = $c_tvsh1 = $c_sasia = $c_cmimi_pa_tvsh = $c_vlera_pa_tvsh = $c_vlera_e_tvsh = $c_vlera_me_tvsh = $c_zbritje = $searchProdukt = $pershkrimi_ofertes = "";

//------------------------------------------------------------
if (isset($_POST['shtoprodukt']))
//------------------------------------------------------------
{
    // Disable form resubmission on refresh
    disableFormResubmission();

    $searchProdukt = htmlspecialchars((int)$_POST['produktID']);

    $validated = true;
    $error = "";

    // Validate serch input
    if (empty($searchProdukt)) {
        $validated = false;
        $error .= "Produkti nuk ekziston";
    }

    // Check for cart product duplicates
    $existingCarts = getCartItems();
    foreach ($existingCarts as $c) {
        if ($c['c_produktID'] == $searchProdukt) {
            $validated = false;
            $error .= "Produkti existon ne liste";
        }
    }

    if ($validated === true) {
        $sql = "SELECT * FROM produktet
                LEFT JOIN njesit ON produktet.njesiID=njesit.njesiID
                WHERE produktet.produktID='$searchProdukt'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($res = mysqli_fetch_assoc($result)) {
                $c_stafiID = $_SESSION["stafiID"];
                $c_produktID = $res['produktID'];
                $c_emri_produktit = $res['emriProduktit'];
                $c_njesiID = $res['njesiID'];
                $c_tvsh1 = $res['tvsh1'];
                $c_sasia = $res['sasia'];
                $c_cmimi_pa_tvsh = $res['cmimiShites'];
                $c_vlera_pa_tvsh = $res['cmimiShites'] * $res['sasia'];
                $c_vlera_e_tvsh = ($res['tvsh1'] / 100) * $c_vlera_pa_tvsh;
                $c_vlera_me_tvsh =  $c_vlera_e_tvsh + $c_vlera_pa_tvsh;
                $c_zbritje = ($res['zbritje'] / 100) * $c_vlera_pa_tvsh;

                // Insert into Cart table
                $sqlInsertCart = "INSERT INTO cart (c_stafiID, c_produktID, c_njesiID, c_emri_produktit,  c_tvsh1, c_sasia, c_cmimi_pa_tvsh, c_vlera_pa_tvsh, c_vlera_e_tvsh, c_vlera_me_tvsh, c_zbritje) VALUES ('$c_stafiID ', '$c_produktID', '$c_njesiID', '$c_emri_produktit', '$c_tvsh1','$c_sasia','$c_cmimi_pa_tvsh','$c_vlera_pa_tvsh','$c_vlera_e_tvsh','$c_vlera_me_tvsh','$c_zbritje')";
                mysqli_query($link, $sqlInsertCart);
                setSessionAlert('success', 'Produkti me sukses u regjistrua te lista per oferte');
            }
        }
    } else {
        setSessionAlert('error', $error);
    }
}

//------------------------------------------------------------
if (isset($_POST['produktDelete']))
//------------------------------------------------------------
{
    // Disable form resubmission on refresh
    disableFormResubmission();

    $id = htmlspecialchars($_POST['produktDelete']);

    $sql = "DELETE FROM cart WHERE cartID='$id'";
    if (mysqli_query($link, $sql)) {
        // Success
        setSessionAlert('success', 'U fshij me sukses.');
    } else {
        // Delete Error
        setSessionAlert('error', $link->error);
        die("Error:" . mysqli_error($link));
    }
}

//------------------------------------------------------------
if (isset($_POST['submit_komenti']))
//------------------------------------------------------------
{
    // Disable form resubmission on refresh
    disableFormResubmission();

    $pershkrimi_ofertes = htmlspecialchars($_POST["pershkrimi_ofertes"]);

    $validated = true;
    $error = "";

    if (empty($pershkrimi_ofertes)) {
        $validated = false;
        $error .= "Përshkrimi i detyrueshëm";
    } else {
        $pershkrimi_ofertes = clean_input($pershkrimi_ofertes);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z\p{Cyrillic}0-9' \s\-]+$/u", $pershkrimi_ofertes)) {
            $validated = false;
            $error .= "Lejohen vetëm shkronja dhe numra";
        }
    }

    if ($validated === true) {
        $_SESSION['pershkrimi_ofertes'] = $pershkrimi_ofertes;
        setSessionAlert('success', 'Komenti u shtua me sukses');
    } else {
        setSessionAlert('error', $error);
    }
}

//------------------------------------------------------------
if (isset($_POST['submit_konsumatori']))
//------------------------------------------------------------
{
    // Disable form resubmission on refresh
    disableFormResubmission();

    $searchKonsumatori = htmlspecialchars($_POST['konsumatorID']);

    $validated = true;
    $error = "";

    if (empty($searchKonsumatori)) {
        $validated = false;
        $error .= "Konsumatori i detyrueshëm";
    } else {
        $konsumatorID = clean_input($searchKonsumatori);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z\p{Cyrillic}0-9' \s\-]+$/u", $konsumatorID)) {
            $validated = false;
            $error .= "Lejohen vetëm shkronja dhe numra";
        }
    }

    if ($validated === true) {
        $sql = "SELECT * FROM konsumatoret WHERE konsumatorID='$searchKonsumatori'";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($res2 = mysqli_fetch_assoc($result)) {
                $_SESSION['res2_konsumatorID'] = $res2['konsumatorID'];
                $_SESSION['res2_k_emri'] = $res2['k_emri'];
                $_SESSION['res2_k_mbiemri'] = $res2['k_mbiemri'];
                $_SESSION['res2_rruga'] = $res2['rruga'];
            }
        }
        setSessionAlert('success', 'Konsumatori u shtua me sukses');
    } else {
        setSessionAlert('error', $error);
    }
}

//------------------------------------------------------------
if (isset($_POST['paguaj']))
//------------------------------------------------------------
{
    // Disable form resubmission on refresh
    disableFormResubmission();

    // Random unique ID
    $numri_ofertes_fatures = date('dmY') . rand(0000, 9000);

    $validated = true;
    $error = "";

    // Get all Cart items
    $cartItems = getCartItems();

    // Require at least one product in a cart
    if (is_array($cartItems) && count($cartItems) == 0) {
        $validated = false;
        $error .= "Nuk ka asnjë produkt për ofertë<br>";
    }
    // Require konsumatoriID session
    if (!isset($_SESSION['res2_konsumatorID'])) {
        $validated = false;
        $error .= "Konsumatori i detyrueshëm<br>";
    }
    // Require pershkrimi_ofertes session
    if (!isset($_SESSION['pershkrimi_ofertes'])) {
        $validated = false;
        $error .= "Përshkrimi ofertes i detyrueshëm<br>";
    }

    if ($validated === true) {
        $countter = 0;

        // Use 'try catch' to catch errors (because of many queries)
        try {
            // Start transaction
            $link->begin_transaction();

            // Define gjithsej variables
            $o_gjithsej_sasia = 0;
            $o_gjithsej_pa_tvsh = 0;
            $o_gjithsej_e_tvsh = 0;
            $o_gjithsej_me_tvsh = 0;

            foreach ($cartItems as $resofer) {
                $countter++;
                $a_stafiID = $resofer["c_stafiID"];
                $a_produktID = $resofer['c_produktID'];
                $a_emri_produktit = $resofer['c_emri_produktit'];
                $a_njesiID = $resofer['c_njesiID'];
                $a_nr_rendor = $countter;
                $a_tvsh1 = $resofer['c_tvsh1'];
                $a_sasia = $resofer['c_sasia'];
                $a_cmimi_pa_tvsh = $resofer['c_cmimi_pa_tvsh'];
                $a_vlera_pa_tvsh = $resofer['c_cmimi_pa_tvsh'] * $resofer['c_sasia'];
                $a_vlera_e_tvsh = ($resofer['c_tvsh1'] / 100) * $a_vlera_pa_tvsh;
                $a_vlera_me_tvsh =  $a_vlera_e_tvsh + $a_vlera_pa_tvsh;
                $a_zbritje = ($resofer['c_zbritje'] / 100) * $a_vlera_pa_tvsh;
                // insert varibales to table oferte_fature
                $o_gjithsej_sasia += $resofer['c_sasia'];
                $o_gjithsej_pa_tvsh += $resofer['c_vlera_pa_tvsh'];
                $o_gjithsej_e_tvsh += $resofer['c_vlera_e_tvsh'];
                $o_gjithsej_me_tvsh += $resofer['c_vlera_me_tvsh'];


                // Insert each cart product into oferte_fature_items
                $link->query("INSERT INTO oferte_fature_items (a_produktID, konsumatorID, a_stafiID, a_njesiID, a_nr_rendor, a_emri_produktit,  a_tvsh1, a_sasia, a_cmimi_pa_tvsh, a_vlera_pa_tvsh, a_vlera_e_tvsh, a_vlera_me_tvsh, a_zbritje) VALUES ('$a_produktID','{$_SESSION['res2_konsumatorID']}', '$a_stafiID','$a_njesiID', '$a_nr_rendor', '$a_emri_produktit', '$a_tvsh1','$a_sasia','$a_cmimi_pa_tvsh','$a_vlera_pa_tvsh','$a_vlera_e_tvsh','$a_vlera_me_tvsh','$a_zbritje')");
            }

            // Insert into oferte_fature table
            $link->query("INSERT INTO oferte_fature (stafiID, konsumatorID, numri_ofertes_fatures, pershkrimi_ofertes, gjithsej_sasia, gjithsej_pa_tvsh, gjithsej_e_tvsh, gjithsej_me_tvsh) 
            VALUES ('{$_SESSION['stafiID']}','{$_SESSION['res2_konsumatorID']}','$numri_ofertes_fatures','{$_SESSION['pershkrimi_ofertes']}', '$o_gjithsej_sasia', '$o_gjithsej_pa_tvsh', '$o_gjithsej_e_tvsh', '$o_gjithsej_me_tvsh')");

            // Get oferte_fature 'oferte_fatureID' to Update 'oferte_fature_items' table
            $sqlof = "SELECT * FROM oferte_fature 
            LEFT JOIN oferte_fature_items ON oferte_fature.oferte_fatureID=oferte_fature_items.oferte_fature_itemID 
            RIGHT JOIN konfigurime ON konfigurime.konfigurimeID=konfigurime.konfigurimeID
            WHERE oferte_fature.isDeleted='0' ORDER BY oferte_fature.oferte_fatureID DESC LIMIT 1";
            $result = mysqli_query($link, $sqlof);
            if (mysqli_num_rows($result) > 0) {
                while ($resup = mysqli_fetch_assoc($result)) {
                    $oferte_fatureID = $resup['oferte_fatureID'];

                    // Update 'oferte_fature_items' table
                    $link->query("UPDATE oferte_fature_items SET a_oferte_fatureID='$oferte_fatureID' WHERE a_oferte_fatureID='0'");

                    // Delete all from cart table
                    $link->query("DELETE FROM cart");
                }
            }

            // Commit changes
            $link->commit();

            // Everything went great
            setSessionAlert('success', 'Oferta me sukses u mbyll');

            unset($_SESSION['res2_konsumatorID']);
            unset($_SESSION['res2_k_emri']);
            unset($_SESSION['res2_k_mbiemri']);
            unset($_SESSION['res2_rruga']);
            unset($_SESSION['pershkrimi_ofertes']);
            // header('Location:' . APP_URL . '/index.php?page=pagesat_print&id=' . $oferte_fatureID);
            forceRedirect(APP_URL . '/index.php?page=pagesat_print&id=' . $oferte_fatureID);
            exit;
        } catch (Exception $e) {
            // Something went wrong. Rollback
            $link->rollback();
            // Save errors in a session
            $error .= "Oferta nuk u mbyll!<br><br>";
            $error .= $e->getMessage();
            setSessionAlert('error', $error);
        }
    } else {
        // Display validation errors
        setSessionAlert('error', $error);
    }
}
?>

<div class="container-fluid">
    <!-- Header Title START -->
    <div class="pt-3 pb-2 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <h2><i class="fas fa-money-check-alt fa-fw"></i>
            <?php echo $replaceTitle ?? 'Krijo Pagese' ?>
        </h2>
    </div> <!-- Header Title END -->

    <!-- Display Session Messages-->
    <?php echo showSessionAlert(); ?>

    <section class="card my-3 pb-3">
        <header class="card-header">
            <span class="error"><?php echo $lang['Fusha_te_detyrueshme'] ?? "* Fusha të detyrueshme"; ?></span>
        </header>

        <!-- Control the column width, and how they should appear on different devices -->
        <div class="row">
            <div id="shto-produkt" class="col col-md-8 mt-3">
                <div class="card ml-1 mx-1">

                    <!-- Shto produkt form -->
                    <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center my-4" action="" method="POST">
                        <div class="col col-md-8">
                            <div class="input-group">
                                <!-- <label for="dlist" class="control-label"><?php echo $lang['produktet_list'] ?? "produktet *"; ?></label> -->
                                <?php
                                echo '<datalist id="plist">';
                                $produktet = getProduktet();
                                foreach ($produktet as $produkt) {
                                    echo "<option value='$produkt[produktID]'>$produkt[emriProduktit]</option>";
                                }
                                echo "</datalist>";
                                ?>
                                <input list="plist" id="produktID" name="produktID" class="form-control" value="<?php echo $produktID; ?>" autocomplete="off" placeholder="Zgjidh produkt...">
                                <button class="btn btn-outline-secondary" name="shtoprodukt" type="submit" value="shtoprodukt" id="button-addon2"><i class="fa fa-shopping-cart"></i> Shto produkt</button>
                            </div>
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped table-sm table-hover text-center">
                            <thead class="bg-dark text-light" style="position: sticky;top: 0">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Emri produktit</th>
                                    <!-- <th scope="col">Emri<br>njesis</th> -->
                                    <th scope="col">Njesia</th>
                                    <th scope="col">sasia</th>
                                    <!-- <th  scope="col">tvsh</th> -->
                                    <th scope="col">cmimi<br>pa tvsh</th>
                                    <th scope="col">Vlera<br>pa tvsh</th>
                                    <th scope="col">vlera e tvsh</th>
                                    <th scope="col">Vlera<br>me tvsh</th>
                                    <th scope="col">Zbritje</th>
                                    <th scope="col">Vlera Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $count = 0;
                                $sasia_total = 0;
                                $vlera_pa_tvsh_total = 0;
                                $vlera_e_tvsh_total = 0;
                                $vlera_me_tvsh_total = 0;
                                $c_zbritje_total = 0;
                                $c_vlera_total = 0;

                                $cc_stafiID = $_SESSION["stafiID"];
                                $sqlCart = "SELECT * FROM cart 
                                INNER JOIN njesit ON cart.c_njesiID=njesit.njesiID 
                                WHERE c_stafiID='$cc_stafiID' AND cart.isDeleted=njesit.isDeleted";
                                $resultCart = $link->query($sqlCart);
                                $rowCart = $resultCart->fetch_all(MYSQLI_ASSOC);

                                if (count($rowCart) > 0) {
                                    foreach ($rowCart as $rowcarte) {
                                        $count++;
                                        $sasia_total += $rowcarte['c_sasia'];
                                        $vlera_pa_tvsh_total += $rowcarte['c_vlera_pa_tvsh'];
                                        $vlera_e_tvsh_total += $rowcarte['c_vlera_e_tvsh'];
                                        $vlera_me_tvsh_total += $rowcarte['c_vlera_me_tvsh'];
                                        $c_zbritje_total += $rowcarte['c_zbritje'];
                                        $c_vlera_total = $vlera_me_tvsh_total - $c_zbritje_total;

                                        //uji2021
                                        // $shuma_total = $shuma_me_tvsh - $shuma_amnesti;
                                        // $shuma_amnesti = ($amnesti / 100) * $shuma_pa_tvsh;
                                ?>
                                        <tr class="py-0">
                                            <td><?php echo $count ?? ''; ?>
                                                <!-- <td><?php echo $rowcarte['c_nr_rendor'] ?? ''; ?> -->
                                                <!-- <?php echo $rowcarte['cartID'] ?? ''; ?> -->
                                            </td>
                                            <td><?php echo $rowcarte['c_emri_produktit'] ?? ''; ?></td>
                                            <!-- <td><?php echo $rowcarte['emri_njesis'] ?? ''; ?></td> -->
                                            <td><?php echo $rowcarte['njesia'] ?? ''; ?></td>
                                            <td>
                                                <input type="number" min="0" step="0.00" onkeypress="return event.charCode >= 48" style="max-width: 65px;" data-cartId="<?php echo $rowcarte['cartID'] ?>" name="c_sasia" class="c_sasia" value="<?php echo (int) $rowcarte['c_sasia'] ?? ''; ?>">
                                            </td>
                                            <!-- <td><?php echo $rowcarte['c_tvsh1'] ?? ''; ?></td> -->
                                            <td class="c_cmimi_pa_tvsh"><?php echo $rowcarte['c_cmimi_pa_tvsh'] ?? ''; ?></td>
                                            <td class="c_vlera_pa_tvsh"><?php echo $rowcarte['c_vlera_pa_tvsh'] ?? ''; ?></td>
                                            <td>
                                                <span class="c_vlera_e_tvsh"><?php echo $rowcarte['c_vlera_e_tvsh'] ?? ''; ?></span>
                                                (<span class="c_tvsh1"><?php echo $rowcarte['c_tvsh1'] ?? ''; ?></span>%)
                                            </td>
                                            <td><span class="c_vlera_me_tvsh"><?php echo $rowcarte['c_vlera_me_tvsh'] ?? ''; ?></span></td>

                                            <td>
                                                <input type="number" min="0" step="0.00" onkeypress="return event.charCode >= 48" style="max-width: 65px;" data-cartId="<?php echo $rowcarte['c_zbritje'] ?>" name="c_zbritje" class="c_zbritje" value="<?php echo (int) $rowcarte['c_zbritje'] ?? ''; ?>">
                                            </td>

                                            <td><?php echo $rowcarte['c_vlera_total'] ?? ''; ?></td>
                                            <!-- <td>In progress</td> -->
                                            <td>
                                                <form class="frmDelete" action="?page=pagesat_new&id=<?php echo $rowcarte['cartID']; ?>" method="POST">
                                                    <input type="hidden" name="produktDelete" value="<?php echo $rowcarte['cartID']; ?>">
                                                    <button class="btn" type="submit"><i class="far fa-trash-alt fa-lg text-danger"></i></button>
                                                </form>
                                            </td>
                                        </tr>

                                <?php
                                    }
                                } else {
                                    echo '<tr>';
                                    echo '<td  colspan="11">';
                                    echo ' Nuk ka asnje produkt per oferte!';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>

                            </tbody>
                            <!-- <tfoot>
                                <tr class="mt-3">
                                    <th colspan="2"></th>
                                    <th scope="row">Totals</th>
                                    <td>sasia total<?php echo  $sasia_total; ?></td>
                                    <td> total vlera e tvsh<?php echo  $vlera_e_tvsh_total; ?></td>
                                    <td> total vlera me tvsh<?php echo  $vlera_me_tvsh_total; ?></td>
                                    <td> total zbritje<?php echo  $c_zbritje_total; ?></td>
                                    <td> <input type="submit" name="paguaj" value="paguaj" class="btn btn-sm btn-secondary"></td>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>
                </div>
            </div>

            <div class="col col-md-4 mt-4">
                <p class="font-weight-bolder pt-lg-0 pt-4 mx-1 mb-0">Payment Summary</p>
                <hr class="mt-2 mx-1">

                <!-- Shto komment form -->
                <form class="mx-1" action="" method="post">
                    <div class="mb-3">
                        <label for="pershkrimi_ofertes" class="form-label">Pershkrimi ofertes</label>
                        <textarea class="form-control" id="pershkrimi_ofertes" name="pershkrimi_ofertes" rows="3"><?php echo $_SESSION['pershkrimi_ofertes'] ?? ""; ?></textarea>
                        <button class="btn btn-outline-secondary mt-1" name="submit_komenti" type="submit" value="submit_komenti" id="button-addon2"><i class="fa fa-shopping-cart"></i> Komenti</button>
                    </div>
                </form>

                <!-- Shto konsumator form -->
                <form class="mx-1" action="" method="post">
                    <div class="input-group mb-3">
                        <!-- <label for="dlist" class="control-label"><?php echo $lang['produktet_list'] ?? "produktet *"; ?></label> -->
                        <input list="klist" id="konsumatorID" name="konsumatorID" class="form-control" value="<?php echo $konsumatorID; ?>" autocomplete="off" aria-label="Example text with button addon" aria-describedby="button-addon1">
                        <?php
                        echo '<datalist id="klist">';
                        $konsumatoret = getKonsumatoret();
                        foreach ($konsumatoret as $konsumatori) {
                            echo "<option value='$konsumatori[konsumatorID] $konsumatori[k_emri] $konsumatori[k_mbiemri]'></option>";
                        }
                        echo "</datalist>";
                        ?>
                        <button class="btn btn-outline-secondary" name="submit_konsumatori" type="submit" value="submit_konsumatori" id="button-addon2"><i class="fa fa-shopping-cart"></i> Zgjidh klient</button>
                    </div>
                </form>

                <!-- Paguaj form -->
                <form action="" method="post">
                    <div id="card-paguaj" class="card px-md-3 px-2 pt-4 mx-1">
                        <div class="unregistered mb-4"><span class="py-1">Te dhenat e klientit</span></div>
                        <div class="d-flex justify-content-between"> <small class="text-muted">Emri dhe mbiemri </small>
                            <p class="">
                                <?php
                                if (isset($_SESSION['res2_konsumatorID']) && !empty($_SESSION['res2_konsumatorID'])) {
                                    echo $_SESSION['res2_konsumatorID'] . ' ';
                                }
                                if (isset($_SESSION['res2_k_emri']) && !empty($_SESSION['res2_k_emri'])) {
                                    echo $_SESSION['res2_k_emri'] . ' ';
                                }
                                if (isset($_SESSION['res2_k_mbiemri']) && !empty($_SESSION['res2_k_mbiemri'])) {
                                    echo  $_SESSION['res2_k_mbiemri'] . ' ';
                                }
                                ?>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between"> <small class="text-muted">Rruga</small>
                            <p class="">
                                <?php
                                if (isset($_SESSION['res2_rruga']) && !empty($_SESSION['res2_rruga'])) {
                                    echo $_SESSION['res2_rruga'];
                                }
                                ?>
                            </p>
                        </div>
                        <hr>
                        <div class="unregistered mb-4"> <span class="py-1">Vlera e pageses</span></div>
                        <!-- <div class="d-flex justify-content-between b-bottom"> <input type="text" class="ps-2" placeholder="COUPON CODE">
                            <div class="btn btn-primary">Apply</div>
                        </div> -->
                        <div class="d-flex flex-column b-bottom">
                            <div class="d-flex justify-content-between py-1"> <small class="text-muted">Sasia total</small>
                                <p id="sasia_total"><?php echo number_format($sasia_total, 2); ?></p>
                            </div>
                            <div class="d-flex justify-content-between py-1"> <small class="text-muted">Gjithsej vlera pa TVSH</small>
                                <p id="vlera_pa_tvsh_total"><?php echo number_format($vlera_pa_tvsh_total, 2); ?></p>
                            </div>
                            <div class="d-flex justify-content-between py-1"> <small class="text-muted">Gjithsej vlera e TVSH-se</small>
                                <p id="vlera_e_tvsh_total"><?php echo number_format($vlera_e_tvsh_total, 2); ?></p>
                            </div>
                            <div class="d-flex justify-content-between pb-1"> <small class="text-muted">Gjithsej vlera me TVSH</small>
                                <p id="vlera_me_tvsh_total"><?php echo number_format($vlera_me_tvsh_total, 2); ?></p>
                            </div>
                            <div class="d-flex justify-content-between py-1"> <small class="text-muted">Zbritje</small>
                                <p><?php echo number_format($c_zbritje_total, 2); ?></p>
                            </div>
                            <div class="d-flex justify-content-between"> <small class="text-muted">Shuma gjithsej</small>
                                <p><?php echo number_format($c_vlera_total, 2); ?></p>
                            </div>
                        </div>
                        <div class="sale my-3"> <span>sale<span class="px-1">expiring</span><span>in</span>:</span><span class="red">21<span class="ps-1">hours</span>,31<span class="ps-1 ">minutes</span></span></div>
                        <button class="btn btn-outline-secondary mb-2" name="paguaj" type="submit" value="paguaj" id="button-addon2"><i class="fa fa-shopping-cart"></i> Mbyll oferten</button>
                    </div>
                </form>
            </div>
        </div> <!-- row END -->
</div> <!-- container END -->

<script>
    // Get Sasia total element
    let sasiaTotalElement = document.getElementById('sasia_total');
    // Get c_vlera_pa_tvsh and vlera_pa_tvsh_total
    let paTvshElement = document.getElementById('vlera_pa_tvsh_total');
    let allCvpt = document.querySelectorAll('.c_vlera_pa_tvsh');
    // Get all  c_vlera_e_tvsh
    let cVleraETvShElement = document.getElementById('vlera_e_tvsh_total');
    let allCvеt = document.querySelectorAll('.c_vlera_e_tvsh');

    // Get all  c_vlera_me_tvsh
    let cVleraMETvShElement = document.getElementById('vlera_me_tvsh_total');
    let allCvmеt = document.querySelectorAll('.c_vlera_me_tvsh');

    // On Update zbritje with ajax
    let zbrInputs = document.querySelectorAll(".c_zbritje");
    zbrInputs.forEach(function(el) {
        el.onchange = function() {
            // Code to make calculations for the "zbritja"
            console.log('zbritje change');
        }
    });

    // On Update sasia with ajax
    let qtyInputs = document.querySelectorAll(".c_sasia");
    qtyInputs.forEach(function(el) {
        el.onchange = function(event) {
            // td - input Sasia
            let c_sasia = el.value;

            // Get element data-* attribute
            let cartId = el.getAttribute("data-cartId");

            // tr Parent Element
            const trParentElement = this.parentNode.parentNode;

            // td - c_cmimi_pa_tvsh
            let ccpt = trParentElement.querySelector('.c_cmimi_pa_tvsh').textContent;
            // td - c_vlera_pa_tvsh 
            let cvpt = trParentElement.querySelector('.c_vlera_pa_tvsh');
            // Total of (td - input Sasia) * (td - c_cmimi_pa_tvsh)
            const cvptTotal = parseInt(c_sasia) * parseFloat(ccpt);
            // Update c_cmimi_pa_tvsh
            cvpt.textContent = cvptTotal.toFixed(2);

            // td - c_vlera_e_tvsh and c_tvsh1
            let ctvsh1 = trParentElement.querySelector('.c_tvsh1').textContent;
            let cvet = trParentElement.querySelector('.c_vlera_e_tvsh');
            const cvetTotal = (parseFloat(ctvsh1) / 100) * cvptTotal;
            cvet.textContent = cvetTotal.toFixed(2);

            // td - c_vlera_me_tvsh and c_vlera_pa_tvsh + c_vlera_e_tvsh
            let cvmet = trParentElement.querySelector('.c_vlera_me_tvsh');
            const cvmetTotal = cvetTotal + cvptTotal;
            cvmet.textContent = cvmetTotal.toFixed(2);

            // Update in database
            fetch(`app/pages/pagesat/cart/cart_edit.php
            ?cartId=${cartId}
            &sasia=${c_sasia}
            &cvptTotal=${cvptTotal}
            &cvetTotal=${cvetTotal}
            &cvmetTotal=${cvmetTotal}
            `)
                .then(response => response.json())
                .then(data => console.log(data))
                .catch(error => console.error(error));

            // Update sasia total
            let sasiaTotal = 0;
            qtyInputs.forEach(function(input) {
                sasiaTotal += parseInt(input.value);
            })
            sasiaTotalElement.textContent = sasiaTotal.toFixed(2);

            // Update vlera_pa_tvsh_total
            let cPaTvshTotal = 0;
            allCvpt.forEach(function(el) {
                cPaTvshTotal += parseFloat(el.textContent);
            });
            paTvshElement.textContent = cPaTvshTotal.toFixed(2);

            // Update vlera_e_tvsh_total
            let cETvshTotal = 0;
            allCvеt.forEach(function(el) {
                cETvshTotal += parseFloat(el.textContent);
            });
            cVleraETvShElement.textContent = cETvshTotal.toFixed(2);

            // Update vlera_me_tvsh_total
            let cMeTvshTotal = 0;
            allCvmеt.forEach(function(el) {
                cMeTvshTotal += parseFloat(el.textContent);
            });
            cVleraMETvShElement.textContent = cMeTvshTotal.toFixed(2);
        };
    });
</script>