
const form_updatepass = document.getElementById('form-update-password')
const passwordCurrent = document.getElementById('password-current');
const passwordNew = document.getElementById('password-new');
const passwordNew1 = document.getElementById('password-new1');

//Show input error messages
function showErrorMess(input, message) {
    const formControl = input.parentElement;
    // formControl.className = 'form-update error  relative ';
    const id =input.getAttribute('id');
    const formControl_ = form_updatepass.parentElement;
    
    let small;
   if(id ==="password-current"){
        small = formControl_.querySelector('.update-pass-curent');
        $( '.update-pass-curent' ).show();
        $( '.update-pass-curent' ).addClass("red" );}
    
    else if(id ==="password-new"){
        small = formControl_.querySelector('.update-pass-curentnew');
        $( '.update-pass-curentnew' ).show();
        $( '.update-pass-curentnew' ).addClass("red" );
    } else if(id ==="password-new1"){
        small = formControl_.querySelector('.update-pass-curentnew1');
        $( '.update-pass-curentnew1' ).show();
        $( '.update-pass-curentnew1' ).addClass("red" );
    }
    small.innerText = message;
}

//show success colour
function showSuccesMess(input) {
    const formControl = input.parentElement;
    const id =input.getAttribute('id');
    const formControl_ = form.parentElement;
    let small;
     if(id ==="password-current"){
        small = formControl_.querySelector('.update-pass-curent');
        $( '.update-pass-curent' ).hide();}
    
    else if(id ==="password-new"){
        small = formControl_.querySelector('.update-pass-curentnew');
        $( '.update-pass-curentnew' ).hide();
    }
    else if(id ==="password-new1"){
        small = formControl_.querySelector('.update-pass-curentnew1');
        $( '.update-pass-curentnew1' ).hide();
    }
}


//checkRequired fields
function checkRequiredMess(inputArr) {
    inputArr.forEach(function(input){
        if(input.value.trim() === ''){
            showErrorMess(input,`${getFieldNameMess(input)} is required`)
            return false;
        }else {
            showSuccesMess(input);
            return true;
        }
    });
}

function checkUpper(input){
    for(let i = 0; i<input.length;i++){
        if(input[i].charCodeAt(0)>=65 && input[i].charCodeAt(0)<=90 ){
            return true;
        }

    }
    return false;
}

function checkLower(input){
    for(let i = 0; i<input.length;i++){
        if(input[i].charCodeAt(0)>=97 && input[i].charCodeAt(0)<=122 ){
            return true;
        }

    }
    return false;
}

function checkCharacter(input){
    for(let i = 0; i<input.length;i++){
        if((input[i].charCodeAt(0)>=33 && input[i].charCodeAt(0)<=47)||
            (input[i].charCodeAt(0)>=58 && input[i].charCodeAt(0)<=64)||(input[i].charCodeAt(0)>=91 && input[i].charCodeAt(0)<=95) 
            ||(input[i].charCodeAt(0)>=123 && input[i].charCodeAt(0)<=126)){
            return true;
        }

    }
    return false;
}
function checkNumber(input){
    for(let i = 0; i<input.length;i++){
        if( input[i].charCodeAt(0)>=48 && input[i].charCodeAt(0)<=57){
            return true;
        }

    }
    return false;
}
//check input Length
function checkLengthMess(input,inputCurrent,inputNew, min ,max) {
    const id =input.getAttribute('id');
    if(input.value.replace(/\s/g, '').length < min) {
        if(id==="password-current" || id==="password-new"|| id==="password-new1"){
            showErrorMess(input, `Mật khẩu phải ít nhất ${min} kí tự`);
            return false;
        }
        else{
            showErrorMess(input, `${getFieldNameMess(input)} phải ít nhất ${min} kí tự`);
            return false;
        }
        
    }else if(input.value.replace(/\s/g, '').length > max) {
      if(id==="password-current" || id==="password-new"|| id==="password-new1"){
            showErrorMess(input, `Mật khẩu nhiều nhất ${max} kí tự`);
            return false;
        }
        else{
            showErrorMess(input, `${getFieldNameMess(input)} nhiều nhất ${max} kí tự`);
            return false;
        }
    }else if(inputCurrent.value === inputNew.value){
            showErrorMess(passwordNew, 'Mật khẩu mới không được giống mật khẩu hiện tại');
            return false;
    }
    else {
        if(checkCharacter(input.value) && checkLower(input.value) &&checkNumber(input.value)&&checkUpper(input.value)){
            showSuccesMess(input);
            return true;
        }
        else{
            
            showErrorMess(input, "Mật khẩu phải chứa chữ hoa, chữ thường, số và kí tự");
            return false;
        }
    }
}

