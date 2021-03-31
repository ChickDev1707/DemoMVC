

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

    let rc_registerForm = document.getElementById('rc-register-form');
    let rc_infoPanel = document.getElementById('rc-info-panel');
    if(rc_registerForm!= null){
        readerCardPanel.appendChild(rc_registerForm);
    }
    if(rc_infoPanel!= null){
        readerCardPanel.appendChild(rc_infoPanel);
    }
    // console.log(readerCardPanel);

   
}

// function appendReaderInfoPanel(){
//     // replace register form by info panel after registering successfully
//     let readerCardPanel = document.getElementById("reader-card-panel");
//     let rc_registerForm = document.getElementById('rc-register-form');
//     console.log(readerCardPanel);
//     readerCardPanel.removeChild(readerCardPanel.childNodes[0]);
    
//     let rc_infoPanel = document.getElementById('rc-info-panel');
//     readerCardPanel.appendChild(rc_infoPanel);
// }

