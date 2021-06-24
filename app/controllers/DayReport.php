
<?php
    class DayReport extends Controller{

        private $dayReportModel;

        public function __construct()
        {
            $this->dayReportModel = $this->model('DayReportModel');
        }

        public function index(){  

            //$output = "";

            if(isset($_POST['submit_export_to_excel'])) {

                $data = $this->dayReportModel->getDataFromDayReport($_POST['date_report']);

                $fileName = "export_data_day-" . date('Ymd') . ".csv"; 
 
                $output = null;
                $flag = false;
                    foreach($data as $e) {
                        if (!$flag)
                        {
                            $output .= "TEN SACH" . ",";
                            $output .= "NGAY MUON" . ",";
                            $output .= "SO NGAY TRA TRE" . "\n";
                            $flag = true;

                        }
                        $output .= $e->TEN_SACH . ",";
                        $output .= date("d-m-Y", strtotime($e->NGAY_MUON)) . ",";
                        $output .= $e->SO_NGAY_TRA_TRE . "\n";

                    }
                header("Content-Disposition: attachment; filename=\"$fileName\""); 
                header("Content-Type: application/vnd.ms-excel");
                header('Cache-Control: max-age=0');
                header("Pragma: no-cache");
                header("Expires: 0");
    
                echo $output;
                return;

            }

            $rows = $this->dayReportModel->getAllDay();
            
            if(isset($_POST['submit_get_report'])) {

                $message = "";
                $type = "correct";

                $info = $this->dayReportModel->getInfoLatePaymentBook($_POST['date_report']);
                if($info == null) {
                    $message = "Không có sách trả trễ nào trong ngày";
                    $type = "warning";
                    $this->view("librarian/Day-report");
                    
                } else {
                    if($this->checkDate($rows, $_POST['date_report'])) {
                        foreach($info as $item) {
                            $data = [
                                'ngay'=>$_POST['date_report'],
                                'ten_sach'=>$item->TEN_SACH,
                                'ngay_muon'=>$item->NGAY_MUON,
                                'so_ngay_tra_tre'=>$item->SO_NGAY_TRA_TRE
                            ];
                            //tao the
                            $this->dayReportModel->createLatePaymentCard($data);
                            // lay thong tin cua the
                            $loadedData = [
                                'info'=>$this->dayReportModel->getDataFromDayReport($_POST['date_report']),
                                'date'=>$_POST['date_report']
                            ];
                            $this->view("librarian/Day-report", $loadedData);
                        }
                        
                    } else { // da lap bao cao
                        $loadedData = [
                            'info'=>$this->dayReportModel->getDataFromDayReport($_POST['date_report']),
                            'date'=>$_POST['date_report']
                        ];
                        $this->view("librarian/Day-report", $loadedData);
                    }
                }
                

                $vars = array($type, $message);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                    
                echo "<script> showMessageBox.apply(null, $jsVars);</script>";

            } else {
                $this->view("librarian/Day-report");
            }
            
        }
        public function checkDate($rows, $date) {
            foreach($rows as $row) {
                if($date == date('Y-m-d', strtotime($row->NGAY))) return false;
            }
            return true;
        }

    }
?>