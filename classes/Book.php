<?php
    class Book {
        private $conn;

        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllBooks(){
            $query = "SELECT * FROM book";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            return $stmt; 
        }

        public function addBook(){
            $query = "INSERT INTO "
        }
    }

?>