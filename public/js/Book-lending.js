

window.onload = function(){
    let readerCardIdInput = document.getElementById("reader-card-id-input");
    let readerNameDisplayBox = document.getElementById("reader-name-display-box");

    let bookIdInput = document.getElementById("book-id-input");
    let bookNameDisplayBox = document.getElementById("book-name-display-box");
    
    readerCardIdInput.addEventListener("input", function(e){
        let readerId = parseInt(e.target.value);
        let readerName = findReaderName(readerId);
        readerNameDisplayBox.value = readerName;
    })

    bookIdInput.addEventListener("input", function(e){
        let bookId = parseInt(e.target.value);
        let bookName = findBookName(bookId);
        bookNameDisplayBox.value = bookName;
    })
}

function findReaderName(id){
    readerName = "undefined";
    data['readers'].forEach(reader => {
        if(reader['MA_DOC_GIA'] == id) readerName = reader['HO_TEN_DOC_GIA'];
    });
    return readerName;
}
function findBookName(id){
    bookName = "undefined";
    data['books'].forEach(book => {
        if(book['MA_SACH'] == id) bookName = book['TEN_SACH'];
    });
    return bookName;
}