<?php
    class BookAddingModel extends Database{
        private $database;
        public function __construct()
        {
            $this->database = new Database();
        }
        public function fileHandler(){
            $image = $_FILES['book_image'];

            $fileName = $_FILES['book_image']['name'];
            $fileTmpName = $_FILES['book_image']['tmp_name'];
            $fileSize = $_FILES['book_image']['size'];
            $fileError = $_FILES['book_image']['error'];
            $fileType = $_FILES['book_image']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if (in_array($fileActualExt, $allowed))
            {
                if ($fileError === 0)
                {
                    if ($fileSize < 5000000)
                    {
                        $fileNameNew = uniqid('', true).".".$fileActualExt;
                        $fileDestination = 'uploads/'. $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        return $fileDestination;
                    }
                    else
                    {
                        echo "Your file is too big!";
                    }
                }
                else
                {
                    echo "There was an error uploading your file!";
                }
            }
            else
            {
                echo "You cannot upload files of this type!";
            }
        }
        public function insertBook($data)
        {          
            $sql = 'INSERT INTO sach (MA_SACH, TEN_SACH, THE_LOAI, TAC_GIA, NHA_XUAT_BAN, NAM_XUAT_BAN, NGAY_NHAP_SACH, TRI_GIA, TINH_TRANG, IMAGE_PATH) VALUES (:book_code, :book_name, :book_type, :book_author, :book_publisher, :book_year, :book_import, :book_cost, 0, :image_path)';
            $this->database->query($sql);
            $this->database->execute($data);
        }
        public function getPublishDistance()
        {
            $sql = 'SELECT KHOANG_CACH_NAM_XUAT_BAN FROM quydinh';
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
        public function checkPrimaryKey($code){
            $sql = "SELECT MA_SACH from sach WHERE MA_SACH = ?";
            $this->database->query($sql);
            $this->database->execute([$code]);
            $rows = $this->database->resultSet();
            if ($rows == null)
            {
                return true;
            }
            else{
                return false;
            }
        }
    }