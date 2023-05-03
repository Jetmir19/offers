<?php
// Global configuration
require_once "../../../config/config.php";

// Database Connection
require_once DB_PATH . '/connect.php';

// Get the ID and quantity values from the query string
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $cartId = $_GET["cartId"];
    $sasia = $_GET["sasia"];

    // echo json_encode([$cartId, $sasia]);
    // exit;

    // Prepare and bind the update statement using prepared statements
    $stmt = LINK->prepare("UPDATE cart SET c_sasia = ? WHERE cart_ID = ?");
    $stmt->bind_param("ii", $sasia, $cartId);

    if ($stmt->execute()) {
        $response = array("status" => "success", "message" => "Cart sasia updated successfully.");
        echo json_encode($response);
    } else {
        $response = array("status" => "error", "message" => "Error updating Cart Sasia: " . LINK->error);
        echo json_encode($response);
    }
}
