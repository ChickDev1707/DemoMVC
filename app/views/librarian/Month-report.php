

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Custom-scrollbar.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Report.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Message-box.css">
    <script src="<?php echo URLROOT;?>public/js/Main.js"></script>

    <script src="https://kit.fontawesome.com/a7cf4e395f.js" crossorigin="anonymous"></script>
    <style>
        .list-wrapper ul li:nth-child(11){
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
                <i class="fab fa-medium"></i>
                <h1>Báo cáo tháng</h1>
            </div>
        </div>
    </div>
    <!-- header -->
    <div class="feature-panel-wrapper">
        <form method="POST" class="feature-panel" id="month-report-panel">
            <div class="date-input-container">
                <!-- <form method="POST"> -->
                    <div class="info-field">
                        <label for="">Tháng: </label>
                        <div class="input-field">
                            <input type="number" min=1 max=12 name="month" required>
                        </div>
                    </div>
                    <div class="info-field">
                        <label for="">Năm: </label>
                        <div class="input-field">
                            <input type="number" min=2010 max=<?php echo date('Y', strtotime(date('Y-m-d'))); ?> name="year" required>
                        </div>
                    </div>
                    <!-- <input type="submit" value= "xem phiếu" name="mr_create_report"> -->
                <!-- </form> -->
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
                            <td><?php echo ++$count; ?></td>
                            <td><?php echo $e->THE_LOAI; ?></td>
                            <td><?php echo $e->SO_LUOT_MUON; ?></td>
                            <td><?php echo $e->TI_LE * 100; ?>%</td>
                        </tr>
                    <?php } ?>
                </table>
        
            </div>
            <div class="function-btn-container">
                <input type="submit" value= "Xem phiếu" name="submit_get_report">
                <input type="submit" value= "In phiếu" name="submit_export_to_excel">
            </div>
            <?php require APPROOT."/views/includes/Message-box.php"; ?>
        </div>
    </form>  
</body>
</html>
            