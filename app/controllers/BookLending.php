


<?php
    class BookLending extends Controller{
        private $bookLendingModel;
        public function __construct()
        {
            $this->bookLendingModel = $this->model('bookLendingModel');
        }
        public function index(){
            
            $this->view("librarian/Book-lending");

            
        }
        // public function init(){
            
        // }
    }
    
?>
