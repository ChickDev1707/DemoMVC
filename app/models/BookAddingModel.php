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
                    if ($fileSize < 500000)
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
            $sql = "INSERT INTO sach(MA_SACH, TEN_SACH, THE_LOAI, TAC_GIA, NGAY_NHAP_SACH, NAM_XUAT_BAN, NHA_XUAT_BAN, TRI_GIA, TINH_TRANG, IMAGE_PATH) 
            VALUES (:book_code, :book_name, :book_type, :book_author, :book_import, :book_year, :book_publisher, :book_cost, 0, '$data[8]')";
            $this->database->query($sql);
            $this->database->execute($data);
        }
    }