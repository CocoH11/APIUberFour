<?php


class Order
{
    private $conn;
    private $table_name = "orders";

    public $id;
    public $dateOrder;
    public $total;
    public $idClient;

    public function __construct($db){
        $this->conn = $db;
    }

    public function readAll($idClient){
        $query = "SELECT `idOrder`, `dateOrder`, `totalPrice`, `idClient` FROM " . $this->table_name . " WHERE `idClient` = " . $idClient;
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }

    public function readOne($idOrder){
        $query = "SELECT `idOrder`, `dateOrder`, `totalPrice`, `idClient` FROM " . $this->table_name . " WHERE `idOrder` = " .$idOrder;
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }

    function create(){
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET `dateOrder` =:dateOrder, `totalPrice` =:totalPrice, `idClient` =:idClient" ;
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->dateOrder=htmlspecialchars(strip_tags($this->dateOrder));
        $this->total=htmlspecialchars(strip_tags($this->total));
        $this->idClient=htmlspecialchars(strip_tags($this->idClient));
        $stmt->bindParam(":dateOrder", $this->dateOrder);
        $stmt->bindParam(":totalPrice", $this->total);
        $stmt->bindParam(":idClient", $this->idClient);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDateOrder()
    {
        return $this->dateOrder;
    }

    /**
     * @param mixed $dateOrder
     */
    public function setDateOrder($dateOrder)
    {
        $this->dateOrder = $dateOrder;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * @param mixed $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }




}