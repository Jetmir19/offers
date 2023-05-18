<?php
$konsumatorID = $emriProduktit = $c_konsumatorID = $c_produktetID = $produktetID = $c_njesiID = $c_emri_produktit = $c_emri_njesis = $c_njesia = $c_tvsh1 = $c_sasia = $c_cmimi_pa_tvsh = $c_vlera_pa_tvsh = $c_vlera_e_tvsh = $c_vlera_me_tvsh = $c_zbritje = $searchProdukt = $pershkrimi_ofertes = "";

//------------------------------------------------------------
if (isset($_POST['shtoprodukt']))
//------------------------------------------------------------
{
    // Disable form resubmission on refresh
    disableFormResubmission();

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $searchProdukt = (int)$_POST['produktetID'];

    $validated = true;
    $error = "";

    // Validate serch input
    if (empty($searchProdukt)) {
        $validated = false;
        $error .= "Lista per oferta eshte e shprazet";
    }

    // Check for cart product duplicates
    $existingCarts = getCart();
    foreach ($existingCarts as $c) {
        if ($c['c_produktetID'] == $searchProdukt) {
            $validated = false;
            $error .= "Produkti existon ne liste";
        }
    }

    if ($validated === true) {
        $sql = "SELECT * FROM produktet
        LEFT JOIN njesit ON produktet.njesiID=njesit.njesiID
        WHERE produktet.produktetID='$searchProdukt'
        ";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($res = mysqli_fetch_assoc($result)) {
                $c_stafiID = $_SESSION["stafiID"];
                $c_produktetID = $res['produktetID'];
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
                $sqlInsertCart = "INSERT INTO cart (c_stafiID, c_produktetID, c_njesiID, c_emri_produktit,  c_tvsh1, c_sasia, c_cmimi_pa_tvsh, c_vlera_pa_tvsh, c_vlera_e_tvsh, c_vlera_me_tvsh, c_zbritje) VALUES ('$c_stafiID ', '$c_produktetID', '$c_njesiID', '$c_emri_produktit', '$c_tvsh1','$c_sasia','$c_cmimi_pa_tvsh','$c_vlera_pa_tvsh','$c_vlera_e_tvsh','$c_vlera_me_tvsh','$c_zbritje')";
                mysqli_query($link, $sqlInsertCart);
                $_SESSION['success'] = "Produkti me sukses u regjistrua te lista per oferte";
            }
        }
    } else {
        $_SESSION['error'] = $error;
    }
}

//------------------------------------------------------------
if (isset($_POST['produktDelete']))
//------------------------------------------------------------
{
    // Disable form resubmission on refresh
    disableFormResubmission();

    $id = htmlspecialchars($_POST['produktDelete']);
    // Soft delete klient
    $sql = "DELETE FROM cart WHERE cart_ID = '$id'";
    if (mysqli_query($link, $sql)) {
        // Success
        $_SESSION['error'] = "U fshij me sukses.";
    } else {
        // Delete Error
        $_SESSION['error'] = $link->error;
        die("Error:" . mysqli_error($link));
    }
}

//------------------------------------------------------------
if (isset($_POST['submit_komenti']))
//------------------------------------------------------------
{
    // Disable form resubmission on refresh
    disableFormResubmission();
    submitComment($_POST);
}

//------------------------------------------------------------
if (isset($_POST['submit_konsumatori']))
//------------------------------------------------------------
{
    // Disable form resubmission on refresh
    disableFormResubmission();

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $searchKonsumatori = $_POST['konsumatorID'];

    $validated = true;
    $error = "";

    if (empty($searchKonsumatori)) {
        $validated = false;
        $error .= "konsumatorID i detyrueshëm";
    } else {
        $konsumatorID = clean_input($searchKonsumatori);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z\p{Cyrillic}0-9' \s\-]+$/u", $konsumatorID)) {
            $validated = false;
            $error .= "Lejohen vetëm shkronja dhe numra";
        }
    }

    if ($validated === true) {
        $sql = "SELECT * FROM konsumatoret WHERE konsumatorID='$searchKonsumatori' ";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($res2 = mysqli_fetch_assoc($result)) {
                $_SESSION['res2_konsumatorID'] = $res2['konsumatorID'];
                $_SESSION['res2_k_emri'] = $res2['k_emri'];
                $_SESSION['res2_k_mbiemri'] = $res2['k_mbiemri'];
                $_SESSION['res2_rruga'] = $res2['rruga'];
            }
        }
        $_SESSION['success'] = "Konsumatori u shtua me sukses";
    } else {
        $_SESSION['error'] = $error;
    }
}

