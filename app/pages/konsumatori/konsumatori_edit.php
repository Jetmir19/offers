<?php
// define variables and set to empty values
$konsumator_code = $k_emri = $firma = $k_mbiemri = $nr_amez = $tip_konsumator = $rruga = $fshati =  $komuna = $qyteti =  $shteti = $adresa_perkohshme = $mobil = $email = "";
$konsumator_codeErr = $k_emriErr = $k_mbiemriErr = $firmaErr = $nr_amezErr = $tip_konsumatorErr = $rrugaErr =  $fshatiErr = $qytetiErr = $shtetiErr = $adresa_perkohshmeErr = $mobilErr =  $emailErr = "";

// Save START
//------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['saveKonsumatori']))
//------------------------------------------------------------
{
  // Disable form resubmission on refresh
  disableFormResubmission();

  // echo "<pre>";
  // print_r($_POST);
  // echo "</pre>";
  // die;

  $validated = true;

  $konsumatorID = mysqli_real_escape_string($link, $_POST['id']);
  // $konsumator_code = mysqli_real_escape_string($link, $_POST['konsumator_code']);
  $k_emri = isset($_POST['k_emri']) ? mysqli_real_escape_string($link, $_POST['k_emri']) : null;
  $k_mbiemri = isset($_POST['k_mbiemri']) ? mysqli_real_escape_string($link, $_POST['k_mbiemri']) : null;
  $firma = isset($_POST['firma']) ? mysqli_real_escape_string($link, $_POST['firma']) : null;
  $nr_amez = mysqli_real_escape_string($link, $_POST['nr_amez']);
  $tip_konsumator = $tip_konsumator ? mysqli_real_escape_string($link, $_POST['tip_konsumator']) : "";
  $rruga = mysqli_real_escape_string($link, $_POST['rruga']);
  $fshati = mysqli_real_escape_string($link, $_POST['fshati']);
  $komuna = mysqli_real_escape_string($link, $_POST['komuna']);
  $qyteti = mysqli_real_escape_string($link, $_POST['qyteti']);
  $shteti = mysqli_real_escape_string($link, $_POST['shteti']);
  $adresa_perkohshme = mysqli_real_escape_string($link, $_POST['adresa_perkohshme']);
  $mobil = mysqli_real_escape_string($link, $_POST['mobil']);
  $email = mysqli_real_escape_string($link, $_POST['email']);

  // Include Validation
  require_once PAGES_PATH . '/konsumatori/includes/konsumatori_validate.php';

  // Check for nr_amez to avoid duplicate
  $sqlMaticen = "SELECT nr_amez FROM konsumatoret WHERE konsumatorID != '" . $konsumatorID . "'";
  if ($result = mysqli_query($link, $sqlMaticen)) {
    while ($foundMaticen = mysqli_fetch_assoc($result)) {
      foreach ($foundMaticen as $amez) {
        if ($nr_amez == $amez) {
          $validated = false;
          $nr_amezErr = "Ekziston konsumator me numër amëz të njejtë";
          setSessionAlert('error', $nr_amezErr);
        }
      }
    }
  }

  if ($validated === true) {
    // Attempt update query execution
    $sql = "UPDATE konsumatoret SET k_emri='$k_emri', k_mbiemri='$k_mbiemri', firma='$firma', nr_amez='$nr_amez', tip_konsumator='$tip_konsumator', rruga='$rruga', fshati='$fshati', komuna='$komuna', qyteti='$qyteti', shteti='$shteti', adresa_perkohshme='$adresa_perkohshme', mobil='$mobil', email='$email' WHERE konsumatorID=$konsumatorID";

    if ($link->query($sql)) {
      // Save in Historia
      saveHistoria('edit', 'konsumatori', 'Regjistruar me sukses.', 'success');
      // $_SESSION['success'] = "Regjistruar me sukses.";
      msgModal("success");
    } else {
      msgModal("error", $link->error);
    }
  }
} // Save END

