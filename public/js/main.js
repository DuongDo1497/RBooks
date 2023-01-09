$(function() {
    // $('.user-hi').hover(function() {
    //     $('.login-user').removeAttr('display');
    //     $('.login-user').css({
    //         display: 'block',
    //     });
    // });

    // $('.login-user').on('mouseleave', function() {
    //     $('.login-user').removeAttr('style');
    // });

    function dashboardSmHidden() {
        $(".dashboard-small").addClass("hidden")
    }

    
    $(document).ready(function(){
        $(".login .user-active").click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).toggleClass("clicked");
            let isClicked = $(".user-active").hasClass("clicked");
            if (isClicked) {
                $(".dashboard-small").addClass("active");
                $(".dashboard-small").removeClass("opacity-hidden");
                $(".dashboard-small").removeClass("hidden");
            }else{
                $(".dashboard-small").removeClass("active");
                $(".dashboard-small").addClass("opacity-hidden");
                setTimeout(
                    dashboardSmHidden
                , 1500);
            }
        });

        $('body').click( function() {
            $(".login .user-active").removeClass("clicked");
            $(".dashboard-small").removeClass("active");
            $(".dashboard-small").addClass("opacity-hidden");
            setTimeout(
                dashboardSmHidden
            , 1500);
        });
    });
    


    $('.open-popup-link').magnificPopup({
	  type:'inline',
	  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
	});

    let url = window.location.href;
    if(url === "https://rbooks.vn/" || url === "http://rbooks.vn/" || url.includes("shopping/c") || url.includes("products")){
        $('.menu-default-wrap').hide();
    }else{
        $('.menu-default-wrap').show();
    }

    $(".filter-all").addClass("active");
    if(url.includes("?keyword") || url.includes("&page")){
        $(".filter-all").removeClass("active");
    }else{
        $(".filter-all").addClass("active");
    }


    
    let menuItem = document.querySelectorAll(".menu-list .menu-item");
    let titleCate = document.querySelector(".product-main .title");
    let filterCate = document.querySelector(".categories .filter-all");

    menuItem.forEach(element => {
        let link = element.querySelector("a").getAttribute("href");
        if (url.includes(link)){
            filterCate.setAttribute("href", link);
            let nameCategory = element.querySelector("a").textContent;
            let typeCategory = nameCategory.slice(4);
            titleCate.outerHTML = "<h3 class='title'>" + "Sách" + "<span>" + typeCategory + "</span>" + "</h3>";
            if (link === url) {
                element.querySelector("a").style.color = "#0578c4";
            }
        }
    })
    
    // let result = url.slice(url.lastIndexOf("sach"), url.lastIndexOf(".")).replaceAll("-", " ");

    $(window).scroll(function (event) {
        var scrollNum = $(window).scrollTop();
        if (scrollNum > 180) {
            $(".header").addClass("fixed");
        }else{
            $(".header").removeClass("fixed");
        }
    });

    $(".read-more").text("Đọc thêm nội dung");
    $(".read-more").click(function() {
        $(".des-wrap").toggleClass("active");

        if($(".des-wrap").hasClass("active")){
            $(".gradient").hide()
            $(".read-more").text("Rút gọn nội dung");
            // console.log(1);
        }else{
            $(".gradient").show()
            $(".read-more").text("Đọc thêm nội dung");
            // console.log(2);
        }
    })

    let progressItem = $(".progress-item");
    progressItem.each(function () {
        let getDataRate = $(this).children(".rate").attr("data-rate");
        for (let i = 1; i <= getDataRate; i++) {
            $(this).children(".rate").append(`
                <img class="img-fluid" src="../../../../../imgs/star.jpg" alt="Đánh giá">
            `)
        }
    })

    let rateStart = $(".rate-start-wrap .icon");

    rateStart.click(function(e){
        e.preventDefault();
        let getVal = $(this).attr("data-value");
        $(".rate-value").attr("value", getVal);
        let newArr = rateStart.slice(0, getVal);
        let lengthNewArr = newArr.length;
        let lengthArr = rateStart.slice(lengthNewArr, rateStart.length);
        if(newArr){
            newArr.addClass("active");
        }
        lengthArr.removeClass("active");
        let parentArr = rateStart.children()
        parentArr.each(function(index){
            if(index < newArr.length){
                $(this).children().css("fill", "#FDD835")
            }else{
                $(this).children().css("fill", "#f4f4f4")
            }
        })
    })

    document.getElementById("file-img").addEventListener("change", function(){
        var files = this.files;
        console.log(files);

        for (var i = 0; i < files.length; i++){
            let reviewImg = document.querySelector(".review-img img");
            let urlImg = `imgs/${files[i].name}`;
            console.log(urlImg);
            var reader = new FileReader();
            reader.onload = function (e) {
                console.log(e);
            };
        }
    })
    
    
    let progressRate = document.querySelectorAll(".progress-item");
    let totalQuantityProgress = document.querySelector(".comment-point .quantity-num").innerText;
    let arr = [];
    progressRate.forEach((element, index) => {
        let quantityRate = element.querySelector(".quantity").innerText;
        let progressBar = element.querySelector(".progress-bar");
        let result = (quantityRate/totalQuantityProgress) * 100;
        arr.push(result);
        progressBar.style.width = `${arr[index]}%`;
    })

    if (Number(totalQuantityProgress) === 0) {
        document.querySelector(".comment-list").style.display = "none";
    }else{
        document.querySelector(".comment-list").style.display = "block";
    }
    
});


let url = window.location.href;
let menuDefaultItem = document.querySelectorAll(".menu-default .menu-item");
menuDefaultItem.forEach((e) => {
    let menuDefaultLink = e.querySelector(".menu-link");
    if(url === menuDefaultLink.getAttribute("href")){
        e.classList.add("active");
    }
})
console.log(url);