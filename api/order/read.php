<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
include_once '../config/database.php';
include_once '../objects/Order.php';
include_once '../objects/OrderLine.php';
include_once '../objects/Dish.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object

// read products will be here
$order = new Order($db);
// query products
if (isset($_GET["idClient"])){
    $stmt = $order->readAll($_GET["idClient"]);
    $num = $stmt->rowCount();
    if($num>0){
        $orders_array = array();
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $order_item = array(
                "id" => $row["idOrder"],
                "dateOrder" => $row["dateOrder"],
                "totalPrice" => $row["totalPrice"],
                "idClient" => $row["idClient"],
                "dishes" => array()
            );
            $order_line = new OrderLine($db);
            $stmtLine = $order_line->readOne($row["idOrder"]);
            while( $rowLine = $stmtLine->fetch(PDO::FETCH_ASSOC) ){
                $dish = new Dish($db);
                $stmtDish = $dish->readOne($rowLine["idDish"]);
                $rowDish = $stmtDish->fetch(PDO::FETCH_ASSOC);
                $dishItem = array(
                    "id" => $rowDish["idDish"],
                    "name" => $rowDish["name"],
                    "description" => $rowDish["description"],
                    "price" => $rowDish["price"],
                    "calories" => $rowDish["calories"],
                    "proteins" => $rowDish["proteins"],
                    "carbs" => $rowDish["carbs"],
                    "imageURL" => $rowDish["imageURL"]
                );
                array_push($order_item["dishes"], $dishItem);
            }
            array_push($orders_array, $order_item);
        }
        http_response_code(200);
        echo json_encode($orders_array);
    }
    else{

        // set response code - 404 Not found
        http_response_code(404);

        // tell the user no products found
        echo json_encode(
            array("message" => "No products found.")
        );
    }
}else {
    http_response_code(404);
    echo json_encode(
        array("message", "No client id provided")
    );
}