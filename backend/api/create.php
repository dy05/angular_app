<?php
require 'database.php';

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
    $amount = mysqli_real_escape_string($con, (int)$request->amount);


    // Create.
    $sql = "INSERT INTO `policies`(`id`,`number`,`amount`) VALUES (null,'{$number}','{$amount}')";

    if(mysqli_query($con,$sql)) {
        http_response_code(201);

        $policy = [
            'number' => $number,
            'amount' => $amount,
            'id'    => mysqli_insert_id($con)
        ];

        echo json_encode($policy);
        return;
    } else {
        return http_response_code(422);
    }
}
