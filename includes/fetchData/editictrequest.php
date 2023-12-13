<?php
$page = "Response Page";

// requires
require_once '../conn.php';

session_start();

$response = array();

if (isset($_GET['EditICTRequest'])) {
    $id = $conn->real_escape_string($_GET['id']);

    $query = "SELECT * FROM helpdesks WHERE id=?";
    $result = $conn->execute_query($query, [$id]);

    while ($row = $result->fetch_object()) {
        $response = $row;
    }
}

$responseJSON = json_encode($response);

echo $responseJSON;
