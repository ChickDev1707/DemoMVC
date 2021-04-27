<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
                    <div class="book-item">
                        <div class="item-main-picture">
                            <img src="https://cdn.tgdd.vn/2021/04/campaign/3048628-4726801454-death-740x4312x-640x360.jpeg" alt="">
                        </div>
                        <div class="item-footer-describe">
                            <h1>Name</h1>
                            <h4>Author</h4>
                            <i class="far fa-calendar"></i>
                            <span>Publish</span>
                        </div>
                    </div>
                    <div class="book-item">
                        <div class="item-main-picture">
                            <img src="https://cdn.tgdd.vn/2021/04/campaign/3048628-4726801454-death-740x4312x-640x360.jpeg" alt="">
                        </div>
                        <div class="item-footer-describe">
                            <h1>Name</h1>
                            <h4>Author</h4>
                            <i class="far fa-calendar"></i>
                            <span>Publish</span>
                        </div>
                    </div>
                    <div class="book-item">
                        <div class="item-main-picture">
                            <img src="https://cdn.tgdd.vn/2021/04/campaign/3048628-4726801454-death-740x4312x-640x360.jpeg" alt="">
                        </div>
                        <div class="item-footer-describe">
                            <h1>Name</h1>
                            <h4>Author</h4>
                            <i class="far fa-calendar"></i>
                            <span>Publish</span>
                        </div>
                    </div>
                    <div class="book-item">
                        <div class="item-main-picture">
                            <img src="https://cdn.tgdd.vn/2021/04/campaign/3048628-4726801454-death-740x4312x-640x360.jpeg" alt="">
                        </div>
                        <div class="item-footer-describe">
                            <h1>Name</h1>
                            <h4>Author</h4>
                            <i class="far fa-calendar"></i>
                            <span>Publish</span>
                        </div>
                    </div>
                    <div class="book-item">
                        <div class="item-main-picture">
                            <img src="https://cdn.tgdd.vn/2021/04/campaign/3048628-4726801454-death-740x4312x-640x360.jpeg" alt="">
                        </div>
                        <div class="item-footer-describe">
                            <h1>Name</h1>
                            <h4>Author</h4>
                            <i class="far fa-calendar"></i>
                            <span>Publish</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>