<?php

// Global configuration
require_once __DIR__ . "/app/config/config.php";

// Database Connection
require_once DB_PATH . '/connect.php';

// Functions
require LIBRARY_PATH . '/sessionFunctions.php';
require LIBRARY_PATH . '/dbFunctions.php';
require LIBRARY_PATH . '/helperFunctions.php';
require LIBRARY_PATH . '/uiFunctions.php';

// Require Login
requireLogin();

// Require konfigurime
requireKonfigurime();

// Get single stafi
$stafi = getStafiById($_SESSION["stafiID"]);

// ------------------------- ROUTING START ------------------------------- //
// When creating a new page, please register it here!
$pagesArray = array(
    // --- Admin --- //
    'dashboard' => $stafi['isAdmin'] == 1 ? 'dashboard/home' : 'dashboard/home2',

    // --- konsumatori --- //
    'konsumatori' => 'konsumatori/konsumatori',
    'konsumatori_new' => 'konsumatori/konsumatori_new',
    'konsumatori_edit' => 'konsumatori/konsumatori_edit',
    'konsumatori_view' => 'konsumatori/konsumatori_view',

    // --- Produktet --- //
    'produktet' => 'produktet/produktet',
    'produktet_new' => 'produktet/produktet_new',
    'produktet_edit' => 'produktet/produktet_edit',

    // --- Njesit --- //
    'njesit' => 'njesit/njesit',
    'njesit_new' => 'njesit/njesit_new',
    'njesit_edit' => 'njesit/njesit_edit',
    'njesit_view' => $stafi['isAdmin'] == 1 ? 'njesit/modals/njesit_view' : 'error/401',

    // --- ofertat --- //
    'ofertat' => 'ofertat/ofertat',
    'ofertat_edit' => 'ofertat/ofertat_edit',

    // --- pagesat --- //
    'pagesat' => 'pagesat/pagesat',
    'pagesat_new' => 'pagesat/pagesat_new',
    'cart_edit' => 'pagesat/cart/cart_edit',
    'pagesat_print' => 'pagesat/pagesat_print',

    // --- stafi --- //
    'stafi' => $stafi['isAdmin'] == 1 ? 'stafi/stafi' : 'error/401',
    'stafi_new' => $stafi['isAdmin'] == 1 ? 'stafi/stafi_new' : 'error/401',
    'stafi_edit' => $stafi['isAdmin'] == 1 ? 'stafi/stafi_edit' : 'error/401',
    'stafi_view' => $stafi['isAdmin'] == 1 ? 'stafi/modals/stafi_view' : 'error/401',

    // --- konfigurime --- //
    'konfigurime' => $stafi['isAdmin'] == 1 ? 'konfigurime/konfigurime' : 'error/401',
    'konfigurime_new' => $stafi['isAdmin'] == 1 ? 'konfigurime/konfigurime_new' : 'error/401',

    // --- historia --- //
    'historia' => 'historia/historia',
    'historia_view' => $stafi['isAdmin'] == 1 ? 'historia/modals/historia_view' : 'error/401',

    // --- ndihme --- //    
    'ndihme' => 'ndihme/ndihme',
);

// Get page url 
$page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'dashboard';
$page = filter_var($page, FILTER_SANITIZE_URL);
// Check if the page is loaded within an iframe
$isIframe = isset($_GET['iframe']) && htmlspecialchars($_GET['iframe']) === 'true';

// Static includes
require_once PAGES_PATH . '/includes/header.php';
// Do not load these if page is iframe
if (!$isIframe) {
    require_once PAGES_PATH . '/includes/topnav.php';
    require_once PAGES_PATH . '/includes/leftnav.php';
}

/**
 * If that key exist in $pagesArray the we use the value of that array as path of the file
 * For example: if the url is "index.php?page=ndihme" then...
 * ..."ndihme" is the key of $pagesArray like $pagesArray['ndihme'] and the value is 'ndihme/ndihme'...
 * ...so we use the value 'ndihme/ndihme' as the path of the file... 
 * for example: if the value is 'ndihme/ndihme' that means folder=ndihme and the file=ndihme.php
 */
if (array_key_exists($page, $pagesArray)) {
    if (file_exists(PAGES_PATH . '/' . $pagesArray[$page] . '.php')) {
        require_once PAGES_PATH . '/' . $pagesArray[$page] . '.php';
    } else {
        require_once PAGES_PATH . '/error/404.php';
    }
} else {
    require_once PAGES_PATH . '/error/404.php';
}

require_once PAGES_PATH . '/includes/footer.php';
