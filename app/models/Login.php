
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
        public function getUserId($username){
            $sql = "SELECT * FROM demo_account WHERE USERNAME = ?";
            $this->db->query($sql);
            $this->db->bind(1, $username);
            $this->db->execute();
            $rows = $this->db->fetch();
            return $rows[0]['ID'];
        }
    }
?>