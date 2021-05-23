console.log(data);
const list = document.querySelector('.book-list');
const searchBar = document.querySelector('.search-bar input');

searchBar.addEventListener('keyup', function(e){
    const searchString = e.target.value.toLowerCase();
    const filterBooks = data.filter(book => {
        return book["TEN_SACH"].toLowerCase().includes(searchString) || book['TAC_GIA'].toLowerCase().includes(searchString);
    });
    displayBooks(filterBooks);
})

window.addEventListener('DOMContentLoaded', function(){
    displayBooks(data);
})
function displayBooks(data){
    let books = data.map(function(item){
        return `<div class="book-item">
                <div class="item-main-picture">
                    <img src="${item["IMAGE_PATH"]}" alt="picture">
                </div>
                <div class="item-footer-describe">
                    <h1>${item["TEN_SACH"]}</h1>
                    <h4>${item["TAC_GIA"]}</h4>
                    <i class="far fa-calendar"></i>
                    <span>${item["NAM_XUAT_BAN"]}</span>
                    <h4>${item["TINH_TRANG"] == 0 ? 'Còn hàng' : 'Hết hàng'}</h4>
                </div>
                </div>`
    })
    books = books.join("");
    list.innerHTML = books;
}