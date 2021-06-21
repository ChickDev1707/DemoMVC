<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Info-form.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/librarian/Reader-card.css">
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
        <div class="feature-panel tab-bar-panel" id="reader-card-panel">
            <input type="radio" id="create-reader-card-tab" class= "tab-1" name="tabs" checked>
            <input type="radio" id="reader-card-list-tab" class= "tab-2" name="tabs">
            <div class="nav-container">
                <nav>
                    <label class="lable-tab-1" for="create-reader-card-tab"><i class="far fa-plus-square"></i> Tạo thẻ</label>
                    <label class="lable-tab-2" for="reader-card-list-tab"><i class="far fa-list-alt"></i> Danh sách</label>
                    <div class="slider"></div>
                </nav>
            </div>
            <section>
                <div class="content content-1">
                    <div class="info-form-outer">
                        <div class="left-box">
                            <div class="title-icon"><i class="fas fa-book-reader"></i></div>
                            <div>
                                <h3>Tạo thẻ độc giả</h3>
                                <p>Nhập vào thông tin cá nhân theo form bên cạnh, lưu ý nhập thông tin hợp lệ theo yêu cầu</p>
                            </div>
                            <div class="right-arrow"><i class="fas fa-angle-right"></i></div>
                        </div>
                        <form method="POST" class="right-form">
                            <div class = "info-field">
                                <label for="">Tên độc giả</label>
                                <div class="input-field">
                                    <input type="text" placeholder = "Họ và tên" name = "name" required>
                                </div>
                            </div>
                            <div class = "info-field">
                                <label for="">Loại độc giả</label>
                                <div class="input-field">
                                    <select name="type_of_Reader">
                                        <?php foreach($data['type_of_readers'] as $type) { ?>
                                            <option value="<?php echo $type->TEN_LOAI_DOC_GIA ?>"><?php echo $type->TEN_LOAI_DOC_GIA ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class = "info-field">
                                <label for="">Ngày sinh</label>
                                <div class="input-field">
                                    <input type="date" max=<?php echo date('Y-m-d', strtotime(date('Y-m-d'))); ?> placeholder = "Date of birth" name = "date_of_birth" required>
                                </div>
                            </div>
                            <div class = "info-field">
                                <label for="">Địa chỉ</label>
                                <div class="input-field">
                                    <input type="text" placeholder = "Địa chỉ" name = "address" required>
                                </div>
                            </div>
                            <div class = "info-field">
                            <label for="">Email</label>
                                <div class="input-field">
                                    <input type="text" placeholder = "Email" name = "email" required>
                                </div>
                            </div>
                            <div class = "info-field">
                                <label for="">Ngày lập thẻ</label>
                                <div class="input-field">
                                    <input name="create_date" type="date" max=<?php echo date('Y-m-d', strtotime(date('Y-m-d'))); ?> required>
                                </div>
                            </div>
                            <input type="submit" value = "Tạo thẻ" name = "submit_create_card">
                        </form>
                    </div>
                </div>
                <div class="content content-2">
                    <h3>Danh sách độc giả</h3>
                    <table>
                        <tr>
                            <th>STT</th>
                            <th>Mã độc giả</th>
                            <th>Họ Tên</th>
                            <th>Loại Độc giả</th>
                            <th>Ngày sinh</th>
                            <th>Địa chỉ</th>
                            <th>Email</th>
                            <th>Ngày lập thẻ</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                        <?php $stt=0; foreach($data['info_reader_cards'] as $info) { $stt++; ?>
                            <tr>
                                <form method="POST">
                                    <input type="number" value=<?php echo $info->MA_DOC_GIA; ?> name="reader_card_id" hidden>
                                    <td><?php echo $stt; ?></td>
                                    <td><?php echo $info->MA_DOC_GIA; ?></td>
                                    <td><?php echo $info->HO_TEN_DOC_GIA; ?></td>
                                    <td><?php echo $info->LOAI_DOC_GIA; ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($info->NGAY_SINH)); ?></td>
                                    <td><?php echo $info->DIA_CHI; ?></td>
                                    <td><?php echo $info->EMAIL; ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($info->NGAY_LAP_THE)); ?></td>
                                    <td><button type="submit" name="submit_update_reader" class="update-btn">Sửa</button></td>
                                    <td><button type="submit" name="submit_delete_reader" class="delete-btn">Xóa</button></td>
                                </form>
                            </tr>
                        <?php } ?>
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
                                        <input type="text" value=<?php echo $data['info_single_card']->HO_TEN_DOC_GIA ?> placeholder = "Họ và tên" name = "update_name" required>
                                    </div>
                                </div>
                                <div class = "info-field">
                                    <label for="">Loại độc giả</label>
                                    <div class="input-field">
                                        <select name="update_type_of_Reader">
                                            <option value="<?php echo $data['info_single_card']->LOAI_DOC_GIA; ?>"><?php echo $data['info_single_card']->LOAI_DOC_GIA; ?></option>
                                            <?php foreach($data['type_of_readers'] as $type) { 
                                                if($type->TEN_LOAI_DOC_GIA != $data['info_single_card']->LOAI_DOC_GIA) { ?>
                                                    <option value="<?php echo $type->TEN_LOAI_DOC_GIA ?>"><?php echo $type->TEN_LOAI_DOC_GIA ?></option>
                                                <?php } ?> 
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class = "info-field">
                                    <label for="">Ngày sinh</label>
                                    <div class="input-field">
                                        <input type="date" max=<?php echo date('Y-m-d', strtotime(date('Y-m-d'))); ?> value=<?php echo date("Y-m-d", strtotime($data['info_single_card']->NGAY_SINH)); ?> placeholder = "Date of birth" name = "update_date_of_birth" required>
                                    </div>
                                </div>
                                <div class = "info-field">
                                    <label for="">Địa chỉ</label>
                                    <div class="input-field">
                                        <input type="text" value=<?php echo $data['info_single_card']->DIA_CHI ?> placeholder = "Địa chỉ" name = "update_address" required>
                                    </div>
                                </div>
                                <div class = "info-field">
                                <label for="">Email</label>
                                    <div class="input-field">
                                        <input type="text" value=<?php echo $data['info_single_card']->EMAIL ?> placeholder = "Email" name = "update_email" required>
                                    </div>
                                </div>
                                <div class = "info-field">
                                    <label for="">Ngày lập thẻ</label>
                                    <div class="input-field">
                                        <input max=<?php echo date('Y-m-d', strtotime(date('Y-m-d'))); ?> value=<?php echo date("Y-m-d", strtotime($data['info_single_card']->NGAY_LAP_THE)); ?> name="update_create_date" type="date" required>
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
            </section>
        </div>
    </div>
</body>
</html>
            