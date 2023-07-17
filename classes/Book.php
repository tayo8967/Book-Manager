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

        public function updateBook($id, $title, $author, $description, $publish){
            // Prepare the SQL update statement with placeholders
            $query = "UPDATE book SET Title = :title, Author = :author, Description = :description, Published_Year = :publish WHERE id = :id";
            $stmt = $this->conn->prepare($query);

            // Bind parameters to the prepared statement
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':author', $author, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':publish', $publish, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            header('Location: ../index.php');
        }

        public function getSpecificBook($id){
            $query = "SELECT * FROM book WHERE Id = $id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }
    }

?>