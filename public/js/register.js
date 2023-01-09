const form = document.getElementById('formRegister')
const username = document.getElementById('ursRegister');
const email = document.getElementById('emailRegister')
const password = document.getElementById('pwdRegister');
const password2 = document.getElementById('confirmRegister');

//Show input error messages
function showError(input, message) {
    const formControl = input.parentElement;
    formControl.className = 'form-group error row relative';
    const id =input.getAttribute('id');
    const formControl_ = form.parentElement;
    
    let small;
    if(id ==="ursRegister"){
        small = formControl_.querySelector('.msg_user');
        $( '.msg_user' ).show();
        $( '.msg_user' ).css("display","inline-block");
        $( '.msg_user' ).addClass("msg-err-register" );
    }
    else if(id ==="emailRegister"){
        small = formControl_.querySelector('.msg_email');
        $( '.msg_email' ).show();
        $( '.msg_email' ).css("display","inline-block");
        $( '.msg_email' ).addClass("msg-err-register" );}
    else if(id ==="pwdRegister"){
        small = formControl_.querySelector('.msg_pwd');
        $( '.msg_pwd' ).show();
        $( '.msg_pwd' ).css("display","inline-block");
        $( '.msg_pwd' ).addClass("msg-err-register" );}
    
    else if(id ==="confirmRegister"){
        small = formControl_.querySelector('.msg_confirm');
        $( '.msg_confirm' ).show();
        $( '.msg_confirm' ).css("display","inline-block");
        $( '.msg_confirm' ).addClass("msg-err-register" );
    }
    small.innerText = message;
}

//show success colour
function showSucces(input) {
    const formControl = input.parentElement;
    formControl.className = 'form-group success row relative';
    const id =input.getAttribute('id');
    const formControl_ = form.parentElement;
    let small;
    if(id ==="ursRegister"){
        small = formControl_.querySelector('.msg_user');
        console.log("hide roi nhe anh oi");
        $( '.msg_user' ).hide();
    }
    else if(id ==="emailRegister"){
        small = formControl_.querySelector('.msg_email');
        console.log("hide roi nhe anh oi");
        $( '.msg_email' ).hide();}
    else if(id ==="pwdRegister"){
        small = formControl_.querySelector('.msg_pwd');
        console.log("hide roi nhe anh oi");
        $( '.msg_pwd' ).hide();}
    
    else if(id ==="confirmRegister"){
        small = formControl_.querySelector('.msg_confirm');
        console.log("hide roi nhe anh oi");
        $( '.msg_confirm' ).hide();
    }
}

//check email is valid
function checkEmail(input) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(re.test(input.value.trim())) {
        console.log("hide")
        showSucces(input)
        // $('.msg_email').hide();
        return true;
    }else {
        showError(input,'Email không hơp lệ');
        return false;
    }
}


