
<?php
    class ReaderCard extends Controller{
        private $ReaderCardModel;
        public function __construct()
        {
            $this->ReaderCardModel = $this->model("ReaderCardModel");
        }
        public function index(){
            $author = $this->ReaderCardModel->getAuthor();
            $ageMin = $this->ReaderCardModel->getAgeMin();
            $ageMax = $this->ReaderCardModel->getAgeMax();
            $this->view("librarian/Reader-card", $author);
            if(isset($_POST['submit'])) {
                $data = [
                    'name'=>$_POST['name'],
                    'type'=>$_POST['type_of_Reader'],
                    'birthday'=>$_POST['date_of_birth'],
                    'address'=>$_POST['address'],
                    'email'=>$_POST['email'],
                    'dateCreate'=>$_POST['book_import']
                ];
                // $errMessage = $this->FormValidation($data);
                if(!$this->valid_email($data['email'])) {
                    $errMessage = "Invalid Email address!";
                    $this->showErrorMessage($errMessage);

                } else if(!$this->CheckValidAge($_POST['date_of_birth'], $ageMin, $ageMax)) {
                    $errMessage = 'Độ tuổi không đúng với quy định!';
                    $this->showErrorMessage($errMessage);
                } else {
                    $this->ReaderCardModel->CreateUserAccount($data);
                    $this->ReaderCardModel->CreateReaderCard($data);
                }
            }
        }
        public function CheckValidAge($birthday, $ageMin, $ageMax) {
            if(is_string($birthday)) {
                $birthday = strtotime($birthday);
            }
            // 31536000 is the number of seconds in a 365 days year.
            if(time() - $birthday < $ageMin * 31536000)  {
                return false;
            }
            if(time() - $birthday > $ageMax * 31536000) {
                return false;
            }

            return true;
        }
        // public function FormValidation($data) {
        //     $errMessage = "";
        //     if(!$this->valid_email($data['email'])) {
        //         $errMessage = "Invalid Email address!";
        //     }
        //     return $errMessage;
        // }

        public function showErrorMessage($errMessage) {
            echo "
                <script>
                    let Message = document.querySelector('.message');
                    Message.innerText =  '$errMessage'
                </script>
            ";
        }

        public function valid_email($str) {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
        }
    }
?>