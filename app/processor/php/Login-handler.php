
<?php
    require_once './Login.php';
?>
<?php
    $myPage = new MainPage();
    if(isset($_POST['submit'])){
        $accounts = $myPage->loginModel->getAccounts();
        // echo "user input". "<br>";
        $usernameInput = $_POST['username'];
        $passInput = $_POST['pass'];
        
        $usernames = getUsernames($accounts);
        if(!in_array($usernameInput, $usernames)){
            echo "no account";
        }else{
            $password = getPass($accounts, $usernameInput);
            if($password == $passInput){
                header("Location: http://localhost/MVC/app/controllers/User.php");
            }
            else echo "failed";
        }
    }
    function getUsernames($rows){
        $usernames = array();
        foreach($rows as $row){
            array_push($usernames, $row['USERNAME']);
        }
        return $usernames;
    }
    function getPass($rows, $username){
        foreach($rows as $row){
            if($row['USERNAME'] == $username) return $row['PASSWORD'];
        }
    }
?>