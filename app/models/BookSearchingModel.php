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
        public function getBookById($bookId){
            $sql = "SELECT * from sach WHERE MA_SACH = ?";
            $this->database->query($sql);
            $this->database->bind(1, $bookId);
            $book = $this->database->single();
            return $book;
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
        public function updateBookModelWithImage($data){
            $sql = "UPDATE sach
                    SET TEN_SACH = :book_name, THE_LOAI = :book_type, TAC_GIA = :book_author, NGAY_NHAP_SACH = :book_import, NHA_XUAT_BAN = :book_publisher, NAM_XUAT_BAN = :book_year, TRI_GIA = :book_cost, IMAGE_PATH = :image_path
                    WHERE MA_SACH = :book_id";
            $this->database->query($sql);
            $this->database->execute($data);
            
        }
        public function updateBookModelWithoutImage($data){
            $sql = "UPDATE sach
                    SET TEN_SACH = :book_name, THE_LOAI = :book_type, TAC_GIA = :book_author, NGAY_NHAP_SACH = :book_import, NHA_XUAT_BAN = :book_publisher, NAM_XUAT_BAN = :book_year, TRI_GIA = :book_cost
                    WHERE MA_SACH = :book_id";
            $this->database->query($sql);
            $this->database->execute($data);
            
        }
        public function searchBooks($data)
        {
            if ($data['search_type'] == "book_author")
            {
                $sql = "SELECT * FROM sach WHERE TAC_GIA LIKE ?";
                $this->database->query($sql);
                $this->database->bind(1, $data['search_value']);
            }
            else if ($data['search_type'] == "book_name")
            {
                $sql = "SELECT * FROM sach WHERE TEN_SACH LIKE ?";
                $this->database->query($sql);
                $this->database->bind(1, $data['search_value']);
            }
            else if ($data['search_type'] == "book_type")
            {
                $sql = "SELECT * FROM sach WHERE THE_LOAI LIKE ?";
                $this->database->query($sql);
                $this->database->bind(1, $data['search_value']);
            }
            else{
                $sql = "SELECT * FROM sach WHERE (TEN_SACH LIKE :search_value) OR (THE_LOAI LIKE :search_value) OR (TAC_GIA LIKE :search_value)";
                $this->database->query($sql);
                $this->database->bindParam(':search_value', $data['search_value'], PDO::PARAM_STR, 50);
            }

            // print_r($this->database);
            $rows = $this->database->resultSet();
            return $rows;
        }
        public function deleteBook($bookId){
            $sql = "DELETE FROM sach WHERE MA_SACH = ?";
            $this->database->query($sql);
            $this->database->bind(1, $bookId);
            $this->database->execute();
        }
        public function getAllBookInfoInBorrowTicket($bookId){
            $sql = "SELECT * FROM phieu_muon_tra WHERE MA_SACH = ?";
            $this->database->query($sql);
            $this->database->bind(1, $bookId);
            $rows = $this->database->resultSet();
            return $rows;
        }
        public function deleteAllBookInfoInBorrowTicket($bookId){
            $sql = "DELETE FROM phieu_muon_tra WHERE MA_SACH = ?";
            $this->database->query($sql);
            $this->database->bind(1, $bookId);
            $this->database->execute();
        }
        // public function getBookStatus($bookId){
        //     $sql = "SELECT TINH_TRANG FROM sach WHERE MA_SACH = ?";
        //     $this->database->query($sql);
        //     $this->database->bind(1, $bookId);
        //     $rows = $this->database->resultSet();
        //     return $rows;
        // }
    }
?>