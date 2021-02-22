<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/Order.php';
include_once '../objects/OrderLine.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);
$data = json_decode(file_get_contents("php://input"));
if (
    !empty($data->dateOrder) &&
    !empty($data->totalPrice) &&
    !empty($data->idClient) &&
    !empty($data->dishes)
) {
    $order->setDateOrder($data->dateOrder);
    $order->setTotal($data->totalPrice);
    $order->setIdClient($data->idClient);
    $isOrderCreated = $order->create();
    if ($isOrderCreated){
        $order_id = $db->lastInsertId();
        foreach ($data->dishes as $dish_id){
            $line = new OrderLine($db);
            $line->setIdOrder($order_id);
            var_dump("order_id =" . $order_id);
            var_dump("dish_id =" . $dish_id);
            $line->setIdDish($dish_id);
            $line->create();
        }
        if ($isOrderCreated) {
            http_response_code(201);
            echo json_encode(array("message" => "Order was created."));

        } else {
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create order."));
        }
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}