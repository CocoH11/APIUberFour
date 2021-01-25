<?php


class Client
{
    private $conn;
    private $table_name = "clients";

    private $idClient;
    private $firsName;
    private $lastName;
    private $email;
    private $dateOfBirth;

    public function __construct($db){
        $this->conn = $db;
    }
}