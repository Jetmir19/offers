<?php

// Get a Global config
//------------------------------------------------------------
function getKonfigurime($id)
//------------------------------------------------------------
{
  $sql = "SELECT * FROM konfigurime
          WHERE konfigurimeID = $id";

  // @TODO: add row in database is deleted.

  $result = DBLINK->query($sql);

  if ($result) {
    $row = $result->fetch_assoc();

    return $row;
  }

  return false;
}

// Get all Produktet
//------------------------------------------------------------
function getProduktet()
//------------------------------------------------------------
{
  $sql = "SELECT * FROM produktet
          WHERE isDeleted = 0";
  $result = DBLINK->query($sql);

  if ($result) {
    $row = $result->fetch_all(MYSQLI_ASSOC);

    return $row;
  }
  return false;
}

// Get all Produktet
//------------------------------------------------------------
function getCartItems()
//------------------------------------------------------------
{
  $sql = "SELECT * FROM cart
          WHERE isDeleted = 0";
  $result = DBLINK->query($sql);

  if ($result) {
    $row = $result->fetch_all(MYSQLI_ASSOC);

    return $row;
  }
  return false;
}

// Get all Furnitoret
//------------------------------------------------------------
function getFurnitoret()
//------------------------------------------------------------
{
  $sql = "SELECT * FROM furnitoret
          WHERE isDeleted = 0";
  $result = DBLINK->query($sql);

  if ($result) {
    $row = $result->fetch_all(MYSQLI_ASSOC);

    return $row;
  }

  return false;
}

// Get all Njesit
//------------------------------------------------------------
function getNjesit()
//------------------------------------------------------------
{
  $sql = "SELECT * FROM njesit
          WHERE isDeleted = 0";
  $result = DBLINK->query($sql);

  if ($result) {
    $row = $result->fetch_all(MYSQLI_ASSOC);

    return $row;
  }

  return false;
}

// Get all Brends
//------------------------------------------------------------
function getCatProduktet()
//------------------------------------------------------------
{
  $sql = "SELECT * FROM produktet_cat
          WHERE isDeleted = 0";
  $result = DBLINK->query($sql);

  if ($result) {
    $row = $result->fetch_all(MYSQLI_ASSOC);

    return $row;
  }

  return false;
}

// Get Konsumatori  
//------------------------------------------------------------
function getKonsumatoret()
//------------------------------------------------------------
{
  $sql = "SELECT * FROM konsumatoret 
          WHERE isDeleted = 0";
  $result = DBLINK->query($sql);

  if ($result) {
    $row = $result->fetch_all(MYSQLI_ASSOC);

    return $row;
  }

  return false;
}

// Get Konsumatori by ID
//------------------------------------------------------------
function getKonsumatoriById($id)
//------------------------------------------------------------
{
  $sql = "SELECT * FROM konsumatoret 
          WHERE konsumatorID = '{$id}'
          AND isDeleted = 0";
  $result = DBLINK->query($sql);

  if ($result) {
    $row = $result->fetch_assoc();

    return $row;
  }

  return false;
}

// Get a Konsumator full Name 
//------------------------------------------------------------
function getKonsumatorFullName($id)
//------------------------------------------------------------
{
  $sql = "SELECT konsumatorID, k_emri, k_mbiemri, isDeleted FROM konsumatoret 
          WHERE konsumatorID = '$id'
          AND isDeleted = 0";
  $result = DBLINK->query($sql);

  if ($result) {
    $row = $result->fetch_assoc();

    return $row['k_emri'] . " " . $row['k_mbiemri'];
  }

  return false;
}

// Get all stafi
//------------------------------------------------------------
function getStafi()
//------------------------------------------------------------
{
  $sql = "SELECT * FROM stafi
          WHERE isDeleted = 0
          ORDER BY dateCreated DESC";
  $result = DBLINK->query($sql);

  if ($result) {
    $row = $result->fetch_all(MYSQLI_ASSOC);

    return $row;
  }

  return false;
}

// Get a single stafi
//------------------------------------------------------------
function getStafiById($id)
//------------------------------------------------------------
{
  $sql = "SELECT * FROM stafi 
          WHERE stafiID = '$id'
          AND isDeleted = 0";
  $result = DBLINK->query($sql);

  if ($result) {
    $row = $result->fetch_assoc();

    return $row;
  }

  return false;
}

// Get a single njesi
//------------------------------------------------------------
function getNjesiById($id)
//------------------------------------------------------------
{
  $sql = "SELECT * FROM njesit 
          WHERE njesiID = '$id'
          AND isDeleted = 0";
  $result = DBLINK->query($sql);

  if ($result) {
    $row = $result->fetch_assoc();

    return $row;
  }

  return false;
}

// Get all Ofertat by fatura_printID
//------------------------------------------------------------
function getOfertatPrint($fatura_printID)
//------------------------------------------------------------
{
  $sql = "SELECT * FROM oferte_fature 
  LEFT JOIN konsumatoret ON oferte_fature.konsumatorID = konsumatoret.konsumatorID
  RIGHT JOIN stafi ON oferte_fature.stafiID = stafi.stafiID
   WHERE oferte_fature.oferte_fatureID='$fatura_printID' 
   AND oferte_fature.isDeleted = '0'";
  $result = DBLINK->query($sql);

  if ($result) {
    $row = $result->fetch_assoc();

    return $row;
  }

  return false;
}

