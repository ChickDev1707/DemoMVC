
<?php
    class BookLendingModel extends Database {
        private $database;
        public function __construct()
        {
            $this->database = new Database();
        }
        public function createBookLendingCard($data) {
            $sql = 'INSERT INTO PHIEU_MUON_SACH (MA_SACH, MA_DOC_GIA) VALUES (:book_id, :reader_id)';
            $this->database->query($sql);
            $this->database->execute($data);
        }  
        private function getBookInfo($bookId){
            $sql = 'SELECT * FROM SACH WHERE MA_SACH= $bookId';
            $this->database->query($sql);
            $this->database->single();
            
        } 

    }

?>