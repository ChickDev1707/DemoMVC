
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
                <h1>Get fine</h1>
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
                            <input type="number" placeholder = "reader card Id" name = "fc_reader_card_id" required>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Tên độc giả</label>
                        <div class="input-field">
                            <input type="text" placeholder="Reader's name" name = "fc_reader_name" readonly>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Tổng nợ</label>
                        <div class="input-field">
                            <input type="number" placeholder="Total money" name = "fc_total_money" readonly>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Số tiền thu</label>
                        <div class="input-field">
                            <input type="number" placeholder="Received money" name = "fc_received_money" require>
                        </div>
                    </div>
                    <div class = "info-field">
                        <label for="">Còn lại</label>
                        <div class="input-field">
                            <input type="number" placeholder="Total money" name = "fc_total_money" readonly>
                        </div>
                    </div>
                    <input type="submit" value = "Lend book" name = "submit_get_fine">
                </form>
            </div>
            <!-- <?php require APPROOT."/views/includes/Message-box.php"; ?> -->
        </div>
    </div>
</body>
</html>
            