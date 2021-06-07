
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/librarian/Fine-card.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Info-form.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Message-box.css">

    <script src="<?php echo URLROOT;?>public/js/Main.js"></script>
    <script> var data = <?php echo json_encode($data); ?>;</script>
    <script src="<?php echo URLROOT;?>public/js/Fine-card.js"></script>
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
                <i class="fas fa-dollar-sign"></i>
                <h1>Thu tiền phạt</h1>
            </div>
        </div>
    </div>
    <!-- header -->
    <div class="feature-panel-wrapper">
        <div class="feature-panel" id="fine-card-panel">
        <div class="info-form-outer">
                <div class="left-box">
                    <div class="title-icon"><i class="fas fa-dollar-sign"></i></div>
                    <div>
                        <h3>Thu tiền phạt</h3>
                        <p>Nhập vào mã độc giả để được hệ thống kiểm tra và thu tiền phạt</p>
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
                        <label for="">Tên độc giả</label>
                        <div class="input-field">
                            <input id="reader-name-display-box" type="text" placeholder="Tên độc giả" name = "reader_name" readonly>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Tổng nợ</label>
                        <div class="input-field">
                            <input id="total-money-display-box" type="text" placeholder="Tổng nợ" name = "total_money" readonly>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Số tiền thu</label>
                        <div class="input-field">
                            <input id="received-money-input" min="0" type="number" placeholder="Số tiền thu" name = "received_money" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Còn lại</label>
                        <div class="input-field">
                            <input id="remain-money-display-box" type="text" placeholder="Số tiền còn lại" name = "remain_money" readonly>
                        </div>
                    </div>
                    <input type="submit" value = "Thu tiền" name = "submit_get_fine">
                </form>
            </div>
            <?php require APPROOT."/views/includes/Message-box.php"; ?>
        </div>
    </div>
</body>
</html>
            