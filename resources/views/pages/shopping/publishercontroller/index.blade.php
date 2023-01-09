@extends('layouts.master')

@section('content')

<div id="main-content">
    <div class="container" id="main-category">
        
        <div class="row no-gutters">
            <!-- Menu left -->
            <div class="col-xl-3 col-lg-3">
                <div id="category-menu" class="widget-block">
                    <h3>{{ trans('home.DANH MỤC') }}<span class="icon-down-category"><i class="fas fa-angle-down"></i></span></h3>
                    <ul class="list-unstyled widget-list-link widget-list-link-category">
                        @if($locale == "vi" || $locale == "")
                            @foreach($categories as $category)
                                <a href="{{ route('shopping.index', ['id' => $category->id, 'alias' => $category->slug]) }}"><li class="pl-2 text-dark">{{ $category->name }}</li></a>
                            @endforeach
                        @else
                            @foreach($categories as $category)
                                <a href="{{ route('shopping.index', ['id' => $category->id, 'alias' => $category->slug]) }}"><li class="pl-2 text-dark">{{ $category->nameEnglish }}</li></a>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <div id="publisher" class="widget-block">
                    <h3>{{ trans('home.NHÀ PHÁT HÀNH') }}<span class="icon-down-publisher"><i class="fas fa-angle-down"></i></span></h3>
                    <ul class="list-unstyled widget-list-link widget-list-link-publisher"> 
                        @foreach($publishers as $pub)
                            <li class="pl-2 text-dark"><a href="{{ route('publisher.index', ['alias' => $pub->publisher]) }}">{{ $pub->publisher }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- /Menu left -->

            <!-- Main -->
            <div class="col-xl-9 col-lg-9" id="category-main-content">
                <!-- Category banner -->
                <div id="category-banner">
                    
                    @include('pages.homecontroller.partials.banner')
                </div>
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
                </div>
                <!-- /Category filter -->

                <!-- Books -->
                
                <div class="row category-books-row">
                    @foreach($products as $product)
                    <div class="col-lg-3 col-md-3 col-6 category-books">
                        @include('pages.homecontroller.product-a-page')
                    </div>
                    @endforeach
                </div>
                
                <!-- /Books -->

                <!-- Pagination -->
                @if($products->lastPage() > 1)
                    <div class="pagination-container text-center border-top">
                        <div class="center-pagination">
                            <nav aria-label="Page navigation example">
                                <!-- <ul class="pagination pagination-sm pt-2"> -->
                                {{ 
                                    $products->appends(request()->query())->links("pagination::bootstrap-4") 
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
</div>

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

    });
</script>

@endsection