// Get all Artikujt for the Print
//------------------------------------------------------------
function getArtikujtPrint($fatura_printID)
//------------------------------------------------------------
{
  $sql = "SELECT * FROM oferte_fature_items
          INNER JOIN konsumatoret ON oferte_fature_items.konsumatorID = konsumatoret.konsumatorID
          LEFT JOIN oferte_fature ON oferte_fature_items.a_oferte_fatureID = oferte_fature.oferte_fatureID
          WHERE  oferte_fature_items.a_oferte_fatureID ='$fatura_printID'
          AND oferte_fature_items.isDeleted='0'";
  $result = DBLINK->query($sql);

  if ($result) {
    $row = $result->fetch_all(MYSQLI_ASSOC);

    return $row;
  }

  return false;
}

// Get all Historia
//------------------------------------------------------------
function getHistoria()
//------------------------------------------------------------
{
  $sql = "SELECT * FROM historia
          WHERE isDeleted = 0
          ORDER BY dateCreated DESC";
  $result = DBLINK->query($sql);

  if ($result) {
    $row = $result->fetch_all(MYSQLI_ASSOC);

    return $row;
  }

  return false;
}

// Get a single Historia
//------------------------------------------------------------
function getHistoriaById($id)
//------------------------------------------------------------
{
  $sql = "SELECT * FROM historia 
          WHERE historiaID = '$id'
          AND isDeleted = 0";
  $result = DBLINK->query($sql);

  if ($result) {
    $row = $result->fetch_assoc();

    return $row;
  }

  return false;
}

// Insert Historia
//------------------------------------------------------------
function saveHistoria($action, $module, $message, $hstatusi)
//------------------------------------------------------------
{
  // Prepare an insert statement
  $sql = "INSERT INTO historia (stafiID, action, module, message, hstatusi) 
          VALUES ('{$_SESSION['stafiID']}', '{$action}', '{$module}', '{$message}', '{$hstatusi}')";
  $result = DBLINK->query($sql);

  if ($result) {
    return true;
  }

  return false;
}

// Upload Logo function for Konfigurime
//------------------------------------------------------------
function uploadKonfigurimeLogo($files, $inputId, $folder)
//------------------------------------------------------------
{
  $output = "";

  // Logo Upload
  if (isset($files[$inputId]) && !empty($files[$inputId]["name"])) {
    // Get actual logo
    $row = getKonfigurime(1);
    if ($row) {
      $actual_logo = UPLOADS_PATH . "/" . $folder . "/" . $row[$inputId];

      // Remove existing logo
      $dir = UPLOADS_PATH . "/konfigurime/";
      foreach (glob($dir . '*.*') as $v) {
        if ($v === $actual_logo) {
          @unlink($v);
        }
      }
    }

    // Check if file was uploaded without errors
    if ($files[$inputId]["error"] == 0) {
      $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
      $filename = $files[$inputId]["name"];
      $filetype = $files[$inputId]["type"];
      $filesize = $files[$inputId]["size"];
      $files_ext = pathinfo($filename, PATHINFO_EXTENSION);

      // Verify file extension
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      if (!array_key_exists($ext, $allowed)) {
        $output = "Error: Please select a valid file format.";
      }

      // Verify file size - 5MB maximum
      $maxsize = 5 * 1024 * 1024;
      if ($filesize > $maxsize) {
        $output = "Error: File size is larger than the allowed limit.";
      }

      // Verify MYME type of the file
      if (in_array($filetype, $allowed)) {
        // Rename file
        $filename = uniqid() . "." . $files_ext;
        // Start upload
        move_uploaded_file($files[$inputId]["tmp_name"], UPLOADS_PATH . "/" . $folder . "/" . $filename);
        $output = "success";
      } else {
        $output = "Error: There was a problem uploading your file. Please try again.";
      }
    } else {
      $output = "Error: " . $files[$inputId]["error"];
    }

    return [$output, $filename];
  } else {
    return [null, null];
  }
}

// Upload Image function for Stafi
//------------------------------------------------------------
function uploadStafiImage($files, $folder, $stafiID = null)
//------------------------------------------------------------
{
  $output = "";

  if (isset($files["image"]) && !empty($files["image"]["name"])) {
    // Get actual stafi image
    $row = getStafiById($stafiID);
    if ($row) {
      $actual_image = UPLOADS_PATH . "/" . $folder . "/" . $row['image'];

      // Remove existing image
      $dir = UPLOADS_PATH . "/stafi/";
      foreach (glob($dir . '*.*') as $v) {
        if ($v === $actual_image) {
          @unlink($v);
        }
      }
    }

    // Check if file was uploaded without errors
    if ($files["image"]["error"] == 0) {
      $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
      $filename = $files["image"]["name"];
      $filetype = $files["image"]["type"];
      $filesize = $files["image"]["size"];
      $files_ext = pathinfo($filename, PATHINFO_EXTENSION);

      // Verify file extension
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      if (!array_key_exists($ext, $allowed)) {
        $output = "Error: Please select a valid file format.";
      }

      // Verify file size - 5MB maximum
      $maxsize = 5 * 1024 * 1024;
      if ($filesize > $maxsize) {
        $output = "Error: File size is larger than the allowed limit.";
      }

      // Verify MYME type of the file
      if (in_array($filetype, $allowed)) {
        // Rename file
        $filename = uniqid() . "." . $files_ext;
        // Start Upload
        move_uploaded_file($files["image"]["tmp_name"], UPLOADS_PATH . "/" . $folder . "/" . $filename);
        $output = "success";
      } else {
        $output = "Error: There was a problem uploading your file. Please try again.";
      }
    } else {
      $output = "Error: " . $files["image"]["error"];
    }

    return [$output, $filename];
  } else {
    return [null, null];
  }
}
