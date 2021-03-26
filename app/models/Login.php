
<?php
    require_once '../system/database.php';
?>
<?php

    class Login extends Database
    {
        private $db;
        public function __construct()
        {
            $this->db = new Database();
        }
        public function getAccounts(){
            $sql = "SELECT * FROM demo_account";
            $this->db->query($sql);
            $this->db->execute();
            $rows = $this->db->fetch();
            return $rows;
        }
    }
?>