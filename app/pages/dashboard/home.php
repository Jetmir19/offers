<!-- Header Title END -->

<!-- <div class="col-xl-3 col-sm-6 py-2"> -->
<div class="container-fluid mb-3 pb-5">
    <!-- Header Title START -->
    <div class="pt-3 pb-2 mb-3 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <h2>Mirë se vini<strong class="text-muted"> Administrator </strong></h2>
    </div> <!-- Header Title END -->

    <section class="row mt-4">
        <!-- ************** Konsumatorët START ************** -->
        <div class="col mb-3">
            <div class="d-flex flex-wrap border">
                <div class="bg-success text-light p-3">
                    <div class="d-flex align-items-center justify-content-center h-100" style="min-width: 100px;">
                        <i class="fa fa-users fa-4x"></i>
                    </div>
                </div>
                <div class="bg-white p-3">
                    <p class="text-uppercase text-secondary mb-0">Konsumatorët</p>
                    <h3 class="font-weight-bold mb-0">
                        <?php
                        $sql = mysqli_query($link, "SELECT * FROM konsumatoret WHERE isDeleted = 0");
                        $num_rows = mysqli_num_rows($sql);
                        echo "$num_rows \n";
                        ?>
                    </h3>
                </div>
                <div class="bg-white p-3">
                    <p class="font-weight-bold mb-0">Aktiv -
                        <?php
                        $sql = mysqli_query($link, "SELECT * FROM konsumatoret WHERE kostatusi = 'aktiv' AND isDeleted = 0");
                        $num_rows = mysqli_num_rows($sql);
                        echo "$num_rows";
                        ?>
                    </p>
                    <p class="font-weight-bold mb-0">Inaktiv -
                        <?php
                        $sql = mysqli_query($link, "SELECT * FROM konsumatoret WHERE kostatusi = 'inaktiv' AND isDeleted = 0");
                        $num_rows = mysqli_num_rows($sql);
                        echo "$num_rows";
                        ?>
                    </p>
                </div>
            </div>
        </div> <!-- ************** Konsumatorët END ************** -->

        <!-- ************** Matësi START ************** -->
        <div class="col-md-6 mb-3">
            <div class="d-flex flex-wrap border">
                <div class="bg-secondary text-light p-3">
                    <div class="d-flex align-items-center justify-content-center h-100" style="min-width: 100px;">
                        <i class="fas fa-faucet fa-4x"></i>
                    </div>
                </div>
                <div class="bg-white p-3">
                    <p class="text-uppercase text-secondary mb-0">Matësit</p>
                    <h3 class="font-weight-bold mb-0">
                        <?php
                        // $sql = mysqli_query($link, "SELECT * FROM matesi WHERE isDeleted = 0");
                        // $num_rows = mysqli_num_rows($sql);
                        // echo "$num_rows \n";
                        ?>
                    </h3>
                </div>
                <div class="bg-white p-3">
                    <p class="font-weight-bold mb-0">Aktiv -
                        <?php
                        // $sql = mysqli_query($link, "SELECT * FROM matesi WHERE mastatusi = 'aktiv' AND isDeleted = 0 ");
                        // $num_rows = mysqli_num_rows($sql);
                        // echo "$num_rows";
                        ?>
                    </p>

                    <p class="font-weight-bold mb-0">Inaktiv -
                        <?php
                        // $sql = mysqli_query($link, "SELECT * FROM matesi WHERE mastatusi = 'inaktiv' AND isDeleted = 0 ");
                        // $num_rows = mysqli_num_rows($sql);
                        // echo "$num_rows";
                        ?>
                    </p>
                </div>
            </div>
        </div> <!-- ************** Matësi END ************** -->

        <!-- ************** Produktet ************** -->
        <div class="col-md-6 mb-3">
            <div class="d-flex flex-wrap border">
                <div class="bg-secondary text-light p-3">
                    <div class="d-flex align-items-center justify-content-center h-100" style="min-width: 100px;">
                        <i class="fas fa-calendar-check fa-4x"></i>
                    </div>
                </div>
                <div class="bg-white p-3">
                    <p class="text-uppercase text-secondary mb-0">Produktet</p>
                    <h3 class="font-weight-bold mb-0">
                        <?php
                        $sql = mysqli_query($link, "SELECT * FROM produktet WHERE isDeleted = 0");
                        $num_rows = mysqli_num_rows($sql);
                        echo "$num_rows \n";
                        ?>
                    </h3>
                </div>
                <div class="bg-white p-3">
                    <!-- <p class="font-weight-bold mb-0">Të paguara - -->
                    <?php
                    // $sql = mysqli_query($link, "SELECT * FROM leximi WHERE lestatusi = 'paguar' AND isDeleted = 0 ");
                    // $num_rows = mysqli_num_rows($sql);
                    // echo "$num_rows";
                    ?>
                    </p>

                    <!-- <p class="font-weight-bold mb-0">Pa paguara - -->
                    <?php
                    // $sql = mysqli_query($link, "SELECT * FROM leximi WHERE lestatusi = 'pa paguar' AND isDeleted = 0 ");
                    // $num_rows = mysqli_num_rows($sql);
                    // echo "$num_rows";
                    ?>
                    </p>

                </div>
            </div>
        </div> <!-- ************** Leximi END ************** -->

        <!-- ************** Faturat ************** -->
        <div class="col-md-6 mb-3">
            <div class="d-flex flex-wrap border">
                <div class="bg-danger text-light p-3">
                    <div class="d-flex align-items-center justify-content-center h-100" style="min-width: 100px;">
                        <i class="fas fa-print fa-4x"></i>
                    </div>
                </div>
                <div class="bg-white p-3">
                    <p class="text-uppercase text-secondary mb-0">Faturat</p>
                    <h3 class="font-weight-bold mb-0">
                        <?php
                        $sql = mysqli_query($link, "SELECT * FROM oferte_fature WHERE isDeleted = 0");
                        $num_rows = mysqli_num_rows($sql);
                        echo "$num_rows \n";
                        ?>
                    </h3>
                </div>
            </div>
        </div> <!-- ************** Faturat e leximit END ************** -->

        <!-- ************** Konfigurime START ************** -->
        <div class="col-md-6 mb-3">
            <div class="d-flex flex-wrap border">
                <div class="bg-info text-light p-3">
                    <div class="d-flex align-items-center justify-content-center h-100" style="min-width: 100px;">
                        <i class="fa fa-cog fa-4x"></i>
                    </div>
                </div>
                <div class="bg-white p-3">
                    <p class="text-uppercase text-secondary mb-0">Konfigurime</p>
                    <h3 class="font-weight-bold mb-0">
                        <?php
                        $sql = mysqli_query($link, "SELECT * FROM konfigurime");
                        $num_rows = mysqli_num_rows($sql);
                        echo "$num_rows \n";
                        ?>
                    </h3>
                </div>
            </div>
        </div> <!-- ************** Konfigurime END ************** -->

        <!-- ************** Stafi START ************** -->
        <div class="col-md-6 mb-3">
            <div class="d-flex flex-wrap border">
                <div class="bg-warning text-light p-3">
                    <div class="d-flex align-items-center justify-content-center h-100" style="min-width: 100px;">
                        <i class="fa fa-user fa-4x"></i>
                    </div>
                </div>
                <div class="flex flex-wrap bg-white p-3">
                    <p class="text-uppercase text-secondary mb-0">Stafi</p>
                    <h3 class="font-weight-bold mb-0">
                        <?php
                        $sql = mysqli_query($link, "SELECT * FROM stafi WHERE isDeleted = 0");
                        $num_rows = mysqli_num_rows($sql);
                        echo "$num_rows \n";
                        ?>
                    </h3>
                </div>
            </div>
        </div> <!-- ************** Stafi END ************** -->
    </section> <!-- section 1 end -->

    <section class="row mt-4">
        <!-- ************** Gjithsej kubik START ************** -->
        <div class="col-md-4 mb-3">
            <div class="text-center p-3 border shadow-sm">
                <h4>Gjithsej kubik</h4>
                <hr>
                <p class="text-muted">
                    <?php
                    // $sql = "SELECT SUM(gjithsej_kubik) AS gjithsej_kubik FROM fatura_leximi WHERE isDeleted = 0";
                    // $result = $link->query($sql);
                    // $row = $result->fetch_assoc();
                    // echo "\n" . $row['gjithsej_kubik'];
                    ?>
                </p>
            </div>
        </div> <!-- ************** Gjithsej kubik END ************** -->

        <!-- ************** Gjithsej pa tvsh START ************** -->
        <div class="col-md-4 mb-3">
            <div class="text-center p-3 border shadow-sm">
                <h4>Gjithsej pa tvsh</h4>
                <hr>
                <p class="text-muted">
                    <?php
                    // $sql = "SELECT SUM(gjithsej_pa_tvsh) AS gjithsej_pa_tvsh FROM fatura_leximi WHERE isDeleted = 0";
                    // $result = $link->query($sql);
                    // $row = $result->fetch_assoc();
                    // echo "\n" . $row['gjithsej_pa_tvsh'];
                    ?>
                </p>
            </div>
        </div> <!-- ************** Gjithsej pa tvsh START ************** -->

        <!-- ************** Gjithsej e tvsh START ************** -->
        <div class="col-md-4 mb-3">
            <div class="text-center p-3 border shadow-sm">
                <h4>Gjithsej e tvsh-se</h4>
                <hr>
                <p class="text-muted">
                    <?php
                    // $sql = "SELECT SUM(gjithsej_e_tvsh) AS gjithsej_e_tvsh FROM fatura_leximi WHERE isDeleted = 0";
                    // $result = $link->query($sql);
                    // $row = $result->fetch_assoc();
                    // echo "\n" . $row['gjithsej_e_tvsh'];
                    ?>
                </p>
            </div>
        </div> <!-- ************** Gjithsej e tvsh START ************** -->

        <!-- ************** Gjithsej me tvsh START ************** -->
        <div class="col-md-4 mb-3">
            <div class="text-center p-3 border shadow-sm">
                <h4>Gjithsej me tvsh</h4>
                <hr>
                <p class="text-muted">
                    <?php
                    // $sql = "SELECT SUM(gjithsej_me_tvsh) AS gjithsej_me_tvsh FROM fatura_leximi WHERE isDeleted = 0";
                    // $result = $link->query($sql);
                    // $row = $result->fetch_assoc();
                    // echo "\n" . $row['gjithsej_me_tvsh'];
                    ?>
                </p>
            </div>
        </div> <!-- ************** Gjithsej me tvsh END ************** -->

        <!-- ************** Gjithsej amnesti START ************** -->
        <div class="col-md-4 mb-3">
            <div class="text-center p-3 border shadow-sm">
                <h4>Gjithsej amnesti</h4>
                <hr>
                <p class="text-muted">
                    <?php
                    // $sql = "SELECT SUM(gjithsej_amnesti) AS gjithsej_amnesti FROM fatura_leximi WHERE isDeleted = 0";
                    // $result = $link->query($sql);
                    // $row = $result->fetch_assoc();
                    // echo "\n" . $row['gjithsej_amnesti'];
                    ?>
                </p>
            </div>
        </div> <!-- ************** Gjithsej amnesti END ************** -->

        <!-- ************** Gjithsej total START ************** -->
        <div class="col-md-4 mb-3">
            <div class="text-center p-3 border shadow-sm">
                <h4>Gjithsej Total</h4>
                <hr>
                <p class="text-muted">
                    <?php
                    // $sql = "SELECT SUM(gjithsej_total) AS gjithsej_total FROM fatura_leximi WHERE isDeleted = 0";
                    // $result = $link->query($sql);
                    // $row = $result->fetch_assoc();
                    // echo "\n" . $row['gjithsej_total'];
                    ?>
                </p>
            </div>
        </div> <!-- ************** Gjithsej total END ************** -->
    </section> <!-- section 2 end -->

</div>
<!--/row container-->