@extends('layouts.master')

@section('content')

<!-- Menu & banner -->
<div id="main-banner-container">
    <div class="container">
        <div class="row no-gutters">
            <!-- Main menu -->
            <div class="col-xl-3 col-lg-3 d-sm-block d-none">
                <h3>{{ trans('home.DANH MỤC') }}</h3>

                <ul id="main-menu">

                    @if($locale == "vi" || $locale == "")
                    @foreach($categories as $category)
                        <li class="pl-2"><a href="{{ route('shopping.index', ['id' => $category->id, 'alias' => $category->slug]) }}">{{ $category->name }}</a></li>
                    @endforeach
                    @else
                    @foreach($categories as $category)
                        <li class="pl-2"><a href="{{ route('shopping.index', ['id' => $category->id, 'alias' => $category->slug]) }}">{{ $category->nameEnglish }}</a></li>
                    @endforeach
                    @endif
                </ul>
            </div>
            <div class="col-xl-3 col-lg-3 menu-mobile d-sm-none d-block">
                <h3>{{ trans('home.DANH MỤC') }}<span class="icon-down-menu"><i class="fas fa-angle-down"></i></span></h3>
                <ul id="main-menu">
                    @foreach($categories as $category)
                        <li class="pl-2"><a href="{{ route('shopping.index', ['id' => $category->id, 'alias' => $category->slug]) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <!-- /Main menu -->

            <!-- Main banner -->
            <div class="col-xl-9 col-lg-9" id="main-banner-col">
                <div id="main-banner">
                    <!--<img src="{{ asset('public/imgs/banners/banner_1.png') }}" class="img-fluid">-->
                    @include('pages.homecontroller.partials.banner')
                </div>
                <div class="row no-gutters">
                    <div class="col-xl-6 col-md-6 main-banner-1">
                        <a href="https://www.youtube.com/channel/UCKi9oeMrldjtEJKhalszIqA" title="" target=_blank>
                            <img src="{{ asset('public/imgs/banners/banner_7.jpg') }}" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-xl-6 col-md-6 main-banner-2">
                        <a href="https://www.youtube.com/channel/UC40qGVhqAYh-CO6zsCzyeIw" target="_blank"><img src="{{ asset('public/imgs/banners/banner_6.jpg') }}" class="img-fluid"></a>
                    </div>
                </div>
            </div>
            <!-- /Main banner -->

        </div>
    </div>
</div>
<!-- /Menu & banner -->

