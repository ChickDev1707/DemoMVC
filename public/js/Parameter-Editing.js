

function updateReaderCardParams(data){
    let inputMinAge = document.getElementById("input-min-age");
    let inputMaxAge = document.getElementById("input-max-age");
    let inputCardDateLimit = document.getElementById("input-card-date-limit");

    inputMinAge.value = data['min_age'];
    inputMaxAge.value = data['max_age'];
    inputCardDateLimit.value = data['card_date_limit'];
}
function updateYearDistance(yearDistance){
    let inputYearDistance = document.getElementById("input-year-distance");
    inputYearDistance.value = yearDistance;
    
}

function updateChangeBorrowParams(data){
    let inputMaxNumOfBook = document.getElementById("input-max-num-of-book");
    let inputMaxBorrowDayAmount = document.getElementById("input-max-borrow-day-amount");
    
    inputMaxNumOfBook.value = data['max_num_of_book'];
    inputMaxBorrowDayAmount.value = data['max_borrow_day_amount'];
    
}

function hideParamsListWrapper(){
    let listContainerWrapper = document.getElementById("params-list-wrapper");
    listContainerWrapper.style.display = "none";
}

function displayBookTypes(data){
    let paramsListWrapper = document.querySelector("#params-list-wrapper");
    let paramsListContainer = document.querySelector("#params-list-wrapper .params-list-container");
    
    let types = data.map((type, index)=>{
        return createTypeItem(type, index);
    });
    listItems = `
        <h3>Thể loại</h3>
            <div class= "list">
                ${types.join(" ")}
            </div>
        <input type="submit" value = "Xóa" name= "submit_type_delete">
        <div class="params-hide" onclick = "hideParamsListWrapper()"><i class="fas fa-times"></i></div>
    `;
    paramsListContainer.innerHTML= listItems;
    console.log(listItems);
    paramsListWrapper.style.display= "block";

}

function createTypeItem(bookType, index){
    return `
        <div>
            <input type="text" readonly value="${bookType['TEN_THE_LOAI_SACH']}" name= "type-${index}">
            <label class="checkbox-container">
                <input type="checkbox" value="checked" name= "type-check-${index}">
                <span class="checkmark"></span>
            </label>
        </div>
    `
}


function displayBookAuthors(data){
    let paramsListWrapper = document.querySelector("#params-list-wrapper");
    let paramsListContainer = document.querySelector("#params-list-wrapper .params-list-container");
    
    let authors = data.map((author, index)=>{
        return createAuthorItem(author, index);
    });
    listItems = `
        <h3>Tác giả</h3>
            <div class= "list">
                ${authors.join(" ")}
            </div>
        <input type="submit" value = "Xóa" name= "submit_author_delete">
        <div class="params-hide" onclick = "hideParamsListWrapper()"><i class="fas fa-times"></i></div>
    `;
    paramsListContainer.innerHTML= listItems;
    paramsListWrapper.style.display= "block";

}

function createAuthorItem(bookAuthor, index){
    return `
        <div>
            <input type="text" readonly value="${bookAuthor['TEN_TAC_GIA']}" name= "author-${index}">
            <label class="checkbox-container">
                <input type="checkbox" value="checked" name= "author-check-${index}">
                <span class="checkmark"></span>
            </label>
        </div>
    `
}