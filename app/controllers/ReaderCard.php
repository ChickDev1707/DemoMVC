<?php
    class ReaderCard extends Controller{
        private $ReaderCardModel;
        public function __construct()
        {
            $this->ReaderCardModel = $this->model("ReaderCardModel");
        }
        public function index(){
            $authors = $this->ReaderCardModel->getAuthor();
            $this->view("librarian/Reader-card", $authors);

            if(isset($_POST['submit'])) {
                $data = [
                    'name'=>$_POST['name'],
                    'type'=>$_POST['type_of_Reader'],
                    'birthday'=>$_POST['date_of_birth'],
                    'address'=>$_POST['address'],
                    'email'=>$_POST['email'],
                    'dateCreate'=>$_POST['book_import']
                ];

                $message = "";
                $type = "correct";
                $errorMessage = $this->getErrorMessage($data);

                if($errorMessage != "") {
                    $message = $errorMessage;
                    $type = "incorrect";
                }else {
                    $message = "Tạo thẻ độc giả thành công!";
                    
                    $this->ReaderCardModel->CreateReaderCard($data);
                }
                $vars = array($type, $message);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                
                echo "<script> showMessageBox.apply(null, $jsVars);</script>";
                
            }
        }
        
        public function getErrorMessage($data) {
            $ageMin = $this->ReaderCardModel->getAgeMin();
            $ageMax = $this->ReaderCardModel->getAgeMax();

            if(!$this->valid_email($data['email'])) {
                return "Địa chỉ Email không hợp lệ!";

            } 
            if(!$this->CheckValidAge($_POST['date_of_birth'], $_POST['book_import'], $ageMin, $ageMax)) {
               return 'Độ tuổi không đúng với quy định!';
            }
            return "";
        }

        public function CheckValidAge($birthday, $dateCreated, $ageMin, $ageMax) {
            $days = strtotime($dateCreated)- strtotime($birthday);
            if($days < $ageMin * 31536000) {
                return false;
            } 
            if($days > $ageMax * 31536000) {
                return false;
            }
            return true;
        }

        public function valid_email($str) {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
        }
    }
?>