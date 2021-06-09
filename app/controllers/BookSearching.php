

<?php
    class BookSearching extends Controller{
        private $bookSearchingModel;
        public function __construct()
        {
            $this->bookSearchingModel = $this->model('BookSearchingModel');
        }
        public function index(){
            $data = $this->bookSearchingModel->getBooks();
            
            $this->view("librarian/Book-searching", $data);

            $this->addGetBookDetailListener();
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
        
    }
?>