// if GET Request START
//------------------------------------------------------------
if (isset($_GET['id']))
//------------------------------------------------------------
{
  $konsumatorID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);
  $row = getKonsumatoriById($konsumatorID);

  if ($row) {
    // check for redirect
    if ($konsumatorID !== $row['konsumatorID']) {
      forceRedirect(APP_URL . "/index.php?page=konsumatori_edit&id=" . $row['konsumatorID']);
    }
?>

    <div class="container-fluid">

      <!-- Header Title START -->
      <div class="pt-3 pb-2 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <h2><i class="fas fa-users fa-fw"></i> Nrysho konsumatorin</h2>
      </div>
      <!-- Header Title END -->

      <!-- Display Session Messages-->
      <?php echo showSessionAlert(); ?>

      <section class="card my-3">
        <header class="card-header">
          <span class="error">* Fusha të detyrueshme</span>
        </header>
        <div class="card-body">

          <form id="klient-form" class="form-group" action="<?php echo APP_URL; ?>/index.php?page=konsumatori_edit&id=<?php echo $row['konsumatorID'] ?>" method="POST">
            <div class="row">
              <div class="col-md-12 mb-3">
                <div class="px-3 pt-3 pb-2 border border-<?php echo $tip_konsumatorErr ? 'danger' : ''; ?>">
                  <span class="mr-3">Tip konsumatori: </span>
                  <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" value="Person fizik" id="Person_fizik" name="tip_konsumator" <?php echo $row['tip_konsumator'] == "Person fizik" ? " checked" : ""; ?>>
                    Person fizik
                  </div>
                  <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" value="Person juridik" id="Person_juridik" name="tip_konsumator" <?php echo $row['tip_konsumator'] == "Person juridik" ? "checked" : ""; ?>>
                    Person juridik
                  </div>
                  <div class="text-danger mt-2"><?php echo $tip_konsumatorErr; ?></div>
                </div>
              </div>
              <div class="col-md-6" id="emri_div">
                <div class="form-group row">
                  <div class="col">
                    <label for="emri" class="control-label">Emri *</label>
                    <input type="text" class="form-control <?php echo $k_emriErr ? ' is-invalid' : ''; ?>" id="emri" name="emri" value="<?php echo $row['k_emri']; ?>">
                    <span id="invalid-feedback" class="invalid-feedback"><?php echo $k_emriErr; ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-6" id="mbiemri_div">
                <div class="form-group row">
                  <div class="col">
                    <label for="mbiemri" class="control-label">Mbiemri *</label>
                    <input type="text" class="form-control <?php echo $k_mbiemriErr ? ' is-invalid' : ''; ?>" id="mbiemri" name="mbiemri" value="<?php echo $row['k_mbiemri']; ?>">
                    <span class="invalid-feedback"><?php echo $k_mbiemriErr; ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-12 d-none" id="firma_div">
                <div class="form-group row">
                  <div class="col">
                    <label for="firma" class="control-label">Firma *</label>
                    <input type="text" class="form-control <?php echo $firmaErr ? ' is-invalid' : ''; ?>" id="firma" name="firma" value="<?php echo $row['firma']; ?>">
                    <span class="invalid-feedback"><?php echo $firmaErr; ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col">
                    <label for="nr_amez" class="control-label">Numri Amëz *</label>
                    <input type="number" class="form-control <?php echo $nr_amezErr ? ' is-invalid' : ''; ?>" name="nr_amez" value="<?php echo $row['nr_amez']; ?>">
                    <span class="invalid-feedback"><?php echo $nr_amezErr; ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col">
                    <label for="rruga" class="control-label">Rruga *</label>
                    <input type="text" class="form-control <?php echo $rrugaErr ? ' is-invalid' : ''; ?>" name="rruga" value="<?php echo $row['rruga']; ?>">
                    <span class="invalid-feedback"><?php echo $rrugaErr; ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group row">
                  <div class="col">
                    <label for="fshati" class="control-label">Fshati *</label>
                    <input type="text" class="form-control <?php echo $fshatiErr ? ' is-invalid' : ''; ?>" name="fshati" value="<?php echo $row['fshati']; ?>">
                    <span class="invalid-feedback"><?php echo $fshatiErr; ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group row">
                  <div class="col">
                    <label for="komuna" class="control-label">Komuna *</label>
                    <input type="text" class="form-control <?php echo $komunaErr ? ' is-invalid' : ''; ?>" name="komuna" value="<?php echo $row['komuna']; ?>">
                    <span class="invalid-feedback"><?php echo $komunaErr; ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group row">
                  <div class="col">
                    <label for="qyteti" class="control-label">Qyteti </label>
                    <input type="text" class="form-control <?php echo $qytetiErr ? ' is-invalid' : ''; ?>" name="qyteti" value="<?php echo $row['qyteti']; ?>">
                    <span class="invalid-feedback"><?php echo $qytetiErr; ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group row">
                  <div class="col">
                    <label for="konsumator_code" class="control-label">Kodi </label>
                    <input type="text" class="form-control <?php echo $konsumator_codeErr ? ' is-invalid' : ''; ?>" name="konsumator_code" value="<?php echo $row['konsumator_code']; ?>" disabled>
                    <span class="invalid-feedback"><?php echo $konsumator_codeErr; ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col">
                    <label for="shteti" class="control-label">Shteti *</label>
                    <input type="text" class="form-control <?php echo $shtetiErr ? ' is-invalid' : ''; ?>" name="shteti" value="<?php echo $row['shteti']; ?>">
                    <span class="invalid-feedback"><?php echo $shtetiErr; ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col">
                    <label for="adresa_perkohshme" class="control-label">Adresa e perkohshme </label>
                    <input type="text" class="form-control <?php echo $adresa_perkohshmeErr ? ' is-invalid' : ''; ?>" name="adresa_perkohshme" value="<?php echo $row['adresa_perkohshme']; ?>">
                    <span class="invalid-feedback"><?php echo $adresa_perkohshmeErr; ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col">
                    <label for="mobil" class="control-label">Mobil </label>
                    <input type="text" class="form-control <?php echo $mobilErr ? ' is-invalid' : ''; ?>" name="mobil" value="<?php echo $row['mobil']; ?>">
                    <span class="invalid-feedback"><?php echo $mobilErr; ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col">
                    <label for="email" class="control-label">Email </label>
                    <input type="text" class="form-control <?php echo $emailErr ? ' is-invalid' : ''; ?>" name="email" value="<?php echo $row['email']; ?>">
                    <span class="invalid-feedback"><?php echo $emailErr; ?></span>
                  </div>
                </div>
              </div>
            </div> <!-- row END -->

            <input type="hidden" name="id" value="<?php echo $row['konsumatorID']; ?>">

            <!-- Buttons START -->
            <div class="row mt-5">
              <div class="col text-right">
                <hr class="mb-2">
                <button class="btn btn-success mr-1 px-4" type="submit" name="saveKonsumatori">Ruaj</button>
                <a href="<?= APP_URL . '/index.php?page=konsumatori'; ?>" class="btn btn-secondary">Anulo</a>
              </div>
            </div> <!-- Buttons END -->
          </form>

        </div> <!-- card-body END -->
      </section> <!-- card END -->

    </div><!-- container END -->

<?php
  } else {
    msgBox('Konsumatori nuk ekziston.', '/index.php?page=konsumatori', "error");
  }
} // if GET Request END
else {
  msgBox('Faqja nuk mund të hapet direkt!', '/index.php?page=konsumatori', "error");
}
?>

