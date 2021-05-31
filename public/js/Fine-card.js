window.onload = function(){
    let readerCardIdInput = document.getElementById("reader-card-id-input");

    let readerNameDisplayBox = document.getElementById("reader-name-display-box");
    let totalMoneyDisplayBox = document.getElementById("total-money-display-box");
    let receivedMoneyInput = document.getElementById("received-money-input");
    let remainMoneyDisplayBox = document.getElementById("remain-money-display-box");
    
    let totalMoney = null;
    readerCardIdInput.addEventListener("input", function(e){
        let readerId = parseInt(e.target.value);

        let readerName = findReaderInfoFieldValue(readerId, 'HO_TEN_DOC_GIA');
        readerNameDisplayBox.value = readerName;

        totalMoney = findReaderInfoFieldValue(readerId, 'TONG_NO');
        if(totalMoney != "undefined") totalMoney = parseInt(totalMoney);
        totalMoneyDisplayBox.value = totalMoney;

    })
    receivedMoneyInput.addEventListener("input", function(e){
        let receivedMoney= parseInt(e.target.value);
        let remainMoney = totalMoney - receivedMoney;
        remainMoneyDisplayBox.value = remainMoney.toString();
    })

}

function findReaderInfoFieldValue(id, field){
    selectedValue = "undefined";
    data.forEach(reader => {
        if(reader['MA_DOC_GIA'] == id) selectedValue = reader[field];
    });
    return selectedValue;
}

