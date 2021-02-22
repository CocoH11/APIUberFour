<?php


class Client
{
    private $conn;
    private $table_name = "clients";

    private $idClient;
    private $firstName;
    private $lastName;
    private $email;
    private $dateOfBirth;
    private $imageURL;
    private $extraNapKins;
    private $frequentRefill;

    public function __construct($db){
        $this->conn = $db;
    }

    public function readOne(){
        $query = "SELECT `idClient`, `firstName`, `lastName`, `email`, `dateOfBirth`, `imageURL`, `extraNapkins`,  `frequentRefill` FROM " . $this->table_name . " WHERE `idClient` = " . $this->idClient;
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }

    function create(){
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET `firstName` =:firstName, `lastName` =:lastName, `email` =:email, `imageURL` =:imageURL, `extraNapkins` =:extraNapkins, `frequentRefill` =:frequentRefill";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->firstName=htmlspecialchars(strip_tags($this->firstName));
        $this->lastName=htmlspecialchars(strip_tags($this->lastName));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->imageURL=htmlspecialchars(strip_tags($this->imageURL));
        $this->extraNapKins=htmlspecialchars(strip_tags($this->extraNapKins));
        $this->frequentRefill = htmlspecialchars(strip_tags($this->frequentRefill));
        // bind values
        $stmt->bindParam(":firstName", $this->firstName);
        $stmt->bindParam(":lastName", $this->lastName);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":imageURL", $this->imageURL);
        $stmt->bindParam(":extraNapkins", 1);
        $stmt->bindParam(":frequentRefill", 0);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
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

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param mixed $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return mixed
     */
    public function getImageURL()
    {
        return $this->imageURL;
    }

    /**
     * @param mixed $imageURL
     */
    public function setImageURL($imageURL)
    {
        $this->imageURL = $imageURL;
    }

    /**
     * @return mixed
     */
    public function getExtraNapKins()
    {
        return $this->extraNapKins;
    }

    /**
     * @param mixed $extraNapKins
     */
    public function setExtraNapKins($extraNapKins)
    {
        $this->extraNapKins = $extraNapKins;
    }

    /**
     * @return mixed
     */
    public function getFrequentRefill()
    {
        return $this->frequentRefill;
    }

    /**
     * @param mixed $frequentRefill
     */
    public function setFrequentRefill($frequentRefill)
    {
        $this->frequentRefill = $frequentRefill;
    }





}