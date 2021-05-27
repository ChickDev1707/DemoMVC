

function hideMessageBox(){
    let messageBox = document.getElementById("message-box");
    messageBox.style.display = "none";
}

function show(){
    let select = document.getElementById("select");
    let messageBox = document.getElementById("message-box");
    customMessageBox(select.value, "Test");

    messageBox.style.display = "block";
}

function customMessageBox(type, message){
    let messageBox = document.getElementById("message-box");
    let messageText = document.querySelector("#message-box p");
    let color;
    if(type == "incorrect"){
        color= "#d63031";
        switchToIncorrect();
    }else{
        color = "#10ac84";
        switchToCorrect();
    }
    
    messageBox.style.backgroundColor = color;
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