


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/public/css/User.css">
    <script src= "http://localhost/MVC/public/js/User.js" defer></script>
    <title>Document</title>
</head>
<body>
    <?php 
        require APPROOT. "/views/Header.php";
    ?>
    <div id="list-wrapper">
        <ul id="user-list">
            <li class= "user-feature-tag">Reader Card</li>
            <li class= "user-feature-tag">Book look up</li>
            <li class= "user-feature-tag">Borrow book</li>
        </ul>
    </div>
    <div id="main-panel">
        <div id= "reader-card-panel">
            
        </div>
        <!-- add features -->
        <?php 
            require APPROOT. "/views/user/BookSearching.php";
            require APPROOT. "/views/user/BorrowBook.php";
        ?>
    </div>

</body>
</html>