<?php
// Global configuration
require_once "../../config/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Jetmir Qazimi">

    <!-- If Javascript is Enabled then redirect -->
    <script>
        window.location.replace("<?php echo APP_URL; ?>/");
    </script>

    <title>Offers</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/public/css/bootstrap.min.css">
</head>

<body>

    <div class="container-fluid">

        <div class="container h-100">
            <div class="row text-center">
                <div class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3 col-12 p-3 error-main">
                    <div class="row">
                        <div class="col-lg-8 col-12 col-sm-10 offset-lg-2 offset-sm-1 mt-5 pt-5">
                            <h1 class="m-0">JavaScript is off!</h1>
                            <h6 class="text-muted">Please enable JavaScript to view full site.</h6>
                            <p>Ju lutemi kthehuni në
                                <span class="text-info"><a href="<?php echo APP_URL; ?>/">faqen e parë.</a></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container END -->

</body>

</html>