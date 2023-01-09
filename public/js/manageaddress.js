const homeEditAddress = document.querySelector(".home-editaddress");
const officeEditAddress = document.querySelector(".office-editaddress");

function functionHomeEditAddress() {
    homeEditAddress.classList.add('btn-homeofficeeditaddress') 
    officeEditAddress.classList.remove('btn-homeofficeeditaddress')
}
function functionOficeEditAddress() {
    officeEditAddress.classList.add('btn-homeofficeeditaddress') 
    homeEditAddress.classList.remove('btn-homeofficeeditaddress')
}

const homeAddress = document.querySelector(".home-address");
const officeAddress = document.querySelector(".office-address");

function functionOficeAddress() {
    officeAddress.classList.add('btn-homeofficeaddress') 
    homeAddress.classList.remove('btn-homeofficeaddress')
}
function functionHomeAddress() {
    homeAddress.classList.add('btn-homeofficeaddress') 
    officeAddress.classList.remove('btn-homeofficeaddress')
}