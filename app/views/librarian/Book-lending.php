
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/librarian/Book-lending.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Info-form.css">
    <script src="https://kit.fontawesome.com/a7cf4e395f.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php
        require APPROOT."/views/includes/Header.php";
        require APPROOT."/views/includes/Librarian-nav-panel.php";
    ?>
    <div class="feature-panel-wrapper">
        <div class="feature-panel" id="book-lending-panel">
        <div class="info-form-outer">
                <div class="left-box">
                    <div class="title-icon"><i class="fas fa-hand-holding"></i></div>
                    <div>
                        <h3>Cho mượn sách</h3>
                        <p>Nhập vào Mã độc giả và mã sách để được hệ thống kiểm tra và cho mượn sách</p>
                    </div>
                    <div class="right-arrow"><i class="fas fa-angle-right"></i></div>
                </div>
                <form action="POST" class="right-form">
                    <div class = "info-field">
                        <label for="">Mã độc giả</label>
                        <div class="input-field">
                            <input type="number" placeholder = "Reader Id" name = "readerId" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Mã sách</label>
                        <div class="input-field">
                            <input type="number" placeholder = "Book Id" name = "BookId" required>
                        </div>
                    </div>
                    
                    <input type="submit" value = "ADD" name = "submit">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
            