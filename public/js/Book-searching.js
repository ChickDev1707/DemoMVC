console.log(data);
const list = document.querySelector('.book-list');
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
            </div>
            </div>`
})
books = books.join("");
list.innerHTML = books;