<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="google-site-verification" content="L0-hmlu-Zdbk8Qx3X5W-tCpzvrQmdCFYYy5mIFufgMs" />
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="https://rbooks.vn/public/imgs/logo/icon-rb.png" sizes="32x32" />
  <title>{{ trans('home.Công Ty TNHH R Books') }}</title>

  <!-- Bootstrap -->
  <link href="{{ asset('/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Fontawesome -->
  <link href="{{ asset('/libs/fontawesome/css/all.min.css') }}" rel="stylesheet">
  <!-- Magnific Popup -->
  <link href="{{ asset('/libs/magnific/css/magnific-popup.css') }}" rel="stylesheet">
  <!-- Owl Carousel -->
  <link href="{{ asset('/libs/owl-carousel/css/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/libs/owl-carousel/css/owl.theme.default.min.css') }}" rel="stylesheet">
  <!-- Animate css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <!-- Toast -->
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" /> -->
  <link href="{{ asset('/css/toastr.css') }}" rel="stylesheet">

  <!-- Style -->
  <link href="{{ asset('/css/reset.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/font.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/home.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/login.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/register.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/about.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/info.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/checkout_process.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/cart.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/manageaddress.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/order.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/recruitment.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/done.process.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/updatepassword.blade.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/contact.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/email.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/myinformation.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/comment.css') }}" rel="stylesheet">
</head>

