window.onload = function () {
    let ReturnBookIdInput = document.getElementById('rb-card-id-input');
    let readerNameDisplayBox = document.getElementById('reader-name-display-box');
    let bookNameDisplayBox = document.getElementById('book-name-display-box');
    let fienDisplayBox = document.getElementById('rb-fine-display-box');

    ReturnBookIdInput.addEventListener("input", (e) => {
        let returnBookId = parseInt(e.target.value);
        let readerName = findReaderName(returnBookId);
        let bookName = findBookName(returnBookId);
        let fine = getFine(returnBookId);
        readerNameDisplayBox.value = readerName;
        bookNameDisplayBox.value = bookName;
        fienDisplayBox.value = fine;
    })
    
    function findReaderName(id) {
        readerName = "undefined";
        let readerId;
        data['BookAndReaderIds'].forEach( Element => {
            if(Element['MA_PHIEU_MUON'] == id) readerId = Element['MA_DOC_GIA'];
        });
        data['readers'].forEach(reader => {
            if(reader['MA_DOC_GIA'] == readerId) readerName = reader['HO_TEN_DOC_GIA'];
        });
        return readerName;
    }

    function findBookName(id) {
        bookName = "undefined";
        let bookId;
        data['BookAndReaderIds'].forEach( Element => {
            if(Element['MA_PHIEU_MUON'] == id) bookId = Element['MA_SACH'];
        });
        data['books'].forEach(book => {
            if(book['MA_SACH'] == bookId) bookName = book['TEN_SACH'];
        });
        return bookName;
    }

    function getFine(id) {
        fine = "undefined";
        data['BookAndReaderIds'].forEach( Element => {
            if(Element['MA_PHIEU_MUON'] == id) fine = Element['TIEN_PHAT_KY'];
        });
        return fine;
    }
}