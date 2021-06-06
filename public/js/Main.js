

function hideMessageBox(){
    let messageBoxWrapper = document.getElementById("message-box-wrapper");
    messageBoxWrapper.style.display= "none";
}
function stopPropagate(e){
    e.stopPropagation();
}

function showMessageBox(type, message){
    let messageBoxWrapper = document.getElementById("message-box-wrapper");
    customMessageBox(type, message);

    messageBoxWrapper.style.display = "block";
}

function customMessageBox(type, message){
    let messageTitle = document.querySelector("#message-box h2");
    let messageText = document.querySelector("#message-box p");
    let title = "";
    if(type == "incorrect"){
        switchToIncorrect();
        title = "Lỗi!"
    }else{
        switchToCorrect();
        title = "Thành công!";
    }
    
    messageTitle.innerHTML = title;
    messageText.innerHTML = message;
    
}
function switchToCorrect(){
    let iconCorrect = document.getElementById("icon-correct");
    let iconIncorrect = document.getElementById("icon-incorrect");
    iconCorrect.style.display = "block";
    iconIncorrect.style.display = "none";
}
function switchToIncorrect(){
    let iconCorrect = document.getElementById("icon-correct");
    let iconIncorrect = document.getElementById("icon-incorrect");
    iconCorrect.style.display = "none";
    iconIncorrect.style.display = "block";
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