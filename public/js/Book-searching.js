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
        return `<div class="book-container">
        <img src="${item['IMAGE_PATH']}" alt="" class="book-cover" >
        <div class="info-box">
            <h3><i class="far fa-bookmark"></i>${item['TEN_SACH']}</h3>
            <p><i class="far fa-user"></i>${item['TAC_GIA']}</p>
            <div class="status">${item['TINH_TRANG'] == false ? "Borrow" : "Borrowed"}</div>
        </div>
    </div>`
    })
    books = books.join("");
    list.innerHTML = books;
}