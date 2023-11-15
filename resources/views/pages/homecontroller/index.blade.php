@extends('layouts.master')

@section('content')
  <div class="wrapper">
    <div class="section section-introduce">
      <div class="container">
        <div class="introduce-wrap">
          <div class="menu-category">
            <div class="card">
              <div class="card-header">
                <h5>{{ trans('home.Danh mục sản phẩm') }}</h5>
              </div>
              <div class="card-body">
                <ul class="menu-list">
                  @foreach ($categories as $category)
                    <li class="menu-item">
                      <a href="{{ route('shopping.index', ['id' => $category->id, 'alias' => $category->slug]) }}"
                        class="menu-link">{{ $category->name }}</a>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>

          <div class="banner">
            <ul class="menu-main">
              <li class="menu-item">
                <a href="{{ route('home') }}" class="menu-link">{{ trans('home.Trang chủ') }}</a>
              </li>
              <li class="menu-item">
                <a href="{{ route('about-rbooks') }}" class="menu-link">{{ trans('home.Giới thiệu') }}</a>
              </li>
              <li class="menu-item">
                <a href="{{ route('products') }}" class="menu-link">{{ trans('home.Sản phẩm') }}</a>
              </li>
              {{-- <li class="menu-item">
                <a href="{{ route('paper') }}" class="menu-link">{{ trans('home.Paper') }}</a>
              </li> --}}
              {{-- <li class="menu-item">
                <a href="{{ route('recruitment') }}" class="menu-link">{{ trans('home.Career') }}</a>
              </li> --}}
              <li class="menu-item">
                <a href="{{ route('contact') }}" class="menu-link">{{ trans('home.Liên hệ') }}</a>
              </li>
            </ul>

            <div class="banner-main">
              @include('pages.homecontroller.partials.banner')
            </div>

            <div class="banner-thumb">
              <div class="item">
                <img class="img-fluid icon" src="{{ 'imgs/icon-banner-01.png' }}" alt="">
                <div class="content">
                  <p class="title">{{ trans('home.MIỄN PHÍ GIAO HÀNG') }}</p>
                  <p class="des">{{ trans('home.Hóa đơn trên 300.000 đ') }}</p>
                </div>
              </div>
              <div class="item">
                <img class="img-fluid icon" src="{{ 'imgs/icon-banner-02.png' }}" alt="">
                <div class="content">
                  <p class="title">{{ trans('home.BẢO ĐẢM HOÀN TIỀN') }}</p>
                  <p class="des">{{ trans('home.Trong vòng 30 ngày') }}</p>
                </div>
              </div>
              <div class="item">
                <img class="img-fluid icon" src="{{ 'imgs/icon-banner-03.png' }}" alt="">
                <div class="content">
                  <p class="title">{{ trans('home.THANH TOÁN AN TOÀN') }}</p>
                  <p class="des">{{ trans('home.100% Thanh toán an toàn') }}</p>
                </div>
              </div>
              <div class="item">
                <img class="img-fluid icon" src="{{ 'imgs/icon-banner-04.png' }}" alt="">
                <div class="content">
                  <p class="title">{{ trans('home.HỖ TRỢ 24/7') }}</p>
                  <p class="des">{{ trans('home.Trong giờ hành chính') }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section section-brand-intro">
      <div class="container">
        <div class="brand-intro">
          <div class="item">
            <a href="#">
              <img class="img-fluid avatar" src="{{ asset('imgs/BANNER-SACH-KINH-DOANH.png') }}" alt="">
            </a>
          </div>

          <div class="item">
            <a href="#">
              <img class="img-fluid avatar" src="{{ asset('imgs/BANNER-SACH-CHUA-LANH.png') }}" alt="">
            </a>
          </div>

          <div class="item">
            <a href="#">
              <img class="img-fluid avatar" src="{{ asset('imgs/BANNER-SACH-BAN-LINH.png') }}" alt="">
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="section section-productFirst">
      <div class="container">
        <div class="productFirst-wrap">
          <div class="row">
            <div class="col-xxl-4">
              <div class="special-books">
                <div class="card">
                  <div class="card-header">
                    <h5 class="title">{{ trans('home.Sách đặc biệt') }}</h5>
                  </div>
                  <div class="card-body">
                    <div class="product horizontal">
                      @foreach ($topNewEconomy as $product)
                        @include('pages.homecontroller.product-a-page')
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xxl-8">
              <div class="product-tab">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                      type="button" role="tab" aria-controls="pills-home"
                      aria-selected="true">{{ trans('home.Top sách hot') }}</button>
                  </li>

                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                      data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                      aria-selected="false">{{ trans('home.Combo hot') }}</button>
                  </li>

                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                      data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                      aria-selected="false">{{ trans('home.Top sách khuyến mãi') }}</button>
                  </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab">
                    <div class="product vertical">
                      @foreach ($topWeek as $product)
                        @include('pages.homecontroller.product-a-page')
                      @endforeach
                    </div>
                  </div>

                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="product vertical">
                      @foreach ($top as $product)
                        @include('pages.homecontroller.product-a-page')
                      @endforeach
                    </div>
                  </div>

                  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="product vertical">
                      @foreach ($topSale as $product)
                        @include('pages.homecontroller.product-a-page')
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section section-banner-product">
      <div class="container">
        <div class="owl-carousel owl-theme banner-product">
          <div class="item">
            <a href="#">
              <img src="{{ asset('imgs/banners/banner-product.jpg') }}" class="img-fluid">
            </a>
          </div>
          <div class="item">
            <a href="#">
              <img src="{{ asset('imgs/banners/banner-product.jpg') }}" class="img-fluid">
            </a>
          </div>
          <div class="item">
            <a href="#">
              <img src="{{ asset('imgs/banners/banner-product.jpg') }}" class="img-fluid">
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="section section-productSecond">
      <div class="container">
        <div class="productSecond-wrap">
          <div class="row">
            <div class="col-xxl-4">
              <div class="promotion-hot">
                <!-- <img class="img-fluid" src="{{ empty($productOneSale->images->last()) ? asset(RBOOKS_NO_IMAGE_URL) : RBOOKS_IMAGE_URL . $productOneSale->images->last()->path }}" alt="">
                                              <div class="content">
                                                  <h3 class="small-title">{{ $productOneSale->author }}</h3>
                                                  <h2 class="title">{{ $productOneSale->name }} - <span class="percent">{{ round(100 - ($productOneSale->sale_price / $productOneSale->cover_price) * 100, 0) }}%</span></h2>
                                                  <p class="des">{{ date_format($productOneSale->created_at, 'Y') }}</p>
                                                  <a href="{{ route('product.index', ['id' => $productOneSale->id, 'alias' => $productOneSale->slug]) }}" class="btn btn-primary">Xem chi tiết</a>
                                              </div> -->
                <img class="img-fluid" src="{{ asset('imgs/promotion-hot.jpg') }}" alt="">
                <a href="{{ route('product.index', ['id' => '97', 'alias' => 'combo-nguoi-tre-voi-co-don-toi-da-yeu-nguoi-am-tham-nhu-the-dung-vi-co-don-ma-nam-voi-mot-ban-tay']) }}"
                  class="btn btn-primary btn-readmore">
                  <span class="text">{{ trans('home.Xem chi tiết') }}</span>
                  <span class="icon">
                    <i class="fa-solid fa-angles-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xxl-8">
              <div class="product-carousel">
                <div class="card">
                  <div class="card-header">
                    <h5 class="title">{{ trans('home.Top sách combo hot') }}</h5>
                  </div>
                  <div class="card-body">
                    <div class="owl-carousel owl-theme product product-carousel-list vertical flex-nowrap">
                      @foreach ($orderBefore as $product)
                        @include('pages.homecontroller.product-a-page')
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section section-banner-about">
      <div class="container">
        <div class="banner-about-wrap">
          <div class="row">
            <div class="col-xxl-4">
              <div class="video-company">
                <iframe class="youtube-widget" src="https://www.youtube.com/embed/gnctjA0dHQQ" frameborder="0"
                  allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <!-- <iframe class="youtube-widget" src="https://www.youtube.com/embed/LGJMd08iUIg" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
              </div>
            </div>

            <div class="col-xxl-8">
              <div class="banner-small">
                <div class="item">
                  <a href="https://www.youtube.com/channel/UC40qGVhqAYh-CO6zsCzyeIw" target="_blank">
                    <img src="{{ asset('imgs/banners/banner_6.jpg') }}" class="img-fluid">
                  </a>
                </div>
                <div class="item">
                  <a href="https://bossstack.vn/" title="" target=_blank>
                    <img src="{{ asset('imgs/banners/banner_7.jpg') }}" class="img-fluid">
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section section-productThird">
      <div class="container">
        <div class="productThird-wrap">
          <div class="row">
            <div class="col-xxl-4">
              @include('pages.homecontroller.partials.banner-sidebar')
            </div>

            <div class="col-xxl-8">
              <div class="product-carousel">
                <div class="card">
                  <div class="card-header">
                    <h5 class="title">{{ trans('home.Sách sắp phát hành') }}</h5>
                  </div>
                  <div class="card-body">
                    <div class="owl-carousel owl-theme product product-hot-list vertical flex-nowrap">
                      @foreach ($topCombo as $product)
                        @include('pages.homecontroller.product-a-page')
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>

              <div class="partner">
                <div class="owl-carousel owl-theme partner-carousel">
                  <div class="item"><img class="" src="{{ asset('public/imgs/logo-partner-6.png') }}"
                      alt=""></div>
                  <div class="item"><img class="" src="{{ asset('public/imgs/logo-partner.png') }}"
                      alt=""></div>
                  <div class="item"><img class="" src="{{ asset('public/imgs/logo-partner-1.png') }}"
                      alt=""></div>
                  <div class="item"><img class="" src="{{ asset('public/imgs/logo-partner-2.png') }}"
                      alt=""></div>
                  <div class="item"><img class="" src="{{ asset('public/imgs/logo-partner-3.png') }}"
                      alt=""></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
