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
                $borrowedDate = $this->returnbookModel->findDateBorrowed($_POST['borrowCardId']);
                $expriedDaysBorrowed = $this->expriedDaysBorrowed($this->formatDate($borrowedDate->NGAY_MUON), $_POST['datereturn']);

                if($expriedDaysBorrowed < 0) {
                    $ErrMessage = "Invalid Date!";
                    echo $ErrMessage;
                    $this->showErrorMessage($ErrMessage);
                } else {

                    $borrowedDate = $this->returnbookModel->findDateBorrowed($_POST['borrowCardId']);
                    $TienPhatMoiNgay = $this->returnbookModel->getTienPhatMoiNgay();

                    $data = [
                        'ngay_tra'=>$_POST['datereturn'],
                        'so_ngay_tra_tre'=>$expriedDaysBorrowed,
                        'tien_phat_ky'=>$this->punishMoney($expriedDaysBorrowed, $TienPhatMoiNgay)
                    ];
                    $this->returnbookModel->updateBookCard($_POST['borrowCardId']);
                    $this->returnbookModel->updateReturnCard($data);
                }
                
            }
        }
        public function formatDate($date) {
            $time = strtotime($date);
            $newformatDate = date('Y-m-d',$time);
            return $newformatDate;
        }
        public function expriedDaysBorrowed($borrowed, $return) {
                return ((strtotime($return) - strtotime($borrowed)) / (60 * 60 * 24)) - 4;
        }
        public function punishMoney($numberDays, $tienphatmoingay) {
            return $numberDays * $tienphatmoingay;
        }
        // public function checkInvalidDate($borrowedDay, $returnDay) {
        //     $Brday = date("d",strtotime($borrowedDay));
        //     $Rtday = date("d",strtotime($returnDay));
        //     if(($Rtday - $Brday) < 0) {
        //         return false;
        //     }
        //     return true;
        // }   
        public function showErrorMessage($ErrMessage) {
            echo "
                <script>
                    let Message = document.querySelector('.message');
                    Message.innerText =  '$ErrMessage'
                </script>
            ";
        }
    }
?>  