<?php 

    // include '\xampp\php\PEAR';
    // require_once "..C:/xampp/php/pear/Classes/PHPEXcel.php";

?>
<?php
    class MonthReport extends Controller {
        private $MonthReportModel;
        public function __construct()
        {
            $this->MonthReportModel = $this->model("MonthReportModel");
        }
        public function index() {          
            if(isset($_POST['submit_export_to_excel'])) {
                $data = $this->MonthReportModel->getData($_POST['month'], $_POST['year']);

                $fileName = "export_data_month-" . date('Ymd') . ".csv"; 
 
                $output = null;
                    $flag = false;
                    foreach($data as $e) {
                        if (!$flag)
                        {
                            $output .= "THE LOAI" . ",";
                            $output .= "SO LUOT MUON" . ",";
                            $output .= "TI LE" . "\n";
                            $flag = true;

                        }
                        $output .= $e->THE_LOAI . ",";
                        $output .= $e->SO_LUOT_MUON . ",";
                        $output .= $e->TI_LE . "\n";

                    }
                    header("Content-Disposition: attachment; filename=\"$fileName\""); 
                    header("Content-Type: application/vnd.ms-excel");
                    header('Cache-Control: max-age=0');
                    header("Pragma: no-cache");
                    header("Expires: 0");
        
                    echo $output;
                    return;      

                // header("Content-Disposition: attachment; filename=\"$fileName\"");
                // header("Content-Type: application/vnd.openxmlformatofficedocument.spreadsheetml.sheet");
                // header("Content-Transfer-Encoding: binary");
                // header("Cache-Control: must-revalidate");
                // header("Pragma: no-cache");
            }   
            
            if(isset($_POST['submit_get_report'])) {
                $message = "";
                $type = "correct";

                $dataExport = $this->MonthReportModel->exportReport($_POST['month'], $_POST['year']);
                if($_POST['month'] == date('m', strtotime(date('Y-m-d'))) and $_POST['year'] == date('Y', strtotime(date('Y-m-d')))) {
                    $message = "Tháng vẫn chưa kết thúc!";
                    $type = "warning";

                    $this->view("librarian/Month-report");
                } else if($dataExport == null) {
                    $message = "Không có lượt mượn nào trong tháng";
                    $type = "warning";

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
                        $data = [
                            'info'=>$this->MonthReportModel->getData($_POST['month'], $_POST['year']),
                            'month'=>$_POST['month'],
                            'year'=>$_POST['year']
                        ];
                        $this->view("librarian/Month-report", $data);
                    }
                    // da ton tai
                    else {
                        $data = [
                            'info'=>$this->MonthReportModel->getData($_POST['month'], $_POST['year']),
                            'month'=>$_POST['month'],
                            'year'=>$_POST['year']
                        ];
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