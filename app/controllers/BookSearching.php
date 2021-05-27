

<?php
    class BookSearching extends Controller{
        private $bookSearchingModel;
        public function __construct()
        {
            $this->bookSearchingModel = $this->model('BookSearchingModel');
        }
        public function index(){
            $data = $this->bookSearchingModel->getBooks();
            $this->view("general/Book-searching", $data);
        }
    }
?>