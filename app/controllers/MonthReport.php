
<?php
    class MonthReport extends Controller {

        private $MonthReportModel;
        public function __construct()
        {
            $this->MonthReportModel = $this->model("MonthReportModel");
        }
        public function index() {
            $this->view("librarian/Month-report");
            // $da = $this->MonthReportModel->getData(5, 2021);
            // foreach($da as $e) {
            //     echo $e->THE_LOAI;
            //     echo "<br>";
            //     echo $e->SO_LUOT_MUON;
            //     echo "<br>";
            //     echo $e->TI_LE;
            //     echo "<br>";
            // }
            if(isset($_POST['mr_create_report'])) {
                $data = $this->MonthReportModel->exportReport($_POST['month'], $_POST['year']);
                $rows = $this->MonthReportModel->getAllMonthYear();
                $total =$this->MonthReportModel->countRows($_POST['month'], $_POST['year']);

                $dataReport = [
                    'month'=>$_POST['month'],
                    'year'=>$_POST['year'],
                    'total'=>$total
                ];

                if($this->checkData($rows, $_POST['month'], $_POST['year'])) { // chua ton tai
                    $this->MonthReportModel->createMonthReport($dataReport);
                    $MonthReportId = $this->MonthReportModel->getMonthReportId($_POST['month'], $_POST['year']);
                    foreach($data as $e) {
                        $this->MonthReportModel->createMonthReportDetails($MonthReportId, $e->THE_LOAI, $e->TOTAL, $e->TOTAL/$total);
                    }
                    $this->MonthReportModel->getData($_POST['month'], $_POST['year']);
                }
                // da ton tai
                else {
                    $this->MonthReportModel->getData($_POST['month'], $_POST['year']);
                }
            }
        }

        public function checkData($rows, $month, $year) {
            foreach($rows as $row) {
                if($row->THANG == $month && $row->NAM == $year) return false;
            }
            return true;
        }
        
    }
?>