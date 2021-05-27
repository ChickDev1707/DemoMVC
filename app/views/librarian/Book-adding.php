<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/librarian/Book-adding.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Message-box.css">
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
        <div class="extended-info-form-outer">
                <div class="top-bar">
                    <h2><i class="fas fa-book-medical"></i> Phiếu nhận sách mới</h2>
                </div>
                <div class="left-box">
                    <div class="file-upload-wrapper">
                        <img src="" alt="" id="avatar">
                        <input type="file" id="avatar-uploader" hidden onchange="previewFile()">
                        <label for="avatar-uploader">Choose file</label>
                    </div>
                </div>
                <form method="POST" class="right-form">
                    <div class = "info-field">
                        <label for="">Tên sách</label>
                        <div class="input-field">
                            <input type="text" placeholder = "Full Name" name = "book_name" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Thể loại</label>
                        <div class="input-field">
                            <input type="text" placeholder = "Type" name = "book_type" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Tác giả</label>
                        <div class="input-field">
                            <input type="text" placeholder = "Author" name = "book_author" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Nhà xuất bản</label>
                        <div class="input-field">
                            <input type="text" placeholder = "Publisher" name = "book_publisher" required>
                        </div>
                    </div>
                    <div class="extended-info-field">
                        <div class = "info-field">
                            <label for="">Năm xuất bản</label>
                            <div class="input-field">
                                <select name="book_year" require>
                                    <option value="">2015</option>
                                    <option value="">2016</option>
                                    <option value="">2017</option>
                                </select>
                            </div>    
                        </div>
                        <div class = "info-field">
                            <label for="">Ngày nhập</label>
                            <div class="input-field">
                                <input name="book_import" type="date" required>
                            </div>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Trị giá</label>
                        <div class="input-field">
                            <input type="text" placeholder = "Cost" name = "book_publisher" required>
                        </div>
                    </div>
                    <input type="submit" value = "Thêm sách" name = "submit">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
