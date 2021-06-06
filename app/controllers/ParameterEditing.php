
<?php
    class ParameterEditing extends Controller{

        public function __construct()
        {
            // $this->MonthReportModel = $this->model("MonthReportModel");
        }
        public function index() {
            // $data = [];
            $this->view("librarian/Parameter-editing");
            
        }
       
    }
?>