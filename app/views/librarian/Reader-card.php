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
                                    <select name="type_of_Reader" id="">
                                        <?php foreach($data as $author) { ?>
                                            <option value="<?php echo $author->TEN_LOAI_DOC_GIA ?>"><?php echo $author->TEN_LOAI_DOC_GIA ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class = "info-field">
                                <label for="">Ngày sinh</label>
                                <div class="input-field">
                                    <input type="date" placeholder = "Date of birth" name = "date_of_birth" required>
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
                                    <input name="book_import" type="date" required>
                                </div>
                            </div>
                            <input type="submit" value = "Tạo thẻ" name = "submit">
                        </form>
                    </div>
                </div>
                <div class="content content-2">
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
                            <td>Nhan Huu Thuan</td>
                            <td>X</td>
                            <td>20-11-2001</td>
                            <td>Newyork</td>
                            <td>thuancoixy234786@gmail.com</td>
                            <td>27-05-2001</td>
                            <td><button onclick="showUpdateReaderForm()" class="update-btn">Sửa</button></td>
                            <td><button onclick="showDeleteReaderBox()" class="delete-btn">Xóa</button></td>
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
                                        <input type="text" placeholder = "Họ và tên" name = "name" required>
                                    </div>
                                </div>
                                <div class = "info-field">
                                    <label for="">Loại độc giả</label>
                                    <div class="input-field">
                                        <select name="type_of_Reader" id="">
                                            <?php foreach($data as $author) { ?>
                                                <option value="<?php echo $author->TEN_LOAI_DOC_GIA ?>"><?php echo $author->TEN_LOAI_DOC_GIA ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class = "info-field">
                                    <label for="">Ngày sinh</label>
                                    <div class="input-field">
                                        <input type="date" placeholder = "Date of birth" name = "date_of_birth" required>
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
                                        <input name="book_import" type="date" required>
                                    </div>
                                </div>
                                <input type="submit" value = "Cập nhật" name = "submit_update_reader">
                            </form>
                            <button onclick="hideUpdateReaderForm()"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                </div>
            </section>
            <?php require APPROOT."/views/includes/Message-box.php"; ?>
        </div>
    </div>
    <script>
        function hideUpdateReaderForm(){
            let updateFormWrapper = document.getElementById("update-form-wrapper");
            updateFormWrapper.style.display = "none";
        }
        function showUpdateReaderForm(){
            let updateFormWrapper = document.getElementById("update-form-wrapper");
            updateFormWrapper.style.display = "block";
        }
    </script>
</body>
</html>
            