<body>
  <header class="header">
    <div class="container">
      <div class="header-main">
        <a class="header-logo" href="{{ route('home') }}">
          <img class="img-fluid" src="{{ asset('/imgs/logo_blue.png') }}" alt="R books Logo" title="RBooks.VN">
          <h1 class="visually-hidden">Rbooks</h1>
        </a>

        <div class="header-search">
          <form action="{{ route('search') }}">
            <div class="input-group">
              <input class="form-control" type="text"
                placeholder="{{ trans('home.Nhập ISBN, tiêu đề hoặc tác giả') }}" name = "keyword">
              <button class="btn btn-outline-secondary" type="submit">
                {{-- <i class="fas fa-search"></i> --}}
                <img class="img-fluid" src="{{ 'imgs/icon-search.svg' }}" alt="">
              </button>
            </div>
          </form>
        </div>

        <div class="header-control">
          <!-- <div class="order">
                        <a href="{{ route('customer-order') }}">
                            <div class="icon">
                                <i class="fa-regular fa-heart"></i>
                            </div>
                            <div class="text">
                                Đơn hàng
                            </div>
                        </a>
                    </div> -->

          <div class="cart">
            <a href="{{ route('cart') }}">
              <div class="icon">
                <img class="img-fluid" src="{{ '/imgs/icon-shopping-cart.svg' }}" alt="">
                <span class="cart-number">{{ !empty($total) ? $total['totalQuantity'] : '0' }}</span>
              </div>
              <div class="text">
                {{ trans('home.Giỏ hàng') }}
              </div>
            </a>
          </div>

          <div class="login">
            @guest
              <a href="#" data-bs-toggle="modal" data-bs-target="#modalLogin">
                <div class="icon">
                  <img class="img-fluid" src="{{ '/imgs/icon-log-in.svg' }}" alt="">
                </div>
                <div class="text">
                  {{ trans('home.Đăng nhập') }}
                </div>
              </a>
            @else
              <a class="user-active" href="#">
                <div class="icon">
                  <i class="fa-regular fa-circle-user"></i>
                </div>
                <div class="text">
                  <span style="font-size: 1.2rem">Hello,</span><br />{{ Auth::user()->name }}
                </div>
              </a>
              <div class="dashboard-small opacity-hidden hidden">
                <div class="info-user">
                  <div class="avatar">
                    <img src="" alt="">
                  </div>
                  <div class="info">
                    <p class="name">{{ Auth::user()->name }}</p>
                    <p class="email">{{ Auth::user()->email }}</p>
                    <a href="{{ route('customer') }}"
                      class="btn btn-primary edit">{{ trans('home.Chỉnh sửa thông tin cá nhân') }}</a>
                  </div>
                </div>
                <ul class="dashboard-small-list">
                  <li class="menu-item">
                    <a href="{{ route('customer-order') }}" class="menu-link">
                      <span class="icon"><i class="fa-regular fa-rectangle-list"></i></span>
                      <span class="text">{{ trans('home.Danh sách đơn hàng') }}</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="{{ route('customer-addresses') }}" class="menu-link">
                      <span class="icon"><i class="fa-solid fa-gears"></i></span>
                      <span class="text">{{ trans('home.Cài đặt tài khoản') }}</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="{{ route('logout') }}" class="menu-link"
                      onclick="event.preventDefault();document.getElementById('logout-form').submit(); ">
                      <span class="icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                      <span class="text">{{ trans('home.Thoát') }}</span>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                    </a>
                  </li>
                </ul>

              </div>
            @endguest
          </div>
        </div>
      </div>

      @include('pages.homecontroller.menu')
    </div>
  </header>

  @yield('content')

  <footer class="footer">
    <div class="footerTop">
      <div class="container">
        <div class="footerTop-main">
          <div class="item">
            <a class="footerTop-logo" href="{{ route('home') }}">
              <img class="img-fluid" src="{{ asset('/imgs/logo-w.png') }}" alt="R Books Logo">
            </a>
            <div class="content">
              <p class="text">
                <img class="img-fluid" src="{{ asset('/imgs/icon-location.svg') }}" alt="">
                {{ trans('home.Địa chỉ: LM81-42.OT04 (Officetel), Tòa Landmark 81 Vinhomes Central Park, Số 720A Điện Biên Phủ, Phường 22, Quận Bình Thạnh, Thành phố Hồ Chí Minh, Việt Nam') }}
              </p>
              <p class="text">
                <img class="img-fluid" src="{{ asset('/imgs/icon-telephone.svg') }}" alt="">
                {{ trans('home.Hotline: 08 4966 4005') }}
              </p>
              <p class="text">
                <img class="img-fluid" src="{{ asset('/imgs/icon-mail.svg') }}" alt="">
                {{ trans('home.Email: info@rbooks.vn') }}
              </p>
            </div>
          </div>

          <div class="item">
            <h4 class="footerTop-title">
              {{ trans('home.Về RBooks') }}
            </h4>
            <ul class="footerTop-menu">
              <li class="menu-item">
                <a href="{{ route('about-rbooks') }}" class="menu-link">{{ trans('home.Giới thiệu') }}</a>
              </li>
              <li class="menu-item">
                <a href="{{ route('recruitment') }}" class="menu-link">{{ trans('home.Tuyển dụng') }}</a>
              </li>
              <li class="menu-item">
                <a href="{{ route('privacy') }}" class="menu-link">{{ trans('home.Chính sách bảo mật') }}</a>
              </li>
              <li class="menu-item">
                <a href="{{ route('how-to-order') }}" class="menu-link">{{ trans('home.Hướng dẫn mua hàng') }}</a>
              </li>
              <li class="menu-item">
                <a href="{{ route('payment') }}" class="menu-link">{{ trans('home.Phương thức thanh toán') }}</a>
              </li>
              <li class="menu-item">
                <a href="{{ route('shipping-method') }}"
                  class="menu-link">{{ trans('home.Phương thức vận chuyển') }}</a>
              </li>
            </ul>
          </div>

          <div class="item">
            <h4 class="footerTop-title">
              {{ trans('home.Chứng nhận bởi') }}
            </h4>
            <a class="footerTop-BCT" href="http://online.gov.vn/Home/WebDetails/36094" target="_blank">
              <img class="img-fluid" src="{{ asset('/imgs/logo/dathongbao.png') }}"
                alt="Đã thông báo Bộ Công Thương">
            </a>
          </div>

          <div class="item">
            <h4 class="footerTop-title">
              {{ trans('home.Kết nối với chúng tôi') }}
            </h4>

            <div class="footerTop-social">
              <div class="fb-page" data-href="https://www.facebook.com/rbooks.songbanlinh" data-tabs="events"
                data-width="320" data-height="" data-small-header="false" data-adapt-container-width="true"
                data-hide-cover="false" data-show-facepile="true">
                <blockquote cite="https://www.facebook.com/rbooks.songbanlinh" class="fb-xfbml-parse-ignore"><a
                    href="https://www.facebook.com/rbooks.songbanlinh">Sách RBooks</a></blockquote>
              </div>
            </div>

            <ul class="footerTop-social d-none">
              <li class="menu-item">
                <a href="https://www.facebook.com/rbooks.vn/" class="menu-link" target="_blank">
                  <i class="fa-brands fa-facebook"></i>
                </a>
              </li>

              <li class="menu-item">
                <a href="https://www.youtube.com/channel/UC40qGVhqAYh-CO6zsCzyeIw?view_as=subscriber"
                  class="menu-link" target="_blank">
                  <i class="fa-brands fa-youtube"></i>
                </a>
              </li>

              <li class="menu-item" target="_blank">
                <a href="#" class="menu-link">
                  <i class="fa-brands fa-twitter"></i>
                </a>
              </li>
            </ul>

          </div>
        </div>
      </div>
    </div>

    <div class="footerCopyright">
      <div class="container">
        <div class="footerCopyright-main">
          <p class="text">
            Copyright @ 2014 R BOOKS Co., LTD
          </p>

          <div class="language">
            <ul class="language-menu">
              <li class="menu-item">
                <a href="/locale/vi" class="menu-link">
                  <img class="img-fluid" src="{{ asset('/imgs/logo/vi.png') }}">
                </a>
              </li>

              <li class="menu-item">
                <a href="/locale/en" class="menu-link">
                  <img class="img-fluid" src="{{ asset('/imgs/logo/en.png') }}">
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>

  @include('pages.homecontroller.modal_login')
  @include('pages.homecontroller.modal_register')

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-140160462-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-140160462-1');
  </script>
  <!-- Facebook Pixel Code -->
  <script>
    ! function(f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function() {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '335646733514821');
    fbq('track', 'PageView');
  </script>
  <noscript>
    <img height="1" width="1"
      src="https://www.facebook.com/tr?id=335646733514821&ev=PageView
    &noscript=1" />
  </noscript>
  <!-- Facebook Pixel Code -->
  <script>
    ! function(f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function() {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '554248482025640');
    fbq('track', 'PageView');
  </script>
  <noscript>
    <img height="1" width="1"
      src="https://www.facebook.com/tr?id=554248482025640&ev=PageView
        &noscript=1" />
  </noscript>
  <!-- Scripts FB -->
  <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s);
      js.id = id;
      js.src =
        'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=114267289181237&autoLogAppEvents=1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
  <!-- Jquery -->
  <script src="{{ asset('/libs/jquery.min.js') }}"></script>
  <!-- Bootstrap JS -->
  <script src="{{ asset('/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Fontawesome JS -->
  <script src="{{ asset('/libs/fontawesome/js/all.min.js') }}"></script>
  <!-- Magnific Popup JS -->
  <script src="{{ asset('/libs/magnific/js/jquery.magnific-popup.min.js') }}"></script>
  <!-- Owl Carousel JS -->
  <script src="{{ asset('/libs/owl-carousel/js/owl.carousel.min.js') }}"></script>
  <!-- in ra thong bao -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  <!-- Style page JS -->
  <script src="{{ asset('/js/main.js') }}"></script>
  <script src="{{ asset('/js/carousel.js') }}"></script>
  <script src="{{ asset('/js/register.js') }}"></script>
  <script src="{{ asset('/js/login.js') }}"></script>
  <script src="{{ asset('/js/info.js') }}"></script>
  <script src="{{ asset('/js/checkout_process.js') }}"></script>
  <script src="{{ asset('/js/manageaddress.js') }}"></script>
  <script src="{{ asset('/js/updatepassword.js') }}"></script>
  <script src="{{ asset('/js/product.js') }}"></script>
  @yield('script')
</body>

</html>
