<?php
    class Db {
        private $servername = "localhost";
        private $username = "root";
        private $password = "0987654321"; 
        private $dbname = "db_ms_store";

        public function connect() {
            try {
                $pdo = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                } catch(PDOException $e) {
                throw $e;
            }
            return $pdo;
        }
    }
?>