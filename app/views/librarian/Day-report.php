

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Custom-scrollbar.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Report.css">
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
            <i class="fab fa-dailymotion"></i>
                <h1>Daily report</h1>
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
        <div class="feature-panel" id="month-report-panel">
            <div class="date-input-container">
                <div class="info-field">
                    <label for="">Ngày: </label>
                    <div class="input-field">
                        <input type="date" required>
                    </div>
                </div>
            </div>
            <div class="table-container">
            <h3><i class="fas fa-table"></i> Báo cáo thống kê sách trả trễ</h3>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Tên Sách</th>
                        <th>Ngày mượn</th>
                        <th>Số ngày trả trễ</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>tieu thuyet</td>
                        <td>5</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>self help</td>
                        <td>10</td>
                        <td>20</td>
                    </tr>
                    
                </table>
        
            </div>
            <div class="function-btn-container">
                <input type="submit" value= "Xem phiếu" name="mr_query_report">
                <input type="submit" value= "lập phiếu" name="mr_create_report">
            </div>
        </div>
    </div>  
</body>
</html>
            