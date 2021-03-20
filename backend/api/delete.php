<?php

require 'database.php';

// Extract, validate and sanitize the id.
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$item = getItem($id);

if(!$item) {
    return http_response_code(400);
}

// Delete.
$sql = "DELETE FROM `policies` WHERE `id` ='{$id}' LIMIT 1";

if(mysqli_query($con, $sql)) {
    return http_response_code(204);
} else {
    return http_response_code(422);
}
