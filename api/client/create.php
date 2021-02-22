<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/Client.php';

$database = new Database();
$db = $database->getConnection();
$client = new Client($db);
$data = json_decode(file_get_contents("php://input"));
if (
    !empty($data->firstName) &&
    !empty($data->lastName) &&
    !empty($data->email) &&
    !empty($data->dateOfBirth)
) {
    $client->setFirstName($data->firstName);
    $client->setLastName($data->lastName);
    $client->setEmail($data->email);
    $client->setDateOfBirth($data->dateOfBirth);
    $client->setImageURL("image not found");
    $client->setExtraNapKins(false);
    $client->setFrequentRefill(false);

    if ($client->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Client was created."));
    }
    else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create client."));
    }
}
else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