//checkRequimsg-err-register fields
function checkRequired(input) {
    console.log("trim: " + input.value.trim());
        if(input.value.trim() === ''){
            console.log(input.id + "id")
            if(input.id==="emailRegister"){
                showError(input,"Email không được bỏ trống")
            }
            else{
                showError(input,`${getFieldName(input)} is required`)
            }
            return false;
        }else {
            showSucces(input);
            return true;
        }
        
    
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
    console.log("voo characters");
    for(let i = 0; i<input.length;i++){
        if((input[i].charCodeAt(0)>=33 && input[i].charCodeAt(0)<=47)||
            (input[i].charCodeAt(0)>=58 && input[i].charCodeAt(0)<=64)||(input[i].charCodeAt(0)>=91 && input[i].charCodeAt(0)<=95) 
            ||(input[i].charCodeAt(0)>=123 && input[i].charCodeAt(0)<=126) ||input[i].charCodeAt(0) === 96 ){
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
function checkLength(input, min ,max) {
    const id =input.getAttribute('id');
    if(input.value.length < min) {
        if(id==="ursRegister"){
            showError(input, `Tên tài khoản/Email phải ít nhất ${min} kí tự`);
            return false;
        }
        else if(id==="pwdRegister" || id==="confirmRegister"){
            showError(input, `Mật khẩu phải ít nhất ${min} kí tự`);
            return false;
        }
        else{
            showError(input, `${getFieldName(input)} phải ít nhất ${min} kí tự`);
            return false;
        }
        
    }else if(input.value.length > max) {
        if(id==="ursRegister"){
            showError(input, `Tên tài khoản/Email nhiều nhất nhất ${max} kí tự`);
            return false;
        }
        else if(id==="pwdRegister"|| id==="confirmRegister" ){
            showError(input, `Mật khẩu nhiều nhất ${max} kí tự`);
            return false;
        }
        else{
            showError(input, `${getFieldName(input)} nhiều nhất ${max} kí tự`);
            return false;
        }
    }else {
        if(id==="pwdRegister" || id==="confirmRegister"){
            if((checkCharacter(input.value) && checkLower(input.value) &&checkNumber(input.value)&&checkUpper(input.value))||
            (input.value.includes('`')&& checkLower(input.value) &&checkNumber(input.value)&&checkUpper(input.value))){
                showSucces(input);
                return true;
            }
            else{
                
                showError(input, "Mật khẩu phải chứa chữ hoa, chữ thường, số và kí tự");
                return false;
            }
            

        }
        else{
            showSucces(input);
            return true;
        }
    }
}

//get FieldName
function getFieldName(input) {
    return input.id.charAt(0).toUpperCase() + input.id.slice(1);
}

// check passwords match
function checkPasswordMatch(input1, input2) {
    console.log(input1.value + " " + input2.value)
    if(input1.value !== input2.value) {
        showError(input2, 'Mật khẩu không khớp');
        return false;
    }
    return true;
}


//Event Listeners
// form.addEventListener('submit',function(e) {
//     e.preventDefault();
//     // let isValidUsr =  checkRequired([username, email, password, password2]);
//     let isValidEmail = checkRequired(email);
//     let isValidLengthUrs = checkLength(username,6,15);
//     let isValidLengthPwd = checkLength(password,6,25);
//     let isValidLengthConfirm =checkLength(password2,6,25);
//     if(isValidEmail ===true){
//         isValidEmail = checkEmail(email);
//     }
//     //let isValidEmail = checkEmail(email);
//     let isValidSamePwd =checkPasswordMatch(password, password2);
//     console.log(isValidLengthUrs+ " " + isValidLengthPwd+ " " +
//         isValidLengthConfirm+ " " +
//         isValidEmail+ " " + isValidSamePwd);
    
//     if(!isValidLengthUrs|| !isValidLengthPwd||
//         !isValidLengthConfirm||
//         !isValidEmail|| !isValidSamePwd){
//             e.preventDefault();
//     }

    



// });



////hiển thị mật khẩu

// showBtn.onclick = (()=>{
//     if(passField.type === "password"){
//         passField.type = "text";
//             //showBtn.classList.add("hide-btn");
//         console.log("pwd");
//     }else{
//         passField.type = "password";
//         //showBtn.classList.remove("hide-btn");
//         console.log("text");
//     }
// });

$(document).ready(function(){
    $(".eye-pwd").hide();
    $('.icon-eye-pwd').click(function() {
        console.log("click");
        if($("#pwdRegister").attr("type") === "password"){
            $("#pwdRegister").attr("type", "text")
            $(".eye-slash-pwd").hide();
             $(".eye-pwd").show();

        }else{
            console.log("bỏ gạch");
             $(".eye-pwd").hide();
             $(".eye-slash-pwd").show();
            $("#pwdRegister").attr("type", "password");
        }
    });
})
$(document).ready(function(){
    $(".eye-rePwd").hide();
    $('.icon-eye-rePwd').click(function() {
        console.log("click");
        if($("#confirmRegister").attr("type") === "password"){
            $("#confirmRegister").attr("type", "text")
            $(".eye-slash-rePwd").hide();
             $(".eye-rePwd").show();

        }else{
            console.log("bỏ gạch");
             $(".eye-rePwd").hide();
             $(".eye-slash-rePwd").show();
            $("#confirmRegister").attr("type", "password");
        }
    });
})
$(document).ready(function(){
    $('.btn-close-register').click(function() {
        // $("#modalRegister").css("display","none");
        $("#modalRegister").modal('toggle');
    });
})
$(document).ready(function(){
    $('#modalRegister').on('shown.bs.modal', function () {
        $('#ursRegister').focus();
    });
})
$(document).ready(function(){
    $('#modalRegister input').keypress(function( e ) {
        if(e.which === 32) 
            return false;
    });
})

