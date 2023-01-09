$('#customControlVAT').click(function() {
    $(".vat-default").toggle(this.checked);
});
$('#customControlAutosizing').click(function() {
    $(".content-gift").toggle(this.checked);
});

function formatPhoneNumber(phoneNumber){
    // return  + '.' + phoneNumber.slice(4,7) + '.' +  phoneNumber.slice(7);
    return `${phoneNumber.slice(0, 4)}.${phoneNumber.slice(4,7)}.${phoneNumber.slice(7)}`
}

$( document ).ready(function() {
    const phoneNumber = document.getElementById('phone-customer-checkout').value;
    const numPhoneAfterFormat = formatPhoneNumber(phoneNumber);
    //const customerPhone = document.querySelector('.customer-phone');
    $(".customer-phone").text(numPhoneAfterFormat);
});
$( document ).ready(function() {
    const phoneNumber = document.getElementById('phone-customer-checkout').value;
    const numPhoneAfterFormat = formatPhoneNumber(phoneNumber);
    //const customerPhone = document.querySelector('.customer-phone');
    $(".customer-phone").text(numPhoneAfterFormat);
});
$('.gift-number input').keypress(function( e ) {
    if(e.which < 48 || e.which > 57) 
        return false;
});
$( document ).ready(function() {
    $(".gift-message textarea").css("resize","none");
});

$(".gift-message textarea").each(function () {
    this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
  }).on("input", function () {
    this.style.height = "auto";
    this.style.height = (this.scrollHeight) + "px";
  });

