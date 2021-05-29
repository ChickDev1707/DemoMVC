<?php
    class ReturnBookModel extends Database {
        private $database;
        public function __construct()
        {
            $this->database = new Database();
        }
        public function findDateBorrowed($MA_PHIEU_MUON_TRA) {
            $sql =  "SELECT * FROM phieu_muon_tra WHERE MA_PHIEU_MUON = $MA_PHIEU_MUON_TRA";
            $this->database->query($sql);
            $row = $this->database->single();      
            return $row;
        }
        public function updateReturnCard($data) {
            $sql = "UPDATE phieu_muon_tra SET NGAY_TRA=:ngay_tra, SO_NGAY_TRA_TRE = 0, TIEN_PHAT_KY = 0
            WHERE MA_PHIEU_MUON=:ma_phieu_muon_tra";
            $this->database->query($sql);
            $this->database->execute($data);
        }
        public function updateReturnCardLate($data) {    
            $sql = "UPDATE phieu_muon_tra SET NGAY_TRA=:ngay_tra, SO_NGAY_TRA_TRE=:so_ngay_tra_tre, TIEN_PHAT_KY=:tien_phat_ky
            WHERE MA_PHIEU_MUON=:ma_phieu_muon_tra";
            $this->database->query($sql);
            $this->database->execute($data);
        }
        public function updateBookCard($bookId) {
            $sql = "UPDATE sach SET TINH_TRANG = 'false' WHERE MA_SACH = $bookId";
            $this->database->query($sql);
            $this->database->execute();
        }
        public function getTienPhatMoiNgay() {
            $sql = "SELECT * FROM thamso";
            $this->database->query($sql);
            $row = $this->database->resultSet();      
            return $row[0]->TIEN_PHAT_MOI_NGAY;
        }
    }

?>