
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/librarian/Book-lending.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Info-form.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Message-box.css">
    <script src="https://kit.fontawesome.com/a7cf4e395f.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php
        require APPROOT."/views/includes/Librarian-nav-panel.php";
    ?>
    <div class="top-bar-wrapper">
        <div class="top-bar-container">
            <div class="title-container">
                <i class="fas fa-hand-holding-medical"></i>
                <h1>Book lending</h1>
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
        <div class="feature-panel" id="book-lending-panel">
        <div class="info-form-outer">
                <div class="left-box">
                    <div class="title-icon"><i class="fas fa-hand-holding"></i></div>
                    <div>
                        <h3>Cho mượn sách</h3>
                        <p>Nhập vào mã phiếu mượn và ngày mượn để được hệ thống kiểm tra và cho mượn sách</p>
                    </div>
                    <div class="right-arrow"><i class="fas fa-angle-right"></i></div>
                </div>
                <form method="POST" class="right-form">
                    <div class = "info-field">
                        <label for="">Mã độc giả</label>
                        <div class="input-field">
                            <input type="number" placeholder = "Reader card Id" name = "lb_reader_card_id" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Mã sách</label>
                        <div class="input-field">
                            <input type="number" placeholder = "Book Id" name = "lb_book_id" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Ngày mượn</label>
                        <div class="input-field">
                            <input type="date" name = "lb_date" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Tên độc giả</label>
                        <div class="input-field">
                        <input type="text" placeholder="Reader's name" name = "lb_reader_name" readonly>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Tên sách</label>
                        <div class="input-field">
                        <input type="text" placeholder="Book's name" name = "lb_book_name" readonly>
                        </div>
                    </div>
                    <input type="submit" value = "Mượn sách" name = "submit_lend_book">
                </form>
            </div>
            <?php require APPROOT."/views/includes/Message-box.php"; ?>
        </div>
    </div>
</body>
</html>
            