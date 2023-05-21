<?php

// Search/Filter buttons
//------------------------------------------------------------
function showSearchButtons($page)
//------------------------------------------------------------
{
    echo '<hr class="mb-1">
            <div class="row mb-2 align-items-end">
                <div class="col d-none d-md-block pr-md-0">&nbsp;</div>
                <div class="col-md-auto pr-md-0">
                    <button type="submit" name="search" id="search" class="btn btn-block btn-outline-secondary my-2">
                        <i class="fas fa-search"></i> Kërko
                    </button>
                </div>
                <div class="col-md-auto pr-md-0">
                    <button type="reset" class="btn btn-block btn-outline-secondary my-2"><i class="fas fa-backspace"></i> Anulo</button>
                </div>
                <div class="col-md-auto">
                    <a href="index.php?page=' . $page . '" class="btn btn-block btn-outline-secondary my-2">
                        <i class="fas fa-sync-alt"></i> Ringarko
                    </a>
                </div>
            </div>';
}

/**
 * Get's the current page(button) from the url
 * @param array $pages array of pages or string
 * @return string if the $page matches
 */
//------------------------------------------------------------
function activeButton($pages)
//------------------------------------------------------------
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
//------------------------------------------------------------
function activeLink($link)
//------------------------------------------------------------
{
    // Get page url 
    $page = isset($_GET['page']) ? $_GET['page'] : '/';
    $page = filter_var($page, FILTER_SANITIZE_URL);

    if ($link == $page) {
        echo 'active-link';
    }
}

/**
 * Bootstrap Modal for error Messages
 * @param string $status "success" or "error".
 * @param string $body html or body message.
 *  */
//------------------------------------------------------------
function msgModal($status = "info", $body = "", $btnok_url = "")
//------------------------------------------------------------
{
    $icon = "";
    $btnok = "";

    if ($status == 'success') {
        $icon = '<span style="font-size: 3em; color: LimeGreen;"><i class="far fa-check-circle"></i></span>';
        $body = $body != "" ? $body : "Regjistruar me sukses";
    }
    if ($status == 'error') {
        $icon = '<span style="font-size: 3em; color: Tomato;"><i class="fas fa-exclamation-circle"></i><span>';
        $body = $body != "" ? '<small class="text-danger">' . $body . '</small>' : "Dicka shkoi keq!";
    }
    if ($status == 'info') {
        $icon = '<span style="font-size: 3em; color: lightblue;"><i class="fas fa-info-circle"></i><span>';
        $body = $body != "" ? '<small class="text-info">' . $body . '</small>' : "Mungojnë informacione";
    }

    if ($btnok_url != "") {
        $btnok = '<a href="' . APP_URL . $btnok_url . '" class="btn btn-block btn-info">OK</a>';
    } else {
        $btnok = '<button type="button" class="btn btn-block btn-info" data-dismiss="modal">OK</button>';
    }

    echo '<div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="msgModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center mb-2">
                        <div class="mb-2 my-3">' . $icon . '</div>
                        <h4 class="text-muted">' . $body . '</h4>
                    </div>
                    <div class="modal-footer">
                        ' . $btnok . '
                    </div>
                </div>
            </div>
        </div>';

    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                $('#msgModal').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });
            });
         </script>";
}

// Error/Success Message Box
//------------------------------------------------------------
function msgBox($msg, $url, $icon = "", $btn_text = "")
//------------------------------------------------------------
{
    if (!$btn_text) {
        $btn_text = "Kthehu mbrapa";
    }

    if ($icon == 'success') {
        $icon = '<div class="mb-3"><span style="font-size: 3em; color: LimeGreen;"><i class="far fa-check-circle"></i></span></div>';
    }
    if ($icon == 'error') {
        $icon = '<div class="mb-3"><span style="font-size: 3em; color: Tomato;"><i class="fas fa-exclamation-circle"></i><span></div>';
    }

    echo '<div class="container h-100">
            <div class="row align-items-center h-100">
                <div class="col-md-6 mx-auto">
                    <div class="jumbotron text-center text-danger border shadow">
                    ' . $icon . '
                    ' . $msg . '
                        <div class="mt-4">
                            <a href="' . APP_URL . $url . '" class="btn btn-info"><i class="fas fa-long-arrow-alt-left"></i> ' . $btn_text . '</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
}
