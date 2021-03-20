<?php
require 'database.php';

// Extract, validate and sanitize the id.
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if(!$id) {
    return http_response_code(400);
}

$item = getItem($id);
if(!$item) {
    return http_response_code(400);
}

// Get the posted data.
$postdata = file_get_contents("php://input");

$is_post = false;

if (empty($postdata)) {
    $is_post = true;
    $postdata = $_POST;
}

if(isset($postdata) && !empty($postdata)) {
    // Extract the data.
    if ($is_post) {
        $request = new stdClass();
        $request->number = $postdata['number'];
        $request->amount = $postdata['amount'];
    } else {
        $request = json_decode($postdata);
    }

    // Validate.
    if(trim($request->number) === '' || (float)$request->amount < 0) {
        return http_response_code(400);
    }

    // Sanitize.
    $number = mysqli_real_escape_string($con, trim($request->number));
    $amount = mysqli_real_escape_string($con, (float)$request->amount);

    // Update.
    $sql = "UPDATE `policies` SET `number`='$number',`amount`='$amount' WHERE `id` = '{$id}'";

    if(mysqli_query($con, $sql)) {
        $policy = [
            'id'    => $id,
            'number' => $number,
            'amount' => $amount
        ];

        echo json_encode($policy);
        return;
    } else {
        return http_response_code(422);
    }
}
