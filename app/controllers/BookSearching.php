

<?php
    class BookSearching extends Controller{
        private $bookSearchingModel;
        private $bookAddingModel;
        public function __construct()
        {
            $this->bookSearchingModel = $this->model('BookSearchingModel');
            $this->bookAddingModel = $this->model('BookAddingModel');
        }
        public function index(){
            $books = $this->bookSearchingModel->getBooks();

            $ruleAuthor = $this->bookAddingModel->getAuthors();
            $ruleType = $this->bookAddingModel->getTypes();
            // add data to book form
            $data = [
                'ruleAuthor'=>$ruleAuthor,
                'ruleType'=>$ruleType,
                'books'=>$books,
            ];

            $this->view("general/Book-searching", $data);
        }
    }
?>