<script>
  // Toggle Firma, Emri dhe mbiemri Inputs
  window.addEventListener("DOMContentLoaded", function(event) {
    const emri_div = document.getElementById('emri_div')
    const emri_input = document.getElementById('k_emri');
    const mbiemri_div = document.getElementById('mbiemri_div')
    const mbiemri_input = document.getElementById('k_mbiemri');
    const firma_div = document.getElementById('firma_div');
    const firma_input = document.getElementById('firma');

    firma_input.disabled = true;

    document.querySelector('#Person_fizik').onchange = function(e) {
      emri_div.style.display = 'block';
      emri_input.disabled = false;
      mbiemri_div.style.display = 'block';
      mbiemri_input.disabled = false;
      firma_div.classList.add('d-none');
      // firma_input.value = "";
      firma_input.disabled = true;
    }
    document.querySelector('#Person_juridik').onchange = function(e) {
      emri_div.style.display = 'none';
      // emri_input.value = "";
      emri_input.disabled = true;
      mbiemri_div.style.display = 'none';
      // mbiemri_input.value = "";
      mbiemri_input.disabled = true;
      firma_div.classList.remove('d-none');
      firma_input.disabled = false;
    }

    if (document.querySelector('#Person_juridik').checked) {
      emri_div.style.display = 'none';
      // emri_input.value = "";
      emri_input.disabled = true;
      mbiemri_div.style.display = 'none';
      // mbiemri_input.value = "";
      mbiemri_input.disabled = true;
      firma_div.classList.remove('d-none');
      firma_input.disabled = false;
    }
  });
</script>