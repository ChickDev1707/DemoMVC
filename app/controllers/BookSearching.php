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
        
        private function displayBooks($data){
                $this->view("librarian/Book-searching", $data);
    
                $this->addGetBookDetailListener();
                $this->addGetBookUpdateListener();
        }
        private function addGetBookDetailListener(){
            if(isset($_GET['submit_detail'])){
                $bookId = $_GET['book_id'];
                $book = $this->bookSearchingModel->getBookById($bookId);
                $activities = $this->bookSearchingModel->getBookActivities($bookId);
                $vars = array($book, $activities);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                echo "<script> showBookDetailPanel.apply(null, $jsVars);</script>";
            }
        }
        private function addGetBookUpdateListener(){
            if (isset($_GET['submit_update'])){

                $bookId = $_GET['book_id'];
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
        public function index($data=null)
        {
            if (is_null($data))
            {
                $books = $this->bookSearchingModel->getBooks();
                $ruleAuthor = $this->bookAddingModel->getAuthors();
                $ruleType = $this->bookAddingModel->getTypes();
                $data = [
                    'books'=> $books,
                    'ruleAuthor' => $ruleAuthor,
                    'ruleType' => $ruleType,
                ];
            }
            $this->view("librarian/Book-searching", $data);
            $this->addGetBookDetailListener();
            $this->addGetBookUpdateListener();
        }
        public function search($data=null)
        {
            if (isset($_GET['submit_search']))
            {   
                $searchValue = '%'.$_GET['search_value'].'%';
                // print_r(gettype($searchValue));
                $booksSearch = [
                    'search_type'=>$_GET['search_type'],
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
                $this->index($data);                

                $_SESSION['currentResult'] = $data;
                $_SESSION['bookList'] = $newListBook;
            }
            else{
                $this->index($_SESSION['currentResult']);
                // unset($_SESSION['currentResult']);
            }
        }
        public function update($data=null)
        {
            $type = "";
            $message = "";
            if (isset($_POST['submit']) && $_POST['submit'] == "Cập nhật")
            {
                $bookId = $_POST['book_id'];
                $flagCheck = $this->updateBookController($bookId);
                // print_r($_SESSION['currentResult']);
                // print_r($flagCheck);
                $ruleAuthor = $this->bookAddingModel->getAuthors();
                $ruleType = $this->bookAddingModel->getTypes();
                $newListBook = $this->bookSearchingModel->getBooks();
                $data = [
                    'ruleAuthor'=>$ruleAuthor,
                    'ruleType'=>$ruleType,
                    'books'=>$newListBook,
                ];
                $this->index($data);
                // return $data;
                $this->alertMessage($flagCheck[0], $flagCheck[1]);
                
            }
            else{
                $this->index($data);
            }
        }
        public function delete($data=null)
        {
            $type = "";
            $message = "";
            if (isset($_POST['submit_delete'])) {
                $bookId = $_POST['book_id'];
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
                $this->index($data);
                $this->alertMessage($type, $message);

            }
            else{
                $this->index($data);
            }
        }
        public function PrintAndExport()
        {
            if(isset($_GET['submit_export_excel_file'])) {
                    if(isset($_SESSION['bookList'])) {
                        $dataExport = $_SESSION['bookList'];
                        //var_dump($_SESSION['bookList']);
                        unset($_SESSION['bookList']);
                    } else {
                        $dataExport = $this->bookSearchingModel->getBooks();
                    }
                    $csv = "MA SACH,TEN SACH,THE LOAI,TAC GIA,NGAY NHAP,NHA XUAT BAN, NAM XUAT BAN,TRI GIA,TINH TRANG\r\n";
                    foreach($dataExport as $row)
                    {
                        $data = array(
                            'ma_sach' => $row->MA_SACH,
                            'ten_sach' => "$row->TEN_SACH",
                            'the_loai' => $row->THE_LOAI,
                            'tac_gia' => $row->TAC_GIA,
                            'ngay_nhap' => $row->NGAY_NHAP_SACH,
                            'nha_xuat_ban' => $row->NHA_XUAT_BAN,
                            'nam_xuat_ban' => $row->NAM_XUAT_BAN,
                            'tri_gia' => $row->TRI_GIA,
                            'tinh_trang'=>$row->TINH_TRANG
                        );
                        $csv .= join(",", $data)."\r\n";
                    }
                    // $csv = mb_convert_encoding($csv, "UTF-8", "UTF-8");
                    header("Content-type: text/csv; charset=utf-8,%EF%BB%BF");
                    header("Content-disposition: csv; filename=" . date("Y-m-d") . "_reportSearching.csv; size=".strlen($csv));
                    echo chr(0xEF).chr(0xBB).chr(0xBF).$csv;
                    return;
                }
                $this->index();
    
        }
        public function alertMessage($type, $message)
        {
                $flagCheck = array($type, $message);
                $jsFlagCheck = json_encode($flagCheck, JSON_HEX_TAG | JSON_HEX_AMP);
                echo "<script> showMessageBox.apply(null, $jsFlagCheck);</script>";
        }
    }
        
?>