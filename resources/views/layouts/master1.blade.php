<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="google-site-verification" content="L0-hmlu-Zdbk8Qx3X5W-tCpzvrQmdCFYYy5mIFufgMs" />
    <title>Công Ty TNHH R Books</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="icon" type="image/png" href="https://rbooks.vn/public/imgs/logo/icon-rb.png" sizes="32x32" />
    <link href="{{ asset('/libs1/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!--<link href="{{ asset('libs1/bootstrap/css/font-awesome.min.css') }}" rel="stylesheet">-->
    <link href="{{ asset('/libs1/bootstrap/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/libs1/bootstrap/css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/libs1/icofont/icofont.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/solid.css" integrity="sha384-r/k8YTFqmlOaqRkZuSiE9trsrDXkh07mRaoGBMoDcmA58OHILZPsk29i2BsFng1B" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/regular.css" integrity="sha384-IG162Tfx2WTn//TRUi9ahZHsz47lNKzYOp0b6Vv8qltVlPkub2yj9TVwzNck6GEF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/brands.css" integrity="sha384-BKw0P+CQz9xmby+uplDwp82Py8x1xtYPK3ORn/ZSoe6Dk3ETP59WCDnX+fI1XCKK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/fontawesome.css" integrity="sha384-4aon80D8rXCGx9ayDt85LbyUHeMWd3UiBaWliBlJ53yzm9hqN21A+o1pqoyK04h+" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('/libs1/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
    
    <link href="{{ asset('/css/rbooks.css') }}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-140160462-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-140160462-1');
    </script>

    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window,document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
     fbq('init', '335646733514821');
    fbq('track', 'PageView');
    </script>
    <noscript>
     <img height="1" width="1"
    src="https://www.facebook.com/tr?id=335646733514821&ev=PageView
    &noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window,document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
     fbq('init', '554248482025640'); 
    fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" 
        src="https://www.facebook.com/tr?id=554248482025640&ev=PageView
        &noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

