
// -------------------------------------------------------------------
// delete-element-message-box
function hideDeleteElementMessageBox(event){
    let deleteElementMessageBoxWrapper = document.getElementById("delete-element-message-box-wrapper");
    deleteElementMessageBoxWrapper.style.display= "none";
    event.preventDefault();
}
function stopPropagate(e){
    e.stopPropagation();
}

function showDeleteElementMessageBox(type, message){
    let deleteElementMessageBoxWrapper = document.getElementById("delete-element-message-box-wrapper");
    customDeleteElementMessageBox(type, message);

    deleteElementMessageBoxWrapper.style.display = "block";
}

function customDeleteElementMessageBox(type, message){
    let messageTitle = document.querySelector("#delete-element-message-box h2");
    let messageText = document.querySelector("#delete-element-message-box p");
    let title = "";
    if(type == "incorrect"){
        deleteElementSwitchToIncorrect();
        title = "Lỗi!"
    }else if(type == "warning"){
        deleteElementSwitchToWarning();
        title = "Lưu ý";
    }
    else{
        deleteElementSwitchToCorrect();
        title = "Thành công!";
    }
    
    messageTitle.innerHTML = title;
    messageText.innerHTML = message;
    
} 
function deleteElementSwitchToCorrect(){
    let iconCorrect = document.querySelector("#delete-element-message-box .icon-container .icon-correct");
    let iconIncorrect = document.querySelector("#delete-element-message-box .icon-container .icon-incorrect");
    let iconWarning = document.querySelector("#delete-element-message-box .icon-container .icon-warning");
    iconCorrect.style.display = "block";
    iconIncorrect.style.display = "none";
    iconWarning.style.display = "none";
}
function deleteElementSwitchToWarning(){
    let iconCorrect = document.querySelector("#delete-element-message-box .icon-container .icon-correct");
    let iconIncorrect = document.querySelector("#delete-element-message-box .icon-container .icon-incorrect");
    let iconWarning = document.querySelector("#delete-element-message-box .icon-container .icon-warning");
    iconWarning.style.display = "block";
    iconIncorrect.style.display = "none";
    iconCorrect.style.display= "none";
}
function deleteElementSwitchToIncorrect(){
    let iconCorrect = document.querySelector("#delete-element-message-box .icon-container .icon-correct");
    let iconIncorrect = document.querySelector("#delete-element-message-box .icon-container .icon-incorrect");
    let iconWarning = document.querySelector("#delete-element-message-box .icon-container .icon-warning");
    iconIncorrect.style.display = "block";
    iconCorrect.style.display = "none";
    iconWarning.style.display = "none";
}