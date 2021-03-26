
<?php
    require '../system/controller.php';
?>
<?php
    class Pages extends Controller
    {
        public function index(){
            $this->view('User');
            $userModel = $this->model('User');
            $userModel->getUser();
        }
    }
    $myPages = new Pages();
    $myPages->index();
?>
