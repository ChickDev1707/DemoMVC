<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/librarian/MonthlyReport.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Info-form.css">
    <script src="https://kit.fontawesome.com/a7cf4e395f.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php
        require APPROOT."/views/includes/Header.php";
        require APPROOT."/views/includes/Librarian-nav-panel.php";
    ?>
    <form method="POST">
        <h3>Lập báo cáo</h3>
        <input type="text" name="month" placeholder="Tháng: " required>
        <input type="text" name="month" placeholder="Năm: " required>
        <input type="submit" name="submit" value="xuất báo cáo">
    </form>
    <table>
        <tr>
            <th>thể loại</th>
            <th>số lượt mượn</th>
            <th>tỉ lệ</th>
        </tr>
        <?php foreach($data as $item) {?>
        <tr>
            <th><?php echo $item->THE_LOAI ?></th>
            <th><?php echo $item->TOTAL ?></th>
            <th><?php echo ($item->TOTAL / $number ) * 100 ?>%</th>
        </tr> 
        <?php } ?>
    </table>
    
</body>
</html>