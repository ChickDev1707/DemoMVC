
<?php
    
    // class Login extends Controller
    // {
    //     private $loginModel;
    //     public function __construct()
    //     {
    //         $this->loginModel = $this->model('LoginModel');
    //     }
    //     public function init(){
            
    //         $this->view('Login');
    //         $this->signIn();
    //         $this->signUp();
    //     }
    //     private function signIn(){
    //         if(isset($_POST['sign-in'])){
    //             $accounts = $this->loginModel->getAccounts();
                
    //             $usernameInput = $_POST['username'];
    //             $passInput = $_POST['password'];
                
    //             $usernames = $this->getUsernames($accounts);
    //             if(!in_array($usernameInput, $usernames)){
    //                 echo "no account";
    //             }else{
    //                 $password = $this->getPass($accounts, $usernameInput);
    //                 if($password == $passInput){
    //                     // login successfully
    //                     $user = $this->loginModel->getUser($usernameInput);
    //                     $this->createUserSession($user);
    //                     // use session to store userId permanently across pages
    //                     header("Location: http://localhost/MVC/public/User/init");
    //                 }
    //                 else echo "failed";
    //             }
    //         }
    //     }
    //     private function signUp(){
    //         if(isset($_POST['sign-up'])){
    //             $accounts = $this->loginModel->getAccounts();
                
    //             $usernameInput = $_POST['username'];
    //             $passInput = $_POST['password'];
    //             $passConfirmInput = $_POST['confirmPassword'];
                
    //             $usernames = $this->getUsernames($accounts);
    //             if(in_array($usernameInput, $usernames)){
    //                 echo "this account is used";
    //             }else{
    //                 if($passInput != $passConfirmInput){
    //                     echo "confirm password doesn't match";
    //                 }else{
    //                     $data = ['username'=> $usernameInput,
    //                             'password'=> $passInput,
    //                             'createdCard'=> 0];
    //                     $this->loginModel->setUser($data);
    //                 }
    //             }
    //         }
    //     }
    //     private function getUsernames($rows){
    //         $usernames = array();
    //         foreach($rows as $row){
    //             array_push($usernames, $row->USERNAME);
    //         }
    //         return $usernames;
    //     }
    //     private function getPass($rows, $username){
    //         foreach($rows as $row){
    //             if($row->USERNAME == $username) return $row->USER_PASSWORD;
    //         }
    //     }
    //     protected function createUserSession($user){
    //         $_SESSION['userId'] = $user->USERID;
    //         $_SESSION['username'] = $user->USERNAME;
    //         $_SESSION['password'] = $user->USER_PASSWORD;
    //         $_SESSION['createdCard'] = $user->KIEM_TRA_TAO_THE;
    //     }
       
    // }
    // echo "hello world";
?>

<?php
    class Login extends Controller{
        
        public function init(){
            $this->view("Login");

            if(isset($_POST['login'])){
                $role = $_POST['role'];
                if($role === "librarian"){
                    
                    $_SESSION["role"]= "librarian";
                    header("Location: ". URLROOT. "Role/librarian");
                }else{
                    $_SESSION["role"]= "reader";
                    header("Location: ". URLROOT. "Role/reader");
                }
            }
        }
    }
?>