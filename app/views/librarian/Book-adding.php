<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/librarian/Book-adding.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Message-box.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Book-form.css">

    <script src="https://kit.fontawesome.com/a7cf4e395f.js" crossorigin="anonymous"></script>
    <script src="<?php echo URLROOT;?>public/js/Main.js"></script>
    <title>Document</title>
</head>
<body>
    <?php
        require APPROOT."/views/includes/Librarian-nav-panel.php";
    ?>
    <div class="top-bar-wrapper">
        <div class="top-bar-container">
            <div class="title-container">
                <i class="fas fa-plus"></i>
                <h1>Book adding</h1>
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
        <div class="feature-panel" id="book-adding-panel">
            <?php require APPROOT."/views/includes/Book-form.php"; ?>
            <?php require APPROOT."/views/includes/Message-box.php"; ?>
        </div>
    </div>
</body>
</html>
