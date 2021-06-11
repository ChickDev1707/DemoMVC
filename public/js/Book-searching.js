
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