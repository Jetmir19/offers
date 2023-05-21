<?php

// Require login
//------------------------------------------------------------
function requireLogin()
//------------------------------------------------------------
{
    if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== 1) {
        header('Location:' . APP_URL . '/login');
        exit;
    }
}

// Require konfigurime
//------------------------------------------------------------
function requireKonfigurime()
//------------------------------------------------------------
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
 * Save success, error or warning message in the SESSION
 * @param string $status
 * @param string $msg
 */
//------------------------------------------------------------
function setSessionAlert($status, $msg)
//------------------------------------------------------------
{
    switch ($status) {
        case 'success':
            $_SESSION['success'] = $msg;
            break;
        case 'error':
            $_SESSION['error'] = $msg;
            break;
        case 'info':
            $_SESSION['info'] = $msg;
            break;
        case 'warning':
            $_SESSION['warning'] = $msg;
            break;
        default:
            # code...
            break;
    }
}

// Get's the success, error and warning message from SESSION
//------------------------------------------------------------
function showSessionAlert()
//------------------------------------------------------------
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
