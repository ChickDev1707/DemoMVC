

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