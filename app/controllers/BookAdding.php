<?php
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    class BookAdding extends Controller{

        private $bookAddingModel;
        public function __construct()
        {
            $this->bookAddingModel = $this->model('BookAddingModel');
        }
        public function index(){
            $ruleAuthor = $this->bookAddingModel->getAuthors();
            $ruleType = $this->bookAddingModel->getTypes();
            $rules = [
                'ruleAuthor'=>$ruleAuthor,
                'ruleType'=>$ruleType,
            ];
            $this->view("librarian/Book-adding", $rules);
            if (isset($_POST['submit']))
            {
                $message = "";
                $type = "correct";
                $error = $this->errorMessage();
                if ($error != "")
                {
                    $type = "incorrect";
                    $message = $error;
                }
                else{
                    // Lấy đuôi file
                    $fileExt = explode('.', $_FILES['book_image']['name']);
                    $fileActualExt = strtolower(end($fileExt));
                    // Tạo tên file
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    // Tạo đường dẫn và chuyển file
                    $fileDestination = 'image/'. $fileNameNew;
                    move_uploaded_file($_FILES['book_image']['tmp_name'], $fileDestination);
                    // Insert
                    if ($_FILES['book_image']['error'] === 4)
                    {
                        $imagePath = URLROOT."public/image/default-book-cover.png";
                    }
                    else{
                        $imagePath = URLROOT."public/".$fileDestination;
                    }
                    $data = [
                        'book_name'=>$_POST['book_name'],
                        'book_type'=>$_POST['book_type'],
                        'book_author'=>$_POST['book_author'],
                        'book_publisher'=>$_POST['book_publisher'],
                        'book_year'=>$_POST['book_year'],
                        'book_import'=>$_POST['book_import'],
                        'book_cost'=>$_POST['book_cost'],
                        'image_path'=>$imagePath,
                    ];
                    $this->bookAddingModel->insertBook($data);
                    $message = "Thêm sách thành công!";
                }
                $vars = array($type, $message);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                
                echo "<script> showMessageBox.apply(null, $jsVars);</script>";
            }
        }
        public function errorMessage(){
            $message = "";
            // Thông tin sách được nhập

            $ruleYear = $this->bookAddingModel->getPublishDistance();
            $yearInsert = $_POST['book_year'];
            $dateImport = $_POST['book_import'];

            // Lấy thời gian hiện tại

            $now = getdate();
            $currentYear = $now['year'];

            // Thông tin ảnh được nhập

            $image = $_FILES['book_image'];

            $fileName = $_FILES['book_image']['name'];
            $fileTmpName = $_FILES['book_image']['tmp_name'];
            $fileSize = $_FILES['book_image']['size'];
            $fileError = $_FILES['book_image']['error'];
            $fileType = $_FILES['book_image']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
            // File được cho phép

            $allowed = array('jpg', 'jpeg', 'png', "");

            if ($currentYear - $yearInsert > $ruleYear)
            {
                $message = "Khoảng cách năm xuất bản phải nhỏ hơn " . $ruleYear . " !";
            }
            else if (!in_array($fileActualExt, $allowed))
            {
                $message = "Không được upload loại file này!";
            }
            else if ($fileError !== 0 && $fileError !== 4)
            {
                $message = "Có lỗi trong quá trình upload!";
            }
            else if ($fileSize >= 5000000)
            {
                $message = "File của bạn quá lớn!";
            }
            return $message;

        }
        
    }
?>