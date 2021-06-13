
window.onload= function(){
    let formHeaderTitle = document.querySelector(".extended-info-form-outer .top-bar h2");
    formHeaderTitle.textContent= "Cập nhật sách";

    let submitAddBookBtn = document.getElementById("submit-add-book");
    submitAddBookBtn.value= "Cập nhật";
}

function showBookDetailPanel(book, activities){
    let detailBoxWrapper = document.getElementById("detail-box-wrapper");
    addMainDetail(book);
    addSubDetailToElements(book);
    uploadBookActivities(activities);
    detailBoxWrapper.style.display = "block";
}

function showBookUpdatePanel(book){
    let updateBoxWrapper = document.getElementById("book-form-wrapper");
    console.log(updateBoxWrapper);
    updateBoxWrapper.style.display = "block";
    setDefaultValueToBookForm(book);
}

function addMainDetail(book){
    let bookCover = document.querySelector(".detail-book-info-container .book-cover");
    let bookName = document.querySelector(".detail-book-info-container .info-box h3");
    let pTags = document.querySelectorAll(".detail-book-info-container .info-box p");
    
    let status = document.querySelector(".detail-book-info-container .info-box .status");
    let statusColor= book['TINH_TRANG'] == false? "#27ae60": "#d63031";
    let statusText= book['TINH_TRANG'] == false? " Chưa được mượn": " Đã được mượn";
    
    bookCover.setAttribute("src", book['IMAGE_PATH']);
    bookName.innerHTML= `<i class="far fa-bookmark"></i> ${book['TEN_SACH']}`;
    pTags[0].innerHTML= `<i class="far fa-user"></i> ${book['TAC_GIA']}`;
    pTags[1].innerHTML= `<i class="far fa-square"></i> ${book['THE_LOAI']}`;
    status.innerHTML= `${statusText}`; 
    status.style['background-color'] = statusColor;
}
function setDefaultValueToBookForm(book){
        let bookName = document.querySelector('.input-field input[name="book_name"]');
        let bookTypes = document.querySelectorAll('.input-field select[name="book_type"] option');
        let bookAuthors = document.querySelectorAll('.input-field select[name="book_author"] option');
        let bookPublisher = document.querySelector('.input-field input[name="book_publisher"]');
        let bookYear = document.querySelector('.input-field input[name="book_year"]');
        let bookImport = document.querySelector('.input-field input[name="book_import"]');
        let bookCost = document.querySelector('.input-field input[name="book_cost"]');
        var bookType, bookAuthor;
        let avatar = document.querySelector('#avatar');
        let bookIdUpdate = document.querySelector('.submit-container input[name="book_id"]');
        let bookIdDelete = document.querySelector('#delete-book-message-box input[name="book_id"]');


        bookTypes.forEach(type => {
            if (type.value == book['THE_LOAI']) bookType = type;
        });
        bookAuthors.forEach(author => {
            if (author.value == book['TAC_GIA']) bookAuthor = author;
        });
        // Đặt giá trị mặc định
        bookName.setAttribute('value', book['TEN_SACH']);
        bookPublisher.setAttribute('value', book['NHA_XUAT_BAN']);
        bookYear.setAttribute('value', book['NAM_XUAT_BAN']);
        bookImport.setAttribute('value', book['NGAY_NHAP_SACH']);
        bookCost.setAttribute('value', book['TRI_GIA']);
        bookType.setAttribute('selected', true);
        bookAuthor.setAttribute('selected', true);
        avatar.setAttribute('src', book['IMAGE_PATH']);
        bookIdUpdate.setAttribute('value', book['MA_SACH']);
        bookIdDelete.setAttribute('value', book['MA_SACH']);
        console.log(bookIdDelete);


}
function addSubDetailToElements(book){
    let pTags = document.querySelectorAll(".more-info-panel p");

    pTags[0].innerHTML = `Năm xuất bản: ${book['NAM_XUAT_BAN']}`;
    pTags[1].innerHTML = `Nhà xuất bản: ${book['NHA_XUAT_BAN']}`;
    pTags[2].innerHTML = `Ngày nhập: ${book['NGAY_NHAP_SACH']}`;
    pTags[3].innerHTML = `<i class="fas fa-dollar-sign"></i> ${book['TRI_GIA']} vnd`;
}

