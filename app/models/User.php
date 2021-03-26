
<?php
    require_once '../system/database.php';
?>
<?php

    class User extends Database
    {
        private $db;
        public function __construct()
        {
            $this->db = new Database();
        }
        public function getUser(){
            $sql = "SELECT * FROM demo_user";
            $this->db->query($sql);
            $this->db->execute();
            $rows = $this->db->fetch();
            foreach($rows as $row){
                echo $row['username'] . '<br>';
            }
        }
    }
?>