<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
include_once '../config/database.php';
include_once '../objects/Client.php';

$database = new Database();
$db = $database->getConnection();

$client = new Client($db);
if (isset($_GET['id'])){
    $client->setIdClient($_GET['id']);
    $stmt = $client->readOne();
    $num = $stmt->rowCount();
    if ($num > 0) {
        $clients_arr = array();
        $clients_arr["records"] = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $client_item = array(
                "idClient" => $row["idClient"],
                "firstName" => $row["firstName"],
                "lastName" => $row["lastName"],
                "email" => $row["email"],
                "dateOfBirth" => $row["dateOfBirth"],
            );
            array_push($clients_arr["records"], $client_item);
        }
        http_response_code(200);
        echo json_encode($clients_arr);
    }
    else {
        http_response_code(404);
        echo json_encode(
            array("message" => "No client found.")
        );
    }
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No client found.")
    );
}