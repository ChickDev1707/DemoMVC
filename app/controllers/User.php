
<?php
    
    class User extends Controller{
        
        private $userModel;

        public function __construct()
        {
            $this->userModel = $this->model('UserModel');
        }
        
        public function loadCardRegister(){
            $this->view('user/readerCard/Register');
            if(isset($_POST['createCardSubmit'])){
                
                $data =[
                    'id'=> $_SESSION['userId'],
                    'name'=> $_POST['name'],
                    'type'=> $_POST['type'],
                    'dateOfBirth'=> $_POST['dateOfBirth'],
                    'address'=> $_POST['address'],
                    'email'=> $_POST['email'],
                    'createDate'=> date('d/m/Y'),
                    'imgName'=> 'abc.jpg',
                ];
                
                $this->userModel->setReaderCardInfo($data);
                $this->userModel->changeReaderCardStatus(['id'=> $_SESSION['userId']]);
                // update panel after create card 
                // hide form and show info
                $this->loadReaderInfo();
                echo "<script> appendReaderInfoPanel() </script>";
            }
        }
        public function loadReaderInfo(){
            $data = $this->userModel->getReaderCardInfo($_SESSION['userId']);
            $this->view('user/readerCard/Info', $data);
        }
        public function init(){
            $this->view("user/Main");
            if($_SESSION['createdCard'] == 0){
                $this->loadCardRegister();
            }else{
                $this->loadReaderInfo();
            }
        }
    }
    
?>