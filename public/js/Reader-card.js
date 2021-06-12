
function hideUpdateReaderForm(){
    let updateFormWrapper = document.getElementById("update-form-wrapper");
    updateFormWrapper.style.display = "none";
}
function showUpdateReaderForm(){
    let updateFormWrapper = document.getElementById("update-form-wrapper");
    updateFormWrapper.style.display = "block";
}

function focusReaderCardListTab(){
    let readerCardListTab = document.getElementById("reader-card-list-tab");
    let createReaderCardTab = document.getElementById("create-reader-card-tab");
    readerCardListTab.checked = true;
    createReaderCardTab.checked = false;

}
function focusCreateReaderCardTab(){
    let createReaderCardTab = document.getElementById("create-reader-card-tab");
    let readerCardListTab = document.getElementById("reader-card-list-tab");
    createReaderCardTab.checked = true;
    readerCardListTab.checked = false;
}