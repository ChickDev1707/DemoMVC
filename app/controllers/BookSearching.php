<?php 
    session_start();
?>
<?php
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    include("C:/xampp/htdocs/LibraryManagementSystem/app/controllers/BookAdding.php");
    class BookSearching extends Controller{
        private $bookSearchingModel;
        private $bookAddingModel;
        private $idSelected;
        public function __construct()
        {
            $this->bookSearchingModel = $this->model('BookSearchingModel');
            $this->bookAddingModel = $this->model('BookAddingModel');
        }
        public function index(){
                        
            $data = null;
            $flagCheck = null;
            if (!isset($_SESSION['currentResult'])){
                $books = $this->bookSearchingModel->getBooks();
                $ruleAuthor = $this->bookAddingModel->getAuthors();
                $ruleType = $this->bookAddingModel->getTypes();
                $data = [
                    'ruleAuthor'=>$ruleAuthor,
                    'ruleType'=>$ruleType,
                    'books'=>$books,
                ];
                $_SESSION['currentResult'] = $data;
                // print_r($_SESSION['currentResult']);
            }
            else{
                $data = $_SESSION['currentResult'];
            }

            if (isset($_POST['submit_search']))
            {   
                $searchValue = '%'.$_POST['search_value'].'%';
                // print_r(gettype($searchValue));
                $booksSearch = [
                    'search_type'=>$_POST['search_type'],
                    'search_value'=>$searchValue,
                ];
                $ruleAuthor = $this->bookAddingModel->getAuthors();
                $ruleType = $this->bookAddingModel->getTypes();
                $newListBook = $this->bookSearchingModel->searchBooks($booksSearch);
                // print_r($newListBook);
                $data = [
                    'ruleAuthor'=>$ruleAuthor,
                    'ruleType'=>$ruleType,
                    'books'=>$newListBook,
                ];
                $_SESSION['currentResult'] = $data;
                $_SESSION['bookList'] = $newListBook;
                
            }

            $output = "";
            if(isset($_POST['submit_export_excel_file'])) {
                if(isset($_SESSION['bookList'])) {
                    $dataExport = $_SESSION['bookList'];
                    //var_dump($_SESSION['bookList']);
                } else {
                    $dataExport = $this->bookSearchingModel->getBooks();
                }
                
                $output .= '
                    <table class="table">
                        <tr>
                            <th>Ma sach</th>
                            <th>Ten sach</th>
                            <th>The loai</th>
                            <th>Tac gia</th>
                            <th>Ngay nhap sach</th>
                            <th>Nha xuat ban</th>
                            <th>Nam xuat ban</th>
                            <th>Tri gia</th>
                            <th>Tinh trang</th>
                        </tr>
                ';
                foreach($dataExport as $e) {
                    $output .= '
                        <tr>
                            <td>'. $e->MA_SACH .'</td>
                            <td>'. $e->TEN_SACH .'</td>
                            <td>'. $e->THE_LOAI .'</td>
                            <td>'. $e->TAC_GIA .'</td>
                            <td>'. date("d-m-Y", strtotime($e->NGAY_NHAP_SACH)) .'</td>
                            <td>'. $e->NHA_XUAT_BAN .'</td>
                            <td>'. $e->NAM_XUAT_BAN .'</td>
                            <td>'. $e->TRI_GIA .'</td>
                            <td>'. $e->TINH_TRANG .'</td>
                        </tr>
                    ';
                }
                $output .= '</table>';

                header("Content-Type: application/xls");    
                header("Content-Disposition: attachment; filename=reportSearching.xls");
                echo $output;
                return;
            }
            if (isset($_POST['submit']) && $_POST['submit'] == "Cập nhật")
            {
                $bookId = $_POST['book_id'];
                $flagCheck = $this->updateBookController($bookId);
                // print_r($_SESSION['currentResult']);
                // print_r($flagCheck);
                $ruleAuthor = $this->bookAddingModel->getAuthors();
                $ruleType = $this->bookAddingModel->getTypes();
                // if (isset($_SESSION['currentResult']))
                // {
                //     $newListBook = $this->bookSearchingModel->searchBooks($_SESSION['currentResult']);                    
                // }
                // else{
                    $newListBook = $this->bookSearchingModel->getBooks();
                // }
                $data = [
                    'ruleAuthor'=>$ruleAuthor,
                    'ruleType'=>$ruleType,
                    'books'=>$newListBook,
                ];
                
                
            }
            if (isset($_POST['submit']) && $_POST['submit'] == "Xóa sách") {
                $bookId = $_POST['book_id'];
                $type = "";
                $message = "";
                $bookStatus = $this->bookSearchingModel->getBookStatus($bookId);
                if ($bookStatus == 1)
                {
                    $type = "incorrect";
                    $message = "Xóa sách thất bại!";
                }else
                {
                    $rows = $this->bookSearchingModel->getAllBookInfoInBorrowTicket($bookId);
                    if (!is_null($rows))
                    {
                        $this->bookSearchingModel->deleteAllBookInfoInBorrowTicket($bookId);
                    }
                    $this->bookSearchingModel->deleteBook($bookId);
                    
                    $type = "correct";
                    $message = "Xóa sách thành công!";
                }
                $ruleAuthor = $this->bookAddingModel->getAuthors();
                    
                $ruleType = $this->bookAddingModel->getTypes();
                $Books = $this->bookSearchingModel->getBooks();
                $data = [
                        'ruleAuthor'=>$ruleAuthor,
                        'ruleType'=>$ruleType,
                        'books'=>$Books,
                ];
                $flagCheck = array($type, $message);
            }
            $this->displayBooks($data);
            if (!is_null($flagCheck))
            {
                $jsFlagCheck = json_encode($flagCheck, JSON_HEX_TAG | JSON_HEX_AMP);
                echo "<script> showMessageBox.apply(null, $jsFlagCheck);</script>";
            }           
            unset($_SESSION['currentResult']);
            // session_destroy();
        }

        private function displayBooks($data){
                $this->view("librarian/Book-searching", $data);
    
                $this->addGetBookDetailListener();
                $this->addGetBookUpdateListener();
        }
        private function addGetBookDetailListener(){
            if(isset($_POST['submit_detail'])){
                $bookId = $_POST['book_id'];
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
                echo $error;
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
                        // $imagePath = URLROOT."public/image/default-book-cover.png";
                        $newBook = [
                            'book_id'=>$bookId,
                            'book_name'=>$_POST['book_name'],
                            'book_type'=>$_POST['book_type'],
                            'book_author'=>$_POST['book_author'],
                            'book_publisher'=>$_POST['book_publisher'],
                            'book_year'=>$_POST['book_year'],
                            'book_import'=>$_POST['book_import'],
                            'book_cost'=>$_POST['book_cost'],
                        ];
                        $this->bookSearchingModel->updateBookModelWithoutImage($newBook);
                    }
                    else{
                        $imagePath = URLROOT."public/".$fileDestination;
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
                        $this->bookSearchingModel->updateBookModelWithImage($newBook);
                    }
                    
                    $message = "Cập nhật thành công!";
                }
                $vars = array($type, $message);
                return $vars;
                // $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                
                // echo "<script> showMessageBox.apply(null, $jsVars);</script>";

        }
    }
        
?>