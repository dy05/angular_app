<?php
/**
 * Returns the list of policies.
 */
require 'database.php';

// Extract, validate and sanitize the id.
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id) {
    $item = getItem($id, true);

    if(!$item) {
        return http_response_code(400);
    }

    echo json_encode($item);
    return;
}

$policies = [];
$sql = "SELECT id, number, amount FROM policies";

if($result = mysqli_query($con,$sql)) {
    $i = 0;
    while($row = mysqli_fetch_assoc($result)) {
        $policies[$i]['id']    = $row['id'];
        $policies[$i]['number'] = $row['number'];
        $policies[$i]['amount'] = $row['amount'];
        $i++;
    }

    echo json_encode($policies);
} else {
    return http_response_code(404);
}
