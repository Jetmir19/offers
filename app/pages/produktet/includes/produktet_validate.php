<?php

if (empty($_POST["barkodi"])) {
    $validated = false;
    $barkodiErr = "Barkod i detyrueshëm";
} else {
    $barkodi = clean_input($_POST["barkodi"]);
    if (!preg_match("/^[a-zA-Z\p{Cyrillic}0-9' \s\-]+$/u", $barkodi)) {
        $validated = false;
        $barkodiErr = "Lejohen vetëm numra (pa hapësirë)";
    }
    if (strlen($barkodi) > 4) {
        $validated = false;
        $barkodiErr = "Lejohet vetëm gjatësia e numrit deri në 15 shifror (pa hapësirë)";
    }
}

if (!empty($_POST["serialnumer"])) {
    $serialnumer = clean_input($_POST["serialnumer"]);
    if (!preg_match('/^[0-9]+$/', $serialnumer)) {
        $validated = false;
        $serialnumerErr = "Lejohen vetëm numra";
    }
}

if (!empty($_POST["cmimiBleres"])) {
    $cmimiBleres = clean_input($_POST["cmimiBleres"]);
    if (!preg_match('/^[\-+]?[0-9]*\.*\,?[0-9]+$/', $cmimiBleres)) {
        $validated = false;
        $cmimiBleresErr = "Lejohen vetëm numra prej 0 deri 6 (pa hapësirë)";
    }
}

if (!empty($_POST["cmimiShites"])) {
    $cmimiShites = clean_input($_POST["cmimiShites"]);
    if (!preg_match('/^[\-+]?[0-9]*\.*\,?[0-9]+$/', $cmimiShites)) {
        $validated = false;
        $cmimiShitesErr = "Lejohen vetëm numra prej 1 deri 4 (pa hapësirë)";
    }
}

if (!empty($_POST["garancion_prej"])) {
    $garancion_prej = clean_input($_POST["garancion_prej"]);
    if (!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/',  $garancion_prej)) {
        $validated = false;
        $garancion_prejErr = "Formati i datës duhet të jetë dd-mm-yyyy";
    }
}

if (!empty($_POST["garancion_deri"])) {
    $garancion_deri = clean_input($_POST["garancion_deri"]);
    if (!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/',  $garancion_deri)) {
        $validated = false;
        $garancion_deriErr = "Formati i datës duhet të jetë dd-mm-yyyy";
    }
}

if (!empty($_POST["sasiakritike"])) {
    $sasiakritike = clean_input($_POST["sasiakritike"]);
    if (!preg_match('/^[0-9]+$/', $sasiakritike)) {
        $validated = false;
        $sasiakritikeErr = "Lejohen vetëm numra";
    }
}

if (empty($_POST["inputFurnitori"])) {
    $validated = false;
    $furnitoretIDErr = "Furnitori i detyrueshëm";
} else {
    $furnitoretID = clean_input($_POST["inputFurnitori"]);
    if (!preg_match('/^[0-9]+$/', $furnitoretID)) {
        $validated = false;
        $furnitoretIDErr = "Lejohen vetëm numra (pa hapësirë)";
    }
    // Check is furnitori exists
    $sqlFurnitoret = "SELECT * FROM furnitoret WHERE furnitoretID = '{$furnitoretID}'";
    $result = $link->query($sqlFurnitoret);
    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            $validated = false;
            $furnitoretIDErr = "Furnitori nuk egziston";
        }
    } else {
        return false;
    }
}

if (empty($_POST["inputNjesi"])) {
    $validated = false;
    $njesiIDErr = "Njesia i detyrueshëm";
} else {
    $njesiID = clean_input($_POST["inputNjesi"]);
    if (!preg_match('/^[0-9]+$/', $njesiID)) {
        $validated = false;
        $njesiIDErr = "Lejohen vetëm numra (pa hapësirë)";
    }
    // Check is njesia exists
    $sqlNjesit = "SELECT * FROM njesit WHERE njesiID = '{$njesiID}'";
    $result = $link->query($sqlNjesit);
    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            $validated = false;
            $njesiIDErr = "Njesite nuk egzistojne";
        }
    } else {
        return false;
    }
}

if (empty($_POST["inputcat_produktet"])) {
    $validated = false;
    $cat_produktetIDErr = "Kategorite i detyrueshëm";
} else {
    $cat_produktetID = clean_input($_POST["inputcat_produktet"]);
    if (!preg_match('/^[0-9]+$/', $cat_produktetID)) {
        $validated = false;
        $cat_produktetIDErr = "Lejohen vetëm numra (pa hapësirë)";
    }
    // Check is category exists
    $sqlBrend = "SELECT * FROM cat_produktet WHERE cat_produktetID = '{$cat_produktetID}'";
    $result = $link->query($sqlBrend);
    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            $validated = false;
            $cat_produktetIDErr = "Kategoria nuk egziston";
        }
    } else {
        return false;
    }
}
