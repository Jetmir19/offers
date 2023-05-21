<?php
// Global configuration
require_once "../../../config/config.php";

// Database Connection
require_once DB_PATH . '/connect.php';

// Get the ID and quantity values from the query string
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $cartId = $_GET["cartId"];
    $sasia = $_GET["sasia"];
    $c_vlera_pa_tvsh = $_GET["cvptTotal"];
    $c_vlera_e_tvsh = $_GET["cvetTotal"];
    $c_vlera_me_tvsh = $_GET["cvmetTotal"];

    // echo json_encode([
    //     $cartId,
    //     $sasia,
    //     $c_vlera_pa_tvsh
    // ]);
    // exit;

    // Prepare and bind the update statement using prepared statements
    $stmt = DBLINK->prepare(
        "UPDATE cart SET c_sasia = ?, c_vlera_pa_tvsh = ?, c_vlera_e_tvsh = ?, c_vlera_me_tvsh = ? 
        WHERE cart_ID = ?"
    );
    $stmt->bind_param(
        "iiiii",
        $sasia,
        $c_vlera_pa_tvsh,
        $c_vlera_e_tvsh,
        $c_vlera_me_tvsh,
        $cartId,
    );

    if ($stmt->execute()) {
        $response = array("status" => "success", "message" => "Cart sasia updated successfully.");
        echo json_encode($response);
    } else {
        $response = array("status" => "error", "message" => "Error updating Cart Sasia: " . DBLINK->error);
        echo json_encode($response);
    }
}
