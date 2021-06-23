
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

                // $output .= '
                //     <table class="table" bordered="1">
                //         <tr>
                //             <th>Tên sách</th>
                //             <th>Ngày mượn</th>
                //             <th>Số ngày trả trễ</th>
                //         </tr>
                // ';
                // foreach($data as $e) {
                //     $output .= '
                //         <tr>
                //             <td>'. $e->TEN_SACH .'</td>
                //             <td>'. date("d-m-Y", strtotime($e->NGAY_MUON)) .'</td>
                //             <td>'. $e->SO_NGAY_TRA_TRE .'</td>
                //         </tr>
                //     ';
                // }
                // $output .= '</table>';
                // header("Content-Type: application/xls");    
                // header("Content-Disposition: attachment; filename=reports.xls");
                // echo $output;
                // return;

                $fileName = "Report_data_day-" . date('Ymd') . ".xls"; 
 
                // Column names 
                $fields = array('TEN SACH', 'NGAY MUON', 'SO NGAY TRA TRE'); 
                
                // Display column names as first row 
                $excelData = implode("\t", array_values($fields)) . "\n";
                
                foreach($data as $e) {
                    $rowData = array($e->TEN_SACH, date("d-m-Y", strtotime($e->NGAY_MUON)), $e->SO_NGAY_TRA_TRE);
                    foreach($rowData as $str) {
                        $str = preg_replace("/\t/", "\\t", $str); 
                        $str = preg_replace("/\r?\n/", "\\n", $str);
                        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
                    }
                    $excelData .= implode("\t", array_values($rowData)) . "\n"; 
                }
                header("Content-Disposition: attachment; filename=\"$fileName\""); 
                header("Content-Type: application/vnd.ms-excel");
                header('Cache-Control: max-age=0');
                header("Pragma: no-cache");
                header("Expires: 0");

                // header("Content-Disposition: attachment; filename=\"$fileName\"");
                // header("Content-Type: application/vnd.openxmlformatofficedocument.spreadsheetml.sheet");
                // header("Content-Transfer-Encoding: binary");
                // header("Cache-Control: must-revalidate");
                // header("Pragma: no-cache");

                echo $excelData;
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