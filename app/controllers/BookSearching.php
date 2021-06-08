

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
            $activities = $this->prepareActivities($books);

            $ruleAuthor = $this->bookAddingModel->getAuthors();
            $ruleType = $this->bookAddingModel->getTypes();
            // add data to book form
            $data = [
                'ruleAuthor'=>$ruleAuthor,
                'ruleType'=>$ruleType,
                'books'=>$books,
                'activities'=>$activities
            ];

            $this->view("librarian/Book-searching", $data);
        }
        private function prepareActivities($books){
            $data = [];
            foreach($books as $book){
                $bookActivity = $this->bookSearchingModel->getBookActivities($book->MA_SACH);
                $data[$book->MA_SACH] = $bookActivity;
            }
            return $data;
        }
    }
?>