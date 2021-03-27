
<?php
    class LoginContr extends Controller
    {
        private $loginModel;
        public function __construct()
        {
            $this->loginModel = $this->model('Login');
        }
        public function loadView(){

            $data = [
                'title'=> 'test'
            ];
            $this->view('Login', $data);
            // $userModel = $this->model('Login');
            // $userModel->getUser();
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
                if($row['USERNAME'] == $username) return $row['PASSWORD'];
            }
        }
        public function check(){
            
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
                        $id = $this->loginModel->getUserId($usernameInput);
                        $this->createUserSession($id);
                        // use session to store userId permanently across pages
                        return true;
                    }
                    else echo "failed";
                }
            }
        }
        protected function createUserSession($id){
            $_SESSION['userId'] = $id;
        }
    }
?>
