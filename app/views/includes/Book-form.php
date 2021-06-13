<div class="extended-info-form-container">
    <form class="extended-info-form-outer" method="POST" enctype="multipart/form-data">
        <div class="top-bar">
            <h2><i class="fas fa-book-medical"></i> Phiếu nhận sách mới</h2>
            <button onclick= "hideForm()"><i class="fas fa-times"></i></button>
        </div>
        <div class="left-box">
            <div class="file-upload-wrapper">
                <img src="" alt="" id="avatar">
                <input type="file" id="avatar-uploader" name = "book_image" hidden onchange="previewFile()">
                <label for="avatar-uploader">Chọn ảnh</label>
            </div>
        </div>
        <div class="right-form">
            <div class = "info-field">
                <label for="">Tên sách</label>
                <div class="input-field">
                    <input type="text" placeholder = "Tên sách" name = "book_name" required>
                </div>
            </div>
            <div class = "info-field">
                <label for="">Thể loại</label>
                <div class="input-field">
                    <select name="book_type">
                        <?php
                        foreach($data['ruleType'] as $ruleType): ?>
                            <option value="<?=$ruleType;?>"><?=$ruleType;?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class = "info-field">
                <label for="">Tác giả</label>
                <div class="input-field">
                    <select name="book_author">
                        <?php
                        foreach($data['ruleAuthor'] as $ruleAuthor): ?>
                            <option value="<?=$ruleAuthor;?>"><?=$ruleAuthor;?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class = "info-field">
                <label for="">Nhà xuất bản</label>
                <div class="input-field">
                    <input type="text" placeholder = "Tên nhà xuất bản" name = "book_publisher" required>
                </div>
            </div>
            <div class="extended-info-field">
                <div class = "info-field">
                    <label for="">Năm xuất bản</label>
                    <div class="input-field">
                        <input type="number" name="book_year" min="1900" max="<?php echo date('Y') ?>" value="<?php echo date('Y') ?>">
                    </div>    
                </div>
                <div class = "info-field">
                    <label for="">Ngày nhập</label>
                    <div class="input-field">
                        <input name="book_import" type="date" value="<?php echo date('Y-m-d'); ?>"required>
                    </div>
                </div>
            </div>
            <div class = "info-field">
                <label for="">Trị giá</label>
                <div class="input-field">
                    <input type="number" min="0" placeholder = "Số tiền" name = "book_cost" required>
                </div>
            </div>
            <div class="submit-container">
                <input type="number" hidden name="book_id">
                <input id="submit-add-book" type="submit" value = "Thêm sách" name = "submit">
                <!-- <input  type="submit" value = "Xóa sách" name ="submit"> -->
            </div>
        </div>
    </form>
    <button class="book-delete-btn" onclick="showDeleteBookMessageBox('warning', 'Bạn có chắc muốn xóa toàn bộ thông tin liên quan đến sách này không?')">Xóa sách</button>
</div>
