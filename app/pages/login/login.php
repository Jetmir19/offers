<?php
require_once dirname(dirname(__DIR__)) . "/config/config.php";

require_once DB_PATH . '/connect.php';

// redirect to home if logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header('Location:' . APP_URL . '/');
    exit;
}

// Don't allow iframes(modals) if user is not logged in
// echo '<script>
//         if (window.location !== window.parent.location) {
//             parent.location.reload();
//         } 
//     </script>';

// Define variables and initialize with empty values
$emriperdorues = $fjalekalimi = $emriperdorues_err = $fjalekalimi_err = "";

// Processing form data when form is submitted START
//------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST")
//------------------------------------------------------------
{
    // Check if emriperdorues is empty
    if (empty(trim($_POST["emriperdorues"]))) {
        $emriperdorues_err = "Ju lutemi jepeni emrin përdorues.";
    } else {
        $emriperdorues = trim($_POST["emriperdorues"]);
    }

    // Check if fjalekalimi is empty
    if (empty(trim($_POST["fjalekalimi"]))) {
        $fjalekalimi_err = "Ju lutemi jepeni fjalëkalimin.";
    } else {
        $fjalekalimi = trim($_POST["fjalekalimi"]);
    }

    // Validate credentials
    if (empty($emriperdorues_err) && empty($fjalekalimi_err)) {
        // Prepare a select statement
        $sql = "SELECT stafiID, emri, mbiemri, emriperdorues, fjalekalimi FROM stafi WHERE emriperdorues = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_emriperdorues);

            // Set parameters
            $param_emriperdorues = $emriperdorues;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if emriperdorues exists, if yes then verify fjalekalimi
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $stafiID, $emri, $mbiemri,  $emriperdorues, $hashed_fjalekalimi);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($fjalekalimi, $hashed_fjalekalimi)) {
                            // fjalekalimi is correct, so start a new session
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["stafiID"] = $stafiID;
                            $_SESSION["emriperdorues"] = $emriperdorues;
                            $_SESSION["emri"] = $ermri;
                            $_SESSION["mbiemri"] = $mbiemri;

                            // ------------------- Remember me checkBox START-------------->>
                            // store just the userID and username, no password in the cookies for security reasons
                            // otherwise chrome allows to store the username and password automatically
                            if (isset($_POST['loginRemember'])) {
                                setcookie('stafiID', $stafiID, time() + 30 * 24 * 60 * 60);
                                setcookie('emriperdorues', $emriperdorues, time() + 30 * 24 * 60 * 60);
                            } else {
                                if (isset($_COOKIE['stafiID'])) {
                                    setcookie('stafiID', '', time() - 3600);
                                    setcookie('emriperdorues', '', time() - 3600);
                                }
                            }
                            // ------------------- Remember me checkBox END-------------->>

                            // Redirect user to welcome page
                            header('Location:' . APP_URL . '/');
                        } else {
                            // Display an error message if fjalekalimi is not valid
                            $fjalekalimi_err = "Fjalëkalimi gabuar!.";
                        }
                    }
                } else {
                    // Display an error message if emriperdorues doesn't exist
                    $emriperdorues_err = "Nuk gjendet llogari me këtë emër përdorues!";
                }
            } else {
                echo "Opss! Diçka nuk është në rregull.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
} // Processing form data when form is submitted END
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Login</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo APP_URL; ?>/public/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo APP_URL; ?>/public/css/login.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card card-signin flex-row my-5">
                    <div class="card-img-left d-none d-md-flex">
                        <!-- Background image for card set in CSS! -->
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center mb-0">Program per oferta biznisi</h5>
                        <hr>
                        <h5 class="card-title text-center">Identifikimi</h5>
                        <form class="form" action="" method="post">
                            <div class="form-group mb-3" <?php echo (!empty($emriperdorues_err)) ? 'has-error' : ''; ?>>
                                <input type="text" name="emriperdorues" class="form-control rounded-pill border-0 shadow-sm px-4" value="<?php echo isset($_COOKIE["emriperdorues"]) ? $_COOKIE["emriperdorues"] : $emriperdorues ?>" placeholder="Emri perdordorues">
                                <span class="help-block"><?php echo $emriperdorues_err; ?></span>
                            </div>
                            <div class="form-group mb-3" <?php echo (!empty($fjalekalimi_err)) ? 'has-error' : ''; ?>>
                                <input type="password" name="fjalekalimi" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary" placeholder="fjalekalimi">
                                <span class="help-block"><?php echo $fjalekalimi_err; ?></span>
                            </div>
                            <!-- // ------------------- Remember me checkBox START-------------->
                            <div class="custom-control custom-checkbox mb-3">
                                <input id="loginRemember" name="loginRemember" type="checkbox" class="custom-control-input" <?php echo isset($_COOKIE["stafiID"]) ? "checked" : "" ?>>
                                <label for="loginRemember" class="custom-control-label">Më ruaj</label>
                            </div> <!-- // ------------------- Remember me checkBox END-------------->
                            <button type="submit" name="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Kyçje në sistem</button>
                            <div class="text-center d-flex justify-content-between mt-4">
                                <p>Programuar nga:

                                    <u><a href="http://jetmir-kazimi.eu5.net/" class="font-italic text-muted">&&& </u>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>