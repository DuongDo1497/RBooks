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



            // Số lượng
            let totalQuantityCart = 0;
            let topTotal = document.querySelector("#top_total");
            // Số lượng

            // Giá tạm tính
            let totalMoneyOrder = 0;
            let provisionalTotal = document.querySelector("#sub_total");
            // Giá tạm tính

            // Tiết kiệm
            let totalSaveItem = 0;
            let saveTotal = document.querySelector("#save_total");
            // Tiết kiệm
            
            // Thành tiền đơn hàng
            let intoMoney = document.querySelector(".total-price-cart");
            // Thành tiền đơn hàng

            orderListWrap.forEach(function (element) {
                // Số lượng
                let inputQuantityVal = element.querySelector(".input-number").value;
                totalQuantityCart += Number(inputQuantityVal);
                // Số lượng

                // Giá tạm tính
                let provisionalItem = element.querySelector(".provisional").value;
                console.log(provisionalItem);
                let convertNumberProvisional = convertTypeNumber(provisionalItem);
                totalMoneyOrder += convertNumberProvisional;
                // Giá tạm tính

                // Tiết kiệm
                let getTotalItem = element.querySelector(".total").innerText;
                let convertNumberTotalItem = convertTypeNumber(getTotalItem);
                totalSaveItem += convertNumberTotalItem;
                // Tiết kiệm
            })

            // Số lượng
            topTotal.innerText = totalQuantityCart;

            // Giá tạm tính
            provisionalTotal.innerText = formatCurrency(totalMoneyOrder);

            // Tiết kiệm
            saveTotal.innerText = formatCurrency(totalMoneyOrder - totalSaveItem);

            // Thành tiền đơn hàng
            intoMoney.innerText = formatCurrency(totalMoneyOrder - convertTypeNumber(saveTotal.innerText));
            
            cartNumberHeader.innerText = totalQuantityCart;
        })
    })
    
})

