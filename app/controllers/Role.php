

<?php
    class Role extends Controller{

        public function librarian(){
            $this->view("librarian/Reader-card");
            // init page of librarian
        }
        public function reader(){
            $this->view("reader/My-reader-card");
            // init page of reader
        }
    }
?>