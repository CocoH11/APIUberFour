<?php


class Order
{
    private $conn;
    private $table_name = "orders";

    public $id;
    public $date;
    public $total;
    public $idClient;

    public function __construct($db){
        $this->conn = $db;
    }


}