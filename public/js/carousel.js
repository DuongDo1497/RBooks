$(function () {
  $(".banners-carousel").owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    navText: [
      '<span class="btn-prev"><i class="icon-prev fas fa-chevron-left"></i><span>',
      '<span class="btn-next"><i class="icon-next fas fa-chevron-right"></i><span>',
    ],
    navClass: ["owl-prev", "owl-next"],
    autoplay: true,
    autoplayTimeout: 8000,
    autoHeight: 350,
    center: true,
    dots: false,
    responsive: {
      0: {
        items: 1,
        dots: false,
      },
      600: {
        items: 1,
        dots: false,
      },
      1000: {
        items: 1,
      },
    },
  });

  $(".banner-product").owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    autoplay: true,
    autoplayTimeout: 8000,
    center: true,
    dots: false,
    items: 1,
  });

  $(".product-carousel-list").owlCarousel({
    loop: true,
    // margin: 37,
    nav: false,
    autoplay: true,
    autoplayTimeout: 8000,
    dots: false,
    // items: 2,
    responsiveClass: true,
    responsive: {
      0: {
        items: 2,
        margin: 20,
      },
      576: {
        items: 2,
        margin: 20,
      },
      1200: {
        items: 3,
        margin: 37,
      },
    },
  });

  $(".product-hot-list").owlCarousel({
    loop: true,
    // margin: 37,
    nav: false,
    autoplay: true,
    autoplayTimeout: 8000,
    dots: false,
    // items: 3,
    responsiveClass: true,
    responsive: {
      0: {
        items: 2,
        margin: 20,
      },
      576: {
        items: 3,
        margin: 20,
      },
      1200: {
        items: 3,
        margin: 37,
      },
    },
  });

  $(".product-detail-list").owlCarousel({
    loop: true,
    margin: 25,
    nav: false,
    autoplay: true,
    autoplayTimeout: 8000,
    dots: false,
    items: 6,
  });

  $(".banner-sidebar").owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    autoplay: true,
    autoplayTimeout: 5000,
    center: true,
    dots: false,
    items: 1,
  });

  $(".partner-carousel").owlCarousel({
    loop: true,
    margin: 50,
    nav: true,
    autoplay: true,
    autoHeight: true,
    center: true,
    dots: false,
    nav: false,
    responsive: {
      0: {
        items: 2,
        margin: 30,
      },
      600: {
        items: 3,
      },
      768: {
        items: 5,
      },
      1000: {
        items: 5,
      },
    },
  });
});