</head>
<body>

    <!-- Back to top -->
    <div class="back-to-top">
        <img src="{{ asset('imgs/back-to-top.png') }}" />
    </div>

    <!-- Header -->
    <header id="main-header">

        <!-- Header top -->
        <div id="main-header-top">
            <div class="container">
                <div class="row">

                    <!-- Logo -->
                    <div class="col-xl-2 col-md-2 logo align-self-md-center">
                        <a href="{{ route('home') }}"><img class="img-fluid" src="{{ asset('/imgs/logo_png.png') }}" alt="R books Logo" title="RBooks.VN"></a>
                    </div>
                    <!-- /Logo -->

                    <!-- Search form -->
                    <div class="col-xl-5 col-md-4 search">
                        <form method="get" action="{{ route('search') }}" id="main-header-search">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" placeholder="{{trans('home.Enter ISBN(s), title or author')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-search" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /Search form -->

                    <!-- User area -->
                    <div class="col-xl-5 col-md-6 user">
                        <div class="row">
                            <div class="col-xl-4 col-4 header-icon-col">
                                <a href="{{ route('customer-order') }}" class="order-tracking">{{trans('home.Orders')}}</a>
                            </div>
                            
                            <div class="col-xl-4 col-4 header-icon-col">
                                @guest
                                <a href="#{{-- TODO: add link login --}}" class="user-hi"><span style="line-height: 38px;">{{trans('home.Login')}}</span></a>
                                <div class="login-user">
                                    <ul class="list-unstyled">
                                        <div class="p-1">
                                            <li>
                                                <a class="btn btn-primary list-user" data-toggle="modal" href="#modalLogin">{{trans('home.Login')}}</a>
                                            </li>
                                        </div>
                                        <div class="p-1">
                                            <li>
                                                <a class="btn btn-primary list-user" data-toggle="modal" href="#modalRegister">{{trans('home.Register')}}</a>
                                            </li>
                                        </div>
                                        <div class="p-1">
                                            <li>
                                                <a class="btn btn-primary p-0 login-fb" href="{{ route('facebook-login') }}">
                                                    <i class="fab fa-facebook-square"></i>
                                                    <span>Facebook</span>
                                                </a>
                                            </li>
                                        </div>
                                        <div class="p-1">
                                            <li>
                                                <a class="btn btn-primary p-0 login-gg" href="{{ route('google-login') }}">
                                                    <i class="fab fa-google"></i>
                                                    <span>Google</span>
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </div>
                                @else
                                <a href="#{{-- TODO: add link login --}}" class="user-hi text-truncate">Hello, <span class="user-name">{{ Auth::user()->name }}</span></a>
                                <div class="login-user login-successfully">
                                    <ul class="list-unstyled">
                                        <div class="p-1">
                                            <li>
                                                <a class="list-user text-nowrap" href="{{ route('customer') }}"><span class="icofont-user-alt-4 text-menu pt-2"></span><span class="pl-3 font-weight-bold">{{trans('home.Profile')}}</span></a>
                                            </li>
                                        </div>
                                        <div class="p-1">
                                            <li>
                                                <a class="list-user text-nowrap" href="{{ route('customer-order') }}"><span class="icofont-listing-number text-menu pt-2" aria-hidden="true"></span><span class="pl-3 font-weight-bold">{{trans('home.My Purchase')}}</span></a>
                                            </li>
                                        </div>
                                        <div class="p-1"><li><a class="list-user text-nowrap" href="{{ route('customer-addresses') }}"><span class="icofont-ui-settings text-menu pt-2" aria-hidden="true"></span><span class="pl-3 font-weight-bold">{{trans('home.Account Setting')}}</span></a></div>
                                        <div class="p-1">
                                            <li>
                                                <a class="list-user text-nowrap" href="{{ route('logout') }}"
                                                    onclick="
                                                        event.preventDefault();
                                                        document.getElementById('logout-form').submit();
                                                    ">
                                                    <span class="icofont-logout text-menu pt-2" aria-hidden="true"></span><span class="pl-3 font-weight-bold">{{trans('home.Exit')}}</span>
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </div>
                                    </ul>
                                </div>
                                @endguest
                            </div>

                            <div class="col-xl-4 col-4 header-icon-cart">
                                <a href="{{ route('cart') }}" class="btn btn-cart btn-block"><img class="img-fluid pr-1" src="{{ asset('/imgs/cart.png') }}" alt="">
                                {{trans('home.Cart')}} {{ (!empty($total)) ? "(" . $total['totalQuantity'] . ")" : "(0)" }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /User area -->

                </div>
            </div>
        </div>
        <!-- /Header top -->

        <!-- Header bottom -->
        <div id="main-header-bottom" class="d-none">
            <div class="container">
                <div class="row">
                    <!-- Icon group -->
                    <div class="col-xl clearfix">
                        <div class="icon-box friendly">
                            {{trans('home.Friendly attitude')}}<br />
                            <span>{{trans('home.Prestige - Professional')}}</span>
                        </div>
                        <div class="icon-box support-24h">
                            Viber/Skype/Zalo:<br />
                            <span class="font-weight-bold" style="color: red !important;">08 4966 4005</span>
                        </div>
                        <div class="icon-box quality">
                            {{trans('home.100% Authentic1')}}<br />
                            <span>{{trans('home.100% Authentic2')}}</span>
                        </div>
                        <div class="icon-box fast-delivery">
                            {{trans('home.Nationwide Delivery')}}<br />
                            <span>{{trans('home.Fast & Convenient')}}</span>
                        </div>
                    </div>
                    <!-- /Icon group -->

                </div>
            </div>
        </div>
        <!-- Header bottom -->

        <!-- Menu -->
        <nav id="main-header-menu">
            <div class="container">
                <ul>
                    <li><a href="{{ route('home') }}"><b>{{trans('home.Home')}}</b></a></li>
                    <li><a href="{{ route('about-rbooks') }}"><b>{{trans('home.About')}}</b></a></li>
                    <li><a href="{{ route('products') }}"><b>{{trans('home.Products')}}</b></a></li>
                    <!-- <li><a href="http://blog.rbooks.vn/" target="_blank"><b>{{trans('home.Blog')}}</b></a></li> -->
                    <li><a href="{{ route('recruitment') }}"><b>{{trans('home.Career')}}</b></a></li>
                    <li><a href="{{ route('contact') }}"><b>{{trans('home.Contact')}}</b></a></li>
                </ul>
            </div>
        </nav>

        <nav class="main-header-menu-mb">

            <div class="main-header-menu">
                <div class="container">
                    <div class="header-menu clearfix">
                        <a href="#" onclick="return false;">
                            <b>Menu</b>
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div>
            </div>

            <ul class="list-menu-mobile">
                <li><a href="{{ route('home') }}"><b>Trang chủ</b></a></li>
                <li><a href="{{ route('about-rbooks') }}"><b>Giới thiệu</b></a></li>
                <li><a href="{{ route('products') }}"><b>Sản phẩm</b></a></li>
                <li><a href="http://blog.rbooks.vn/" target="_blank"><b>Tin tức</b></a></li>
                <li><a href="{{ route('recruitment') }}"><b>Tuyển dụng</b></a></li>
                <li><a href="{{ route('contact') }}"><b>Liên hệ</b></a></li>
            </ul>
        </nav>
        <!-- Menu -->
    </header>
    <!-- /Header #main-header -->

    <!-- Main content -->
    @yield('content')
    @yield('email')
    <!-- /Main content -->

    <!-- Main footer -->
    <footer id="main-footer">
        <div class="container">
            <div class="row">
                <!-- Company info -->
                <div class="col-xl-3 col-lg-3 col-md-6 footer-col">
                    <h3> {{trans('home.Rbooks')}} </h3>
                    <div class="address">
                        <span> {{trans('home.Address')}} </span>
                    </div>
                    <p class="mb-0" style="color: #283b91;"><i class="fa fa-envelope"></i><span class="pl-2 font-weight-bold">info@rbooks.vn</span></p>
                    <p class="mb-0" ><i class="fas fa-mobile-alt text-center" style="color: #283b91; width: 14px;"></i><span class="font-weight-bold phone-footer pl-2 pr-2" style="color: red !important;"> 08 4966 4005</span></p>
                    <p><i class="fas fa-phone" style="color: #283b91;"></i><span class="font-weight-bold phone-footer pl-2" style="color: red !important;"> 028 3636 4405</span></p>

                </div>
                <!-- /Company info -->

                <!-- About company -->
                <div class="col-xl-3 col-lg-3 col-md-6 footer-col">
                    <h3>{{trans('home.Gettoknowus')}}</h3>
                    <ul class="footer-link">
                        <li><a href="{{ route('about-rbooks') }}">{{trans('home.Giới thiệu')}}</a></li>
                        <li><a href="{{ route('recruitment') }}">{{trans('home.Careers')}}</a></li>
                        <li><a href="{{ route('privacy') }}">{{trans('home.PrivacyPolicy')}}</a></li>
                        <li><a href="{{ route('how-to-order') }}">{{trans('home.Howtobuy')}}</a></li>
                        <li><a href="{{ route('payment') }}">{{trans('home.PaymentMethods')}}</a></li>
                        <li><a href="{{ route('shipping-method') }}">{{trans('home.ShippingRates&Policies')}}</a></li>
                    </ul>
                </div>
                <!-- /About company -->

                <!-- Payment method -->
                <div class="col-xl-3 col-lg-3 col-md-6 footer-col">
                    <!-- <h3>{{trans('home.PAYMENTMETHOD')}}</h3>
                    <div class="row text-center">
                        <div class="col-4 align-self-center">
                            <img src="{{ asset('/imgs/logo/visa.svg') }}" alt="Visa" class="img-fluid">
                        </div>
                        <div class="col-4 align-self-center">
                            <img src="{{ asset('/imgs/logo/mastercard.svg') }}" alt="Master" class="img-fluid">
                        </div>
                        <div class="col-4 align-self-center">
                            <img src="{{ asset('/imgs/logo/bank_transfer.svg') }}" alt="Master" class="img-fluid">
                        </div>
                    </div> -->
                    <h3>Follow us</h3>
                    <div class="row mb-3">
                        <div class="col-2 col-sm-4" style="flex: 0 0 22%;"><a href="https://www.facebook.com/rbooks.vn/"><img src="{{ asset('/imgs/logo/facebook.svg') }}" alt="facebook" class="img-fluid"></a></div>
                        <div class="col-2 col-sm-4" style="flex: 0 0 22%;"><a href="https://www.youtube.com/channel/UC40qGVhqAYh-CO6zsCzyeIw?view_as=subscriber"><img src="{{ asset('/imgs/logo/youtube.svg') }}" alt="youtube" class="img-fluid"></a></div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-7"><a href="http://online.gov.vn/Home/WebDetails/36094" class="d-block" target="_blank"><img src="{{ asset('/imgs/logo/dathongbao.png') }}" alt="Đã thông báo Bộ Công Thương" class="img-fluid"></a>
                        </div>
                    </div>
                </div>
                <!-- /Payment method -->

                <!-- Follow us -->
                <div class="col-xl-3 col-lg-3 col-md-6 footer-col">
                    <h3>Language</h3>
                    <div class="row px-3 pb-3">
                        <!-- <p class="font-weight-bold">Language: </p> -->
                        <a href="/locale/en"><img src="{{ asset('/imgs/logo/en.png') }}" class="img-fluid mr-2"></a>
                        <a href="/locale/vi"><img src="{{ asset('/imgs/logo/vi.png') }}" class="img-fluid ml-2"></a>
                    </div>
                </div>
                <!-- /Follow us -->
            </div>
        </div>
    </footer>
    <!-- Footer Copyright -->
    <footer id="footer-copyright">
        <div class="container">
            <div class="copyright"><span>Copyright @ 2014 R BOOKS Co., LTD</span></div>
        </div>
    </footer>
    <!-- /Footer Copyright -->

    @include('pages.homecontroller.modal_login')
    @include('pages.homecontroller.modal_register')

    <!-- /Main footer -->

    <!-- Scripts -->
    <script src="{{ asset('/libs1/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/libs1/jquery/owl.carousel.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="{{ asset('/libs1/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/libs1/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <!-- <script type="text/javascript" src="https://app.getresponse.com/view_webform_v2.js?u=GlAX6&webforms_id=BNcTe"></script> -->
    <script src="{{ asset('/libs1/jquery/rbooks.js') }}"></script>
    @yield('script')
    <!-- /Scripts -->
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=114267289181237&autoLogAppEvents=1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>


    <script>

        $('.banners-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            navText: ['<span class="btn-prev"><i class="icon-prev fas fa-chevron-left"></i><span>', '<span class="btn-next"><i class="icon-next fas fa-chevron-right"></i><span>'],
            navClass: ['owl-prev', 'owl-next'],
            autoplay: true,
            autoplayTimeout:5000,
            autoHeight:350,
            center: true,
            dots: true,
            responsive:{
                0:{
                    items:1,
                    dots: false
                },
                600:{
                    items:1,
                    dots: false
                },
                1000:{
                    items:1
                }
            }
        })


        $('.partner-carousel').owlCarousel({
            loop:true,
            margin:50,
            nav:true,
            autoplay: true,
            autoHeight:true,
            center: true,
            dots: false,
            nav: false,
            responsive:{
                0:{
                    items:2,
                    margin:30
                },
                600:{
                    items:3
                },
                768:{
                    items:5
                },
                1000:{
                    items:5
                }
            }
        })

        $(window).scroll(function() {
            if ($(this).scrollTop()) {
                $('.back-to-top').fadeIn();
            } else {
                $('.back-to-top').fadeOut();
            }
        });

        var width = $(window).width();

        if (width < 576){
            $('.menu-mobile h3').click(function() {
                $('ul#main-menu').slideToggle(1000, 0);
            })

            $('.main-header-menu .header-menu a').click(function() {
                $('.list-menu-mobile').slideToggle(1000, 0);

            })
        }

        $(".back-to-top").click(function() {
            $("html, body").animate({scrollTop: 0}, 1500);
         });
    </script>


</body>
</html>