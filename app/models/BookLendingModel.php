
<?php
    class BookLendingModel extends Database {
        private $database;
        public function __construct()
        {
            $this->database = new Database();
        }
        public function createBookLendingCard($data) {
            $sql = 'INSERT INTO phieu_muon_tra (MA_DOC_GIA, MA_SACH, NGAY_MUON, NGAY_TRA, SO_NGAY_TRA_TRE, TIEN_PHAT_KY) VALUES (:reader_card_id, :book_id, :date, NULL, 0, 0)';
            $this->database->query($sql);
            $this->database->execute($data);
        }  
        private function getBookInfo($bookId){
            $sql = 'SELECT * FROM SACH WHERE MA_SACH= $bookId';
            $this->database->query($sql);
            $this->database->single();
            
        } 
        public function getReaderId($id){
            $sql = 'SELECT * FROM doc_gia WHERE MA_DOC_GIA = ?';
            $this->database->query($sql);
            $this->database->bind(1, $id);
            $row= $this->database->single();
            return $row;
        }
        // check if reader exist
        public function getBookId($id){
            $sql = 'SELECT * FROM sach WHERE MA_SACH = ?';
            $this->database->query($sql);
            $this->database->bind(1, $id);
            $row= $this->database->single();
            return $row;
        }
        // check if book exist
        public function getReaderCardCreatedDate($id){
            $sql = 'SELECT NGAY_LAP_THE FROM doc_gia WHERE MA_DOC_GIA = ?';
            $this->database->query($sql);
            $this->database->bind(1, $id);
            $date= $this->database->single()->NGAY_LAP_THE;
            return $date;
        }
        public function getReaderCardTimeLimit(){
            $sql = 'SELECT THOI_HAN_THE FROM thamso';
            $this->database->query($sql);
            $amount= $this->database->single()->THOI_HAN_THE;
            return $amount;
        }
        // for checking if card is expired
        public function getBorrowDays($id){
            $sql = 'SELECT NGAY_MUON FROM phieu_muon_tra WHERE MA_DOC_GIA = ? AND NGAY_TRA IS NULL';
            $this->database->query($sql);
            $this->database->bind(1, $id);
            $rows= $this->database->resultSet();
            return $rows;
        }
        public function getBorrowTimeLimit(){
            $sql = 'SELECT SO_NGAY_MUON_TOI_DA FROM thamso';
            $this->database->query($sql);
            $amount= $this->database->single()->SO_NGAY_MUON_TOI_DA;
            return $amount;
        }
        // for checking if reader has not returned book
        public function getBookStatus($bookId){
            $sql = 'SELECT TINH_TRANG FROM sach WHERE MA_SACH= ?';
            $this->database->query($sql);
            $this->database->bind(1, $bookId);
            $status= $this->database->single()->TINH_TRANG;
            return $status;
        }
        // for checking if book was borrowed by someone else
        public function getBorrowedBookAmount($id){
            $sql = 'SELECT COUNT(*) AS AMOUNT FROM phieu_muon_tra WHERE MA_DOC_GIA = ? AND NGAY_TRA IS NULL';
            $this->database->query($sql);
            $this->database->bind(1, $id);
            $amount= $this->database->single()->AMOUNT;
            return $amount;
        }
        public function getBorrowAmountLimit(){
            $sql = 'SELECT SO_SACH_TOI_DA FROM thamso';
            $this->database->query($sql);
            $limit= $this->database->single()->SO_SACH_TOI_DA;
            return $limit;
        }
        // for checking if the amount of books have been borrowed exceeded limit
        public function updateBookStatus($bookId){
            $sql = 'UPDATE sach SET TINH_TRANG=1 WHERE MA_SACH= ?';
            $this->database->query($sql);
            $this->database->bind(1, $bookId);
            $this->database->execute();
        }

        public function getReaderNames(){
            $sql = 'SELECT MA_DOC_GIA, HO_TEN_DOC_GIA FROM doc_gia';
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
        // for loading book name and reader name to input
    }

?>