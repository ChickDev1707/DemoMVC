

<?php

    class Database
    {
        private $dbHost = DB_HOST;
        private $dbUsername = DB_USERNAME;
        private $dbPass = DB_PASSWORD;
        private $dbName = DB_NAME;

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
        protected function execute($data= null){
            $this->statement->execute($data);
        }
        // protected function insertExecute($data){
        //     $this->statement->execute($data);
        // }
        // protected function fetch(){
        //     return $this->statement->fetchAll();
        // }
        protected function resultSet(){
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        }
        protected function single(){
            $this->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
        }
        
    }
?>