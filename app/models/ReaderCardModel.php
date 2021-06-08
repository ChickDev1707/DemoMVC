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
        public function getAuthor() {
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