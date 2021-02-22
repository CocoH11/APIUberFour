<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../config/database.php';
include_once '../objects/Dish.php';

$database = new Database();
$db = $database->getConnection();

$dish = new Dish($db);
if (isset($_GET['id'])){
    $stmt = $dish->readOne($_GET['id']);
    $num = $stmt->rowCount();

    if ($num != 1){
        $dishes_array = array();
        $row = $stmt->fecth(PDO::FETCH_ASSOC);

        $dish_item = array(
            "id" => $row["idDish"],
            "name" => $row["name"],
            "description" => $row["description"],
            "price" => $row["price"],
            "calories" => $row["calories"],
            "proteins" => $row["proteins"],
            "carbs" => $row["carbs"],
            "imageURL" => $row["imageURL"]
        );
        array_push($dishes_array, $dish_item);

        http_response_code(200);
        echo json_encode($dishes_array);
    } else {
        http_response_code(404);

        echo json_encode(
            array("message"=>"No products found")
        );
    }
} else {
    http_response_code(404);

    echo json_encode(
        array("message" => "No products found")
    );
}
