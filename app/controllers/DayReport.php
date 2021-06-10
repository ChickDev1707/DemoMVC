
<?php
    class DayReport extends Controller{

        private $dayReportModel;

        public function __construct()
        {
            $this->dayReportModel = $this->model('DayReportModel');
        }

        public function index(){  

            $rows = $this->dayReportModel->getAllDay();
            
            if(isset($_POST['mr_query_report'])) {

                $message = "";
                $type = "correct";

                $info = $this->dayReportModel->getInfoLatePaymentBook($_POST['date_report']);
                if($info == null) {
                    $message = "Không có sách trả trễ nào trong ngày";
                    $type = "incorrect";
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
                            $loadedData = $this->dayReportModel->getDataFromDayReport($_POST['date_report']);
                            $this->view("librarian/Day-report", $loadedData);
                        }
                        
                    } else { // da lap bao cao
                        $loadedData = $this->dayReportModel->getDataFromDayReport($_POST['date_report']);
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