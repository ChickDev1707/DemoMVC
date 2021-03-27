<?php 
    require "../app/require.php";
    require '../app/controllers/User.php';
    
    // get user controller;
    $userContr = new User();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href= "css/user-main-page.css">
    <script src= "./js/user-main-page.js"></script>
    <title>Document</title>
</head>
<body>
    <?php 
        $userContr->header();
    ?>
    <div id="list-wrapper">
        <ul id="user-list">
            <li class= "user-feature-tag">Reader Card</li>
            <li class= "user-feature-tag">Book look up</li>
            <li class= "user-feature-tag">Borrow book</li>
        </ul>
    </div>
    <div id="main-panel">
        <!-- add features -->
        <?php 
            $userContr->features();
        ?>
    </div>
</body>
</html>

