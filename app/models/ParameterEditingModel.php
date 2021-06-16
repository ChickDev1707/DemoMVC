
<?php
    class ParameterEditingModel extends Database {
        private $database;
        public function __construct()
        {
            $this->database = new Database();
        } 
        public function getAllParams(){
            $sql = 'SELECT * FROM thamso';
            $this->database->query($sql);
            $this->database->execute();
            $row = $this->database->single();
            return $row;
        } 

        public function changeReaderCardParams($data){
            $sql = 'UPDATE thamso SET TUOI_TOI_THIEU = :min_age, TUOI_TOI_DA = :max_age, THOI_HAN_THE= :card_date_limit';
            $this->database->query($sql);
            $this->database->execute($data);
        }

        public function getAllReaderTypes(){
            $sql = 'SELECT * FROM loai_doc_gia';
            $this->database->query($sql);
            $this->database->execute();
            $rows = $this->database->resultSet();
            return $rows;
        }
        public function addReaderType($readerType){
            $sql = 'INSERT INTO loai_doc_gia (TEN_LOAI_DOC_GIA) VALUES (?)';
            $this->database->query($sql);
            $this->database->bind(1, $readerType);
            $this->database->execute();
        }
        public function deleteReaderType($readerType){
            $sql = 'DELETE FROM loai_doc_gia WHERE TEN_LOAI_DOC_GIA = ?';
            $this->database->query($sql);
            $this->database->bind(1, $readerType);
            $this->database->execute();
        }
        public function getAllReaders(){
            $sql = 'SELECT LOAI_DOC_GIA FROM doc_gia';
            $this->database->query($sql);
            $this->database->execute();
            $rows = $this->database->resultSet();
            return $rows;
        }
        // reader card

        public function getAllBookTypes(){
            $sql = 'SELECT * FROM the_loai_sach';
            $this->database->query($sql);
            $this->database->execute();
            $rows = $this->database->resultSet();
            return $rows;
        }
        public function addBookType($bookType){
            $sql = 'INSERT INTO the_loai_sach (TEN_THE_LOAI_SACH) VALUES (?)';
            $this->database->query($sql);
            $this->database->bind(1, $bookType);
            $this->database->execute();
        }
        public function deleteBookType($bookType){
            $sql = 'DELETE FROM the_loai_sach WHERE TEN_THE_LOAI_SACH = ?';
            $this->database->query($sql);
            $this->database->bind(1, $bookType);
            $this->database->execute();
        }
        public function getAllBooks(){
            $sql = 'SELECT THE_LOAI, TAC_GIA FROM sach';
            $this->database->query($sql);
            $this->database->execute();
            $rows = $this->database->resultSet();
            return $rows;
        }
        // book type

        public function getAllBookAuthors(){
            $sql = 'SELECT * FROM tac_gia';
            $this->database->query($sql);
            $this->database->execute();
            $rows = $this->database->resultSet();
            return $rows;
        }
        public function addBookAuthor($bookAuthor){
            $sql = 'INSERT INTO tac_gia (TEN_TAC_GIA) VALUES (?)';
            $this->database->query($sql);
            $this->database->bind(1, $bookAuthor);
            $this->database->execute();
        }
        public function deleteBookAuthor($bookAuthor){
            $sql = 'DELETE FROM tac_gia WHERE TEN_TAC_GIA = ?';
            $this->database->query($sql);
            $this->database->bind(1, $bookAuthor);
            $this->database->execute();
        }
        // book author

        public function changeYearDistance($yearDistance){
            $sql = 'UPDATE thamso SET KHOANG_CACH_NAM_XUAT_BAN = ?';
            $this->database->query($sql);
            $this->database->bind(1, $yearDistance);
            $this->database->execute();
        }
        // year distance
        public function changeBorrowParams($data){
            $sql = 'UPDATE thamso SET 
                        SO_SACH_TOI_DA = :max_num_of_book, 
                        SO_NGAY_MUON_TOI_DA = :max_borrow_day_amount, 
                        TIEN_PHAT_MOI_NGAY = :fine_money';
            $this->database->query($sql);
            $this->database->execute($data);
        }
    }

?>