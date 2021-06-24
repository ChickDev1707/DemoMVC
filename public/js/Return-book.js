window.onload = function () {
    console.log(data);
    let returnBookIdInput = document.getElementById('rb-card-id-input');
    let readerNameDisplayBox = document.getElementById('reader-name-display-box');
    let bookNameDisplayBox = document.getElementById('book-name-display-box');
    let fineDisplayBox = document.getElementById('rb-fine-display-box');
    let totalFineDisplayBox = document.getElementById('rb-total-fine-display-box');
    let returnDayInput = document.getElementById('return-day');
    
    let punishMoneyEveryDay = parseInt(data['punishMoneyEveryDay']);
    let borrowDayMax = parseInt(data['borrowDayMax']);
    let returnBookId;
    

    returnBookIdInput.addEventListener("input", (e) => {
        returnBookId = parseInt(e.target.value);

        let readerName = findReaderName(returnBookId);
        let bookName = findBookName(returnBookId);
        
        readerNameDisplayBox.value = readerName;
        bookNameDisplayBox.value = bookName;
        
        let fine = getFine(returnBookId, returnDayInput.value);
        if(fine < 0 || isNaN(fine)) fine = 0;
        fineDisplayBox.value = fine;

        let totalFine = getTotalFine(returnBookId, fine);
        totalFineDisplayBox.value = totalFine;
            
    })

    returnDayInput.addEventListener('change', (e) => {
        returnDay = e.target.value;
        let fine = getFine(returnBookId, returnDay);
        if(fine < 0 || isNaN(fine)) fine = 0;
        fineDisplayBox.value = fine;

        let totalFine = getTotalFine(returnBookId, fine);
        totalFineDisplayBox.value = totalFine;
    })

    function findReaderName(id) {
        let readerName = "undefined";
        let readerId;
        data['BookAndReaderIds'].forEach( Element => {
            if(Element['MA_PHIEU_MUON_TRA'] == id) readerId = Element['MA_DOC_GIA'];
        });
        data['readers'].forEach(reader => {
            if(reader['MA_DOC_GIA'] == readerId) readerName = reader['HO_TEN_DOC_GIA'];
        });
        return readerName;
    }

    function findBookName(id) {
        let bookName = "undefined";
        let bookId;
        data['BookAndReaderIds'].forEach( Element => {
            if(Element['MA_PHIEU_MUON_TRA'] == id) bookId = Element['MA_SACH'];
        });
        data['books'].forEach(book => {
            if(book['MA_SACH'] == bookId) bookName = book['TEN_SACH'];
        });
        return bookName;
    }

    function getFine(id, returnDay) {

        let borrowDay = "";
        data['BookAndReaderIds'].forEach( Element => {
            if(Element['MA_PHIEU_MUON_TRA'] == id) borrowDay = Element['NGAY_MUON'];
        });
        let differenceDays = getDifferenceDays(returnDay, borrowDay);

        return (differenceDays - borrowDayMax) * punishMoneyEveryDay;        
    }
    function getTotalFine(id, currentFine) {
        let totalFine = 0;
        let readerId;
        data['BookAndReaderIds'].forEach( Element => {
            if(Element['MA_PHIEU_MUON_TRA'] == id) readerId = Element['MA_DOC_GIA'];
        });
        data['readers'].forEach(reader => {
            if(reader['MA_DOC_GIA'] == readerId) totalFine = reader['TONG_NO'];
        });
        if(totalFine == null) totalFine = 0;
        totalFine =  parseInt(totalFine) + currentFine;
        return totalFine;
    }
    
    function getDifferenceDays(returnDay, borrowDay) {
        const diffDays = (date, otherDate) => Math.ceil((date - otherDate) / (1000 * 60 * 60 * 24));
        let differenceDays =  diffDays(new Date(returnDay), new Date(borrowDay));
        console.log(differenceDays);
        return differenceDays;
    }
}