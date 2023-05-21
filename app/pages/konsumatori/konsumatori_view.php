<?php

// if GET Request START
//------------------------------------------------------------
if (isset($_GET['id']))
//------------------------------------------------------------
{
    $konsumatorID = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $row = getKonsumatoriById($konsumatorID) ?? [];

    // emri dhe mbiemri or firma
    $konsumatorEmri = $row['k_emri'] . ' ' . $row['k_mbiemri'];
    $k = $row['k_emri'] !== "" && $row['k_mbiemri'] !== "" ? $konsumatorEmri : $row['firma'];

    if (count($row) > 0) {
?>
        <div class="container-fluid">

            <!-- Header Title START -->
            <div class="pt-3 pb-2 mb-3 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
                <h2><i class="fas fa-users fa-fw"></i> Profili i Konsumatorit</h2>
                <span class="text-danger pb-3">(Në ndërtim e sipër)</span>
            </div>
            <!-- Header Title END -->

            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="https://www.nicepng.com/png/full/787-7871387_our-team-person-unknown-png.png" alt="" />
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                            <h5><?php echo $k; ?></h5>
                            <h6><?php echo $row['tip_konsumator']; ?></h6>

                            <p class="proile-rating">STATUSI : <span><?php echo $row['kostatusi']; ?></span></p>
                            <p class="proile-rating">Data e regjistrimit : <span><?php echo $row['dateCreated']; ?></span></p>
                            <p class="proile-rating">Numri amëz : <span><?php echo $row['nr_amez']; ?></span></p>

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-light font-weight-bold" href='?page=konsumatori_edit&id=<?php echo (int)$_GET['id']; ?>'>
                            Edit Profile
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>Te gjithe matesit</p>
                            <a href="">Nr. i faturave</a><br />
                            <a href="">Gjithsej lexime</a><br />
                            <a href="">Kubik gjithsej</a>
                            <a href="">Gjithsej te paguar</a>
                            <p>Matesi 1</p>
                            <a href="">Nr. i faturave</a><br />
                            <a href="">Gjithsej lexime</a><br />
                            <a href="">Kubik gjithsej</a>
                            <a href="">Gjithsej te paguar</a>
                            <p>Matesi 2</p>
                            <a href="">Nr. i faturave</a><br />
                            <a href="">Gjithsej lexime</a><br />
                            <a href="">Kubik gjithsej</a>
                            <a href="">Gjithsej te paguar</a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content" id="myTabContent">
                            <!-- Home Tab -->
                            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>ID</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo (int)$_GET['id']; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Emri dhe Mbiemri / Firma</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $k; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Rruga</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $row['rruga']; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Fshati</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $row['fshati']; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Komuna</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $row['komuna']; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Qyteti</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $row['qyteti']; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Shteti</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $row['shteti']; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Adresa e perkohshme</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $row['adresa_perkohshme']; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Email</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $row['email']; ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Mobil</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $row['mobil']; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Koment</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $row['komment']; ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Profile Tab -->
                            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Test1</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>test1</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Test2</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>test2</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div> <!-- container END -->

<?php
    } else {
        msgBox('Konsumatori nuk ekziston.', '/index.php?page=konsumatori', "error");
    }
}  // if GET Request END
else {
    msgBox('Faqja nuk mund të hapet direkt!', '/index.php?page=konsumatori', "error");
}
?>

<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        $('#myTab a').on('click', function(e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>