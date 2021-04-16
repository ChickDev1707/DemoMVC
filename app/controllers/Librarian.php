
<?php
    class Librarian extends Controller{
        
        public function readerCard(){
            $this->view("librarian/Reader-card");
        }
        public function bookSearching(){
            $this->view("librarian/Book-searching");
        }
        public function takeBook(){
            $this->view("librarian/Take-book");
        }
    }
?>