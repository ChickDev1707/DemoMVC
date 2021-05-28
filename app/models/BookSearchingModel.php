<?php
    class BookSearchingModel extends Database
    {
        private $database;
        public function __construct(){
            $this->database = new Database();
        }
        public function getBooks()
        {
            $sql = "SELECT * from sach";
            $this->database->query($sql);
            $rows = $this->database->resultSet();
            return $rows;
        }
        
    }
?>