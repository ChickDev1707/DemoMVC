

<?php
    class FineCard extends Controller{

        private $fineCardModel;
        public function __construct()
        {
            $this->fineCardModel = $this->model('FineCardModel');
        }
        public function index(){
            $data = $this->fineCardModel->getAllReadersInfo();
            
            $this->view("librarian/Fine-card", $data);

            if(isset($_POST['submit_get_fine'])){
                $data= [
                    'reader_card_id'=> $_POST['reader_card_id'],
                    'received_money'=> $_POST['received_money'],
                    'remain_money'=> (int)$_POST['remain_money'],
                ];
                
                $message = "";
                $type = "correct";
                $errorMessage = $this->getErrorMessage($data);

                if($errorMessage != ""){
                    $message = $errorMessage;
                    $type = "incorrect";
                    // has error;
                }else{
                    $message = "Thu tiền thành công!";
                    
                    $this->fineCardModel->createFineCard($data); 
                    $this->fineCardModel->updateTotalFine($data['reader_card_id'], $data['remain_money']);
                }
                $vars = array($type, $message);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                
                echo "<script> showMessageBox.apply(null, $jsVars);</script>";
            }
            
        }
        
        private function getErrorMessage($data){
            
            if($this->fineCardModel->getReaderId($data['reader_card_id']) == null){
                return "Thẻ độc giả không tồn tại";
            }
            if($data['remain_money']< 0){
                return "Số tiền thu lớn hơn tổng nợ";
            }
            
            return "";
        }
        
    }
?>