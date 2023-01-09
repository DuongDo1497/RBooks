@extends('layouts.master')

@section('content')
<div class="wrapper">
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
                            @foreach($categories as $category)
                                <li class="menu-item">
                                    <a href="{{ route('shopping.index', ['id' => $category->id, 'alias' => $category->slug]) }}" class="menu-link">{{ $category->name }}</a>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="banner">
                    <ul class="menu-main">
                        <li class="menu-item">
                            <a href="{{ route('home') }}" class="menu-link">{{trans('home.Home')}}</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('about-rbooks') }}" class="menu-link">{{trans('home.About')}}</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('products') }}" class="menu-link">{{trans('home.Products')}}</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('recruitment') }}" class="menu-link">{{trans('home.Career')}}</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('contact') }}" class="menu-link">{{trans('home.Contact')}}</a>
                        </li>
                    </ul>
                    
                    <div class="banner-main">
                        @include('pages.homecontroller.partials.banner')
                    </div>

                    <div class="banner-thumb">
                        <div class="item">
                            <img class="img-fluid icon" src="{{ asset ('/imgs/icon-banner-01.png') }}" alt="">
                            <div class="content">
                                <p class="title">MIỄN PHÍ GIAO HÀNG</p>
                                <p class="des">Hóa đơn trên 300.000 đ</p>
                            </div>
                        </div>
                        <div class="item">
                            <img class="img-fluid icon" src="{{ asset ('/imgs/icon-banner-02.png') }}" alt="">
                            <div class="content">
                                <p class="title">BẢO ĐẢM HOÀN TIỀN</p>
                                <p class="des">Trong vòng 30 ngày</p>
                            </div>
                        </div>
                        <div class="item">
                            <img class="img-fluid icon" src="{{ asset ('/imgs/icon-banner-03.png') }}" alt="">
                            <div class="content">
                                <p class="title">THANH TOÁN AN TOÀN</p>
                                <p class="des">100% Thanh toán an toàn</p>
                            </div>
                        </div>
                        <div class="item">
                            <img class="img-fluid icon" src="{{ asset ('/imgs/icon-banner-04.png') }}" alt="">
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
                <h2 class="title">Sản phẩm</h2>
                <div class="filter">
                    <div>
                    {{-- @php
                        $top_seller = "";
                        if(strpos(url()->full(), 'top_seller') == false) {
                            $top_seller = "?keyword=".Request::query('keyword')."&top_seller=1";
                        }
                    @endphp
                    <ul class="menu-filter">
                        <li class="menu-item">
                            <a href="https://rbooks.vn/products" class="menu-link filter-all">Tất cả</a>
                        </li>
                        <li class="menu-item">
                            <a href="?keyword={{ Request::query('keyword') }}&newest=0" class="menu-link {{ Request::query('newest') == '0' ? 'active' : '' }}">Mới nhất</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{$top_seller}}" class="menu-link {{ Request::query('top_seller') == 1 ? 'active' : '' }}">Bán chạy</a>
                        </li>
                        <li class="menu-item">
                            <a href="?keyword={{ Request::query('keyword') }}&discount=2" class="menu-link {{ Request::query('discount') == 2 ? 'active' : '' }}">Giá giảm nhiều</a>
                        </li>
                        <li class="menu-item">
                            <a href="?keyword={{ Request::query('keyword') }}&price_asc=3" class="menu-link {{ Request::query('price_asc') == 3 ? 'active' : '' }}">Giá thấp</a>
                        </li>
                        <li class="menu-item">
                            <a href="?keyword={{ Request::query('keyword') }}&price_desc=4" class="menu-link {{ Request::query('price_desc') == 4 ? 'active' : '' }}">Giá cao</a>
                        </li>
                    </ul> --}}
                </div>

                    @if (count($products2) == 0 || $keyword == null )
                    
                    @if (count($products1) == 0 || $keyword == null)
                    <div>
                    <p> Hổng có gì hết chơn. (>_<)</p>
                    <p> Xin lũi nhaa. (T_T)</p>
                    <p> Tìm cái khác ik nè. (◠‿◠)</p>
                    </div>
                    @else
                    <div class="card-body">
                        <div class="product vertical">                        
                                @foreach($products1 as $product)
                                    @include('pages.homecontroller.product-a-page')
                                @endforeach                  
                        </div>
                    </div>
                    @if($products1->lastPage() > 1)
                    <div class="pagination-container">
                        <div class="center-pagination">
                            <nav aria-label="Page navigation example">
                            <!-- <ul class="pagination pagination-sm pt-2"> -->
                        {{ 
                            $products1->appends(request()->query())->links("pagination::bootstrap-4") 
                        }}
                        <!-- </ul> -->
                            </nav>
                        </div>
                    </div>
                    @endif
                    @endif
                    @else
                    <div class="card-body">
                        <div class="product vertical">                        
                                @foreach($products2 as $product)
                                    @include('pages.homecontroller.product-a-page')
                                @endforeach                  
                        </div>
                    </div>
                    @if($products2->lastPage() > 1)
                    <div class="pagination-container">
                        <div class="center-pagination">
                            <nav aria-label="Page navigation example">
                            <!-- <ul class="pagination pagination-sm pt-2"> -->
                        {{ 
                            $products2->appends(request()->query())->links("pagination::bootstrap-4") 
                        }}
                        <!-- </ul> -->
                            </nav>
                        </div>
                    </div>
                    @endif  
                    @endif
                   
               
                    
        
               
                    
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div id="main-content" style="display: none;">
    <div class="container" id="main-category">
        <div class="row no-gutters">
            <!-- Menu left -->
            <div class="col-xl-3 col-lg-3">
                <div id="category-menu" class="widget-block">
                    <h3>{{ trans('home.DANH MỤC') }}<span class="icon-down-category"><i class="fas fa-angle-down"></i></span></h3>
                    <ul class="list-unstyled widget-list-link widget-list-link-category">
                        @if($locale == "vi" || $locale == "")
                        @foreach($categories as $category)
                        <li><a href="{{ route('shopping.index', ['id' => $category->id, 'alias' => $category->slug]) }}">{{ $category->name }}</a></li>
                        @endforeach
                        @else
                            @foreach($categories as $category)
                                <li><a href="{{ route('shopping.index', ['id' => $category->id, 'alias' => $category->slug]) }}">{{ $category->nameEnglish }}</a></li>
                            @endforeach
                        @endif
                        <!-- <li><a href="#">Sách Blockchain</a> <span>(3)</span></li>
                        <li><a href="#">Sách Kinh Tế</a> <span>(3)</span></li>
                        <li><a href="#">Sách Văn Học Nước Ngoài</a> <span>(3)</span></li>
                        <li><a href="#">Sách Văn Học Trong Nước</a> <span>(3)</span></li>
                        <li><a href="#">Sách Giáo Khoa - Giáo Trình</a> <span>(3)</span></li>
                        <li><a href="#">Sách Khoa Học Thần Bí</a> <span>(3)</span></li>
                        <li><a href="#">Sách Thiếu Nhi</a> <span>(3)</span></li>
                        <li><a href="#">Sách Phát triển bản thân</a> <span>(3)</span></li>
                        <li><a href="#">Sách Tin Học - Ngoại Ngữ</a> <span>(3)</span></li>
                        <li><a href="#">Sách Chuyên ngành</a> <span>(3)</span></li>
                        <li><a href="#">Sách Thường thức - Đời sống</a> <span>(3)</span></li>
                        <li><a href="#">Sách Giáo Trình Cao Đẳng - Đại Học</a> <span>(3)</span></li>
                        <li><a href="#">Tạp chí</a> <span>(3)</span></li>
                        <li><a href="#">Văn Phòng Phẩm</a> <span>(3)</span></li> -->
                    </ul>
                </div>

                <div id="publisher" class="widget-block">
                    <h3>{{ trans('home.NHÀ PHÁT HÀNH') }}<span class="icon-down-publisher"><i class="fas fa-angle-down"></i></span></h3>
                    <ul class="list-unstyled widget-list-link widget-list-link-publisher">
                        @foreach($publishers as $publisher)
                        <li><a href="{{ route('publisher.index', ['alias' => $publisher->publisher]) }}">{{ $publisher->publisher }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- /Menu left -->

            <!-- Main -->
            <div class="col-xl-9 col-lg-9" id="category-main-content">
                <!-- Category banner -->
                @include('pages.homecontroller.partials.banner')
                <!-- /Category banner -->

                <!-- Category filter -->
                <div id="category-filter">
                    @php
                        $top_seller = "";
                        if(strpos(url()->full(), 'top_seller') == false) {
                            $top_seller = "?keyword=".Request::query('keyword')."&top_seller=1";
                        }
                    @endphp
                    {{ trans('home.Ưu tiên xem') }}:
                    <ul id="category-filter-list" class="list-unstyled">
                        <li class="{{ Request::query('newest') == '0' ? 'active' : '' }}"><a href="?keyword={{ Request::query('keyword') }}&newest=0">{{ trans('home.HÀNG MỚI') }}</a></li>
                        <li class="{{ Request::query('top_seller') == 1 ? 'active' : '' }}"><a href="{{$top_seller}}">{{ trans('home.BÁN CHẠY') }}</a></li>
                        <li class="{{ Request::query('discount') == 2 ? 'active' : '' }}"><a href="?keyword={{ Request::query('keyword') }}&discount=2">{{ trans('home.GIẢM GIÁ NHIỀU') }}</a></li>
                        <li class="{{ Request::query('price_asc') == 3 ? 'active' : '' }}"><a href="?keyword={{ Request::query('keyword') }}&discount=2"><a href="?keyword={{ Request::query('keyword') }}&price_asc=3">{{ trans('home.GIÁ THẤP') }}</a></li>
                        <li class="{{ Request::query('price_desc') == 4 ? 'active' : '' }}"><a href="?keyword={{ Request::query('keyword') }}&discount=2"><a href="?keyword={{ Request::query('keyword') }}&price_desc=4">{{ trans('home.GIÁ CAO') }}</a></li>

                        <!-- <li><a href="#">Chọn lọc</a></li> -->
                    </ul>

                    <ul class="category-filter-moblie d-sm-none d-block">

                        <li class="default"><span class="font-weight-bold" style="font-size: 15px;">---Chọn---</span> <span class="float-right"><i class="fas fa-angle-down"></i></span>
                            <ul class="category-filter-moblie-item">
                                <li class="{{ Request::query('newest') == '0' ? 'active' : '' }}"><a href="?keyword={{ Request::query('keyword') }}&newest=0">{{ trans('home.HÀNG MỚI') }}</a></li>
                                <li class="{{ Request::query('top_seller') == 1 ? 'active' : '' }}"><a href="{{$top_seller}}">{{ trans('home.BÁN CHẠY') }}</a></li>
                                <li class="{{ Request::query('discount') == 2 ? 'active' : '' }}"><a href="?keyword={{ Request::query('keyword') }}&discount=2">{{ trans('home.GIẢM GIÁ NHIỀU') }}</a></li>
                                <li class="{{ Request::query('price_asc') == 3 ? 'active' : '' }}"><a href="?keyword={{ Request::query('keyword') }}&discount=2"><a href="?keyword={{ Request::query('keyword') }}&price_asc=3">{{ trans('home.GIÁ THẤP') }}</a></li>
                                <li class="{{ Request::query('price_desc') == 4 ? 'active' : '' }}"><a href="?keyword={{ Request::query('keyword') }}&discount=2"><a href="?keyword={{ Request::query('keyword') }}&price_desc=4">{{ trans('home.GIÁ CAO') }}</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /Category filter -->

                <!-- Books -->
                <div class="row category-books-row">
                    @foreach($data as $product)
                    <div class="col-lg-3 col-md-3 col-6 category-books">
                        @include('pages.homecontroller.product-a-page')
                    </div>
                    @endforeach
                </div>
                <!-- /Books -->

                <!-- Pagination -->
                @if($data->lastPage() > 1)
                <div class="pagination-container text-center border-top">
                    <div class="center-pagination">
                        <nav aria-label="Page navigation example">
                            <!-- <ul class="pagination pagination-sm pt-2"> -->
                            {{
                                $data->appends(request()->query())->links("pagination::bootstrap-4") 
                            }}
                            <!-- </ul> -->
                        </nav>
                    </div>
                </div>
                @endif
                <!-- /Pagination -->

            </div>
            <!-- /Main -->
        </div>

    </div>
</div> --}}

@endsection



@section('script')

<script>
    $(function(){
        var width = $(window).width();
        if (width < 576){
            $('.widget-list-link-category').hide();
            $('.widget-list-link-publisher').hide();
            $('#category-menu h3').click(function() {
                $('.widget-list-link-category').slideToggle(1000, 0);
            })
            $('#publisher h3').click(function() {
                $('.widget-list-link-publisher').slideToggle(1000, 0);
            })
        }
        $('.default').click(function() {
            $('.category-filter-moblie-item').slideDown(1000, 0);
        })
    });
</script>

@endsection
