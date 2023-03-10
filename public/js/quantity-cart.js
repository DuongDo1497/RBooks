$(function() {
    let orderListWrap = document.querySelectorAll(".order-list");
    let btnNumOrder = document.querySelectorAll(".btn-number");
    let cartNumberHeader = document.querySelector(".cart-number");

    function convertTypeNumber(nameVariable) {
        return Number(nameVariable.slice(0, -2).split(".").join(""));
    }

    function formatCurrency(nameVariable) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
            minimumFractionDigits: 0
        }).format(Math.abs(nameVariable))
    }

    btnNumOrder.forEach(function (element) {
        element.addEventListener("click", function (e) {
            let totalPriceItem = 0;
            let totalPriceSaleItem = 0;
            let getClassParent = this.parentElement.parentElement.parentElement;
            let type = this.getAttribute("data-type");
            let getId = getClassParent.getAttribute("data-id");
            let price = getClassParent.querySelector(".price").innerText;
            let priceSale = getClassParent.querySelector(".final-price").value;
            let priceNum = convertTypeNumber(price);
            let priceSaleNum = convertTypeNumber(priceSale);
            let totalProItem = getClassParent.querySelector(".total");
            let getValInput = document.querySelectorAll(".input-number");
            let provisional = getClassParent.querySelector(".provisional");
            
            getValInput.forEach(function (element, index) {
                if (Number(getId) === index) {
                    let currentVal = parseInt(getValInput[index].value);
                    if (!isNaN(currentVal)){
                        if(type == 'minus') {
                            if(currentVal > getValInput[index].getAttribute('min')) {
                                getValInput[index].value = currentVal - 1;
                                totalPriceItem = totalPriceItem - (priceNum * (currentVal - 1))
                                totalPriceSaleItem = totalPriceSaleItem - (priceSaleNum * (currentVal - 1))
                                
                                provisional.value = formatCurrency(totalPriceItem);

                                totalProItem.innerText = formatCurrency(totalPriceSaleItem);
                            }
                        } else {
                            if(currentVal < getValInput[index].getAttribute('max')) {
                                getValInput[index].value = currentVal + 1;
                                totalPriceItem = priceNum * (currentVal + 1)
                                totalPriceSaleItem = priceSaleNum * (currentVal + 1)

                                provisional.value = formatCurrency(totalPriceItem);

                                totalProItem.innerText = formatCurrency(totalPriceSaleItem);
                            }
                        } 
                    } else {
                        getValInput[index].value =  0;
                    }
                }
            })



            // S??? l?????ng
            let totalQuantityCart = 0;
            let topTotal = document.querySelector("#top_total");
            // S??? l?????ng

            // Gi?? t???m t??nh
            let totalMoneyOrder = 0;
            let provisionalTotal = document.querySelector("#sub_total");
            // Gi?? t???m t??nh

            // Ti???t ki???m
            let totalSaveItem = 0;
            let saveTotal = document.querySelector("#save_total");
            // Ti???t ki???m
            
            // Th??nh ti???n ????n h??ng
            let intoMoney = document.querySelector(".total-price-cart");
            // Th??nh ti???n ????n h??ng

            orderListWrap.forEach(function (element) {
                // S??? l?????ng
                let inputQuantityVal = element.querySelector(".input-number").value;
                totalQuantityCart += Number(inputQuantityVal);
                // S??? l?????ng

                // Gi?? t???m t??nh
                let provisionalItem = element.querySelector(".provisional").value;
                console.log(provisionalItem);
                let convertNumberProvisional = convertTypeNumber(provisionalItem);
                totalMoneyOrder += convertNumberProvisional;
                // Gi?? t???m t??nh

                // Ti???t ki???m
                let getTotalItem = element.querySelector(".total").innerText;
                let convertNumberTotalItem = convertTypeNumber(getTotalItem);
                totalSaveItem += convertNumberTotalItem;
                // Ti???t ki???m
            })

            // S??? l?????ng
            topTotal.innerText = totalQuantityCart;

            // Gi?? t???m t??nh
            provisionalTotal.innerText = formatCurrency(totalMoneyOrder);

            // Ti???t ki???m
            saveTotal.innerText = formatCurrency(totalMoneyOrder - totalSaveItem);

            // Th??nh ti???n ????n h??ng
            intoMoney.innerText = formatCurrency(totalMoneyOrder - convertTypeNumber(saveTotal.innerText));
            
            cartNumberHeader.innerText = totalQuantityCart;
        })
    })
    
})

