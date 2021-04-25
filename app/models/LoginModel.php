
<?php

    class LoginModel extends Database
    {
        private $database;
        public function __construct()
        {
            $this->database = new Database();
        }
        public function getAccounts(){
            $sql = "SELECT * FROM user_account";
            $this->database->query($sql);
            $this->database->execute();
            $rows = $this->database->resultSet();
            return $rows;
        }
        public function getUser($username){
            $sql = "SELECT * FROM user_account WHERE USERNAME = ?";
            $this->database->query($sql);
            $this->database->bind(1, $username);
            $user = $this->database->single();
            
            return $user;
        }

        public function setUser($data){
            $sql = "INSERT INTO user_account(USERNAME, USER_PASSWORD, KIEM_TRA_TAO_THE) VALUES (:username, :password, :createdCard);";
            $this->database->query($sql);
            $this->database->execute($data);
            
        }
    }
?>