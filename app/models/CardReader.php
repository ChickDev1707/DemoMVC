
<?php
    require_once '../system/database.php';
?>
<?php

    class CardReader extends Database
    {
        private $db;
        public function __construct()
        {
            $this->db = new Database();
        }
        public function getInfo(){
            $sql = "SELECT * FROM demo_account";
            $this->db->query($sql);
            $this->db->execute();
            $rows = $this->db->fetch();
            return $rows;
        }
        public function checkReader(){
            $sql = "SELECT * FROM demo_account";
        }
    }
?>