const list = document.querySelector('.book-list');
const searchBar = document.querySelector('.search-bar input');
const searchBtn = document.querySelector('.search-bar button');
let selectBox = document.querySelector('.search-bar select');
let selection = selectBox.options[selectBox.selectedIndex].value; // lấy value trong option

// console.log(data['activities']);

window.onload= function(){
    let formHeaderTitle = document.querySelector(".extended-info-form-outer .top-bar h2");
    formHeaderTitle.textContent= "Cập nhật sách";

    let submitAddBookBtn = document.getElementById("submit-add-book");
    submitAddBookBtn.value= "Cập nhật"
}
// change default adding book form text to update book form
function hideForm(){
    let formWrapper = document.getElementById('book-form-wrapper');
    formWrapper.style.display = "none";
}
function hideDetailPanel(){
    let detailBoxWrapper = document.getElementById('detail-box-wrapper');
    detailBoxWrapper.style.display = "none";
}


window.addEventListener('DOMContentLoaded', function(){
    displayBooks(data['books']);
})
// cập nhật giá trị select
selectBox.addEventListener('change', function(){
    selection = selectBox.options[selectBox.selectedIndex].value;
    console.log(selection);
})

// Tìm kiếm với giá trị tương ứng
searchBar.addEventListener('keyup', function(e){
    e.preventDefault();
    const searchString = e.target.value.toLowerCase();
    searchBtn.addEventListener('click', function(){
        const filterBooks = data['books'].filter((book) => {
            if (selection == "book_name") return book['TEN_SACH'].toLowerCase().includes(searchString);
            else if (selection == "book_author") return book['TAC_GIA'].toLowerCase().includes(searchString);
            else if (selection == "book_type") return book['THE_LOAI'].toLowerCase().includes(searchString);
            else return ( book['TEN_SACH'].toLowerCase().includes(searchString) ||
                          book['TAC_GIA'].toLowerCase().includes(searchString)  ||
                          book['THE_LOAI'].toLowerCase().includes(searchString));
        });
        displayBooks(filterBooks);
    })
    if (e.keyCode === 13) searchBtn.click();
})


function displayBooks(data){
    
    data.forEach((book)=>{
        let bookContainer = createBook(book);
        list.appendChild(bookContainer);
    })
}

function createBook(book){
    let container = document.createElement("div");
    container.classList.add("book-container");
    
    let bookCover = createBookCover(book['IMAGE_PATH']);
    let infoBox = createInfoBox();
    let bookName = createBookName(book['TEN_SACH']);
    let bookStatus = createBookStatus(book['TINH_TRANG']);
    let buttonContainer = createDetailAndUpdateContainer();
    let detailBtn = createDetailButton(book);
    let updateBtn = createUpdateButton(book);

    buttonContainer.appendChild(detailBtn);
    buttonContainer.appendChild(updateBtn);

    infoBox.appendChild(bookName);
    infoBox.appendChild(bookStatus);
    infoBox.appendChild(buttonContainer);
    
    container.appendChild(bookCover);
    container.appendChild(infoBox);

    return container;
}

function createBookCover(imagePath){
    let bookCover = document.createElement("img");
    bookCover.classList.add("book-cover");
    bookCover.attributes.src = imagePath;
    return bookCover;
}
function createInfoBox(){
    let infoBox = document.createElement("div");
    infoBox.classList.add("info-box");
    return infoBox;
}
function createBookName(name){
    let bookName = document.createElement("h3");
    bookName.innerHTML = `<i class="far fa-bookmark"></i> ${name}`;
    return bookName;
}

function createBookStatus(status){
    let color, text;
    let bookStatus = document.createElement("p");
    console.log(status);
    if(status == 0){
        text = "Chưa được mượn";
        color = "#27ae60"
    }else{
        text = "Đã được mượn";
        color = "#d63031";
    }
    bookStatus.style.color = color;
    bookStatus.innerHTML = `<i class="far fa-question-circle"></i> ${text}`;
    return bookStatus;
}

function createDetailAndUpdateContainer(){
    let container = document.createElement("div");
    container.classList.add("detail-and-update");
    return container;
}
function createDetailButton(book){
    let detailButton = document.createElement("input");
    detailButton.setAttribute("type", "submit"); 
    detailButton.setAttribute("value", "Chi tiết");
    detailButton.setAttribute("method", "POST");
    detailButton.setAttribute("name", "submit_detail");
    detailButton.classList.add("detail-btn");
    // detailButton.innerHTML = "Chi tiết"
    
    let detailBoxWrapper = document.getElementById('detail-box-wrapper');
    detailButton.addEventListener("click", function(){
        addMainDetailToElements(book);
        addSubDetailToElements(book);
        uploadBookActivities(book['MA_SACH']);

        detailBoxWrapper.style.display = "block";
    });
    return detailButton;
}
function addMainDetailToElements(book){
    let bookName = document.querySelector(".detail-book-info-container .info-box h3");
    let pTags = document.querySelectorAll(".detail-book-info-container .info-box p");
    let status = document.querySelector(".detail-book-info-container .info-box .status");
    
    let statusColor= book['TINH_TRANG'] == false? "#27ae60": "#d63031";
    let statusText= book['TINH_TRANG'] == false? "Chưa được mượn": "Đã được mượn";
    
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
function createUpdateButton(book){
    let updateButton = document.createElement("button");
    updateButton.classList.add("update-btn");
    updateButton.innerHTML = "Cập nhật"
    updateButton.addEventListener("click", function(){
        
    });
    return updateButton;
}
function uploadBookActivities(bookId){

    let activitiesContainer = document.querySelector(".detail-activity-container");
    activityCard= data['activities'][bookId].map((activity)=>{
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
    
    let cards = activityCard.join(" ");
    activitiesContainer.innerHTML = `<h3>Hoạt Động</h3> ${cards}`;
}
function createActivityCard($bookId){

}

function showDetailPanel(){
    let detailBoxWrapper = document.getElementById('detail-box-wrapper');
    detailBoxWrapper.style.display = "block";
}
function showUpdateForm(){
    let updateForm = document.getElementById('book-form-wrapper');
    updateForm.style.display = "block";
}