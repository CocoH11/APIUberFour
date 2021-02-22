<?php


class OrderLine
{
    private $conn;
    private $table_name = "orders_lines";

    public $idOrder;
    public $idDish;
    public $quantity;

    public function __construct($database)
    {
        $this->conn = $database;
    }

    public function readOne($idOrder){
        $query = "SELECT `idOrder`, `idDish` FROM " . $this->table_name . " WHERE `idOrder` = " . $idOrder;
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }

    public function create(){
        $query = "INSERT INTO " . $this->table_name . " SET `idOrder` =:idOrder, `idDish` =:idDish" ;
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->idOrder=htmlspecialchars(strip_tags($this->idOrder));
        $this->idDish=htmlspecialchars(strip_tags($this->idDish));
        $stmt->bindParam(":idOrder", $this->idOrder);
        $stmt->bindParam(":idDish", $this->idDish);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getIdOrder()
    {
        return $this->idOrder;
    }

    /**
     * @param mixed $idOrder
     */
    public function setIdOrder($idOrder)
    {
        $this->idOrder = $idOrder;
    }

    /**
     * @return mixed
     */
    public function getIdDish()
    {
        return $this->idDish;
    }

    /**
     * @param mixed $idDish
     */
    public function setIdDish($idDish)
    {
        $this->idDish = $idDish;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }


}