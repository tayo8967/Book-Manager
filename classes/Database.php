<?php
    
    class Database{
        private $host = DB_HOST;
        private $dbname = DB_NAME;
        private $user = DB_USER;
        private $password = DB_PASSWORD;
        private $conn;

        // Create connection method
        public function connect(){
            $this->conn = null;

            try {
                $this->conn = new PDO(
                    "mysql:host=$this->host;dbname=$this->dbname",
                    $this->user,
                    $this->password
                );

                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection error: " . $e->getMessage();
            }

            return $this->conn;
        }
    }
?>
