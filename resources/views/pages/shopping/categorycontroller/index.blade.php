@extends('layouts.master')

@section('content')
  <div class="wrapper categories">
    <div class="section section-introduce">
      <div class="container">
        <div class="introduce-wrap">
          <div class="menu-category">
            <div class="card">
              <div class="card-header">
                <h5>Danh mục sản phẩm</h5>
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
                            <a href="{{ route('paper') }}" class="menu-link">{{trans('home.Paper')}}</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('recruitment') }}" class="menu-link">{{trans('home.Career')}}</a>
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
                <img class="img-fluid icon" src="{{ asset('/imgs/icon-banner-01.png') }}" alt="">
                <div class="content">
                  <p class="title">MIỄN PHÍ GIAO HÀNG</p>
                  <p class="des">Hóa đơn trên 300.000 đ</p>
                </div>
              </div>
              <div class="item">
                <img class="img-fluid icon" src="{{ asset('/imgs/icon-banner-02.png') }}" alt="">
                <div class="content">
                  <p class="title">BẢO ĐẢM HOÀN TIỀN</p>
                  <p class="des">Trong vòng 30 ngày</p>
                </div>
              </div>
              <div class="item">
                <img class="img-fluid icon" src="{{ asset('/imgs/icon-banner-03.png') }}" alt="">
                <div class="content">
                  <p class="title">THANH TOÁN AN TOÀN</p>
                  <p class="des">100% Thanh toán an toàn</p>
                </div>
              </div>
              <div class="item">
                <img class="img-fluid icon" src="{{ asset('/imgs/icon-banner-04.png') }}" alt="">
                <div class="content">
                  <p class="title">HỖ TRỢ 24/7</p>
                  <p class="des">Trong giờ hành chính</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section section-product">
      <div class="container">
        <div class="product-main">
          <h2 class="title"></h2>
          <div class="filter">
            @php
              $top_seller = '';
              if (strpos(url()->full(), 'top_seller') == false) {
                  $top_seller = '?keyword=' . Request::query('keyword') . '&top_seller=1';
              }
            @endphp
            <ul class="menu-filter">
              <li class="menu-item">
                <a href="#" class="menu-link filter-all">Tất cả</a>
              </li>
              <li class="menu-item">
                <a href="?keyword={{ Request::query('keyword') }}&newest=0"
                  class="menu-link {{ Request::query('newest') == '0' ? 'active' : '' }}">Mới nhất</a>
              </li>
              <li class="menu-item">
                <a href="{{ $top_seller }}"
                  class="menu-link {{ Request::query('top_seller') == 1 ? 'active' : '' }}">Bán chạy</a>
              </li>
              <li class="menu-item">
                <a href="?keyword={{ Request::query('keyword') }}&discount=2"
                  class="menu-link {{ Request::query('discount') == 2 ? 'active' : '' }}">Giá giảm nhiều</a>
              </li>
              <li class="menu-item">
                <a href="?keyword={{ Request::query('keyword') }}&price_asc=3"
                  class="menu-link {{ Request::query('price_asc') == 3 ? 'active' : '' }}">Giá thấp</a>
              </li>
              <li class="menu-item">
                <a href="?keyword={{ Request::query('keyword') }}&price_desc=4"
                  class="menu-link {{ Request::query('price_desc') == 4 ? 'active' : '' }}">Giá cao</a>
              </li>
            </ul>
          </div>
          <div class="product vertical">
            @if ($products->count() === 0)
              <p>Không có kết quả</p>
            @endif
            @foreach ($products as $product)
              @include('pages.homecontroller.product-a-page')
            @endforeach
          </div>

          @if ($products->lastPage() > 1)
            <div class="pagination-container">
              <div class="center-pagination">
                <nav aria-label="Page navigation example">
                  <!-- <ul class="pagination pagination-sm pt-2"> -->
                  {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
                  <!-- </ul> -->
                </nav>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <!-- <script>
    $(function() {

      var width = $(window).width();

      if (width < 576) {
        $('.widget-list-link-category').hide();
        $('.widget-list-link-publisher').hide();
        $('#category-menu h3').click(function() {
          $('.widget-list-link-category').slideToggle(1000, 0);

        })
        $('#publisher h3').click(function() {
          $('.widget-list-link-publisher').slideToggle(1000, 0);
        })

      }
      $("ul li").click(function(e) {
        $("li .active").removeClass("active");
        $(this).addClass("active");
      });

      $('.default').click(function() {
        $('.category-filter-moblie-item').slideDown(1000, 0);
      })

      // var selected = localStorage.getItem('selected');
      // if (selected) {
      //   $(".category-filter-1").val(selected);
      // }


      // $(".category-filter-1").change(function() {
      //   localStorage.setItem('selected', $(this).val());
      //   location.reload(val);
      // });
    });
  </script> -->
@endsection
