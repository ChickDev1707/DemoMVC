
<?php
    class MonthReport extends Controller {

        private $MonthReportModel;
        public function __construct()
        {
            $this->MonthReportModel = $this->model("MonthReportModel");
        }
        public function index() {
            $output = "";

            if(isset($_POST['submit_export_to_excel'])) {
                $data = $this->MonthReportModel->getData($_POST['month'], $_POST['year']);
                

                $output .= '
                    <table class="table" bordered="1">
                        <tr>
                            <th>The Loai</th>
                            <th>so luot muon</th>
                            <th>Ti le</th>
                        </tr>
                ';
                foreach($data as $e) {
                    $output .= '
                        <tr>
                            <td>'. $e->THE_LOAI .'</td>
                            <td>'. $e->SO_LUOT_MUON .'</td>
                            <td>'. $e->TI_LE .'</td>
                        </tr>
                    ';
                }
                $output .= '</table>';
                header("Content-Type: application/xls");    
                header("Content-Disposition: attachment; filename=reports.xls");
                echo $output;
                return;
            }
            
            if(isset($_POST['submit_get_report'])) {
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