<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/librarian/Reader-card.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Info-form.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Message-box.css">
    <script src="<?php echo URLROOT;?>public/js/Main.js"></script>
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
                <i class="fas fa-id-card"></i>
                <h1>Thẻ độc giả</h1>
            </div>
        </div>
    </div>
    <!-- header -->
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
                    <div class = "info-field">
                        <label for="">Tên độc giả</label>
                        <div class="input-field">
                            <input type="text" placeholder = "Họ và tên" name = "name" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Loại độc giả</label>
                        <div class="input-field">
                            <select name="type_of_Reader" id="">
                                <?php foreach($data as $author) { ?>
                                    <option value="<?php echo $author->LOAI_DOCGIA ?>"><?php echo $author->LOAI_DOCGIA ?></option>
                                <?php } ?>
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
                            <input type="text" placeholder = "Địa chỉ" name = "address" required>
                        </div>
                    </div>
                    <div class = "info-field">
                    <label for="">Email</label>
                        <div class="input-field">
                            <input type="text" placeholder = "Email" name = "email" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Ngày lập thẻ</label>
                        <div class="input-field">
                            <input name="book_import" type="date" required>
                        </div>
                    </div>
                    <input type="submit" value = "Tạo thẻ" name = "submit">
                </form>
            </div>
            <?php require APPROOT."/views/includes/Message-box.php"; ?>
        </div>
    </div>
</body>
</html>
            