<div id="main-content">
    <div class="container">
        <div class="row">
            <!-- Main -->
            <div class="col-md-9">
                <!-- Top selling week -->
                <div class="book-block" id="top-best-seller">
                    <div class="block-header">
                        <h2 class="top-week">
                            {{trans('home.Most Sold')}}
                            <a href="{{ route('shopping-best-sale.index') }}" class="float-right see-more">{{trans('home.ViewMore')}}</a>
                        </h2>
                    </div>
                    <div class="row">
                        @foreach($topWeek as $product)
                        <div class="col-sm-3 col-6 product-hover p-1">
                            <div class="item">
                                @include('pages.homecontroller.product-a-page')
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /Top selling week -->

                <!-- Best selling -->
                <div class="book-block" id="top-best">
                    <div class="block-header">
                        <h2 class="coming-soon">
                            {{trans('home.New Releases')}}
                            <a href="{{ route('shopping-new-released.index') }}" class="float-right see-more">{{trans('home.ViewMore')}}</a>
                        </h2>
                    </div>
                    <div class="row">
                        @foreach($top as $product)
                        <div class="col-sm-3 col-6 product-hover p-1">
                            <div class="item">
                                @include('pages.homecontroller.product-a-page')
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /Best selling -->

                <!-- Preorder -->
                <div class="book-block" id="pre-order-book">
                    <div class="block-header">
                        <h2 class="combo-hot">
                            {{trans('home.Hot Combo')}}
                            <a href="{{ route('shopping-top-combo.index') }}" class="float-right see-more">{{trans('home.ViewMore')}}</a>
                        </h2>
                    </div>
                    <div class="row">
                        @foreach($orderBefore as $product)
                        <div class="col-sm-3 col-6 product-hover p-1">
                            <div class="item">
                                @include('pages.homecontroller.product-a-page')
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /Preorder -->

                <!-- Top sale off -->
                <div class="book-block" id="top-sale-off">
                    <div class="block-header">
                        <h2 class="top-sale">
                            {{trans('home.Top Sales Promotion')}}
                            <a href="{{ route('shopping-discount.index') }}" class="float-right see-more">{{trans('home.ViewMore')}}</a>
                        </h2>
                    </div>
                    <div class="row">
                        @foreach($topSale as $product)
                        <div class="col-sm-3 col-6 product-hover p-1">
                            <div class="item">
                                @include('pages.homecontroller.product-a-page')
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /Top sale off -->

                <!-- Top combo -->
                <div class="book-block" id="top-combo-hot">
                    <div class="block-header">
                        <h2 class="fashion">
                            {{trans('home.Coming soon1')}}
                            <a href="{{ route('shopping-coming-soon.index') }}" class="float-right see-more">{{trans('home.ViewMore')}}</a>
                        </h2>
                    </div>
                    <div class="row">
                        @foreach($topCombo as $product)
                        <div class="col-md-3 col-6 product-hover p-1">
                            <div class="item">
                                @include('pages.homecontroller.product-a-page')
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /Top combo -->

                <!-- Your recent view -->
                @if($seen->count() != 0)
                <div class="book-block" id="your-recent-view">
                    <div class="block-header">
                        <h2>
                            {{trans('home.Browsing History')}}
                        </h2>
                    </div>
                    <div class="row">
                        @foreach($seen as $product)
                        <div class="col-sm-3 col-6 product-hover p-1">
                            <div class="item">
                                @include('pages.homecontroller.product-a-page')
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                <!-- /Your recent view -->

                <div class="rbooks-promotion d-none">
                    <script type="text/javascript" src="https://app.getresponse.com/view_webform_v2.js?u=GlAX6&webforms_id=BNb7D"></script>
                </div>

                <div class="rbooks-promotion d-none">
                    <script type="text/javascript" src="https://app.getresponse.com/view_webform_v2.js?u=GlAX6&webforms_id=BNAHV"></script>
                </div>

                <div id="rbooks-partner">
                    <div id="partner-list" class="row">
                        <!--<img class="img-fluid" src="{{ asset('imgs/doi_tac.png') }}" alt=""> -->
                        <!-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                          <div class="carousel-inner">
                            <div class="carousel-item active">
                              <img class="d-block w-100" src="{{ asset('imgs/partner.png') }}" alt="">
                            </div>
                            <div class="carousel-item">
                              <img class="d-block w-100" src="{{ asset('imgs/partner.png') }}" alt="">
                            </div>
                            <div class="carousel-item">
                              <img class="d-block w-100" src="{{ asset('imgs/partner.png') }}" alt="">
                            </div>
                            <div class="carousel-item">
                              <img class="d-block w-100" src="{{ asset('imgs/partner.png') }}" alt="">
                            </div>
                            <div class="carousel-item">
                              <img class="d-block w-100" src="{{ asset('imgs/partner.png') }}" alt="">
                            </div>
                            <div class="carousel-item">
                              <img class="d-block w-100" src="{{ asset('imgs/partner.png') }}" alt="">
                            </div>
                          </div>
                        </div> -->
                        <div class="partner-title">
                            <h3>{{trans('home.Partners')}}</h3>
                        </div>
                        <div class="partner">
                            <div class="owl-carousel owl-theme partner-carousel">
                                <div class="item"><img class="" src="{{ asset('public/imgs/logo-partner-6.png') }}" alt=""></div>
                                <div class="item"><img class="" src="{{ asset('public/imgs/logo-partner.png') }}" alt=""></div>
                                <div class="item"><img class="" src="{{ asset('public/imgs/logo-partner-1.png') }}" alt=""></div>
                                <div class="item"><img class="" src="{{ asset('public/imgs/logo-partner-2.png') }}" alt=""></div>
                                <div class="item"><img class="" src="{{ asset('public/imgs/logo-partner-3.png') }}" alt=""></div>
                                <!-- <div class="item"><img class="" src="{{ asset('public/imgs/logo-partner-4.png') }}" alt=""></div>
                                <div class="item"><img class="" src="{{ asset('public/imgs/logo-partner-5.png') }}" alt=""></div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Main -->

            <!-- Right menu -->
            <div class="col-md-3">
                <!-- Ebook Free
                    <div class="widget-block clearfix">
                        <div class="text-center">
                            <div class="pt-2"><span class="h6 text-primary" style="color: #283b91 !important;">{{trans('home.Please enter "mail"')}}<br> {{trans('home.get gifts now')}}</span></div>
                            <h3 class="text-danger p-1"></h3>
                        </div>
                        <div class="row info-ebook-free">
                            <div class="col-xl-6 col-4 align-self-center">
                                <img class="img-fluid" src="{{ asset('public/imgs/ebook_free.png') }}" alt="">
                            </div>
                            <div class="col-xl-6 col-8 pl-0 align-self-lg-center">
                                <div>
                                    <span class="h6 text-danger">{{trans('home.FREE BOOKS')}}</span>
                                    <span class="text-primary" style="color: #283b91 !important;">{{trans('home."14-day Plan Will Surely Boost Your Financial Stability"')}}</span>
                                </div>
                                <div>
                                    <span>
                                        {{trans('home.You know how the first and the most simplify step to increase main income is the fee cut down. All will be showed detail in this book.')}}
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 align-self-lg-center">
                                <div>
                                    <img  class="img-fluid" src="public/imgs/14-webrbooks-bannerlon.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="ebooks_free p-2 mt-3 mt-md-0">
                            <form action="{{route('email-gift')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="{{trans('home.Họ và tên')}}" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="address" placeholder="Address" required>
                                </div>
                                <button class="btn btn-danger w-100">{{trans('home.Get it now')}}</button>
                            </form>
                        </div>
                    </div>
                Ebook Free -->
                <!-- Video -->
                <div class="widget-block clearfix">
                    <h3>
                        {{trans('home.Introducing the Book Video')}}
                        <a href="#" class="float-right see-more"></a>
                    </h3>
                    <iframe class="youtube-widget" src="https://www.youtube.com/embed/gnctjA0dHQQ" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <iframe class="youtube-widget" src="https://www.youtube.com/embed/LGJMd08iUIg" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <!-- /Video -->

                <!-- Books -->
                <div class="widget-block">
                    <h3>
                        {{trans('home.Sách kinh tế')}}
                        <a href="#" class="float-right see-more"></a>
                    </h3>
                    <ul class="book-list clearfix list-unstyled">
                        @foreach($topNewEconomy as $product)
                        <li class="product-hover p-1">
                            <div class="thumbnail img-home">
                                <a href="{{ route('product.index', ['id' => $product->id, 'alias' =>$product->slug ]) }}">
                                    <img src="{{ empty($product->images->last()) ? asset(RBOOKS_NO_IMAGE_URL) : RBOOKS_IMAGE_URL . $product->images->last()->path }}" class="img-fluid img-home">
                                </a>
                                @if(!is_null($product->sale_price) && $product->sale_price != 0)
                                    <div class="coupon-home">{{ round(100 - ($product->sale_price / $product->cover_price * 100), 0) }}%</div>
                                @endif
                            </div>
                            <div class="content">
                                <h4><a href="{{ route('product.index', ['id' => $product->id, 'alias' =>$product->slug ]) }}"><p class="product-name">{{ $product->name }}</p></a></a></h3>
                                <div id="author"></div>
                                <p><span class="price">{{ number_format($product->cover_price) }} đ</span><span class="final-price">{{ number_format($product->sale_price) }} đ</span></p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /Books -->

                <!-- Like page-->
                <div class="widget-block">
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <h3>
                                Fanpage RBooks.vn
                            </h3>

                            <div class="row">
                                <div class="col-12">
                                    <div class="fb-page" data-href="https://www.facebook.com/rbooks.sachchungkhoan" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/rbooks.sachchungkhoan" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/rbooks.sachchungkhoan">RBooks-Kiến thức chứng khoán</a></blockquote></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xl-12 receive-books-desktop">
                            <!-- <h3>{{trans('home.Receive Books')}}<span class="text-danger font-weight-bold"> {{trans('home.Free')}}</span> {{trans('home.Every Week')}}</h3> -->
                            <div class="row pt-2">
                                <div class="col-12">
                                    <div class="fb-group" data-href="https://www.facebook.com/groups/congdongdautudaihanbspf" data-width="" data-show-social-context="false" data-show-metadata="true"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Like page-->

                <div class="ebooks_free p-2 mt-2 pt-0">
                    <form action="{{route('email-voucher')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="{{trans('home.Sign up and receive an ebook for free')}}" style="font-size: .9rem;">
                        </div>
                        <button class="btn btn-danger w-100">{{trans('home.Sign up')}}</button>
                    </form>
                </div>

            </div>
            <!-- /Right menu -->
        </div>
    </div>
</div>

@endsection