//------------------------------------------------------------
if (isset($_POST['paguaj']))
//------------------------------------------------------------
{
    // Disable form resubmission on refresh
    disableFormResubmission();

    $oferta = $_POST['paguaj'];

    // Random unique ID
    $numri_ofertes_fatures = date('dmY') . rand(0000, 9000);

    $validated = true;
    $error = "";

    // Require at least one product in a cart
    $requireCart = getCart();
    if (is_array($requireCart) && count($requireCart) == 0) {
        $validated = false;
        $error .= "Nuk ka asnje produkt per oferte!<br>";
    }
    // Require konsumatoriID session
    if (!isset($_SESSION['res2_konsumatorID'])) {
        $validated = false;
        $error .= "konsumatorID i detyrueshëm<br>";
    }
    // Require pershkrimi_ofertes session
    if (!isset($_SESSION['pershkrimi_ofertes'])) {
        $validated = false;
        $error .= "pershkrimi_ofertes i detyrueshëm<br>";
    }

    if ($validated === true) {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $countter = 0;

        // Use try catch to catch erors (because of many queries)
        try {
            // Start transaction
            $link->begin_transaction();

            $cart = getCart();
            foreach ($cart as $resofer) {
                $countter++;
                $a_stafiID = $resofer["c_stafiID"];
                $a_produktetID = $resofer['c_produktetID'];
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


                // Insert each cart product into artikujt_per_oferte_fature
                $link->query("INSERT INTO artikujt_per_oferte_fature (a_produktetID, konsumatorID, a_stafiID, a_njesiID, a_nr_rendor, a_emri_produktit,  a_tvsh1, a_sasia, a_cmimi_pa_tvsh, a_vlera_pa_tvsh, a_vlera_e_tvsh, a_vlera_me_tvsh, a_zbritje) VALUES ('$a_produktetID','{$_SESSION['res2_konsumatorID']}', '$a_stafiID','$a_njesiID', '$a_nr_rendor', '$a_emri_produktit', '$a_tvsh1','$a_sasia','$a_cmimi_pa_tvsh','$a_vlera_pa_tvsh','$a_vlera_e_tvsh','$a_vlera_me_tvsh','$a_zbritje')");
            }

            // Insert into oferte_fature table
            $link->query("INSERT INTO oferte_fature (stafiID, konsumatorID, numri_ofertes_fatures, pershkrimi_ofertes, gjithsej_sasia, gjithsej_pa_tvsh, gjithsej_e_tvsh, gjithsej_me_tvsh) 
            VALUES ('{$_SESSION['stafiID']}','{$_SESSION['res2_konsumatorID']}','$numri_ofertes_fatures','{$_SESSION['pershkrimi_ofertes']}', '$o_gjithsej_sasia', '$o_gjithsej_pa_tvsh', '$o_gjithsej_e_tvsh', '$o_gjithsej_me_tvsh')");

            // Get oferte_fature 'ofertatID' to Update 'artikujt_per_oferte_fature' table
            $sqlof = "SELECT * FROM oferte_fature 
            LEFT JOIN artikujt_per_oferte_fature ON oferte_fature.ofertatID=artikujt_per_oferte_fature.artikujt_perofert_fature_ID 
            RIGHT JOIN konfigurime ON konfigurime.konfigurimeID=konfigurime.konfigurimeID
            WHERE oferte_fature.isDeleted='0' ORDER BY oferte_fature.ofertatID DESC LIMIT 1";
            $result = mysqli_query($link, $sqlof);
            if (mysqli_num_rows($result) > 0) {
                while ($resup = mysqli_fetch_assoc($result)) {
                    $ofertatID = $resup['ofertatID'];

                    // Update 'artikujt_per_oferte_fature' table
                    $link->query("UPDATE artikujt_per_oferte_fature SET a_ofertatID='$ofertatID' WHERE a_ofertatID='0'");

                    // Delete all from cart table
                    $link->query("DELETE FROM cart");
                }
            }

            // Commit changes
            $link->commit();

            // Everything great
            $_SESSION['success'] = "Oferta me sukses u mbyll";
            unset($_SESSION['res2_konsumatorID']);
            unset($_SESSION['res2_k_emri']);
            unset($_SESSION['res2_k_mbiemri']);
            unset($_SESSION['res2_rruga']);
            unset($_SESSION['pershkrimi_ofertes']);
            // header('Location:' . APP_URL . '/index.php?page=pagesat_print&id=' . $ofertatID);
            forceRedirect(APP_URL . '/index.php?page=pagesat_print&id=' . $ofertatID);
            exit;
        } catch (Exception $e) {
            // Something went wrong. Rollback
            $link->rollback();
            // Save errors in a session
            $error .= "Oferta nuk u mbyll!<br><br>";
            $error .= $e->getMessage();
            $_SESSION['error'] = $error;
        }
    } else {
        // Display validation errors
        $_SESSION['error'] = $error;
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
    <?php echo session_message(); ?>

    <section class="card my-3">
        <header class="card-header">
            <span class="error"><?php echo $lang['Fusha_te_detyrueshme'] ?? "* Fusha të detyrueshme"; ?></span>
        </header>
        <div class="container-fluid">
            <!-- Control the column width, and how they should appear on different devices -->
            <div class="row">
                <div class="col-sm-8 mt-4">
                    <div class="card">
                        <h4 class="text-center my-3 pb-3">To Do App</h4>

                        <!-- Shto produkt form -->
                        <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2" action="" method="POST">
                            <div class="col-8">
                                <div class="input-group mb-3">
                                    <!-- <label for="dlist" class="control-label"><?php echo $lang['produktet_list'] ?? "produktet *"; ?></label> -->
                                    <?php
                                    echo '<datalist id="plist">';
                                    $produktet = getProduktet();
                                    foreach ($produktet as $produkt) {
                                        echo "<option value='$produkt[produktetID]'>$produkt[emriProduktit]</option>";
                                    }
                                    echo "</datalist>";
                                    ?>
                                    <input list="plist" id="produktetID" name="produktetID" class="form-control" value="<?php echo $produktetID; ?>" autocomplete="off" placeholder="shto produktet">
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
                                    $cc_stafiID = $_SESSION["stafiID"];
                                    $sql2 = "SELECT * FROM cart 
                                    INNER JOIN njesit ON cart.c_njesiID=njesit.njesiID 
                                    WHERE c_stafiID='$cc_stafiID' AND cart.isDeleted=njesit.isDeleted";

                                    $result2 = $link->query($sql2);

                                    $row = $result2->fetch_all(MYSQLI_ASSOC);

                                    $count = 0;
                                    $sasia_total = 0;
                                    $vlera_pa_tvsh_total = 0;
                                    $vlera_e_tvsh_total = 0;
                                    $vlera_me_tvsh_total = 0;
                                    $c_zbritje_total = 0;
                                    $c_vlera_total = 0;


                                    if ($row) {
                                        foreach ($row as $rowcarte) {
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
                                            <tr>
                                                <td><?php echo $count ?? ''; ?>
                                                    <!-- <td><?php echo $rowcarte['c_nr_rendor'] ?? ''; ?> -->
                                                    <!-- <?php echo $rowcarte['cart_ID'] ?? ''; ?> -->
                                                </td>
                                                <td><?php echo $rowcarte['c_emri_produktit'] ?? ''; ?></td>
                                                <!-- <td><?php echo $rowcarte['emri_njesis'] ?? ''; ?></td> -->
                                                <td><?php echo $rowcarte['njesia'] ?? ''; ?></td>
                                                <td>
                                                    <input type="number" step="0.00" minlength="0" data-cartId="<?php echo $rowcarte['cart_ID'] ?>" name="c_sasia" class="c_sasia" value="<?php echo (int) $rowcarte['c_sasia'] ?? ''; ?>">
                                                </td>
                                                <!-- <td><?php echo $rowcarte['c_tvsh1'] ?? ''; ?></td> -->
                                                <td class="c_cmimi_pa_tvsh"><?php echo $rowcarte['c_cmimi_pa_tvsh'] ?? ''; ?></td>
                                                <td class="c_vlera_pa_tvsh"><?php echo $rowcarte['c_vlera_pa_tvsh'] ?? ''; ?></td>
                                                <td>
                                                    <span class="c_vlera_e_tvsh"><?php echo $rowcarte['c_vlera_e_tvsh'] ?? ''; ?></span>
                                                    (<span class="c_tvsh1"><?php echo $rowcarte['c_tvsh1'] ?? ''; ?></span>%)
                                                </td>
                                                <td><span class="c_vlera_me_tvsh"><?php echo $rowcarte['c_vlera_me_tvsh'] ?? ''; ?><span></span></td>

                                                <td>
                                                    <input type="number" step="0.00" maxlength="100" minlength="0" data-cartId="<?php echo $rowcarte['c_zbritje'] ?>" name="c_zbritje" class="c_zbritje" value="<?php echo (int) $rowcarte['c_zbritje'] ?? ''; ?>">
                                                </td>

                                                <td><?php echo $rowcarte['c_vlera_total'] ?? ''; ?></td>
                                                <!-- <td>In progress</td> -->
                                                <td>
                                                    <form class="frmDelete" action="?page=pagesat&id=<?php echo $rowcarte['cart_ID']; ?>" method="POST">
                                                        <input type="hidden" name="produktDelete" value="<?php echo $rowcarte['cart_ID']; ?>">
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
                </div><!-- card-body END -->

                <div class="col-sm-4 mt-4">
                    <p class="fw-bold pt-lg-0 pt-4 pb-2">Payment Summary</p>

                    <!-- Shto komment form -->
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="pershkrimi_ofertes" class="form-label">Pershkrimi ofertes</label>
                            <textarea class="form-control" id="pershkrimi_ofertes" name="pershkrimi_ofertes" rows="3"><?php echo $_SESSION['pershkrimi_ofertes'] ?? ""; ?></textarea>
                            <button class="btn btn-outline-secondary" name="submit_komenti" type="submit" value="submit_komenti" id="button-addon2"><i class="fa fa-shopping-cart"></i> Komenti</button>
                        </div>
                    </form>

                    <!-- Shto konsumator form -->
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <!-- <label for="dlist" class="control-label"><?php echo $lang['produktet_list'] ?? "produktet *"; ?></label> -->
                            <input list="klist" id="konsumatorID" name="konsumatorID" class="form-control" value="<?php echo $konsumatorID; ?>" autocomplete="off" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <?php
                            echo '<datalist id="klist">';
                            $konsumatoret = getKonsumatori();
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
                        <div class="card px-md-3 px-2 pt-4">
                            <div class="unregistered mb-4"> <span class="py-1">Te dhenat e klientit </span> </div>
                            <div class="d-flex justify-content-between"> <small class="text-muted">Emri dhe mbiemri </small>
                                <p class="">
                                    <?php if (isset($_SESSION['res2_konsumatorID']) && !empty($_SESSION['res2_konsumatorID'])) {
                                        echo $_SESSION['res2_konsumatorID'];
                                    }; ?>
                                    <?php if (isset($_SESSION['res2_k_emri']) && !empty($_SESSION['res2_k_emri'])) {
                                        echo $_SESSION['res2_k_emri'];
                                    }; ?> <?php if (isset($_SESSION['res2_k_mbiemri']) && !empty($_SESSION['res2_k_mbiemri'])) {
                                                echo  $_SESSION['res2_k_mbiemri'];
                                            }; ?></p>
                            </div>
                            <div class="d-flex justify-content-between"> <small class="text-muted">Rruga</small>
                                <p class=""><?php if (isset($_SESSION['res2_rruga']) && !empty($_SESSION['res2_rruga'])) {
                                                echo $_SESSION['res2_rruga'];
                                            }; ?></p>
                            </div>
                            <hr>
                            <div class="unregistered mb-4"> <span class="py-1">Vlera e pageses</span></div>
                            <!-- <div class="d-flex justify-content-between b-bottom"> <input type="text" class="ps-2" placeholder="COUPON CODE">
                            <div class="btn btn-primary">Apply</div>
                        </div> -->
                            <div class="d-flex flex-column b-bottom">
                                <div class="d-flex justify-content-between py-1"> <small class="text-muted">Sasia total</small>
                                    <p id="sasia_total"><?php echo number_format($sasia_total); ?></p>
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
                            <div class="sale my-3"> <span>sale<span class="px-1">expiring</span><span>in</span>:</span><span class="red">21<span class="ps-1">hours</span>,31<span class="ps-1 ">minutes</span></span> </div>
                            <button class="btn btn-outline-secondary" name="paguaj" type="submit" value="paguaj" id="button-addon2"><i class="fa fa-shopping-cart"></i> Mbyll oferten</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div><!-- container END -->

<script>
    // Get Sasia total element
    let sTotalElement = document.getElementById('sasia_total');
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
        el.onchange = function() {
            // Clear the sTotalElement
            sTotalElement.textContent = "";

            // td - input Sasia
            let c_sasia = el.value;
            let cartId = el.getAttribute("data-cartId");

            // tr Parent Element
            const trParentElement = this.parentNode.parentNode;

            // td - c_cmimi_pa_tvsh
            let ccpt = trParentElement.querySelector('.c_cmimi_pa_tvsh').textContent;
            // td - c_vlera_pa_tvsh 
            let cvpt = trParentElement.querySelector('.c_vlera_pa_tvsh');
            // Total of "td - input Sasia" * td - c_cmimi_pa_tvsh
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
            fetch(`app/pages/pagesat/cart/cart_edit.php?cartId=${cartId}&sasia=${c_sasia}&cvptTotal=${cvptTotal}&cvetTotal=${cvetTotal}&cvmetTotal=${cvmetTotal}`)
                .then(response => response.json())
                .then(data => console.log(data))
                .catch(error => console.error(error));

            // Update sasia total
            let stotal = 0;
            qtyInputs.forEach(function(input) {
                stotal += parseInt(input.value);
            })
            sTotalElement.textContent = stotal.toFixed(2);

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