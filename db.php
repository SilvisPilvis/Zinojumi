<?php

class DBconn {
    private $host = "localhost";
    private $db_name = "spaceful";
    private $username = "root";
    private $password = "";
    public $conn;

    public function __construct() {
        $this->conn = null;    
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        // echo "Connected successfully";
        return $this->conn;
    }

    public function insertMessage($name, $email, $message) {
        // echo strlen($name);
        // Check the length of the inputs
        if (strlen($name) > 30 || strlen($name) <= 0) {
            echo "User name must be less than 30 characters and greater than 0";
            return false;
        }
        if(strlen($email) > 30 || strlen($email) <= 0){
            echo "Email must be less than 30 characters and greater than 0";
            return false;
        }
        if(strlen($message) > 1024 || strlen($message) <= 0){
            echo "Message must be less than 1024 characters and greater than 0";
            return false;
        }
        // Use htmlspecialchars to prevent XSS attacks
        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
        $message = htmlspecialchars($message);

        // Prepare the SQL statement
        $stmt = $this->conn->prepare("INSERT INTO zinojumi (name, email, message) VALUES (:name, :email, :message)");
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':message', $message);
        // $stmt->execute();

        // Execute the statement
        if ($stmt->execute()) {
            echo "Message inserted successfully";
            return true;
        } else {
            return false;
        }
    }

    public function getAllMessages() {
        // Prepare the SQL statement
        $stmt = $this->conn->prepare("SELECT * FROM zinojumi");

        // Execute the statement
        $stmt->execute();

        // Fetch all the rows into an array
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $messages;
    }

    public function searchMessages($searchString) {
        // Prepare the SQL statement
        $stmt = $this->conn->prepare("SELECT * FROM zinojumi WHERE message LIKE :searchString OR name LIKE :searchString OR created LIKE :searchString");

        // Bind the parameters
        $searchString = '%' . $searchString . '%';
        $stmt->bindValue(':searchString', $searchString);

        // Execute the statement
        $stmt->execute();

        // Fetch all the rows into an array
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $messages;
    }
}


?>