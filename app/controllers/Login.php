
<?php
    
    class Login extends Controller
    {
        private $loginModel;
        public function __construct()
        {
            $this->loginModel = $this->model('LoginModel');
        }
        public function init(){

            $this->view('Login');
            if(isset($_POST['submit'])){
                $accounts = $this->loginModel->getAccounts();
                // echo "user input". "<br>";
                $usernameInput = $_POST['username'];
                $passInput = $_POST['pass'];
                
                $usernames = $this->getUsernames($accounts);
                if(!in_array($usernameInput, $usernames)){
                    echo "no account";
                }else{
                    $password = $this->getPass($accounts, $usernameInput);
                    if($password == $passInput){
                        // login successfully
                        $user = $this->loginModel->getUser($usernameInput);
                        $this->createUserSession($user);
                        // use session to store userId permanently across pages
                        header("Location: http://localhost/MVC/public/User/init");
                    }
                    else echo "failed";
                }
            }
        }
        private function getUsernames($rows){
            $usernames = array();
            foreach($rows as $row){
                array_push($usernames, $row['USERNAME']);
            }
            return $usernames;
        }
        private function getPass($rows, $username){
            foreach($rows as $row){
                if($row['USERNAME'] == $username) return $row['USER_PASSWORD'];
            }
        }
        protected function createUserSession($user){
            $_SESSION['userId'] = $user->USERID;
            $_SESSION['username'] = $user->USERNAME;
            $_SESSION['password'] = $user->USER_PASSWORD;
            $_SESSION['createdCard'] = $user->KIEM_TRA_TAO_THE;
        }
    }
?>
