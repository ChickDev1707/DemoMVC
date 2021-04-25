<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/general/Book-searching.css">
    <title>Document</title>
</head>
<body>
    <?php
        require APPROOT."/views/includes/Header.php";
        if($_SESSION["role"] == "librarian"){
            require APPROOT."/views/includes/Librarian-nav-panel.php";
        }else{
            require APPROOT."/views/includes/Reader-nav-panel.php";
        }
    ?>
    <div class="feature-panel-wrapper">
        <div class="feature-panel" id="book-searching-panel">
            <h1>book searching</h1>
        </div>
    </div>
</body>
</html>