
<?php
    class MonthReport extends Controller{

        private $MonthReportModel;
        public function __construct()
        {
            $this->MonthReportModel = $this->model("MonthReportModel");
        }
        public function index() {
            // $data = [];
           
            if(isset($_POST['submit'])) {
                $data = $this->MonthReportModel->exportReport($_POST['month']);
                $numberOfRow =$this->MonthReportModel->countRows();
                $this->view("librarian/Month-report", $data, $numberOfRow);
            } else {
                $this->view("librarian/Month-report");
            }
        }
        // public function Statisticaltable($rows, $numberOfRow) {
            
        // }
    }
?>