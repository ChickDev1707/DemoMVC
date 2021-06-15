<?php
    class ReaderCardModel extends Database {
        private $database;
        public function __construct()
        {
            $this->database = new Database();
        }
        public function CreateReaderCard($data) {
            $sql = "INSERT INTO doc_gia (HO_TEN_DOC_GIA, LOAI_DOC_GIA, NGAY_SINH, DIA_CHI, EMAIL, NGAY_LAP_THE, TONG_NO) VALUES (:name, :type, :birthday, :address, :email, :dateCreate, 0)";
            $this->database->query($sql);
            $this->database->execute($data);
        }
        public function updateReaderCard($data) {
            $sql = "UPDATE doc_gia
                    SET HO_TEN_DOC_GIA = :name, LOAI_DOC_GIA = :type,
                        NGAY_SINH = :birthday, DIA_CHI = :address,
                        EMAIL = :email, NGAY_LAP_THE = :dateCreate
                    WHERE MA_DOC_GIA = :id
            ";
            $this->database->query($sql);
            $this->database->execute($data);
        }
        public function deleteReaderCard($id) {
            $sql = "DELETE FROM doc_gia WHERE MA_DOC_GIA = {$id}";
            $this->database->query($sql);
            $this->database->execute();
        }

        public function deleteFineCard($id) {
            $sql = "DELETE FROM phieu_thu_tien_phat WHERE MA_DOC_GIA = {$id}";
            $this->database->query($sql);
            $this->database->execute();
        }
        public function deleteBorrowCard($id) {
            $sql = "DELETE FROM phieu_muon_tra WHERE MA_DOC_GIA = {$id}";
            $this->database->query($sql);
            $this->database->execute();
        }

        public function getReaderCards() {
            $sql = "SELECT * FROM doc_gia";
            $this->database->query($sql);
            $data = $this->database->resultSet();
            return $data;
        }
        public function getSingleReader($id) {
            $sql = "SELECT * FROM doc_gia WHERE MA_DOC_GIA = {$id}";
            $this->database->query($sql);
            $data = $this->database->single();
            return $data;
        }
        public function getTypeOfReaders() {
            $sql = "SELECT * FROM loai_doc_gia";
            $this->database->query($sql);
            $data = $this->database->resultSet();
            return $data;
        }
        public function getAgeMin() {
            $sql = "SELECT * FROM thamso";
            $this->database->query($sql);
            $row = $this->database->resultSet();      
            return $row[0]->TUOI_TOI_THIEU;
        }
        public function getAgeMax() {
            $sql = "SELECT * FROM thamso";
            $this->database->query($sql);
            $row = $this->database->resultSet();      
            return $row[0]->TUOI_TOI_DA;
        }
    }
?>