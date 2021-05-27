<?php
    class ReturnBook extends Controller {
        private $returnbookModel;
        public function __construct()
        {
            $this->returnbookModel = $this->model('ReturnBookModel');
        }
        public function index () {
            $this->view('librarian/ReturnBook');
           
            if(isset($_POST['returnBook'])) {

                $ma_phieu_muon = $this->returnbookModel->getMaMuonSach($_POST['readerId'], $_POST['bookId']);

                $borrowedDate = $this->returnbookModel->findDateBorrowed($ma_phieu_muon->MA_PHIEU_MUON);
                
                $expriedDays = $this->numberDaysBorrowed($this->formatDate($borrowedDate->NGAY_MUON), $_POST['datereturn']);
                
                $numberDaysBorrowed = $this->numberDaysBorrowed($this->formatDate($borrowedDate->NGAY_MUON), $_POST['datereturn']);
                
                $data = [
                    'readerId'=>$_POST['readerId'],
                    'bookId'=>$_POST['bookId'],
                    'ngay_tra'=>$_POST['datereturn'],
                    'ngay_muon'=>$this->formatDate($borrowedDate->NGAY_MUON),
                    'so_ngay_muon'=>$numberDaysBorrowed,
                    'so_tien_phat'=>$this->punishMoney($expriedDays)
                ];
                $this->checkInvalidDate($this->formatDate($borrowedDate->NGAY_MUON), $_POST['datereturn']);
                $this->returnbookModel->createReturnBookCard($data);
            }
        }
        public function formatDate($borrowed) {
            $time = strtotime($borrowed);
            $newformatDate = date('Y-m-d',$time);
            return $newformatDate;
        }
        public function numberDaysBorrowed($borrowed, $return) {
                // var_dump($borrowed);
                return (strtotime($return) - strtotime($borrowed)) / (60 * 60 * 24);
        }
        public function punishMoney($numberDays) {
            return ($numberDays - 4) * 1000;
        }
        public function checkInvalidDate($borrowedDay, $returnDay) {
            $Brday = date("d",strtotime($borrowedDay));
            $Rtday = date("d",strtotime($returnDay));
            if(($Rtday - $Brday) < 0) {
                echo "invalid Date!";
            }
             
        }   
    }
?>  