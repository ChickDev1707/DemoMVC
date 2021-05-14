
<?php
    class BookLendingModel extends Database {
        private $database;
        public function __construct()
        {
            $this->database = new Database();
        }
        public function createBookLendingCard($data) {
            $sql = 'INSERT INTO PHIEU_MUON_SACH (MA_SACH, MA_DOC_GIA) VALUES (1, 1)';
            $this->database->query($sql);
            $this->database->execute();
        }   

    }

?>