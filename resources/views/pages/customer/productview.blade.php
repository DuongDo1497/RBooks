@extends('layouts.master')

@section('content')
<div class="section section-account">
    <div class="container">
        <div class="account-wrap">
            <div class="row">
                <div class="col-xxl-4">
                    <div class="card account-sidebar">
                        <div class="card-header account-info">
                            <div class="avatar"></div>
                            <div class="info">
                                <p class="number-id">Tài khoản của</p>
                                <p class="name">{{ $customer->fullname }}</p>
                            </div>
                        </div>
                        <div class="card-body account-menu">
                            @include('pages.customer.partials.menu')
                        </div>
                    </div>
                </div>

                <div class="col-xxl-8">
                    <div class="card account-body product-view">
                        <div class="card-header">
                            <h4 class="info-title">Sản phẩm bạn đã xem</h4>
                        </div>
                        <div class="card-body">
                            <div class="product vertical">
                                @if(isset($customer))
                                    @foreach($products as $product)
                                        @include('pages.homecontroller.product-a-page')
                                    @endforeach
                                @endif
                            </div>
                        </div>

                         @if($products->lastPage() > 1)

                            <div class="pagination-container">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="customer-container" style="display: none" >
    <div class="container mt-3 mb-5">
        <div class="row">
            <div class="col-lg-3 col-md-2 col-4">
                {{-- customer-name --}}
                <div class="profile-menu">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-12 text-center customer-avatar">
                            <img src="{{ asset('imgs/person.png') }}" alt="">
                        </div>
                        <div class="col-lg-8 col-md-12 col-12 p-0">
                            <div class="h6 d-none d-sm-none d-md-none d-lg-block">{{ trans('home.Tài khoản của') }}</div>
                            <div class="customer-name">{{ $customer->fullname }}</div>
                        </div>
                    </div>
                    <hr>
                    <div>
                        @include('pages.customer.partials.menu')
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-10 col-8 book-block" id="banner-container">
                <div class="profile">
                    <div class="pb-2"><span class="h5">{{ trans('home.SẢN PHẨM BẠN ĐÃ XEM') }}</span></div>
                    <hr>
                    <div class="product-view">
                        <div class="row">
                            @if(isset($customer))
                            @foreach($customer->products as $product)
                            
                            <div class="col-xl-3 col-lg-4 col-md-4 col-12 product-hover py-2">
                                <div class="item">
                                    <div class="thumbnail img-home">
                                        <a href="<?php echo e(route('product.index', ['id' => $product->id, 'alias' =>$product->slug ])); ?>">
                                            <img src="{{ empty($product->images->last()) ? asset(RBOOKS_NO_IMAGE_URL) : RBOOKS_IMAGE_URL . $product->images->last()->path }}" class="lamian-img-product img-fluid">
                                        </a>
                                        <div class="coupon-category">25%</div>
                                    </div>
                                    <a href="{{ route('product.index', ['id' => $product->id, 'alias' =>$product->slug ]) }}" class="item-title"><p class="product-name">{{ $product->name }}</p></a>
                                    <div class="rate text-center clearfix">
                                    @if(empty($product->comments->first()))
                                        <div class="rate-star">
                                            <img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
                                            <img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
                                            <img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
                                            <img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
                                            <img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
                                        </div>
                                        <div class="rate-review">
                                            <span>({{trans('home.Comments')}})</span>
                                        </div>
                                    @else
                                        <div class="rate-star">                               
                                            @for($i = 0; $i < $product->comments->avg('rate'); $i++)
                                                <img class="pb-2" src="{{ asset('imgs/star.jpg') }}" alt="Đánh giá">
                                                {{-- <img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá"> --}}
                                            @endfor                               
                                        </div>
                                        <div class="rate-review clearfix">
                                            <span>({{ $product->comments->count() }} {{trans('home.Comments')}})</span>
                                        </div>
                                    @endif
                                    </div>
                                    <div class="price text-center clearfix">
                                        <span class="sale-price">{{ $product->cover_price }}</span>
                                        <span class="final-price">{{ $product->sale_price }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <div class="pagination-container text-center border-top">
                             @if($products->lastPage() > 1)

                            <div class="pagination-container">
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
            </div>
        </div>
    </div>
</div>

@endsection