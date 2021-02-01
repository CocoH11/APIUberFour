<?php


class Dish
{
    private $conn;
    private $table_name = "dishes";

    private $idDish;
    private $name;
    private $price;
    private $calories;
    private $proteins;
    private $carbs;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function readAll(){
        $query = "SELECT `idDish`, `name`, `price`, `calories`, `proteins`, `carbs` FROM " . $this->table_name . " ORDER BY `name`";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }


}