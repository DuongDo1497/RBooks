let getProductItem = document.querySelectorAll(".product .item");
getProductItem.forEach((element) => {
  // let getPercentPromo = element.querySelector(".promo-percent");
  // let getPricePromo = element.querySelector(".price .promo");
  // if (getPercentPromo.innerText === "0%") {
  //   getPercentPromo.style.display = "none";
  //   getPricePromo.style.display = "none";
  // }

  let priceSaleElement = element.querySelector(".price .sale");
  let priceSaleNumberElement = element.querySelector(".price .sale .number");
  let priceSaleNumber = priceSaleNumberElement.textContent;
  if (Number(priceSaleNumber) === 0) {
    priceSaleElement.textContent = "Liên hệ";
  }
});

// let priceSaleProDetail = document.querySelector(
//   ".product-detail-control .sale"
// );
// let pricePromoProDetail = document.querySelector(
//   ".product-detail-control .promo"
// );

// if (priceSaleProDetail.innerText === pricePromoProDetail.innerText) {
//   pricePromoProDetail.style.display = "none";
// } else {
//   pricePromoProDetail.removeProperty("style");
// }
