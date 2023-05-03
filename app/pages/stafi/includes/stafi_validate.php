<?php
// Validate emri
if (empty(trim($_POST["emri"]))) {
    $validated = false;
    $emri_err = "Emri i detyrueshëm";
} else {
    $emri = clean_input($_POST["emri"]);
    if (!preg_match("/^[a-zA-Z\p{Cyrillic}0-9' \s\-]+$/u", $emri)) {
        $validated = false;
        $emri_err = "Lejohen vetëm shkronja dhe numra";
    }
}

// Validate mbiemri
if (empty(trim($_POST["mbiemri"]))) {
    $validated = false;
    $mbiemri_err = "Mbiemri i detyrueshëm";
} else {
    if (!preg_match("/^[a-zA-Z\p{Cyrillic}0-9' \s\-]+$/u", $mbiemri)) {
        $validated = false;
        $mbiemri_err = "Lejohen vetëm shkronja dhe numra";
    }
}

// Validate titulli
if (empty(trim($_POST["titulli"]))) {
    $validated = false;
    $titulli_err = "Ju lutemi jepni titullin  ose pozicionin e stafit.";
} else {
    $titulli = clean_input($_POST["titulli"]);
}

// **** INSERT Validation ****
// Validate emriperdorues
if (isset($_POST["emriperdorues"])) {
    if (empty(trim($_POST["emriperdorues"]))) {
        $validated = false;
        $emriperdorues_err = "Ju lutemi jepni emrin përdorues.";
    } else {
        $emriperdorues = clean_input($_POST["emriperdorues"]);
        $sql = "SELECT emriperdorues, isDeleted FROM stafi 
                WHERE emriperdorues = '$emriperdorues'
                AND isDeleted = 0";
        if ($result = mysqli_query($link, $sql)) {
            if (mysqli_num_rows($result) >= 1) {
                $validated = false;
                $emriperdorues_err = "Ky përdorues tashmë ekziston";
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
}
// Validate fjalekalimi
if (isset($_POST["fjalekalimi"])) {
    if (empty(trim($_POST["fjalekalimi"]))) {
        $validated = false;
        $fjalekalimi_err = "Ju lutemi jepni fjalëkalimin.";
    } elseif (strlen(trim($_POST["fjalekalimi"])) < 6) {
        $validated = false;
        $fjalekalimi_err = "Fjalëkalimi duhet të ketë më së paku 6 karaktere.";
    } else {
        $fjalekalimi = clean_input($_POST["fjalekalimi"]);
    }
}
// Validate confirm fjalekalimi
if (isset($_POST["confirm_fjalekalimi"])) {
    if (empty(trim($_POST["confirm_fjalekalimi"]))) {
        $validated = false;
        $confirm_fjalekalimi_err = "Ju lutemi, vërteto fjalëkalimin.";
    } else {
        $confirm_fjalekalimi = clean_input($_POST["confirm_fjalekalimi"]);
        if (empty($fjalekalimi_err) && ($fjalekalimi != $confirm_fjalekalimi)) {
            $validated = false;
            $confirm_fjalekalimi_err = "Fjalëkalimi nuk përputhet.";
        }
    }
}

// **** EDIT Validation ****
// Validate update_emriperdorues
if (isset($_POST["update_emriperdorues"])) {
    if (empty(trim($_POST["update_emriperdorues"]))) {
        $validated = false;
        $update_emriperdorues_err = "Ju lutemi jepni emrin përdorues.";
    } else {
        $update_emriperdorues = clean_input($_POST["update_emriperdorues"]);
        $sql = "SELECT emriperdorues, isDeleted FROM stafi 
            WHERE stafiID != $stafiID
            AND emriperdorues = '$update_emriperdorues'
            AND isDeleted = 0";
        if ($result = mysqli_query($link, $sql)) {
            if (mysqli_num_rows($result) >= 1) {
                $validated = false;
                $update_emriperdorues_err = "Ky përdorues tashmë ekziston";
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
}
// Validate update_fjalekalimi
if (isset($_POST["update_fjalekalimi"]) && isset($_POST["update_confirm_fjalekalimi"])) {
    if ($_POST["update_fjalekalimi"] != "" || $_POST["update_confirm_fjalekalimi"] != "") {
        if (empty(trim($_POST["update_fjalekalimi"]))) {
            $validated = false;
            $update_fjalekalimi_err = "Ju lutemi jepni fjalëkalimin.";
        } elseif (strlen(trim($_POST["update_fjalekalimi"])) < 6) {
            $validated = false;
            $update_fjalekalimi_err = "Fjalëkalimi duhet të ketë më së paku 6 karaktere.";
        } else {
            $update_fjalekalimi = clean_input($_POST["update_fjalekalimi"]);
        }

        // Validate update_confirm_fjalekalimi
        if (empty(trim($_POST["update_confirm_fjalekalimi"]))) {
            $validated = false;
            $update_confirm_fjalekalimi_err = "Ju lutemi, vërteto fjalëkalimin.";
        } else {
            $update_confirm_fjalekalimi = clean_input($_POST["update_confirm_fjalekalimi"]);
            if (empty($update_fjalekalimi_err) && ($update_fjalekalimi != $update_confirm_fjalekalimi)) {
                $validated = false;
                $update_fjalekalimi_err = "Fjalëkalimi nuk përputhet.";
                $update_confirm_fjalekalimi_err = "Fjalëkalimi nuk përputhet.";
            }
        }
    }
}

// Validate data_punesimit
if (empty(trim($_POST["data_punesimit"]))) {
    $validated = false;
    $data_punesimit_err = "Ju lutemi shtoni datën e punësimit të stafit.";
} else {
    $data_punesimit = clean_input($_POST["data_punesimit"]);
}

// @TODO: Validate email...
// @TODO: Validate komment...