//get FieldName
function getFieldNameMess(input) {
    return input.id.charAt(0).toUpperCase() + input.id.slice(1);
}

function checkPasswordMatchMess(input1, input2) {
    
    console.log(input1.value.replace(/\s/g, '') + " " + input2.value.replace(/\s/g, ''))
    if(input1.value.replace(/\s/g, '') !== input2.value.replace(/\s/g, '')) {
        showErrorMess(input2, 'Mật khẩu không khớp');
        return false;
    }
    else{
        showSuccesMess(input2);
        return true;
    }
}
function checkspace(input4, input5){
    console.log(input4.value.split(" ").length)
    console.log(input5.value.split(" ").length)
    if(input4.value.split(" ").length > 1){
        showErrorMess(input4, 'Mật không được có khoảng trống');
    } else if(input5.value.split(" ").length > 1 ){
        showErrorMess(input5, 'Mật không được có khoảng trống');
    }
    return true;
}

form_updatepass.addEventListener('submit', function(e) {
    
    
    let isValidLengthPwd = checkLengthMess(passwordNew,passwordCurrent,passwordNew,6,25);
    let isValidSamePwd =checkPasswordMatchMess(passwordNew, passwordNew1);
    let checkSpacepass= checkspace(passwordNew,passwordNew1)
    if( !isValidLengthPwd|| !isValidSamePwd || !checkSpacepass ){
            e.preventDefault();
            return false;
    }
    else{
         
        return true;
    }
});

$(document).ready(function(){
    $(".eye-rePwdUpdate").hide();
    $('.icon-eye-rePwdUpda').click(function() {
        console.log("click");
        if($("#password-current").attr("type") === "password"){
            $("#password-current").attr("type", "text");
            $(".eye-rePwdUpdate").show();
            $(".eye-slash-rePwdUpdate").hide();
        }else{
            console.log("bỏ gạch");
             $(".eye-slash-rePwdUpdate").show();
             $(".eye-rePwdUpdate").hide();
            $("#password-current").attr("type", "password");
        }
    });
})

$(document).ready(function(){
    $(".eye-rePwdUpdateNew").hide();
    $('.icon-eye-rePwdUpdaNew').click(function() {
        console.log("click");
        if($("#password-new").attr("type") === "password"){
            $("#password-new").attr("type", "text")
            $(".eye-rePwdUpdateNew").show();
             $(".eye-slash-rePwdUpdateNew").hide();

        }else{
            console.log("bỏ gạch");
             $(".eye-slash-rePwdUpdateNew").show();
             $(".eye-rePwdUpdateNew").hide();
            $("#password-new").attr("type", "password");
        }
    });
})
$(document).ready(function(){
    $(".eye-rePwdUpdateNew1").hide();
    $('.icon-eye-rePwdUpdaNew1').click(function() {
        console.log("click");
        if($("#password-new1").attr("type") === "password"){
            $("#password-new1").attr("type", "text")
            $(".eye-rePwdUpdateNew1").show();
             $(".eye-slash-rePwdUpdateNew1").hide();

        }else{
            console.log("bỏ gạch");
             $(".eye-slash-rePwdUpdateNew1").show();
             $(".eye-rePwdUpdateNew1").hide();
            $("#password-new1").attr("type", "password");
        }
    });
})


$(document).ready(function(){
    $('#password-new input').keypress(function( e ) {
        if(e.which === 32) 
            return false;
    });

 })