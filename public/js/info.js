
const yearSelect = document.getElementById("year-info-customer");
const monthSelect = document.getElementById("month-info-customer");
const daySelect = document.getElementById("day-info-customer");

const months = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 
'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10',
'Tháng 11', 'Tháng 12'];

//Months are always the same
(function populateMonths(){
    for(let i = 0; i < months.length; i++){
        const option = document.createElement('option');
        option.textContent = months[i];
        option.value = i;
        monthSelect.appendChild(option);
    }
    monthSelect.value = "Tháng 10";
})();

let previousDay;

function populateDays(month){
    //Delete all of the children of the day dropdown
    //if they do exist
    while(daySelect.firstChild){
        daySelect.removeChild(daySelect.firstChild);
    }
    //Holds the number of days in the month
    let dayNum;
    //Get the current year
    let year = yearSelect.value;

    if(month === 'Tháng 1' || month === 'Tháng 3' || 
    month === 'Tháng 5' || month === 'Tháng 7' || month === 'Tháng 8' 
    || month === 'Tháng 10' || month === 'Tháng 12') {
        dayNum = 31;
    } else if(month === 'Tháng 4' || month === 'Tháng 6' 
    || month === 'Tháng 9' || month === 'Tháng 11') {
        dayNum = 30;
    }else{
        //Check for a leap year
        if(new Date(year, 1, 29).getMonth() === 1){
            dayNum = 29;
        }else{
            dayNum = 28;
        }
    }
    //Insert the correct days into the day <select>
    for(let i = 1; i <= dayNum; i++){
        const option = document.createElement("option");
        option.textContent = i;
        daySelect.appendChild(option);
    }
    if(previousDay){
        daySelect.value = previousDay;
        if(daySelect.value === ""){
            daySelect.value = previousDay - 1;
        }
        if(daySelect.value === ""){
            daySelect.value = previousDay - 2;
        }
        if(daySelect.value === ""){
            daySelect.value = previousDay - 3;
        }
    }
}

function populateYears(){
    //Get the current year as a number
    let year = new Date().getFullYear();
    //Make the previous 100 years be an option
    for(let i = 0; i < 101; i++){
        const option = document.createElement("option");
        option.textContent = year - i;
        yearSelect.appendChild(option);
    }
}

populateDays(monthSelect.value);
populateYears();

yearSelect.onchange = function() {
    populateDays(monthSelect.value);
}
monthSelect.onchange = function() {
    populateDays(monthSelect.value);
}
daySelect.onchange = function() {
    previousDay = daySelect.value;
}
$( document ).ready(function() {
    let value = $("#user-phone-info").val();
    if(value.length > 26){
        $("#user-phone-info").val(value.slice(0,26)+"...");
    }
  });
  
  $( document ).ready(function() {
    $(".msg-err-name").hide();
    let btnSaveInfo = document.querySelector(".btn-save-info");
    btnSaveInfo.onclick = function(e){
        // //lấy ngày tháng năm
        // var e = document.getElementById("day-info-customer");
        // var day = e.value;
        // e = document.getElementById("month-info-customer");
        // var month = e.value.slice(6,e.value.length);
        // e = document.getElementById("year-info-customer");
        // var year = e.value;
        // //set ngày  UI

        // alert("Ngày sinh: " + day + "/" + month +"/" + year);

        let value = $(".input-info--name").val();
        if(value.length === 0){
            $(".msg-err-name").show();
            e.preventDefault();
        }
        else{
            $(".msg-err-name").hide();
        }
    }
    
  });
  $( document ).ready(function() {
    let value = $("#user-phone-info").val();
    if(value.length > 26){
        $("#user-phone-info").val(value.slice(0,26)+"...");
    }
  });
  
  $( document ).ready(function() {
    let phoneInput = document.querySelector(".input-info__phone");
    console.log(phoneInput.value.trim().length);
    if( phoneInput.value.trim().length === 0){
        console.log("thêm mới");
        let changePhone = document.querySelector(".btn-change--phone");
        changePhone.innerText = "Thêm mới";
    }
    else{
        console.log("thay đổi");
        changePhone.innerText = "Thay đổi";
    }
    
  });
  $( document ).ready(function() {
    let dob = $("#full-dob-info").val();
    let splitDob = dob.split("-")
    console.log("ngày sinh: " + splitDob);
    let year = splitDob[0];
    let month = splitDob[1];
    let day = splitDob[2];
    console.log("Tháng: " + month);
    //set
    var e = document.getElementById("day-info-customer");
    e.value =  Number(day);
    var c = document.getElementById("month-info-customer");
    c.value = Number(month) - 1;
    console.log(Number(month));
    e = document.getElementById("year-info-customer");
    e.value = year;
  });
  $(document).ready(function(){
    $(".input-change_phone").keypress(function( e ) {
        if(e.which < 48 || e.which > 57) 
            return false;
    });
      
  })


