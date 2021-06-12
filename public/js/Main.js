
function hideMessageBox(){
    let messageBoxWrapper = document.getElementById("main-message-box-wrapper");
    messageBoxWrapper.style.display= "none";
}
function stopPropagate(e){
    e.stopPropagation();
}

function showMessageBox(type, message){
    let messageBoxWrapper = document.getElementById("main-message-box-wrapper");
    customMessageBox(type, message);

    messageBoxWrapper.style.display = "block";
}

function customMessageBox(type, message){
    let messageTitle = document.querySelector("#main-message-box h2");
    let messageText = document.querySelector("#main-message-box p");
    let title = "";
    if(type == "incorrect"){
        switchToIncorrect();
        title = "Lỗi!"
    }else if(type == "warning"){
        switchToWarning();
        title = "Lưu ý";
    }
    else{
        switchToCorrect();
        title = "Thành công!";
    }
    
    messageTitle.innerHTML = title;
    messageText.innerHTML = message;
    
} 
function switchToCorrect(){
    let iconCorrect = document.querySelector("#main-message-box .icon-container .icon-correct");
    let iconIncorrect = document.querySelector("#main-message-box .icon-container .icon-incorrect");
    let iconWarning = document.querySelector("#main-message-box .icon-container .icon-warning");
    iconCorrect.style.display = "block";
    iconIncorrect.style.display = "none";
    iconWarning.style.display = "none";
}
function switchToWarning(){
    let iconCorrect = document.querySelector("#main-message-box .icon-container .icon-correct");
    let iconIncorrect = document.querySelector("#main-message-box .icon-container .icon-incorrect");
    let iconWarning = document.querySelector("#main-message-box .icon-container .icon-warning");
    iconWarning.style.display = "block";
    iconIncorrect.style.display = "none";
    iconCorrect.style.display= "none";
}
function switchToIncorrect(){
    let iconCorrect = document.querySelector("#main-message-box .icon-container .icon-correct");
    let iconIncorrect = document.querySelector("#main-message-box .icon-container .icon-incorrect");
    let iconWarning = document.querySelector("#main-message-box .icon-container .icon-warning");
    iconIncorrect.style.display = "block";
    iconCorrect.style.display = "none";
    iconWarning.style.display = "none";
}


function previewFile() {
    var avatarContainer = document.querySelector('#avatar');
    var file    = document.querySelector('input[type=file]').files[0];
    var reader  = new FileReader();
  
    reader.onloadend = function () {
        avatarContainer.src = reader.result;
    }
  
    if (file) {
        reader.readAsDataURL(file);
    } else {
        avatarContainer.src = "";
    }
}