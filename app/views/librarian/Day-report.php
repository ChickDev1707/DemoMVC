

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
    <style>
        .list-wrapper ul li:nth-child(12){
            color: #63b8f1;
        }
    </style>
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
                <h1>Báo cáo ngày</h1>
            </div>
        </div>
    </div>
    <!-- header -->
    <div class="feature-panel-wrapper">
        <div class="feature-panel" id="month-report-panel">
            <div class="date-input-container">
                <div class="info-field">
                    <form method="POST">
                        <label for="">Ngày: </label>
                            <div class="input-field">
                                <input type="date" name="date_report" max="<?php echo date('Y-m-d', strtotime(' -1 day')); ?>" required>
                            </div>
                        <input type="submit" value= "Xem phiếu" name="mr_query_report">
                    </form>
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
                    <?php $count = 0;?>
                    <?php foreach($data as $e) {?>
                        <tr>
                            <th><?php echo ++$count; ?></th>
                            <th><?php echo $e->TEN_SACH; ?></th>
                            <th><?php echo date("d-m-Y", strtotime($e->NGAY_MUON)); ?></th>
                            <th><?php echo $e->SO_NGAY_TRA_TRE; ?></th>
                        </tr>
                    <?php } ?>
                </table>
        
            </div>
        </div>
    </div>  
</body>
</html>