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

        public function addBook($title, $author, $description, $publish){
            $query = "INSERT INTO book (Title, Author, Description, Published_Year) VALUES ('$title', '$author', '$description', '$publish')";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            header('Location: ../index.php');
        }

        public function updateBook(){
            
        }

    }

?>