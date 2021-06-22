
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

    <script src="<?php echo URLROOT;?>public/js/Main.js"></script>
    <script> var data = <?php echo json_encode($data); ?>;</script>
    <script src="<?php echo URLROOT;?>public/js/Book-lending.js"></script>
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
                <h1>Mượn sách</h1>
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
                        <p>Nhập vào mã độc giả, mã sách và ngày mượn để được hệ thống kiểm tra và cho mượn sách</p>
                    </div>
                    <div class="right-arrow"><i class="fas fa-angle-right"></i></div>
                </div>
                <form method="POST" class="right-form">
                    <div class = "info-field">
                        <label for="">Mã độc giả</label>
                        <div class="input-field">
                            <input id="reader-card-id-input" type="number" placeholder = "Mã độc giả" name = "reader_card_id" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Mã sách</label>
                        <div class="input-field">
                            <input id="book-id-input" type="number" placeholder = "Mã sách" name = "book_id" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Ngày mượn</label>
                        <div class="input-field">
                            <input value= "<?php echo date("Y-m-d")?>" max="<?php echo date("Y-m-d")?>" type="date" name = "date" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Tên độc giả</label>
                        <div class="input-field">
                        <input id="reader-name-display-box" type="text" placeholder="Tên độc giả" name = "reader_name" readonly>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Tên sách</label>
                        <div class="input-field">
                        <input id="book-name-display-box" type="text" placeholder="Tên sách mượn" name = "book_name" readonly>
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
            