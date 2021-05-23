<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/general/Book-searching.css">
    <script> var data = <?php echo json_encode($data); ?>;</script>
    <script src="<?php echo URLROOT;?>public/js/Book-searching.js" defer></script>
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
            <div class="header-searching">
                <h1>Book Searching</h1>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder = "Search for books & author">
                </div>
            </div>
            <div class="main-searching">
                <h2>Trending now</h2>
                <div class="book-list">
                   
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>