
<?php
    require '../system/controller.php';
?>
<?php
    class MainPage extends Controller
    {
        
        public $loginModel;
        public function __construct()
        {   
            $this->loginModel = $this->model('Login');
        }
        public function startView(){
            $this->view('Login');
            // $userModel = $this->model('Login');
            // $userModel->getUser();
        }
        
    }
?>
