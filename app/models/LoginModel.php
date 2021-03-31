
<?php

    class LoginModel extends Database
    {
        private $db;
        public function __construct()
        {
            $this->db = new Database();
        }
        public function getAccounts(){
            $sql = "SELECT * FROM user_account";
            $this->db->query($sql);
            $this->db->queryExecute();
            $rows = $this->db->resultSet();
            return $rows;
        }
        public function getUser($username){
            $sql = "SELECT * FROM user_account WHERE USERNAME = ?";
            $this->db->query($sql);
            $this->db->bind(1, $username);
            $user = $this->db->single();
            
            return $user;
        }
    }
?>