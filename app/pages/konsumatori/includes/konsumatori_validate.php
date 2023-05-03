<?php
if (isset($_POST["k_emri"])) {
    if (empty($_POST["k_emri"])) {
        $validated = false;
        $k_emriErr = "Emri i detyrueshëm";
    } else {
        $k_emri = clean_input($_POST["k_emri"]);
        // check if name only contains letters and whitespace
        /* $pattern  = "/^[a-zA-Z\p{Cyrillic}0-9\s\-]+$/u"; */
        if (!preg_match("/^[a-zA-Z\p{Cyrillic} '\s\-]+$/u", $k_emri)) {
            $validated = false;
            $k_emriErr = "Lejohen vetëm shkronja dhe hapësirë";
        }
    }
}

if (isset($_POST["k_mbiemri"])) {
    if (empty($_POST["k_mbiemri"])) {
        $validated = false;
        $mbiemriErr = "Mbiemri i detyrueshëm";
    } else {
        $k_mbiemri = clean_input($_POST["k_mbiemri"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z\p{Cyrillic}\s\-]+$/u", $mbiemri)) {
            $validated = false;
            $k_mbiemriErr = "Lejohen vetëm shkronja dhe hapësirë";
        }
    }
}

if (isset($_POST["firma"])) {
    if (empty($_POST["firma"])) {
        $validated = false;
        $firmaErr = "Firma e detyrueshme";
    } else {
        $firma = clean_input($_POST["firma"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z\p{Cyrillic}0-9' \s\-]+$/u", $firma)) {
            $validated = false;
            $firmaErr = "Lejohen vetëm shkronja numra dhe hapësirë";
        }
    }
}

if (empty($_POST["nr_amez"])) {
    $validated = false;
    $nr_amezErr = "Numri amëz i detyrueshëmm";
} else {
    $nr_amez = clean_input($_POST["nr_amez"]);
    // check if name only contains letters and whitespace
    if (!preg_match('/^[0-9]+$/', $nr_amez)) {
        $validated = false;
        $nr_amezErr = "Lejohen vetëm numra (pa hapësirë)";
    }
    if (strlen($nr_amez) <> 13 && strlen($nr_amez) <> 5) {
        $validated = false;
        $nr_amezErr = "Lejohet vetëm gjatësia e numrit për person fizik deri në 13 shifror dhe person juridik 6 (pa hapësirë)";
    }
}

if (empty($_POST["tip_konsumator"])) {
    $validated = false;
    $tip_konsumatorErr = "Tip i konsumatorit i detyrueshëm";
} else {
    $tip_konsumator = clean_input($_POST["tip_konsumator"]);
}

if (empty($_POST["rruga"])) {
    $validated = false;
    $rrugaErr = "Rruga i detyrueshëm";
} else {
    $rruga = clean_input($_POST["rruga"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z\p{Cyrillic}0-9' \s\-]+$/u", $rruga)) {
        $validated = false;
        $rrugaErr = "Lejohen vetëm shkronja dhe numra";
    }
}

if (empty($_POST["fshati"])) {
    $validated = false;
    $fshatiErr = "fshati i detyrueshëm";
} else {
    $fshati = clean_input($_POST["fshati"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z\p{Cyrillic}0-9' \s\-]+$/u", $fshati)) {
        $validated = false;
        $fshatiErr = "Lejohen vetëm shkronja dhe numra";
    }
}

if (empty($_POST["komuna"])) {
    $validated = false;
    $komunaErr = "komuna i detyrueshëm";
} else {
    $komuna = clean_input($_POST["komuna"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z\p{Cyrillic}0-9' \s\-]+$/u", $komuna)) {
        $validated = false;
        $komunaErr = "Lejohen vetëm shkronja dhe numra";
    }
}

if (empty($_POST["qyteti"])) {
    $validated = false;
    $qytetiErr = "Qyteti i detyrueshëm";
} else {
    $qyteti = clean_input($_POST["qyteti"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z\p{Cyrillic}0-9' \s\-]+$/u", $qyteti)) {
        $validated = false;
        $qytetiErr = "Lejohen vetëm shkronja dhe numra";
    }
}

if (empty($_POST["shteti"])) {
    $validated = false;
    $shtetiErr = "Shteti i detyrueshëm";
} else {
    $shteti = clean_input($_POST["shteti"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z\p{Cyrillic}\s\-]+$/u", $shteti)) {
        $validated = false;
        $shtetiErr = "Lejohen vetëm shkronja (pa hapësirë)";
    }
}

if (empty($_POST["adresa_perkohshme"])) {
    // $validated = false;
    // $adresa_perkohshmeErr = "Adresae perkohshme e detyreshme";
} else {
    $adresa_perkohshme = clean_input($_POST["adresa_perkohshme"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z\p{Cyrillic}0-9' \s\-]+$/u", $adresa_perkohshme)) {
        $validated = false;
        $adresa_perkohshmeErr = "Lejohen vetëm shkronja dhe numra";
    }
}

if (empty($_POST["mobil"])) {
    // $validated = false;
    // $mobilErr = "Mobil i detyrueshem";
} else {
    $mobil = clean_input($_POST["mobil"]);
    // check if name only contains letters and whitespace
    if (!preg_match('/^[0-9]+$/', $mobil)) {
        $validated = false;
        $mobilErr = "Lejohen vetëm numra (pa hapësirë)";
    }
}

if (empty($_POST["email"])) {
    $email = "";
} else {
    $email = clean_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validated = false;
        $emailErr = "Format jo valid për e-mail";
    }
}
