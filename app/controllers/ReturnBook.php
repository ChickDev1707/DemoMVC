<?php
    class ReturnBook extends Controller {
        private $returnbookModel;
        public function __construct()
        {
            $this->returnbookModel = $this->model('ReturnBookModel');
        }
        public function index () {
            $data = [
                'readers'=> $this->returnbookModel->getReaderNames(),
                'books'=> $this->returnbookModel->getBookNames(),
                'BookAndReaderIds'=>$this->returnbookModel->getReaderIdsAndBookIds()
            ];

            $this->view('librarian/ReturnBook', $data);
            
            if(isset($_POST['submit_lend_book'])) {
                $borrowedDate = $this->returnbookModel->findDateBorrowed($_POST['rb_card_id']);
                $expriedDaysBorrowed = $this->expriedDaysBorrowed($this->formatDate($borrowedDate->NGAY_MUON), $_POST['rb_date']);

                if($expriedDaysBorrowed < 0) {
                    $ErrMessage = "Invalid Date!";
                    echo $ErrMessage;
                    $this->showErrorMessage($ErrMessage);
                } else if($expriedDaysBorrowed <= 4) {
                    $data = [
                        'ma_phieu_muon_tra'=>$_POST['rb_card_id'],
                        'ngay_tra'=>$_POST['rb_date']
                    ];
                    $this->returnbookModel->updateBookCard($_POST['rb_card_id']);
                    $this->returnbookModel->updateReturnCard($data);
                } else {

                    $borrowedDate = $this->returnbookModel->findDateBorrowed($_POST['rb_card_id']);
                    $TienPhatMoiNgay = $this->returnbookModel->getTienPhatMoiNgay();

                    $data = [
                        'ma_phieu_muon_tra'=>$_POST['rb_card_id'],
                        'ngay_tra'=>$_POST['rb_date'],
                        'so_ngay_tra_tre'=>$expriedDaysBorrowed,
                        'tien_phat_ky'=>$this->punishMoney($expriedDaysBorrowed, $TienPhatMoiNgay)
                    ];
                    $this->returnbookModel->updateBookCard($_POST['rb_card_id']);
                    $this->returnbookModel->updateReturnCardLate($data);
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