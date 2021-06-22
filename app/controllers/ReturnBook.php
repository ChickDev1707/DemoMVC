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
                'BookAndReaderIds'=>$this->returnbookModel->getReaderIdsAndBookIds(),
                'punishMoneyEveryDay'=>$this->returnbookModel->getTienPhatMoiNgay(),
                'borrowDayMax'=>$this->returnbookModel->getBorrowDayMax()
            ];
            $dataTesting = $this->returnbookModel->getReaderIdsAndBookIds();

            $this->view('librarian/ReturnBook', $data);
            $borrowDayMax = $this->returnbookModel->getBorrowDayMax();
            
            if(isset($_POST['submit_lend_book'])) {
                $message = "";
                $type = "correct";

                if($this->checkIdReturnCard($dataTesting, $_POST['rb_card_id'])) {
                    $message = "Mã phiếu mượn không hợp lệ!";
                    $type = "incorrect";
                } else {
                    $borrowedDate = $this->returnbookModel->findDateBorrowed($_POST['rb_card_id']);
                    $expriedDaysBorrowed = $this->expriedDaysBorrowed($this->formatDate($borrowedDate->NGAY_MUON), $_POST['rb_date']);

                    $bookId = $this->returnbookModel->getBookId($_POST['rb_card_id']);
                    $readerId = $this->returnbookModel->getReaderId($_POST['rb_card_id']);

                    $errorMessage = $this->getErrorMessage($expriedDaysBorrowed, $dataTesting, $_POST['rb_card_id']);

                    if($errorMessage != "") {
                        $message = $errorMessage;
                        $type = "incorrect";
                    } else if($expriedDaysBorrowed <= $borrowDayMax) {
                        $message = "Trả sách thành công!";

                        $data = [
                            'ma_phieu_muon_tra'=>$_POST['rb_card_id'],
                            'ngay_tra'=>$_POST['rb_date']
                        ];
                        $this->returnbookModel->updateBookCard($bookId);
                        $this->returnbookModel->updateReturnCard($data);
                    } else {
                        $message = "Trả sách bị quá hạn!";

                        $borrowedDate = $this->returnbookModel->findDateBorrowed($_POST['rb_card_id']);
                        $TienPhatMoiNgay = $this->returnbookModel->getTienPhatMoiNgay();
                        $fine = $this->punishMoney($expriedDaysBorrowed, $borrowDayMax, $TienPhatMoiNgay);

                        $data = [
                            'ma_phieu_muon_tra'=>$_POST['rb_card_id'],
                            'ngay_tra'=>$_POST['rb_date'],
                            'so_ngay_tra_tre'=>$expriedDaysBorrowed - $borrowDayMax,
                            'tien_phat_ky'=>$fine
                        ];

                        $this->returnbookModel->updateBookCard($bookId);
                        $this->returnbookModel->updateReaderCard($readerId, $fine);
                        $this->returnbookModel->updateReturnCardLate($data);
                    }
                }

                $vars = array($type, $message);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                    
                echo "<script> showMessageBox.apply(null, $jsVars);</script>";
                
            }
        }
        public function formatDate($date) {
            $time = strtotime($date);
            $newformatDate = date('Y-m-d',$time);
            return $newformatDate;
        }

        public function expriedDaysBorrowed($borrowed, $return) {
                return ((strtotime($return) - strtotime($borrowed)) / (60 * 60 * 24)) ;
        }

        public function punishMoney($numberDays, $borrowDayMax, $tienphatmoingay) {
            return ($numberDays - $borrowDayMax) * $tienphatmoingay;
        }

        public function getErrorMessage($expriedDay, $data, $id) {
            if($this->checkIdReturnCard($data, $id)) 
            return "Mã phiếu mượn không hợp lệ!";
            if($expriedDay < 0)
            return "Ngày trả không hợp lệ!";
            return "";
        }

        public function checkIdReturnCard($data, $id) {
            foreach($data as $e) {
                if($e->MA_PHIEU_MUON_TRA == $id) return false;
            }
            return true;
        }
    } 
?>  