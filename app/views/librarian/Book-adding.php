<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/librarian/Book-adding.css">
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
        <div class="feature-panel" id="book-adding-panel">
        <!-- <button>excel add</button> -->
            <div class="info-form-outer">
                <div class="left-box">
                    <div class="title-icon"><i class="fas fa-book"></i></div>
                    <div>
                        <h3>Tiếp nhận sách mới</h3>
                        <p>Nhập vào sách mới theo form bên cạnh, lưu ý nhập thông tin sách hợp lệ theo yêu cầu</p>
                    </div>
                    <div class="right-arrow"><i class="fas fa-angle-right"></i></div>
                </div>
                <form action="POST" class="right-form">
                    <div class = "info-field">
                        <label for="">Mã sách</label>
                        <div class="input-field">
                            <input type="text" placeholder = "Book's code" name = "book_code" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Tên sách  </label>
                        <div class="input-field">
                            <input type="text" placeholder = "Book's name" name = "book_name" required>
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
                            <select name="book_year" required>
                               <option value="one">one</option>
                               <option value="">two</option>
                               <option value="">three</option>
                            </select>
                        </div>    
                    </div>
                    <div class = "info-field">
                        <label for="">Ngày nhập</label>
                        <div class="input-field">
                            <input name="book_import" type="date" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Trị giá</label>
                        <div class="input-field">
                            <input type="number" placeholder = "Cost" name = "book_cost" required>
                        </div>
                    </div>
                    <input type="submit" value = "ADD" name = "submit">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
