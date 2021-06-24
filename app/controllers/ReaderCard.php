<?php
    class ReaderCard extends Controller{
        private $ReaderCardModel;
        public function __construct()
        {
            $this->ReaderCardModel = $this->model("ReaderCardModel");
        }
        public function index(){
            session_start();

            if(isset($_POST['submit_update_reader'])) {               
                $_SESSION['id'] = $_POST['reader_card_id'];          
            }

            if(isset($_POST['submit_delete_reader'])){
                $_SESSION['id'] = $_POST['reader_card_id'];
            }

            if(isset($_POST['submit_delete']) && isset($_SESSION['id'])) { 
                $message = "";
                $type = "correct";
                $errorMessage = $this->deleteErrorMessage($_SESSION['id']);
                if($errorMessage != "") {
                    $message = $errorMessage;
                    $type = "incorrect";
                } else {
                    $message = "Xóa độc giả thành công!";

                    $this->ReaderCardModel->deleteFineCard($_SESSION['id']);
                    $this->ReaderCardModel->deleteBorrowCard($_SESSION['id']);
                    $this->ReaderCardModel->deleteReaderCard($_SESSION['id']);
                }
                
                

                $this->display();

                $vars = array($type, $message);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                
                echo "<script> showMessageBox.apply(null, $jsVars);</script>";
                echo "<script> 
                    focusReaderCardListTab();
                    </script>";
            }else if(isset($_POST['submit_create_card'])) {
                $data = [
                    'name'=>$_POST['name'],
                    'type'=>$_POST['type_of_Reader'],
                    'birthday'=>$_POST['date_of_birth'],
                    'address'=>$_POST['address'],
                    'email'=>$_POST['email'],
                    'dateCreate'=>$_POST['create_date']
                ];
                // print_r($data);
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
                $this->display();
                $vars = array($type, $message);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                
                echo "<script> showMessageBox.apply(null, $jsVars);</script>";
                
            } else if(isset($_POST['submit_update_reader_info'])) {
                $dataUpdate = [
                    'id'=>$_SESSION['id'],
                    'name'=>$_POST['update_name'],
                    'type'=>$_POST['update_type_of_Reader'],
                    'birthday'=>$_POST['update_date_of_birth'],
                    'address'=>$_POST['update_address'],
                    'email'=>$_POST['update_email'],
                    'dateCreate'=>$_POST['update_create_date']
                ];

                $message = "";
                $type = "correct";
                $errorMessage = $this->getErrorMessage($dataUpdate);

                if($errorMessage != "") {
                    $message = $errorMessage;
                    $type = "incorrect";
                }else {
                    $message = "Cập nhật độc giả thành công!";
                    
                    $this->ReaderCardModel->updateReaderCard($dataUpdate);
                }

                $this->display();
                $vars = array($type, $message);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                
                echo "<script> showMessageBox.apply(null, $jsVars);</script>";
                echo "<script> 
                    focusReaderCardListTab();
                    </script>";
            } else {
                $this->display();
            }


        }
        
        public function getErrorMessage($data) {
            $ageMin = $this->ReaderCardModel->getAgeMin();
            $ageMax = $this->ReaderCardModel->getAgeMax();

            if(!$this->valid_email($data['email'])) {
                return "Địa chỉ Email không hợp lệ!";

            }            
            if(!$this->CheckValidAge($data['birthday'], $data['dateCreate'], $ageMin, $ageMax)) {
               return 'Độ tuổi không đúng với quy định!';
            }           
            if(!$this->checkDateCreate($data['dateCreate'])) {
                return "Ngày tạo thẻ vi phạm quy định!";
            }
            return "";
        }

        public function CheckValidAge($birthday, $dateCreated, $ageMin, $ageMax) {
            $minYearOld = date("Y-m-d", strtotime("-".$ageMin." year", strtotime($dateCreated)));
            $maxYearOld = date("Y-m-d", strtotime("-".$ageMax." year", strtotime($dateCreated)));
            if($minYearOld < $birthday) {
                return false;
            }
            if($maxYearOld > $birthday) {
                return false;
            }
            return true;
        }

        public function checkDateCreate($dateCreate) {
            $timeDuration = $this->ReaderCardModel->getTimeDuration();
            if(date('Y-m-d', strtotime(' -'.$timeDuration.' day')) > $dateCreate) {
                return false;
            }
            return true;
        }
        public function valid_email($str) {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? false : true;
        }

        public function valid_name($str) {
            return (!preg_match("/^[a-zA-Z](?!.*[ ]{3})[a-zA-Z ]+$/", $str)) ? false : true;
        }

        public function valid_address($str) {
            return (!preg_match("/^[a-zA-Z0-9](?!.*[ ]{3})[a-zA-Z0-9 ]+$/", $str)) ? false : true;
        }

        private function addUpdateReaderListener(){
            if(isset($_POST['submit_update_reader'])) {  

                echo "<script> 
                    focusReaderCardListTab();
                    showUpdateReaderForm();
                    </script>";
            } 
        }
        private function addDeleteReaderListener(){
            if(isset($_POST['submit_delete_reader'])) {

                echo "<script> 
                    focusReaderCardListTab();
                    showDeleteElementMessageBox('warning', 'Xóa độc giả sẽ xóa toàn bộ các dữ liệu liên quan đến độc giả đó!');
                </script>";
            }
        }
        private function display() {
            $typeOfReaders = $this->ReaderCardModel->getTypeOfReaders();
            $infoReaderCards = $this->ReaderCardModel->getReaderCards();
            if(isset($_SESSION['id'])) {
                $infoSingleCard = $this->ReaderCardModel->getSingleReader($_SESSION['id']);
                $dataInfo = [
                    'type_of_readers'=>$typeOfReaders,
                    'info_reader_cards'=>$infoReaderCards,
                    'info_single_card'=>$infoSingleCard
                ];

            } else {
                $dataInfo = [
                    'type_of_readers'=>$typeOfReaders,
                    'info_reader_cards'=>$infoReaderCards
                ];
            }
            $this->view("librarian/Reader-card", $dataInfo);
            $this->addUpdateReaderListener();
            $this->addDeleteReaderListener();
        }

        private function deleteErrorMessage($id) {
            if($this->ReaderCardModel->ValidReaderInFineCard($id) != null or $this->ReaderCardModel->ValidReaderInReaderCard($id)) {
                return "Độc giả vẫn còn nợ!";
            }
            if($this->ReaderCardModel->ValidReaderInBorowCard($id) != null) {
                return "Độc giả vẫn còn sách đang mượn!";
            }
            return "";
        } 
    }
?>