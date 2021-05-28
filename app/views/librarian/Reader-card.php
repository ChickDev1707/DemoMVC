<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/librarian/Reader-card.css">
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
        <div class="feature-panel" id="reader-card-panel">
        <div class="info-form-outer">
                <div class="left-box">
                    <div class="title-icon"><i class="fas fa-book-reader"></i></div>
                    <div>
                        <h3>Tạo thẻ độc giả</h3>
                        <p>Nhập vào thông tin cá nhân theo form bên cạnh, lưu ý nhập thông tin hợp lệ theo yêu cầu</p>
                    </div>
                    <div class="right-arrow"><i class="fas fa-angle-right"></i></div>
                </div>
                <form method="POST" class="right-form">
                    <div class="info-field">
                        <p class="message"></p>
                    </div>
                    <div class = "info-field">
                        <label for="">Họ và tên</label>
                        <div class="input-field">
                            <input type="text" placeholder = "Full Name" name = "name" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Loại độc giả</label>
                        <div class="input-field">
                            <select name="type_of_Reader" >
                                <option value="" disabled selected>Loai doc gia</option>
                                <option value="X">X</option>
                                <option value="Y">Y</option>
                            </select>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Ngày sinh</label>
                        <div class="input-field">
                            <input type="date" placeholder = "Date of birth" name = "date_of_birth" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Địa chỉ</label>
                        <div class="input-field">
                            <input type="text" placeholder = "address" name = "address" required>
                        </div>
                    </div>
                    <div class = "info-field">
                    <label for="">Email</label>
                        <div class="input-field">
                            <input type="text" placeholder = "email" name = "email" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Ngày lập thẻ</label>
                        <div class="input-field">
                            <input name="book_import" type="date" required>
                        </div>
                    </div>
                    <input type="submit" value = "ADD" name = "submit">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
            