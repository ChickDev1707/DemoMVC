
<?php
    class MonthReport extends Controller {

        private $MonthReportModel;
        public function __construct()
        {
            $this->MonthReportModel = $this->model("MonthReportModel");
        }
        public function index() {
            
            if(isset($_POST['mr_create_report'])) {
                $dataMonthYear = [
                    'thang'=>$_POST['month'],
                    'nam'=>$_POST['year']
                ];
                $dataExport = $this->MonthReportModel->exportReport($_POST['month'], $_POST['year']);
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
                    foreach($dataExport as $e) {
                        $dataDetails = [
                            'id'=>$MonthReportId,
                            'type'=>$e->THE_LOAI,
                            'total'=>$e->TOTAL,
                            'rate'=>$e->TOTAL/$total
                        ];
                        $this->MonthReportModel->createMonthReportDetails($dataDetails);
                    }
                    $data = $this->MonthReportModel->getData($_POST['month'], $_POST['year']);
                    $this->view("librarian/Month-report", $data);
                }
                // da ton tai
                else {
                    $data = $this->MonthReportModel->getData($_POST['month'], $_POST['year']);
                    $this->view("librarian/Month-report", $data);
                }
            } else {
                $this->view("librarian/Month-report");
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