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

    <script> var data = <?php echo json_encode($data); ?>;</script>
    <script src="<?php echo URLROOT;?>public/js/Book-searching.js" defer></script>
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
            <div class="header-searching">
                
                <div class="search-bar">
                    <input type="text" placeholder = "Tìm kiếm sách theo mã sách, tên, hoặc tác giả">
                    <button><i class="fas fa-search"></i> Tìm kiếm</button>
                    <select>
                        <option value="all" selected>Tất cả</option>
                        <option value="book_author">Tác giả</option>
                        <option value="book_name">Tên sách</option>
                        <option value="book_type">Thể loại</option>
                    </select>
                </div>
            </div>
            <div class="book-list-section">
                <h2>Sách của thư viện</h2>
                <div class="book-list">
                    <!-- library all books -->
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
                                <h4></h4> 
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
        </div>
    </div>
</body>
</html>