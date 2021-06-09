
<?php
    class MonthReport extends Controller {

        private $MonthReportModel;
        public function __construct()
        {
            $this->MonthReportModel = $this->model("MonthReportModel");
        }
        public function index() {
            
            if(isset($_POST['mr_create_report'])) {
                $message = "";
                $type = "correct";

                $dataExport = $this->MonthReportModel->exportReport($_POST['month'], $_POST['year']);
                if($dataExport == null) {
                    $message = "Không có lượt mượn nào trong tháng";
                    $type = "incorrect";

                    $this->view("librarian/Month-report");

                } else {
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

                }
                $vars = array($type, $message);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                    
                echo "<script> showMessageBox.apply(null, $jsVars);</script>";
                
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