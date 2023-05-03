<?php

// requireLogin();

// // Require konfigurime
// requireKonfigurime();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Oferta</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/public/css/bootstrap.min.css">
    <!-- Font awesome icons -->
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/public/css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/public/css/main.css">
    <link href="<?php echo APP_URL; ?>/public/css/print.css" rel="stylesheet" media="print">
</head>

<body>

    <div class="container-fluid">
        <?php

        $fatura_printID = filter_input(INPUT_GET, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $prow = getofertatPrint($fatura_printID);
        $konsID = $prow["konsumatorID"];

        // $konsID = $prow["konsumatorID"];
        // $konsID = $prow["konsumatorID"];



        // Get a single stafi
        $stafi = getStafiById($_SESSION["stafiID"]);
        $config = getKonfigurime(1);

        // echo "<pre>";
        // print_r($prow);
        // echo "</pre>";
        // die;

        ?>
        <?php echo session_message(); ?>

        <div class="card">
            <div class="card-header">
                <span><strong>FATURË: </strong><?= $prow["numri_ofertes_fatures"]; ?></span>
                <span class="float-right"><strong>Data: </strong><?= $prow["dateUpdated"]; ?></span>
            </div>

            <div class="card-body">

                <div class="table-responsive table-borderless mt-2">
                    <table class="table table-clear">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h6>Prej: OD:</h6>
                                    <div><strong><?= $config["fshati"]; ?></strong></div>
                                    <div>Kontakt person: <?= $config["kontakt_person"]; ?></div>
                                    <div>1227, <?= $config["fshati"] . ', ' . $config["qyteti"] . ' ' . $config["shteti"]; ?></div>
                                    <div>Email: <?= $config["email"]; ?></div>
                                    <div>Mobil: <?= $config["mobil"]; ?></div>
                                </td>
                                <td>
                                    <h6>Deri te:</h6>
                                    <?php
                                    if ($prow['firma'] !== "") {
                                        echo "<div><strong>" . $prow['firma'] . "</strong></div>";
                                    } else {
                                        echo "<div><strong>" . $prow['k_emri'] . " " . $prow['k_mbiemri'] . "</strong></div>";
                                    }
                                    ?>
                                    <div>Addresa: <?php echo $prow["fshati"]; ?></div>
                                    <div><?= $prow["rruga"]; ?>, <?= $prow["qyteti"]; ?></div>
                                    <div><?= $prow["email"]; ?></div>
                                    <div><?= $prow["mobil"]; ?></div>
                                </td>
                                <td>
                                    <h6><?= $config['banka'] ?></h6>
                                    <div>Xhirollogaria: <strong><?= $config['xhirollogaria'] ?></strong></div>
                                    <div>Adresa: <?= $config['banka_adresa'] ?></div>
                                    <div>Email: <?= $config['banka_email'] ?></div>
                                    <div>Mobil: <?= $config['banka_mobil'] ?></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- <div class="table-responsive">
                    <table class="table table-clear">
                        <thead>
                            <tr>
                                <th>Emri i matësit</th>
                                <th>Numri serik</th>
                                <th>Maksimum lexim</th>
                                <th>Kubik të lexuara</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><i><?= $prow["brendi"]; ?></i></td>
                                <td><i><?= $prow["serialnumer"]; ?></i></td>
                                <td><i><?= $prow["vlera_max"]; ?></i></td>
                                <td><i><?= $prow["vlera_prez"]; ?></i> </td>
                            </tr>
                        </tbody>
                    </table>
                </div> -->

                <div class="table-responsive">
                    <table class="table table-striped table-sm table-hover">
                        <thead>
                            <tr>
                                <th>nr</th>
                                <th>Emri produktit</th>
                                <th>Serial</th>
                                <th>sasia</th>
                                <th>Çmimi<br> pa tvsh</th>
                                <th>Vlera <br>pa tvsh</th>
                                <th>Vlera<br> e tvsh</th>
                                <th>Vlera <br>me tvsh</th>
                                <th>Shuma e<br>zbritjes %</th>
                                <th>Shuma total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Get all leximet with this fatura_leximiID
                            $getartikujt = getartikujtPrint($fatura_printID);
                            if ($getartikujt) {
                                foreach ($getartikujt as $arow) {
                            ?>
                                    <tr>
                                        <td><i><?= $arow['a_nr_rendor'] ?></i></td>
                                        <td><i><?= $arow['a_emri_produktit'] ?></i></td>
                                        <td><i><?= $arow['a_nr_serial'] ?></i></td>
                                        <td><b><i><?= $arow['a_sasia'] ?></i></b></td>
                                        <td><b><i><?= $arow['a_cmimi_pa_tvsh'] ?></i></b> </td>
                                        <td><b><i><?= $arow['a_vlera_pa_tvsh'] ?></i></b></td>
                                        <td><b><i><?= $arow['a_vlera_e_tvsh'] ?>(<?= $arow['a_tvsh1'] ?>)%</i></b></td>
                                        <td><b><i><?= $arow['a_vlera_me_tvsh'] ?></i></b></td>
                                        <td><b><i><?= $arow['a_zbritje'] ?>(<?= $arow['a_zbritje'] ?>)%</i></b></td>
                                        <td><b><i><?= $arow['a_shuma_total'] ?></i></b></td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo '<tr class="bg-white"><td colspan="100%">
                                    <div class="border text-center p-2"><span class="text-muted">Nuk u gjet asnjë regjistrim.</span></div>
                                    </td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive mt-3">
                    <table class="table table-clear">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="min-width:450px; max-width:470px; white-space:unset;">
                                    <strong>Shënim ose koment:</strong>
                                    <p class="font-italic bg-light p-2 border mb-2 mt-2"><?php echo $prow['pershkrimi_ofertes']; ?></p>
                                    <p class="text-justify" style="white-space:normal;"><?= $config["tekst"]; ?></p>
                                    <h5><?= $config["tekst2"]; ?></h5>
                                </td>
                                <td style="min-width:250px">
                                    <table class="mt-2">
                                        <tr>
                                            <td><strong>Gjithsej sasia</strong></td>
                                            <td class="text-right"><?php echo $prow['gjithsej_sasia']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Gjithsej pa TVSH</strong></td>
                                            <td class="text-right"><?= $prow['gjithsej_pa_tvsh'] . ' ' . $config['valuta'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Gjithsej vlera e TVSH-se (%)</strong></td>
                                            <td class="text-right"><?= $prow['gjithsej_e_tvsh'] . ' ' . $config['valuta'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Gjithsej me TVSH</strong></td>
                                            <td class="text-right"><?= $prow['gjithsej_me_tvsh'] . ' ' . $config['valuta'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Gjithsej zbritje</strong></td>
                                            <td class="text-right"><?= $prow['gjithsej_zbritje'] . ' ' . $config['valuta'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Gjithsej</strong></td>
                                            <td class="text-right"><?= $prow['gjithsej_total'] . ' ' . $config['valuta'] ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive table-borderless mt-5">
                    <table class="table table-clear">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="mb-4">Kasier: <span class="text-muted"><?= $prow["emri"] . ' ' . $prow["mbiemri"] ?></span></h6>
                                            <div>___________________________</div>
                                        </div>

                                        <div>
                                            <h6 class="mb-4">Kryetari: </h6>
                                            <div>___________________________</div>
                                        </div>

                                        <div>
                                            <h6 class="mb-4">Konsumatori: </h6>
                                            <div>___________________________</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div> <!-- card-body end -->
        </div> <!-- card end -->

    </div> <!-- container END -->

    <script src="<?php echo APP_URL; ?>/public/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo APP_URL; ?>/public/js/popper.min.js"></script>
    <script src="<?php echo APP_URL; ?>/public/js/bootstrap.min.js"></script>
    <script src="<?php echo APP_URL; ?>/app/scripts/modals.js"></script>

    <script>
        // Modal action button (Print button)
        let btnActionModal = window.parent.document.querySelector("#action-btn");
        if (btnActionModal != null) {
            // Click print button from the modal
            btnActionModal.onclick = () => print();
        }
    </script>

</body>
<html>