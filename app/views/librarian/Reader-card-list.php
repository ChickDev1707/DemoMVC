<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Info-form.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/librarian/Reader-card-list.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Message-box.css">

    <script src="<?php echo URLROOT;?>public/js/Main.js"></script>
    <script src="<?php echo URLROOT;?>public/js/Delete-element-messbox.js"></script>
    <script src="<?php echo URLROOT;?>public/js/Reader-card.js"></script>
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
                <i class="fas fa-id-card"></i>
                <h1>Thẻ độc giả</h1>
            </div>
        </div>
    </div>
    <!-- header -->
    <div class="feature-panel-wrapper">
        <div class="feature-panel" id="reader-card-panel">
            <div class="tab-bar-container">
                <ul>
                <li onclick= 'location.href="<?php echo URLROOT;?>ReaderCard/index"'><i class="far fa-plus-square"></i> Tạo thẻ</li>
                    <li onclick= 'location.href="<?php echo URLROOT;?>ReaderCard/list"'><i class="far fa-list-alt"></i> Danh sách</li>
                </ul>
            </div>
            <div class="reader-list-container">
                <h3>Danh sách độc giả</h3>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Họ Tên</th>
                        <th>Loại Độc giả</th>
                        <th>Ngày sinh</th>
                        <th>Địa chỉ</th>
                        <th>Email</th>
                        <th>Ngày lập thẻ</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>thuan</td>
                        <td>X</td>
                        <td>27-05-2001</td>
                        <td>Dong tdap</td>
                        <td>abc@gmail.com</td>
                        <td>12-12-2001</td>
                        <td><button class="update-btn">Sua</button></td>
                        <td><button class="delete-btn">Xoa</button></td>
                    </tr>
                </table>
                <div id="update-form-wrapper">
                    <div class="info-form-outer">
                        <div class="left-box">
                            <div class="title-icon"><i class="fas fa-book-reader"></i></div>
                            <div>
                                <h3>Cập nhật thẻ độc giả</h3>
                                <p>Nhập vào thông tin cá nhân theo form bên cạnh, lưu ý nhập thông tin hợp lệ theo yêu cầu</p>
                            </div>
                            <div class="right-arrow"><i class="fas fa-angle-right"></i></div>
                        </div>
                        <form method="POST" class="right-form">
                            <div class = "info-field">
                                <label for="">Tên độc giả</label>
                                <div class="input-field">
                                    <!-- <input type="text" value=<?php echo $data['info_single_card']->HO_TEN_DOC_GIA ?> placeholder = "Họ và tên" name = "update_name" required> -->
                                    <input type="text">
                                </div>
                            </div>
                            <div class = "info-field">
                                <label for="">Loại độc giả</label>
                                <div class="input-field">
                                    <!-- <select name="update_type_of_Reader">
                                        <option value="<?php echo $data['info_single_card']->LOAI_DOC_GIA; ?>"><?php echo $data['info_single_card']->LOAI_DOC_GIA; ?></option>
                                        <?php foreach($data['type_of_readers'] as $type) { 
                                            if($type->TEN_LOAI_DOC_GIA != $data['info_single_card']->LOAI_DOC_GIA) { ?>
                                                <option value="<?php echo $type->TEN_LOAI_DOC_GIA ?>"><?php echo $type->TEN_LOAI_DOC_GIA ?></option>
                                            <?php } ?> 
                                        <?php } ?>
                                    </select> -->
                                    <select name="" id="">
                                        <option value="one"></option>
                                        <option value="two"></option>
                                    </select>
                                </div>
                            </div>
                            <div class = "info-field">
                                <label for="">Ngày sinh</label>
                                <div class="input-field">
                                    <!-- <input type="date" max=<?php echo date('Y-m-d', strtotime(date('Y-m-d'))); ?> value=<?php echo date("Y-m-d", strtotime($data['info_single_card']->NGAY_SINH)); ?> placeholder = "Date of birth" name = "update_date_of_birth" required> -->
                                    <input type="text">
                                </div>
                            </div>
                            <div class = "info-field">
                                <label for="">Địa chỉ</label>
                                <div class="input-field">
                                    <!-- <input type="text" value=<?php echo $data['info_single_card']->DIA_CHI ?> placeholder = "Địa chỉ" name = "update_address" required> -->
                                    <input type="text">
                                </div>
                            </div>
                            <div class = "info-field">
                            <label for="">Email</label>
                                <div class="input-field">
                                    <!-- <input type="text" value=<?php echo $data['info_single_card']->EMAIL ?> placeholder = "Email" name = "update_email" required> -->
                                    <input type="text">
                                </div>
                            </div>
                            <div class = "info-field">
                                <label for="">Ngày lập thẻ</label>
                                <div class="input-field">
                                    <!-- <input max=<?php echo date('Y-m-d', strtotime(date('Y-m-d'))); ?> value=<?php echo date("Y-m-d", strtotime($data['info_single_card']->NGAY_LAP_THE)); ?> name="update_create_date" type="date" required> -->
                                    <input type="text">
                                </div>
                            </div>
                            <input type="submit" value = "Cập nhật" name = "submit_update_reader_info">
                        </form>
                        <button onclick="hideUpdateReaderForm()"><i class="fas fa-times"></i></button>
                    </div>
                </div>

                <!-- delete book message box -->
                <?php require APPROOT."/views/includes/Delete-element-messbox.php"; ?>
            </div>
            <?php require APPROOT."/views/includes/Message-box.php"; ?>
        </div>
    </div>
</body>
</html>
            