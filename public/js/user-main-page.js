
window.onload = function(){

    let readerCardPanel = document.getElementById("reader-card-panel");
    let bookSearchingPanel = document.getElementById("book-searching-panel");
    let borrowBook = document.getElementById("borrow-book-panel");

    // add event for list
    let featurePanels = [readerCardPanel, bookSearchingPanel, borrowBook];
    let current = readerCardPanel;
    let listTags = document.getElementsByClassName("user-feature-tag");
    for(let i= 0; i<listTags.length; i++){
        tag = listTags[i];
        tag.addEventListener("click", ()=>{
            current.style.display = "none";
            current= featurePanels[i];
            current.style.display = "block";
        })
    }
    // featurePanels and list tags are corresponding to each other 
}

