
<?php

    class User extends Controller{
        
        private $userModel;

        public function __construct()
        {
            $this->userModel = $this->model('UserModel');
        }
        
        public function createNewCard(){
            if(isset($_POST['createCardSub'])){
                
                $data =[
                    'id'=> $_SESSION['userId'],
                    'name'=> $_POST['name'],
                    'type'=> $_POST['type'],
                    'dob'=> $_POST['dob'],
                    'address'=> $_POST['address'],
                    'email'=> $_POST['email'],
                    'createDate'=> $_POST['createdDate'],
                    'imgName'=> 'abc.jpg',
                ];
                
                $this->userModel->setReaderCardInfo($data);
                
                $data = $this->userModel->getReaderCardInfo($_SESSION['userId']);
                $this->view('user/readerCard/Info', $data);
                $this->userModel->changeReaderCardStatus(['id'=> $_SESSION['userId']]);

                
            }
        }
        public function init(){
            $this->view("user/Main");
        }
    }
    
?>