<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Custom-scrollbar.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/librarian/Book-searching.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Book-form.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Message-box.css">

    <script src="<?php echo URLROOT;?>public/js/Main.js"></script>
    <script src="<?php echo URLROOT;?>public/js/Book-searching.js"></script>
    <title>Document</title>
</head>
<body>
    <?php
        require APPROOT."/views/includes/Librarian-nav-panel.php";
    ?>
    <div class="top-bar-wrapper">
        <div class="top-bar-container">
            <div class="title-container">
                <i class="fas fa-search"></i>
                <h1>Tra cứu sách</h1>
            </div>
        </div>
    </div>
    <!-- header -->
    <div class="feature-panel-wrapper">
        <div class="feature-panel" id="book-searching-panel">
            <form class="header-searching">
                
                <div class="search-bar">
                    <input type="text" placeholder = "Tìm kiếm sách theo mã sách, tên, hoặc tác giả">
                    <button type="submit" name="submit_search"><i class="fas fa-search"></i> Tìm kiếm</button>
                    <select>
                        <option value="all" selected>Tất cả</option>
                        <option value="book_author">Tác giả</option>
                        <option value="book_name">Tên sách</option>
                        <option value="book_type">Thể loại</option>
                    </select>
            </form>
            </div>
            <div class="book-list-section">
                <h2><a href=".">Sách của thư viện</a></h2>
                <div class="book-list">
                    <!-- library all books -->
                    <?php foreach($data as $book):  ?>
                        <div class="book-container">
                            <img src="<?php echo $book->IMAGE_PATH?>" alt="" class="book-cover" >
                            <div class="info-box">
                                <h3><i class="far fa-bookmark"></i> <?php echo $book->TEN_SACH?></h3>
                                <p style="color: <?php echo $book->TINH_TRANG==false ? "#27ae60": "#d63031" ?>;" ><i class="far fa-question-circle"></i><?php echo $book->TINH_TRANG==false ? " Chưa được mượn": " Đã được mượn" ?></p>
                                <form method="POST" class="detail-and-update">
                                    <input name="book_id" type="number" value= "<?php echo $book->MA_SACH?>">
                                    <button class="detail-btn" type="submit" name="submit_detail">Chi tiết</button>
                                    <button class="update-btn" type="submit" name="submit_update">Cập nhật</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div id="detail-box-wrapper">
                <div class="detail-main-container">
                    <h2><i class="fas fa-info-circle"></i> Chi tiết sách</h2>
                    <div class="info-activity-wrapper">
                        <div class="detail-book-info-container">
                            <img src="./image/default-book-cover.png" alt="" class="book-cover" >
                            <div class="info-box">
                                <h3></h3>
                                <p></p>
                                <p></p>
                                <div class="status"></div>
                            </div>
                            <div class="more-info-panel">
                                <h4>Thông tin khác</h4> 
                                <p></p>
                                <p></p>
                                <p></p>
                                <p><i class="fas fa-dollar-sign"></i> 50 000 vnd</p>
                            </div>
                        </div>
                        <div class="detail-activity-container">
                            <!-- book activities -->
                        </div>
                    </div>
                    <button onclick="hideDetailPanel()"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <div id="book-form-wrapper">
                <?php require APPROOT."/views/includes/Book-form.php"; ?>
            </div>

            <!-- main message box -->
            <?php require APPROOT."/views/includes/Message-box.php"; ?>

            <!-- delete book message box -->
            <div id="delete-book-message-box-wrapper" class="message-box-wrapper" onclick="hideDeleteBookMessageBox()">
                <form id="delete-book-message-box" class="message-box" onclick="stopPropagate(event)">
                    <div class="icon-container">
                        <i class="fas fa-check icon-correct"></i>
                        <i class="fas fa-times icon-incorrect"></i>
                    </div>
                    <h2>Thành công</h2>
                    <p>message </p>
                    <button onclick="hideDeleteBookMessageBox()">OK</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>