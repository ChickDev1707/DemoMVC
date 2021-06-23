
<?php
    class BookLending extends Controller{
        private $bookLendingModel;
        public function __construct()
        {
            $this->bookLendingModel = $this->model('bookLendingModel');
        }
        public function index(){
            $data = [
                'readers'=> $this->bookLendingModel->getReaderNames(),
                'books'=> $this->bookLendingModel->getBookNames()
            ];
            $this->view("librarian/Book-lending", $data);

            if(isset($_POST['submit_lend_book'])){
                $data= [
                    'reader_card_id'=> $_POST['reader_card_id'],
                    'book_id'=> $_POST['book_id'],
                    'date'=> $_POST['date'],
                ];
                
                $message = "";
                $type = "correct";
                $errorMessage = $this->getErrorMessage($data);

                if($errorMessage != ""){
                    $message = $errorMessage;
                    $type = "incorrect";
                    // has error;
                }else{
                    $message = "Mượn sách thành công!";
                    
                    $this->bookLendingModel->createBookLendingCard($data); 
                    $this->bookLendingModel->updateBookStatus($data['book_id']);
                }
                $vars = array($type, $message);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                
                echo "<script> showMessageBox.apply(null, $jsVars);</script>";
            }
            
        }
        
        private function getErrorMessage($data){
            
            if($this->bookLendingModel->getReaderId($data['reader_card_id']) == null){
                return "Thẻ độc giả không tồn tại";
            }
            if($this->bookLendingModel->getBookId($data['book_id']) == null){
                return "Sách cần mượn không tồn tại";
            }
            // check exists
            
            if($this->isLendingDateViolateBookImportDate($data['book_id'], $data['date'])){
                return "Ngày mượn không được trước ngày nhập sách";
            }

            if($this->isLendingDateViolateLendingLimit($data['date'])){
                return "Ngày mượn vi phạm thời hạn mượn sách";
            }

            // natural constraints
            if($this->isExpiredReaderCard($data['reader_card_id'])){
                return "Thẻ độc giả của bạn đã hết hạn";
            }
            if($this->hasOverBorrowedLimitTimeBook($data['reader_card_id'])){
                return "Bạn có sách mượn quá hạn";
            }
            if($this->isBookBeingBorrowed($data['book_id'])){
                return "sách đã có người mượn";
            }
            if($this->isBorrowAmountExceededLimit($data['reader_card_id'])){
                return "Đã mượn đủ số lượng sách được mượn tối đa";
            }
            return "";
        }
        private function isLendingDateViolateBookImportDate($bookId, $lending){
            $importDate = $this->bookLendingModel->getBookImportDate($bookId);
            $importDate = strtotime($importDate);
            $lendingDate = strtotime($lending);
            $distance = getDifferenceBetweenDates($importDate, $lendingDate);
            if($distance>= 0) return false;
            else return true;
        }
        private function isLendingDateViolateLendingLimit($inputLendingDate){
            $lendingLimit = $this->bookLendingModel->getBorrowTimeLimit();
            $lendingDate = strtotime($inputLendingDate);
            $currentDate = strtotime(date("Y-m-d"));
            $distance = getDifferenceBetweenDates($lendingDate, $currentDate);
            if($distance<= $lendingLimit) return false;
            else return true;
        }
        
        private function isExpiredReaderCard($readerCardId){
            $createdDateData = $this->bookLendingModel->getReaderCardCreatedDate($readerCardId);
            $createdDate = strtotime($createdDateData);
            $currentDate = strtotime(date("Y-m-d"));
            $cardAge = getDifferenceBetweenDates($createdDate, $currentDate);

            $cardLimit = $this->bookLendingModel->getReaderCardTimeLimit();
            if($cardAge> $cardLimit) return true;
            else return false;
        }

        private function hasOverBorrowedLimitTimeBook($readerCardId){
            $borrowDays = $this->bookLendingModel->getBorrowDays($readerCardId);
            $borrowLimit = $this->bookLendingModel->getBorrowTimeLimit();
            $currentDate = strtotime(date("Y-m-d"));

            foreach($borrowDays as $day){
                $borrowedDate = strtotime($day->NGAY_MUON);
                $duration = getDifferenceBetweenDates($borrowedDate, $currentDate);
                if($duration> $borrowLimit) return true;
            }
            return false;
        }
        private function isBookBeingBorrowed($bookId){
            $status = $this->bookLendingModel->getBookStatus($bookId);
            if($status == 0) return false;
            else return true;
        }
        private function isBorrowAmountExceededLimit($readerId){
            $borrowedAmount = $this->bookLendingModel->getBorrowedBookAmount($readerId);
            $amountLimit = $this->bookLendingModel->getBorrowAmountLimit($readerId);
            if($borrowedAmount>= $amountLimit) return true;
            else return false;
        }
    }
    function getDifferenceBetweenDates($start, $end){
        return round(($end - $start)/60/60/24);
    }
    
?>