function uploadBookActivities(activities){

    let activitiesContainer = document.querySelector(".detail-activity-container");
    activityCards= activities.map((activity)=>{
        return `
            <div class="activity-card">
                <div class="icon-container"><i class="fas fa-info"></i></div>
                <div class="info-container">
                    <p>Người mượn: ${activity['HO_TEN_DOC_GIA']}</p>
                    <p>Ngày mượn: ${activity['NGAY_MUON']}</p>
                    <p>Ngày trả: ${activity['NGAY_TRA']}</p>
                </div>
            </div>
        `
    });
    
    let cards = activityCards.join(" ");
    activitiesContainer.innerHTML = `<h3>Hoạt Động</h3> ${cards}`;
}


function hideForm(){
    let formWrapper = document.getElementById('book-form-wrapper');
    formWrapper.style.display = "none";
}
function hideDetailPanel(){
    let detailBoxWrapper = document.getElementById('detail-box-wrapper');
    detailBoxWrapper.style.display = "none";
}

// -------------------------------------------------------------------
// delete-book-message-box
function hideDeleteBookMessageBox(){
    let deleteBookMessageBoxWrapper = document.getElementById("delete-book-message-box-wrapper");
    deleteBookMessageBoxWrapper.style.display= "none";
}
function stopPropagate(e){
    e.stopPropagation();
}

function showDeleteBookMessageBox(type, message){
    let deleteBookMessageBoxWrapper = document.getElementById("delete-book-message-box-wrapper");
    customDeleteBookMessageBox(type, message);

    deleteBookMessageBoxWrapper.style.display = "block";
}

function customDeleteBookMessageBox(type, message){
    let messageTitle = document.querySelector("#delete-book-message-box h2");
    let messageText = document.querySelector("#delete-book-message-box p");
    let title = "";
    if(type == "incorrect"){
        deleteBookSwitchToIncorrect();
        title = "Lỗi!"
    }else if(type == "warning"){
        deleteBookSwitchToWarning();
        title = "Lưu ý";
    }
    else{
        deleteBookSwitchToCorrect();
        title = "Thành công!";
    }
    
    messageTitle.innerHTML = title;
    messageText.innerHTML = message;
    
} 
function deleteBookSwitchToCorrect(){
    let iconCorrect = document.querySelector("#delete-book-message-box .icon-container .icon-correct");
    let iconIncorrect = document.querySelector("#delete-book-message-box .icon-container .icon-incorrect");
    let iconWarning = document.querySelector("#delete-book-message-box .icon-container .icon-warning");
    iconCorrect.style.display = "block";
    iconIncorrect.style.display = "none";
    iconWarning.style.display = "none";
}
function deleteBookSwitchToWarning(){
    let iconCorrect = document.querySelector("#delete-book-message-box .icon-container .icon-correct");
    let iconIncorrect = document.querySelector("#delete-book-message-box .icon-container .icon-incorrect");
    let iconWarning = document.querySelector("#delete-book-message-box .icon-container .icon-warning");
    iconWarning.style.display = "block";
    iconIncorrect.style.display = "none";
    iconCorrect.style.display= "none";
}
function deleteBookSwitchToIncorrect(){
    let iconCorrect = document.querySelector("#delete-book-message-box .icon-container .icon-correct");
    let iconIncorrect = document.querySelector("#delete-book-message-box .icon-container .icon-incorrect");
    let iconWarning = document.querySelector("#delete-book-message-box .icon-container .icon-warning");
    iconIncorrect.style.display = "block";
    iconCorrect.style.display = "none";
    iconWarning.style.display = "none";
}
