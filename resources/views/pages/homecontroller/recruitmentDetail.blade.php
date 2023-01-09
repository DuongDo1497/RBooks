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
  <title>Công Ty TNHH R Books</title>

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
  <!-- Style -->
  <link href="{{ asset('/css/reset.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/font.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/recruitment.css') }}" rel="stylesheet">
</head>

<body>
  <header class="recruitDetail-header">
    <div class="container">
      <div class="header-main">
        <img class="img-fluid" src="{{ asset('/imgs/logo-recruitment.png') }}">

        <div class="header-title">
          <h2 class="position">{{ $recruitment->title }}</h2>
          <h4 class="position-eng">{{ $recruitment->vacancies }}</h4>
        </div>
      </div>
    </div>
  </header>

  <div class="recruitDetail-wrapper">
    <div class="container">
      <div class="recruitDetail-main">
        <h2 class="title">
          Chi tiết công việc
        </h2>
        <div class="job-des">
          <table class="table" style="width: 100%;">
            <tbody>
              <tr>
                <th width="25%">Vị trí</th>
                <td>{{ $recruitment->vacancies }}</td>
                <th width="25%">Số lượng</th>
                <td>{{ $recruitment->quantity }}</td>
              </tr>

              <tr>
                <th width="25%">Thời gian làm việc</th>
                <td>{{ $recruitment->job_description->work_time }}</td>
                <th width="25%">Kinh nghiệm làm việc</th>
                <td>{{ $recruitment->job_description->experience }}</td>
              </tr>

              <tr>
                <th width="25%">Nơi làm việc</th>
                <td colspan="3">{{ $recruitment->job_description->address }}</td>
              </tr>

              <tr>
                <th width="25%">Mức lương</th>
                <td colspan="3">{{ number_format($recruitment->job_description->salary) }} đ</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="benefit">
          <table class="table" style="width: 100%;">
            <tbody>
              <tr>
                <th width="35%">Quyền lợi<br />được hưởng</th>
                <td>
                  <ul class="benefit-list">
                    <li class="benefit-item">{{ $recruitment->job_description->benefit }}</li>
                  </ul>
                </td>
              </tr>

              <tr>
                <th width="35%">Mô tả công việc</th>
                <td>
                  {{ $recruitment->job_description->introduction }}
                </td>
              </tr>

              <tr>
                <th width="35%">Yêu cầu công việc</th>
                <td>
                  {{ $recruitment->job_description->requirements }}
                </td>
              </tr>

              <tr>
                <th width="35%">Yêu cầu khác</th>
                <td>
                  {{ $recruitment->job_description->orther_requirements }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="contact">
          <div class="contact-main">
            <div class="contact-title">Liên hệ</div>
            <table class="table" width="100%">
              <tbody>
                <tr>
                  <th width="15%">
                    <div class="table-title">
                      <span>Tiêu đề email</span>
                      <span>:</span>
                    </div>
                  </th>
                  <td>VỊ TRÍ ỨNG TUYỂN – [tên ứng viên]</td>
                </tr>
                <tr>
                  <th width="15%">
                    <div class="table-title">
                      <span>Người liên hệ</span>
                      <span>:</span>
                    </div>
                  </th>
                  <td>Ms.Kim Ngân</td>
                </tr>
                <tr>
                  <th width="15%">
                    <div class="table-title">
                      <span>Địa chỉ</span>
                      <span>:</span>
                    </div>
                  </th>
                  <td>LM81 - 42.OT04 (Officetel), Landmark 81 Vinhomes Central Park, 720A Điện Biên Phủ, Phường 22, Quận
                    Bình Thạnh, Tp Hồ Chí Minh.</td>
                </tr>
                <tr>
                  <th width="15%">
                    <div class="table-title">
                      <span>Email</span>
                      <span>:</span>
                    </div>
                  </th>
                  <td>info@rbooks.vn</td>
                </tr>
                <tr>
                  <th width="15%">
                    <div class="table-title">
                      <span>Điện thoại</span>
                      <span>:</span>
                    </div>
                  </th>
                  <td>0918 475 500 / 08 4966 4005</td>
                </tr>
              </tbody>
            </table>
          </div>
          <p class="contact-note">
            <span>Lưu ý:</span>
            Chỉ nhận hồ sơ qua email hoặc ứng tuyển trực tiếp trên website.
          </p>
        </div>
        <div class="control">
          <a href="{{ route('home') }}" class="btn btn-link btn-back"><i class="fa-solid fa-arrow-rotate-left"></i>
            Quay lại</a>
          <button type="button" class="btn btn-primary btn-apply" data-bs-toggle="modal" data-bs-target="#careerModal">
            <i class="fa-solid fa-check"></i> Ứng tuyển
          </button>
        </div>
      </div>
    </div>
  </div>

  @include('pages.homecontroller.apply')

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
  <!-- Style page JS -->
  <script src="{{ asset('/js/main.js') }}"></script>
  <script src="{{ asset('/js/carousel.js') }}"></script>
  <script src="{{ asset('/js/register.js') }}"></script>
  <script src="{{ asset('/js/login.js') }}"></script>
  <script src="{{ asset('/js/info.js') }}"></script>
  <script src="{{ asset('/js/checkout_process.js') }}"></script>
  <script src="{{ asset('/js/cart.js') }}"></script>
  <script src="{{ asset('/js/manageaddress.js') }}"></script>
</body>

</html>
