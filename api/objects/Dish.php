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


}