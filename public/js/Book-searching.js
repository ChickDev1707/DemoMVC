const list = document.querySelector('.book-list');
const searchBar = document.querySelector('.search-bar input');
const searchBtn = document.querySelector('.search-bar button');
let selectBox = document.querySelector('.search-bar select');
let selection = selectBox.options[selectBox.selectedIndex].value; // lấy value trong option

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
function showDetailPanel(){
    let detailBoxWrapper = document.getElementById('detail-box-wrapper');
    detailBoxWrapper.style.display = "block";
}
function showUpdateForm(){
    let updateForm = document.getElementById('book-form-wrapper');
    updateForm.style.display = "block";
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
    let books = data.map(function(item){
        return `<div class="book-container">
        <img src="${item['IMAGE_PATH']}" alt="" class="book-cover" >
        <div class="info-box">
            <h3><i class="far fa-bookmark"></i> ${item['TEN_SACH']}</h3>
            <p style= "color:${item['TINH_TRANG'] == false ? "#27ae60" : "#d63031"}"><i class="far fa-question-circle"></i> ${item['TINH_TRANG'] == false ? "Chưa được mượn" : "Đã được mượn"}</p>
            <div class="detail-and-update">
                <button class="detail-btn" onclick=showDetailPanel()>Chi tiết</button>
                <button class="update-btn" onclick=showUpdateForm()>Cập nhật</button>
            </div>
        </div>
    </div>`
    })
    books = books.join("");
    list.innerHTML = books;
}
