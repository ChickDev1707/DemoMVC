

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
                <i class="fab fa-medium"></i>
                <h1>Báo cáo tháng</h1>
            </div>
        </div>
    </div>
    <!-- header -->
    <div class="feature-panel-wrapper">
        <div class="feature-panel" id="month-report-panel">
            <div class="date-input-container">
                <form method="POST">
                    <div class="info-field">
                        <label for="">Tháng: </label>
                        <div class="input-field">
                            <input type="number" name="month" required>
                        </div>
                    </div>
                    <div class="info-field">
                        <label for="">Năm: </label>
                        <div class="input-field">
                            <input type="number" name="year" required>
                        </div>
                    </div>
                    <input type="submit" value= "lập phiếu" name="mr_create_report">
                </form>
            </div>
            <div class="table-container">
                <h3><i class="fas fa-table"></i> Bảng báo cáo tình hình mượn sách theo thể loại</h3>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Thể loại</th>
                        <th>Số lượt mượn</th>
                        <th>Tỉ lệ</th>
                    </tr>
                    <?php $count = 0; ?>
                    <?php foreach($data as $e) { ?>
                        <tr>
                            <th><?php echo ++$count; ?></th>
                            <th><?php echo $e->THE_LOAI; ?></th>
                            <th><?php echo $e->SO_LUOT_MUON; ?></th>
                            <th><?php echo $e->TI_LE; ?></th>
                        </tr>
                    <?php } ?>
                </table>
        
            </div>
            <div class="function-btn-container">
                <input type="submit" value= "Xem phiếu" name="mr_query_report">
                
            </div>
        </div>
    </div>  
</body>
</html>
            