<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/librarian/Parameter-editing.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Custom-scrollbar.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Message-box.css">

    <script src="<?php echo URLROOT;?>public/js/Main.js"></script>
    <script src="<?php echo URLROOT;?>public/js/Parameter-Editing.js"></script>
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
                <i class="fas fa-edit"></i>
                <h1>Thay đổi quy định</h1>
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
                                    <input id="input-min-age" value=<?php echo $data->TUOI_TOI_THIEU?> type="number" min="1" max="100" name="min_age" placeholder="Độ tuổi" required>
                                </div>
                            </div>
                            <div class="info-field">
                                <label for="">Tuổi tối đa</label>
                                <div class="input-field">
                                    <input id="input-max-age" value=<?php echo $data->TUOI_TOI_DA?> type="number" min="1" max="100" name="max_age" placeholder="Độ tuổi" required>
                                </div>
                            </div>
                            <div class="info-field">
                                <label for="">Thời hạn thẻ (ngày)</label>
                                <div class="input-field">
                                    <input id="input-card-date-limit" value=<?php echo $data->THOI_HAN_THE?> type="number" min="1" name="card_date_limit" placeholder="Thời hạn" required>
                                </div>
                            </div>
                            <input class="normal-submit" name="submit_change_reader_card" type="submit" value ="Thay đổi">
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
                                    <input type="text" name="book_type" placeholder="thể loại" required>
                                </div>
                            </div>
                            <input class="normal-submit" name="submit_type_add" type="submit" value= "thêm">
                            <input class="delete-submit" name="submit_type_delete" type="submit" value= "xóa">
                        </form>
                        <form method="POST" action="" class="edit-panel">
                            <div class="info-field">
                                <label for="">Tên tác giả</label>
                                <div class="input-field">
                                    <input type="text" name="book_author" placeholder="tác giả" required>
                                </div>
                            </div>
                            <input class="normal-submit" name="submit_author_add" type="submit" value= "thêm">
                            <input class="delete-submit" name="submit_author_delete" type="submit" value= "xóa">
                        </form>
                        <form method="POST" action="" class="edit-panel">
                            <div class="info-field">
                                <label for="">Khoảng cách năm xuất bản</label>
                                <div class="input-field">
                                    <input id="input-year-distance" value=<?php echo $data->KHOANG_CACH_NAM_XUAT_BAN?> type="text" name="year_distance" min="1" placeholder="số năm" required>
                                </div>
                            </div>
                            <input class="normal-submit" name="submit_year_distance_change" type="submit" value= "thay đổi">
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
                                    <input id="input-max-num-of-book" value=<?php echo $data->SO_SACH_TOI_DA?> name="max_num_of_book" type="number" min="1" placeholder="Số lượng sách" required>
                                </div>
                            </div>
                            <div class="info-field">
                                <label for="">Số ngày mượn tối đa</label>
                                <div class="input-field">
                                    <input id="input-max-borrow-day-amount" value=<?php echo $data->SO_NGAY_MUON_TOI_DA?> name="max_borrow_day_amount" type="number" min="1" placeholder="Số ngày" required>
                                </div>
                            </div>
                            <input class="normal-submit" name="submit_change_borrow" type="submit" value ="Thay đổi">
                        </form>
                    </div>
                </div>
            </div>
            <?php require APPROOT."/views/includes/Message-box.php"; ?>
        </div>
    </div>  
</body>
</html>