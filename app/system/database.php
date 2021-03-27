

<?php

    class Database
    {
        private $dbHost = "localhost";
        private $dbUsername = "root";
        private $dbPass = "";
        private $dbName = "demo";

        protected $connection;
        protected $statement;
        protected function __construct()
        {
            $dsn = "mysql:host=".$this->dbHost.";dbname=".$this->dbName;
            try{
                $this->connection = new PDO($dsn, $this->dbUsername, $this->dbPass);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        protected function query($sql){
            $this->statement = $this->connection->prepare($sql);
        }
        protected function bind($param, $value, $type = null){
            switch($value){
                case is_int($value):
                    $this->statement->bindValue($param, $value, PDO::PARAM_INT);
                    break;
                case is_bool($value):
                    $this->statement->bindValue($param, $value, PDO::PARAM_BOOL);
                    break;
                case is_null($value):
                    $this->statement->bindValue($param, $value, PDO::PARAM_NULL);
                    break;
                default:
                    $this->statement->bindValue($param, $value, PDO::PARAM_STR);
                    break;
            }
        }
        protected function execute(){
            $this->statement->execute();
        }
        protected function fetch(){
            return $this->statement->fetchAll();
        }
        protected function resultSet(){
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        }
        
    }
?>