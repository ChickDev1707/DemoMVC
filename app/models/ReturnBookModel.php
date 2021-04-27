<?php
    class ReturnBookModel extends Database {
        private $database;
        public function __construct()
        {
            $this->database = new Database();
        }
        public function createReturnBookCard($data) {
            $sql = 'INSERT INTO phieutrasach (MA_SACH, MA_DOC_GIA, NGAY_TRA, NGAY_MUON, SO_NGAY_MUON, TIEN_PHAT) VALUES (:bookId, :readerId, :ngay_tra, :ngay_muon, :so_ngay_muon, :so_tien_phat)';
            $this->database->query($sql);
            $this->database->execute($data);
        }   
        public function getMaMuonSach($ma_doc_gia, $ma_sach) {
            $sql =  "SELECT * FROM phieumuonsach WHERE MA_DOC_GIA = $ma_doc_gia and MA_SACH = $ma_sach";
            $this->database->query($sql);
            $row = $this->database->single();   
            return $row;
        }
        public function findDateBorrowed($MA_PHIEU_MUON) {
            $sql =  "SELECT * FROM phieumuonsach WHERE MA_PHIEU_MUON = $MA_PHIEU_MUON";
            $this->database->query($sql);
            $row = $this->database->single();      
            return $row;
        }
    }

?>