<?php
// Escape user inputs for security
$fshati = mysqli_real_escape_string($link, $_POST['fshati']);
$komuna = mysqli_real_escape_string($link, $_POST['komuna']);
$qyteti = mysqli_real_escape_string($link, $_POST['qyteti']);
$shteti = mysqli_real_escape_string($link, $_POST['shteti']);
$kontakt_person = mysqli_real_escape_string($link, $_POST['kontakt_person']);
$mobil = mysqli_real_escape_string($link, $_POST['mobil']);
$email = mysqli_real_escape_string($link, $_POST['email']);
$web = mysqli_real_escape_string($link, $_POST['web']);
$njesia = mysqli_real_escape_string($link, $_POST['njesia']);
$valuta = mysqli_real_escape_string($link, $_POST['valuta']);
$tvsh = mysqli_real_escape_string($link, $_POST['tvsh']);
$tvsh2 = mysqli_real_escape_string($link, $_POST['tvsh2']);
$banka = mysqli_real_escape_string($link, $_POST['banka']);
$xhirollogaria = mysqli_real_escape_string($link, $_POST['xhirollogaria']);
$tekst = mysqli_real_escape_string($link, $_POST['tekst']);
$tekst2 = mysqli_real_escape_string($link, $_POST['tekst2']);
// $logo1 = mysqli_real_escape_string($link, $_POST['logo1']);
// $logo2 = mysqli_real_escape_string($link, $_POST['logo2']);

if (empty($_POST["fshati"])) {
    $validated = false;
    $fshatiErr = "Fshati është i detyrueshëm";
} else {
    $fshati = clean_input($_POST["fshati"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z\p{Cyrillic}\p{L} '\s\-]+$/u", $fshati)) {

        $validated = false;
        $fshatiErr = "Lejohen vetëm shkronja dhe hapësirë e shprazët";
    }
}

if (empty($_POST["komuna"])) {
    $validated = false;
    $komunaErr = "Komuna është e domosdoshme";
} else {
    $komuna = clean_input($_POST["komuna"]);
    // check if name only contains letters and whitespace
    // if (!preg_match('/^[0-9]+$/', $komuna)) 
    if (!preg_match("/^[a-zA-Z\p{Cyrillic} '\s\-]+$/u", $komuna)) {
        $validated = false;
        $komunaErr = "Lejohen vetëm tekst numra dhe hapësirë e shprazët";
    }
}

if (empty($_POST["qyteti"])) {
    $validated = false;
    $qytetiErr = "Qyteti është i detyrueshëm";
} else {
    $qyteti = clean_input($_POST["qyteti"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z\p{Cyrillic}\s\-]+$/u", $qyteti)) {
        $validated = false;
        $qytetiErr = "Lejohen vetëm shkronja dhe shprazëtirë";
    }
}

if (empty($_POST["shteti"])) {
    $validated = false;
    $shtetiErr = "Shteti është i detyrueshëm";
} else {
    $shteti = clean_input($_POST["shteti"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z\p{Cyrillic}0-9' \s\-]+$/u", $shteti)) {
        $validated = false;
        $shtetiErr = "Lejohen vetëm shkronja dhe numra";
    }
}

if (empty($_POST["kontakt_person"])) {
    $validated = false;
    $kontakt_personErr = "Kontakt person është i detyrueshëm";
} else {
    $kontakt_person = clean_input($_POST["kontakt_person"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z\p{Cyrillic}'0-9' \s\-]+$/u", $kontakt_person)) {
        $validated = false;
        $kontakt_personErr = "Lejohen vetëm shkronja dhe numra";
    }
}

if (empty($_POST["mobil"])) {
    $validated = false;
    $mobilErr = "Mobil është i detyrueshëm";
} else {
    $mobil = clean_input($_POST["mobil"]);
    // check if name only contains letters and whitespace
    if (!preg_match('/^[0-9]+$/', $mobil)) {
        $validated = false;
        $mobilErr = "Lejohen vetëm numra";
    }
}

if (empty($_POST["email"])) {
    $email = "";
} else {
    $email = clean_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validated = false;
        $emailErr = "Format jo valid për E-mail";
    }
}

if (empty($_POST["web"])) {
    $webErr = "";
} else {
    $web = clean_input($_POST["web"]);
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $web)) {
        $validated = false;
        $webErr = "Format jo valid për Ueb";
    }
}





if (empty($_POST["njesia"])) {
    $njesiaErr = "";
} else {
    $njesia = clean_input($_POST["njesia"]);
    // // check if name only contains letters and whitespace
    // if (!preg_match('/^[0-9]+$/', $njesia)) {
    //     $validated = false;
    //     $njesiaErr = "Дозволени се само броеви (без простор)";
    // }
}

if (empty($_POST["valuta"])) {
    $validated = false;
    $valutaErr = "Valuta është e domosdoshme";
} else {
    $valuta = clean_input($_POST["valuta"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z\p{Cyrillic}\s\-]+$/u", $valuta)) {
        $validated = false;
        $valutaErr = "Lejohen vetëm shkronja dhe hapësirë e shprazët";
    }
}

if (empty($_POST["tvsh"])) {
    $tvshErr = "";
} else {
    $tvsh = clean_input($_POST["tvsh"]);
    // check if name only contains letters and whitespace
    if (!preg_match('/^[\-+]?[0-9]*\.*\,?[0-9]+$/', $tvsh)) {
        $validated = false;
        $tvshErr = "Për TVSH vendosni vlerë min. 1%";
    }
}

if (empty($_POST["tvsh2"])) {
    $tvsh2Err = "";
} else {
    $tvsh2 = clean_input($_POST["tvsh2"]);
    // check if name only contains letters and whitespace
    if (!preg_match('/^[\-+]?[0-9]*\.*\,?[0-9]+$/', $tvsh2)) {
        $validated = false;
        $tvsh2Err = "Për TVSH 2 vendosni vlerë min. 1%";
    }
}

if (empty($_POST["banka"])) {
    $bankaErr = "";
} else {
    $banka = clean_input($_POST["banka"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z\p{Cyrillic} '\s\-]+$/i",  $banka)) {
        $validated = false;
        $bankaErr = "Lejohen vetëm shkronja dhe hapësirë e shprazët";
    }
}

if (empty($_POST["xhirollogaria"])) {
    $xhirollogariaErr = "";
} else {
    $xhirollogaria = clean_input($_POST["xhirollogaria"]);
    // check if name only contains letters and whitespace
    if (!preg_match('/^[0-9]+$/', $xhirollogaria)) {
        $validated = false;
        $xhirollogariaErr = "Lejohen vetëm numra pa hapësirë e shprazët";
    }
}

if (empty($_POST["tekst"])) {
    $validated = false;
    $tekstErr = "Tekst i detyrueshëm";
} else {
    $tekst = clean_input($_POST["tekst"]);
}

if (empty($_POST["tekst2"])) {
    $validated = false;
    $tekst2Err = "Tekst 2 i detyrueshëm";
} else {
    $tekst2 = clean_input($_POST["tekst2"]);
}

// if (empty($_POST["logo1"])) {
//     $validated = false;
//     $logo1Err = "logo1 i detyrueshëm";
// }

// if (empty($_POST["logo2"])) {
//     $validated = false;
//     $logo2Err = "logo2 i detyrueshëm";
// } 
