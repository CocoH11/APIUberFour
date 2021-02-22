<?php


class Dish
{
    private $conn;
    private $table_name = "dishes";

    private $idDish;
    private $name;
    private $description;
    private $price;
    private $calories;
    private $proteins;
    private $carbs;
    private $imageURL;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function readOne($id){
        $query = "SELECT * FROM " .$this->table_name . " WHERE `idDish` = " . $id;
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }

    public function readAll(){
        $query = "SELECT `idDish`, `name`, `description`, `price`, `calories`, `proteins`, `carbs`, `imageURL` FROM " . $this->table_name . " ORDER BY `name`";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }


}