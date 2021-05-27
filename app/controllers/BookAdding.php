

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
                $error = $this->errorMessage();
                if ($this->checkErrorMessage($error))
                {
                    $this->showErrorMessage($error);
                }
                else{
                    $temp = $this->bookAddingModel->fileHandler();
                    $imagePath = URLROOT."public/".$temp;
                    $data = [
                        'book_code'=>$_POST['book_code'],
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
                }
            }
        }
        public function errorMessage(){

            $ruleYear = $this->bookAddingModel->getPublishDistance();
            $ruleAuthor = $this->bookAddingModel->getAuthors();
            $ruleType = $this->bookAddingModel->getTypes();
            $yearInsert = $_POST['book_year'];
            $now = getdate();
            $currentYear = $now['year'];
            $message = "";
            if ($this->bookAddingModel->checkPrimaryKey($_POST['book_code']) == false)
            {
                $message = "Error: Primary Key Duplication !";
            }
            else if (!in_array($_POST['book_type'], $ruleType))
            {
                $message = "Error: The type of this book is not allowed !";
            }
            else if (!in_array($_POST['book_author'], $ruleAuthor))
            {
                $message = "Error: The author of this book is not allowed !";
            }
            else if ($currentYear - $yearInsert > $ruleYear)
            {
                $message = "Error: The distance of year should be less than " . $ruleYear . " !";
            }
            return $message;

        }
        public function checkErrorMessage($message)
        {
            if ($message != "")
            {
                return true;
            }
            return false;
        }
        public function showErrorMessage($message)
        {
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
?>