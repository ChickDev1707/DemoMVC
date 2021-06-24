<?php
    class ReturnBookModel extends Database {
        private $database;
        public function __construct()
        {
            $this->database = new Database();
        }
        public function findDateBorrowed($MA_PHIEU_MUON_TRA) {
            $sql =  "SELECT * FROM phieu_muon_tra WHERE MA_PHIEU_MUON_TRA = {$MA_PHIEU_MUON_TRA}";
            $this->database->query($sql);
            $row = $this->database->single();      
            return $row;
        }
        public function updateReturnCard($data) {
            $sql = "UPDATE phieu_muon_tra SET NGAY_TRA=:ngay_tra, SO_NGAY_TRA_TRE = 0, TIEN_PHAT_KY = 0
            WHERE MA_PHIEU_MUON_TRA=:ma_phieu_muon_tra";
            $this->database->query($sql);
            $this->database->execute($data);
        }
        public function updateReturnCardLate($data) {    
            $sql = "UPDATE phieu_muon_tra SET NGAY_TRA=:ngay_tra, SO_NGAY_TRA_TRE=:so_ngay_tra_tre, TIEN_PHAT_KY=:tien_phat_ky
            WHERE MA_PHIEU_MUON_TRA=:ma_phieu_muon_tra";
            $this->database->query($sql);
            $this->database->execute($data);
        }
        public function getBookId($id) {
            $sql = "SELECT MA_SACH FROM phieu_muon_tra WHERE MA_PHIEU_MUON_TRA= {$id}";
            $this->database->query($sql);
            $data = $this->database->resultSet();
            return $data[0]->MA_SACH;
        }
        public function getReaderId($id) {
            $sql = "SELECT MA_DOC_GIA FROM phieu_muon_tra WHERE MA_PHIEU_MUON_TRA= {$id}";
            $this->database->query($sql);
            $data = $this->database->resultSet();
            return $data[0]->MA_DOC_GIA;
        }
        public function updateReaderCard($readerId, $fine) {
            $sql = "UPDATE doc_gia SET TONG_NO = TONG_NO + {$fine}  WHERE MA_DOC_GIA= {$readerId}";
            $this->database->query($sql);
            $this->database->execute();
        }
        public function updateBookCard($bookId) {
            $sql = "UPDATE sach SET TINH_TRANG = 'false' WHERE MA_SACH = {$bookId}";
            $this->database->query($sql);
            $this->database->execute();
        }
        public function getTienPhatMoiNgay() {
            $sql = "SELECT * FROM thamso";
            $this->database->query($sql);
            $row = $this->database->resultSet();      
            return $row[0]->TIEN_PHAT_MOI_NGAY;
        }
        public function getBorrowDayMax() {
            $sql = "SELECT * FROM thamso";
            $this->database->query($sql);
            $row = $this->database->resultSet();      
            return $row[0]->SO_NGAY_MUON_TOI_DA;
        }
        public function getReaderNames(){
            $sql = 'SELECT MA_DOC_GIA, HO_TEN_DOC_GIA, TONG_NO FROM doc_gia';
            $this->database->query($sql);
            $this->database->execute();
            $rows= $this->database->resultSet();
            return $rows;
        }
        public function getBookNames(){
            $sql = 'SELECT MA_SACH, TEN_SACH FROM sach';
            $this->database->query($sql);
            $this->database->execute();
            $rows= $this->database->resultSet();
            return $rows;
        }
        public function getReaderIdsAndBookIds() {
            $sql = "SELECT MA_PHIEU_MUON_TRA, MA_SACH, MA_DOC_GIA, NGAY_MUON, TIEN_PHAT_KY FROM phieu_muon_tra";
            $this->database->query($sql);
            $this->database->execute();
            $rows= $this->database->resultSet();
            return $rows;
        }
        public function checkIsReturnBook($id) {
            $sql = "SELECT MA_PHIEU_MUON_TRA FROM phieu_muon_tra WHERE MA_PHIEU_MUON_TRA = {$id} AND NGAY_TRA IS NOT NULL";
            $this->database->query($sql);
            $this->database->execute();
            $rows= $this->database->resultSet();
            return $rows;
        }
    }

?>