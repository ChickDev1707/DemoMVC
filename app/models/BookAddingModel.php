<?php
    class BookAddingModel extends Database{
        private $database;
        public function __construct()
        {
            $this->database = new Database();
        }
        public function insertBook($data)
        {          
            $sql = 'INSERT INTO sach (TEN_SACH, THE_LOAI, TAC_GIA, NHA_XUAT_BAN, NAM_XUAT_BAN, NGAY_NHAP_SACH, TRI_GIA, TINH_TRANG, IMAGE_PATH) VALUES (:book_name, :book_type, :book_author, :book_publisher, :book_year, :book_import, :book_cost, 0, :image_path)';
            $this->database->query($sql);
            $this->database->execute($data);
        }
        public function getPublishDistance()
        {
            $sql = 'SELECT KHOANG_CACH_NAM_XUAT_BAN FROM thamso';
            $this->database->query($sql);
            $rows = $this->database->resultSet();
            return $rows[0]->KHOANG_CACH_NAM_XUAT_BAN;
        }
        public function getAuthors(){
            $sql = 'SELECT TEN_TAC_GIA FROM tac_gia';
            $this->database->query($sql);
            $rows = $this->database->resultSet();
            $values = array();
            foreach ($rows as $row)
            {
                $value = $row->TEN_TAC_GIA;
                array_push($values, $value);
            }
            return $values;
        }
        public function getTypes(){
            $sql = 'SELECT TEN_THE_LOAI_SACH FROM the_loai_sach';
            $this->database->query($sql);
            $rows = $this->database->resultSet();
            $values = array();
            foreach ($rows as $row)
            {
                $value = $row->TEN_THE_LOAI_SACH;
                array_push($values, $value);
            }
            return $values;
        }

}