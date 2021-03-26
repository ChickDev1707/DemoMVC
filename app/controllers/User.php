
<?php
    require '../system/controller.php';
?>
<?php

    class User extends Controller{
        public function index(){
            $this->view('User');
        }
    }
    $userPage = new User();
    $userPage->index();
?>