$(function () {
  $("#number-quantity").on("change keyup", function (e) {
    e.preventDefault();
    changeInputQuantity();
  });

  $(".btn-number").click(function (e) {
    e.preventDefault();
    var type = $(this).attr("data-type");
    var input = $("#number-quantity");
    var currentVal = parseInt(input.val());

    if (!isNaN(currentVal)) {
      if (type == "minus") {
        if (currentVal > input.attr("min")) {
          input.val(currentVal - 1);
          changeInputQuantity();
        }
      } else {
        if (currentVal < input.attr("max")) {
          input.val(currentVal + 1);
          changeInputQuantity();
        }
      }
    } else {
      input.val(0);
      changeInputQuantity();
    }
  });

  if ($("#number-quantity").val() == 1) {
    $(".btn-number.minus").prop("disabled", true);
  }

  function changeInputQuantity() {
    var quantity = parseInt($("#number-quantity").val());
    var quantityWarehouse = parseInt($("#quantityWarehouses").val());

    if (quantity === 1) {
      $(".btn-number.minus").prop("disabled", true);
    } else {
      $(".btn-number.minus").prop("disabled", false);
    }

    if (quantity > quantityWarehouse) {
      $("#error").text("Số lượng bạn nhập nhiều hơn tồn kho");
      $("#error").html(function () {
        return `
                <div class="alert alert-danger" role="alert">
                    <i class="fa-solid fa-triangle-exclamation"></i> Số lượng bạn nhập nhiều hơn tồn kho
                </div>
                `;
      });
      $("#btn-buy").attr({ disabled: "true" });
    } else {
      // $('#error').text('');
      $("#error").html();
      $("#btn-buy").removeAttr("disabled");
    }
  }

  var srcOld1 = $("#img-active").attr("src");
  $(".gallery-small-image .item").each(function () {
    let thisPresent = $(this);
    let getElementThumbImgPresent = $(this).children(".thumbnail");
    let getSrcThumbPresent = getElementThumbImgPresent.attr("src");
    if (srcOld1 === getSrcThumbPresent) {
      thisPresent.addClass("active");
    }

    $(this).click(function () {
      let getElementThumbImg = $(this).children(".thumbnail");
      let getSrcThumb = getElementThumbImg.attr("src");
      srcOld1 = $("#img-active").attr("src", getSrcThumb);

      if (srcOld1.attr("src") === getSrcThumb) {
        if ($(".gallery-small-image .item").hasClass("active")) {
          $(".gallery-small-image .item").removeClass("active");
        }
        $(this).addClass("active");
      }
    });
  });
});

let priceSaleElement = document.querySelector(".price .sale");
let priceSaleNumberElement = document.querySelector(".price .sale .number");
let priceSaleNumber = priceSaleNumberElement.textContent;
let pricePromoElement = document.querySelector(".price .promo");
if (Number(priceSaleNumber) === 0) {
  priceSaleElement.textContent = "Liên hệ";
  pricePromoElement.remove();
}
