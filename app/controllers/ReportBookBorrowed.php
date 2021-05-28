<?php
    class ReportBookBorrowed extends Controller {
        private $ReportBookBorrowedModel;
        public function __construct()
        {
            $this->ReportBookBorrowedModel = $this->model("ReportBookBorrowedModel");
        }
        public function index() {
            // $data = [];
           
            if(isset($_POST['submit'])) {
                $data = $this->ReportBookBorrowedModel->exportReport($_POST['month']);
                $numberOfRow =$this->ReportBookBorrowedModel->countRows();
                $this->view("librarian/ReportBookBorrowed", $data, $numberOfRow);
            } else {
                $this->view("librarian/ReportBookBorrowed");
            }
        }
        public function Statisticaltable($rows, $numberOfRow) {
            
        }
    }

?>