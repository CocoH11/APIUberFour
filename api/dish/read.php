<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../config/database.php';
include_once '../objects/Dish.php';

$database = new Database();
$db = $database->getConnection();

$dish = new Dish($db);

$stmt = $dish->readAll();
$num = $stmt->rowCount();
if ($num > 0) {
    $dishes_arr = array();
    $dishes_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $dish_item = array(
            "id" => $row["idDish"],
            "name" => $row["name"],
            "price" => $row["price"],
            "calories" => $row["calories"],
            "proteins" => $row["proteins"],
            "carbs" => $row["carbs"]
        );
        array_push($dishes_arr["records"], $dish_item);
    }
    http_response_code(200);
    echo json_encode($dishes_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No products found.")
    );
}
