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
                            <a href="{{ route('products') }}" class="menu-link">{{trans('home.Books')}}</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('paper') }}" class="menu-link">{{trans('home.Paper')}}</a>
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
</div>
@endsection