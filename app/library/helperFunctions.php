<?php

// Fix Headers already sent - error in PHP
//------------------------------------------------------------
function forceRedirect($url)
//------------------------------------------------------------
{
    if (headers_sent()) {
        echo ("<script>window.location.href='$url'</script>");
    } else {
        header("Location: $url");
    }
}

// Disable form resubmission on refresh once the form is submitted
//------------------------------------------------------------
function disableFormResubmission($disableNavBack = false)
//------------------------------------------------------------
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

/**
 * A simple PHP function that calculates the percentage of a given number.
 * @param int $number The number you want a percentage of.
 * @param int $percent The percentage that you want to calculate.
 * @return int The final result.
 *  */
//------------------------------------------------------------
function getPercentOfNumber($number, $percent)
//------------------------------------------------------------
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
//------------------------------------------------------------
function clean_input($data)
//------------------------------------------------------------
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

/**
 * Prints array in nicer format
 * @param array $var array to print
 */
//------------------------------------------------------------
function dd(array|string $var): void
//------------------------------------------------------------
{
    echo "<pre>";
    print_r($var);
    echo "</pre>";
    die;
}

/**
 * Prints array in nicer format
 * @param array $var array to print
 */
//------------------------------------------------------------
function dd_print(array|string $var): void
//------------------------------------------------------------
{
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}
