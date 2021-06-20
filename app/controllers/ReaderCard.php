<?php
    class ReaderCard extends Controller{
        private $ReaderCardModel;
        public function __construct()
        {
            $this->ReaderCardModel = $this->model("ReaderCardModel");
        }
        public function index(){
            
            $this->view("librarian/Reader-card-index");
        }
        public function list(){
            $this->view("librarian/Reader-card-list");
        }
        
       
    }
?>