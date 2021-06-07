<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Custom-scrollbar.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/general/Book-searching.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Book-form.css">

    <script> var data = <?php echo json_encode($data); ?>;</script>
    <script src="<?php echo URLROOT;?>public/js/Book-searching.js" defer></script>
    <title>Document</title>
</head>
<body>
    <?php
        if($_SESSION["role"] == "librarian"){
            require APPROOT."/views/includes/Librarian-nav-panel.php";
        }else{
            require APPROOT."/views/includes/Reader-nav-panel.php";
        }
    ?>
    <div class="top-bar-wrapper">
        <div class="top-bar-container">
            <div class="title-container">
                <i class="fas fa-search"></i>
                <h1>Book searching</h1>
            </div>
            <div class="user-icon-container">
                <input type="checkbox" id= "user-account-icon">
                <label for="user-account-icon"></label>
                <i class="fas fa-user"></i>
                <div class="user-account-features-panel">
                    <ul>
                        <li><i class="fas fa-key"></i>password</li>
                        <li><i class="fas fa-sign-out-alt"></i>Sign out</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- header -->
    <div class="feature-panel-wrapper">
        <div class="feature-panel" id="book-searching-panel">
            <div class="header-searching">
                
                <div class="search-bar">
                    <input type="text" placeholder = "Tìm kiếm sách & tác giả">
                    <button><i class="fas fa-search"></i> Tìm kiếm</button>
                </div>
            </div>
            <div class="book-list-section">
                <h2>Sách của thư viện</h2>
                <div class="book-list">
                    <div class="book-container">
                        <img src="<?php echo URLROOT;?>public/image/default-book-cover.png" alt="" class="book-cover" >
                        <div class="info-box">
                            <h3><i class="far fa-bookmark"></i> Two fate</h3>
                            <p><i class="far fa-user"></i> J.k rowling</p>
                            <div class="status">borrowed</div>
                        </div>
                    </div>
                    <div class="book-container">
                        <img src="<?php echo URLROOT;?>public/image/default-book-cover.png" alt="" class="book-cover" >
                        <div class="info-box">
                            <h3><i class="far fa-bookmark"></i> Two fate</h3>
                            <p><i class="far fa-user"></i> J.k rowling</p>
                            <div class="status">borrowed</div>
                        </div>
                    </div>
                    <div class="book-container">
                        <img src="<?php echo URLROOT;?>public/image/default-book-cover.png" alt="" class="book-cover" >
                        <div class="info-box">
                            <h3><i class="far fa-bookmark"></i> Two fate</h3>
                            <p><i class="far fa-user"></i> J.k rowling</p>
                            <div class="status">borrowed</div>
                        </div>
                    </div>
                    <div class="book-container">
                        <img src="<?php echo URLROOT;?>public/image/default-book-cover.png" alt="" class="book-cover" >
                        <div class="info-box">
                            <h3><i class="far fa-bookmark"></i> Two fate</h3>
                            <p><i class="far fa-user"></i> J.k rowling</p>
                            <div class="status">borrowed</div>
                        </div>
                    </div>
                    <div class="book-container">
                        <img src="<?php echo URLROOT;?>public/image/default-book-cover.png" alt="" class="book-cover" >
                        <div class="info-box">
                            <h3><i class="far fa-bookmark"></i> Two fate</h3>
                            <p><i class="far fa-user"></i> J.k rowling</p>
                            <div class="status">borrowed</div>
                        </div>
                    </div>
                    <div class="book-container">
                        <img src="<?php echo URLROOT;?>public/image/default-book-cover.png" alt="" class="book-cover" >
                        <div class="info-box">
                            <h3><i class="far fa-bookmark"></i> Two fate</h3>
                            <p><i class="far fa-user"></i> J.k rowling</p>
                            <div class="status">borrowed</div>
                        </div>
                    </div>
                    

                </div>
            </div>
            <div id="book-form-wrapper">
                <?php require APPROOT."/views/includes/Book-form.php"; ?>
            </div>
        </div>
    </div>
    <script>
        window.onload= function(){
            let formHeaderTitle = document.querySelector(".extended-info-form-outer .top-bar h2");
            formHeaderTitle.textContent= "Cập nhật sách";

            let submitAddBookBtn = document.getElementById("submit-add-book");
            submitAddBookBtn.value= "Cập nhật"
        }
        // change default adding book form text to update book form
        function hideForm(){
            let formWrapper = document.getElementById('book-form-wrapper');
            formWrapper.style.display = "none";
        }
    </script>
</body>
</html>