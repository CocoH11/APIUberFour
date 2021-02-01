<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../config/database.php';
include_once '../objects/Dish.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$dish = new Dish($db);

// read products will be here

// query products
$stmt = $dish->readAll();
$num = $stmt->rowCount();
if($num>0){
    $dishes_arr=array();
    $dishes_arr["records"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $dish_item=array(
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
}
else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}