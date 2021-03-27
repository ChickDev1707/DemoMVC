
<?php

    class User extends Controller{
        
        public function header(){
            $this->view('Header');
        }
        public function features(){
            // $this->view('header/Header');;
            $this->view('user/BookSearching');
            $this->view('user/ReaderCard');
            $this->view('user/BorrowBook');
        }
    }
    
?>