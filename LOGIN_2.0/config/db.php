<?php
    class db{
        private $host = "localhost";
        private $dbname = "marklean";
        private $user = "root";
        private $password = "";

        public function conexion(){
            try{
                $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
                return $pdo;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }
    }
?>