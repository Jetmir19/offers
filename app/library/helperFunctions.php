<?php
// Fix Headers already sent - error in PHP
#------------------------------------------------------------
function forceRedirect($url)
#------------------------------------------------------------
{
    if (headers_sent()) {
        echo ("<script>window.location.href='$url'</script>");
    } else {
        header("Location: $url");
    }
}
// Error Message Box
#------------------------------------------------------------
function errorBox($msg, $url)
#------------------------------------------------------------
{
    return '<div class="container h-100">
  <div class="row align-items-center h-100">
      <div class="col-md-6 mx-auto">
          <div class="jumbotron text-center text-danger border shadow">
          ' . $msg . '
              <div class="mt-4">
                  <a href="' . APP_URL . $url . '" class="btn btn-danger">Врати се назад</a>
              </div>
          </div>
      </div>
  </div>
</div>';
}

// Require login
#------------------------------------------------------------
function requireLogin()
#------------------------------------------------------------
{
    if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== 1) {
        header('Location:' . APP_URL . '/login');
        exit;
    }
}

// Require konfigurime
#------------------------------------------------------------
function requireKonfigurime()
#------------------------------------------------------------
{
    // Get page url 
    $page = isset($_GET['page']) ? $_GET['page'] : '';
    $page = filter_var($page, FILTER_SANITIZE_URL);

    // first exlude konfigurime pages
    if ($page !== 'konfigurime' && $page !== 'konfigurime_new') {
        // Redirect if konfigurime does not exist
        if (getKonfigurime(1) === null) {
            // Set left menu as disabled
            $_SESSION["require_konfigurime_style"] = 'style="pointer-events:none;color:#ccc;"';
            header('Location:' . APP_URL . '/index.php?page=konfigurime');
            exit;
        }
    }
}

/**
 * Get's the current page(button) from the url
 * @param array $pages array of pages or string
 * @return string if the $page matches
 */
#------------------------------------------------------------
function activeButton($pages)
#------------------------------------------------------------
{
    // Get page url 
    $page = isset($_GET['page']) ? $_GET['page'] : '/';
    $page = filter_var($page, FILTER_SANITIZE_URL);

    if (is_array($pages)) {
        foreach ($pages as $p) {
            if ($p === $page) {
                echo 'active-page';
            }
        }
    } else {
        if ($pages == $page) {
            echo 'active-page';
        }
    }
}

/**
 * Get's the current page(link) from the url
 * @param string $link link of the page
 * @return string if the $link matches
 */
#------------------------------------------------------------
function activeLink($link)
#------------------------------------------------------------
{
    // Get page url 
    $page = isset($_GET['page']) ? $_GET['page'] : '/';
    $page = filter_var($page, FILTER_SANITIZE_URL);

    if ($link == $page) {
        echo 'active-link';
    }
}

/**
 * A simple PHP function that calculates the percentage of a given number.
 * @param int $number The number you want a percentage of.
 * @param int $percent The percentage that you want to calculate.
 * @return int The final result.
 *  */
#------------------------------------------------------------
function getPercentOfNumber($number, $percent)
#------------------------------------------------------------
{
    return ($percent / 100) * $number;
}

/**
 * Calculate the percentage of a total
 * ex. 499 of 9999% = 5%
 * @param int $num_amount The number you want to get the percent
 * @param int $num_total Total percent of amount ex.100% or 200% etc.
 * @return int The final result.
 *  */
function cal_percentage($num_amount, $num_total)
{
    $count1 = $num_amount / $num_total;
    $count2 = $count1 * 100;
    $count = number_format($count2, 0);
    return $count;
}

// Field filter validation
#------------------------------------------------------------
function clean_input($data)
#------------------------------------------------------------
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

// Disable form resubmission on refresh once the form is submitted
#------------------------------------------------------------
function disableFormResubmission($disableNavBack = false)
#------------------------------------------------------------
{
    $nav = "";
    if ($disableNavBack === true) {
        $nav = 'history.pushState(null, null, window.location.href);
                    onpopstate = function () {
                    window.history.go(1);
                };';
    }

    echo '<script>
            document.addEventListener("DOMContentLoaded", function(event) {
                // Disable form resubmission
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                ' . $nav . '
            });
        </script>';
}

// Session header Message Error or Success
#------------------------------------------------------------
function session_message()
#------------------------------------------------------------
{
    // Error msg 
    if (isset($_SESSION['error'])) {
        if (is_array($_SESSION['error'])) {
            for ($i = 0; $i < count($_SESSION['error']); $i++) {
                echo '<div id="alert-error" class="alert alert-danger alert-dismissible mt-3">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        ' . $_SESSION['error'][$i] . '
                    </div>';
            }
        } else {
            echo '<div id="alert-error" class="alert alert-danger alert-dismissible mt-3">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    ' . $_SESSION['error'] . '
                </div>';
        }
        unset($_SESSION['error']);
    }

    // Success msg
    if (isset($_SESSION['success'])) {
        // Display alert
        echo '<div id="alert-success" class="alert alert-success alert-dismissible mt-3">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                ' . $_SESSION['success'] . '
            </div>';
        // Close alert after 2.5 sec
        echo '<script>
                setTimeout(function() {
                    $(".alert").alert("close");
                }, 2500);
            </script>';
        unset($_SESSION['success']);
    } elseif (isset($_SESSION['error'])) {
        echo '<div id="alert-danger" class="alert alert-danger alert-dismissible mt-3">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                ' . $_SESSION['error'] . '
            </div>';
        unset($_SESSION['error']);
    }
}

/* Print arrays in nicer format */
# -----------------------------------------------------------
function dd($var)
# -----------------------------------------------------------
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    die;
}
