
<?php
    class BookLendingModel extends Database {
        private $database;
        public function __construct()
        {
            $this->database = new Database();
        }
        public function createBookLendingCard($data) {
            $sql = 'INSERT INTO PHIEU_MUON_SACH (MA_SACH, MA_DOC_GIA, NGAY_TRA, NGAY_MUON, SO_NGAY_MUON, TIEN_PHAT) VALUES (:bookId, :readerId, :ngay_tra, :ngay_muon, :so_ngay_muon, :so_tien_phat)';
            $this->database->query($sql);
            $this->database->execute($data);
        }   
    }

?>