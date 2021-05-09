

<?php
    class BookAdding extends Controller{

        private $bookAddingModel;
        public function __construct()
        {
            $this->bookAddingModel = $this->model('BookAddingModel');
        }
        public function index(){
            $this->view("librarian/Book-adding");
            if (isset($_POST['submit']))
            {
                $temp = $this->bookAddingModel->fileHandler();
                $imagePath = URLROOT."public/".$temp;
                $books = array(
                    $_POST['book_code'],
                    $_POST['book_name'],
                    $_POST['book_type'],
                    $_POST['book_author'],
                    $_POST['book_publisher'],
                    $_POST['book_year'],
                    $_POST['book_import'],
                    $_POST['book_cost'],
                    $imagePath,
                );
                $this->bookAddingModel->insertBook($books);

            }
        }
        
    }
?>