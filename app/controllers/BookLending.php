


<?php
    class BookLending extends Controller{
        private $bookLendingModel;
        public function __construct()
        {
            $this->bookLendingModel = $this->model('bookLendingModel');
        }
        public function index(){
            $this->view("librarian/Book-lending");
            if(isset($_POST['submit_lend_book'])){
                
                $data = array(
                    $_POST['reader_id'],
                    $_POST['book_id'],
                );
                $this->bookLendingModel->createBookLendingCard($data);        
            }
            
        }
        // public function init(){
            
        // }
    }
?>