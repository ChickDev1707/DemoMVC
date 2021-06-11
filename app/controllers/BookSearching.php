<?php
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    include("C:/xampp/htdocs/LibraryManagementSystem/app/controllers/BookAdding.php");
    class BookSearching extends Controller{
        private $bookSearchingModel;
        private $bookAddingModel;
        public function __construct()
        {
            $this->bookSearchingModel = $this->model('BookSearchingModel');
            $this->bookAddingModel = $this->model('BookAddingModel');
        }
        public function index(){
            
            
            if (isset($_POST['submit']) && $_POST['submit'] == "Thêm sách")
            {
                $this->updateBookController($_POST['book_id']);
                $this->loadPage();
            }
            else if (isset($_POST['submit_search']) && $_POST['submit_search'] == "Tìm kiếm"){
                
            }
            else{
                $this->loadPage();
            }
            
        }
        private function loadPage(){
            $listBook = $this->bookSearchingModel->getBooks();

            $ruleAuthor = $this->bookAddingModel->getAuthors();
            $ruleType = $this->bookAddingModel->getTypes();
            
            $data = [
                'ruleAuthor'=>$ruleAuthor,
                'ruleType'=>$ruleType,
                'books'=>$listBook,
            ];
            $this->view("librarian/Book-searching", $data);

            $this->addGetBookDetailListener();
            $this->addGetBookUpdateListener();
        }
        private function addGetBookDetailListener(){
            if(isset($_POST['submit_detail'])){
                $bookId= $_POST['book_id'];
                $book = $this->bookSearchingModel->getBookById($bookId);
                $activities = $this->bookSearchingModel->getBookActivities($bookId);

                $vars = array($book, $activities);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                echo "<script> showBookDetailPanel.apply(null, $jsVars);</script>";
            }
        }
        private function addGetBookUpdateListener(){
            if (isset($_POST['submit_update'])){
                $bookId = $_POST['book_id'];
                $book = $this->bookSearchingModel->getBookById($bookId);
                $vars = array($book);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                echo "<script> showBookUpdatePanel.apply(null, $jsVars);</script>";

            }
        }
        private function updateBookController($bookId)
        {
                $message = "";
                $type = "correct";
                $bookAddingController = new BookAdding();
                $error = $bookAddingController->errorMessage();
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
                    $newBook = [
                        'book_id'=>$bookId,
                        'book_name'=>$_POST['book_name'],
                        'book_type'=>$_POST['book_type'],
                        'book_author'=>$_POST['book_author'],
                        'book_publisher'=>$_POST['book_publisher'],
                        'book_year'=>$_POST['book_year'],
                        'book_import'=>$_POST['book_import'],
                        'book_cost'=>$_POST['book_cost'],
                        'image_path'=>$imagePath,
                    ];
                    $this->bookSearchingModel->updateBookModel($newBook);
                    $message = "Thêm sách thành công!";
                }
                $vars = array($type, $message);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                
                echo "<script> showMessageBox.apply(null, $jsVars);</script>";

        }
    }
        
?>