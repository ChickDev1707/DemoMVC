<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/librarian/Parameter-editing.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Custom-scrollbar.css">

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
                <i class="fas fa-plus"></i>
                <h1>Thay đổi quy định</h1>
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
        <div class="feature-panel" id="edit-panel">
            <div class="description">
                <h2><i class="fas fa-pen"></i> Cập nhật quy định</h2>
                <p>Nhập thông tin cần cập nhật vào các ô input; chọn thêm, xóa hoặc thay đổi</p>
                <p>Thông tin sẽ được ghi nhận lại vào cơ sở dữ liệu</p>
            </div>
            <div id="edit-panel-container">
                <div class="edit-panel-wrapper">
                    <input type="checkbox" id="edit-panel-header-1">
                    <label class="edit-panel-header" for="edit-panel-header-1"><i class="fas fa-id-card"></i> Thẻ độc giả</label>
                    <div id="reader-card-form" class= "form-container">
                        <form method="POST" action="" class="edit-panel">
                            <div class="info-field">
                                <label for="">Tuổi tối thiểu</label>
                                <div class="input-field">
                                    <input type="number" placeholder="Độ tuổi" required>
                                </div>
                            </div>
                            <div class="info-field">
                                <label for="">Tuổi tối đa</label>
                                <div class="input-field">
                                    <input type="number" placeholder="Độ tuổi" required>
                                </div>
                            </div>
                            <div class="info-field">
                                <label for="">Thời hạn thẻ (ngày)</label>
                                <div class="input-field">
                                    <input type="number" placeholder="Thời hạn" required>
                                </div>
                            </div>
                            <input class="normal-submit" type="submit" value ="Thay đổi">
                        </form>
                    </div>
                </div>
                <div class="edit-panel-wrapper">
                    <input type="checkbox" id="edit-panel-header-2">
                    <label class="edit-panel-header" for="edit-panel-header-2"><i class="fas fa-book"></i> Sách</label>
                    <div id="book-form" class="form-container">
                        <form method="POST" action="" class="edit-panel">
                            <div class="info-field">
                                <label for="">Tên thể loại</label>
                                <div class="input-field">
                                    <input type="text" placeholder="thể loại" required>
                                </div>
                            </div>
                            <input class="normal-submit" type="submit" value= "thêm">
                            <input class="delete-submit" type="submit" value= "xóa">
                        </form>
                        <form method="POST" action="" class="edit-panel">
                            <div class="info-field">
                                <label for="">Tên tác giả</label>
                                <div class="input-field">
                                    <input type="text" placeholder="tác giả" required>
                                </div>
                            </div>
                            <input class="normal-submit" type="submit" value= "thêm">
                            <input class="delete-submit" type="submit" value= "xóa">
                        </form>
                        <form method="POST" action="" class="edit-panel">
                            <div class="info-field">
                                <label for="">Khoảng cách năm xuất bản</label>
                                <div class="input-field">
                                    <input type="text" placeholder="khoảng cách" required>
                                </div>
                            </div>
                            <input class="normal-submit" type="submit" value= "thay đổi">
                        </form>
                    </div>
                </div>
                <div class="edit-panel-wrapper">
                    <input type="checkbox" id="edit-panel-header-3">
                    <label class="edit-panel-header" for="edit-panel-header-3"><i class="fas fa-hand-holding-medical"></i> Mượn sách</label>
                    <div id="borrow-book-form" class="form-container">
                        <form method="POST" action="" class="edit-panel">
                            <div class="info-field">
                                <label for="">Số lượng sách mượn tối đa</label>
                                <div class="input-field">
                                    <input type="number" placeholder="Số lượng sách" required>
                                </div>
                            </div>
                            <div class="info-field">
                                <label for="">Số ngày mượn tối đa</label>
                                <div class="input-field">
                                    <input type="number" placeholder="Số ngày" required>
                                </div>
                            </div>
                            <input class="normal-submit" type="submit" value ="Thay đổi">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</body>
</html>