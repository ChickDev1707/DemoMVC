
<?php
    require "../app/require.php";
    require "../app/controllers/Login.php";
    // require "../app/controllers/User.php";
?>

<?php
    $loginContr = new LoginContr();
    $loginContr->loadView();
    
    if($loginContr->check()){
        // login 
        // directing to user page
        header("Location: http://localhost/MVC/public/user-main-page.php");
        
    }

?>
