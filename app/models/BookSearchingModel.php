<?php
    class BookSearchingModel extends Database
    {
        private $database;
        public function __construct(){
            $this->database = new Database();
        }
        public function getBooks()
        {
            $sql = "SELECT * from sach";
            $this->database->query($sql);
            $rows = $this->database->resultSet();
            return $rows;
        }
        public function getBookActivities($bookId){
            $sql = "SELECT HO_TEN_DOC_GIA, NGAY_MUON, NGAY_TRA 
                    FROM phieu_muon_tra, doc_gia 
                    WHERE phieu_muon_tra.MA_DOC_GIA = doc_gia.MA_DOC_GIA AND phieu_muon_tra.MA_SACH= ?";
            $this->database->query($sql);
            $this->database->bind(1, $bookId);
            $rows = $this->database->resultSet();
            return $rows;
        }  
        
    }
?>