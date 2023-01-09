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
                    <div class="card account-body favorite">
                        <div class="card-header">
                            <h4 class="info-title">Sản phẩm yêu thích</h4>
                        </div>
                        <div class="card-body">
                            <div class="product vertical">
                                @foreach($productlikes as $product)
                                    @include('pages.homecontroller.product-a-page')
                                @endforeach
                            </div>
                        </div>
                        @if($productlikes->lastPage() > 1)

                            <div class="pagination-container">
                                <div class="center-pagination">
                                    <nav aria-label="Page navigation example">
                                    <!-- <ul class="pagination pagination-sm pt-2"> -->
                                {{ 
                                    $productlikes->appends(request()->query())->links("pagination::bootstrap-4") 
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

<div id="customer-container" style="display: none">
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
            <div class="col-lg-9 col-md-10 col-8" id="banner-container">
                <div class="profile">
                    <div class="pb-2"><span class="h5">{{trans('home.SẢN PHẨM YÊU THÍCH')}}</span></div>
                    <hr>
                    <div class="favorite-box">
                        @foreach($customer->productlikes as $product)
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-12"><img src="{{ empty($product->images->last()) ? asset(RBOOKS_NO_IMAGE_URL) : RBOOKS_IMAGE_URL . $product->images->last()->path }}" style="width: 100%;"></div>
                            <div class="col-lg-5 col-md-5 col-12">
                                <h6 class="title"><a href="<?php echo e(route('product.index', ['id' => $product->id, 'alias' =>$product->slug ])); ?>">{{ $product->name }}</a></h6>
                                <p class="rating">
                                    @if(empty($product->comments->first()))
                                    <span class="rating-content">
                                        <img src="https://rbooks.vn/imgs/none_star.jpg" alt="Đánh giá">
                                        <img src="https://rbooks.vn/imgs/none_star.jpg" alt="Đánh giá">
                                        <img src="https://rbooks.vn/imgs/none_star.jpg" alt="Đánh giá">
                                        <img src="https://rbooks.vn/imgs/none_star.jpg" alt="Đánh giá">
                                        <img src="https://rbooks.vn/imgs/none_star.jpg" alt="Đánh giá">
                                    </span>
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
                                </p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <p class="price_sell">105,700 đ</p>
                                <p class="price">
                                    <span class="price_cover"><del>151,000 đ</del></span>
                                    <span class="price_sale">-30%</span>
                                </p>
                            </div>
                            <button type="button" class="close close-box" data-toggle="modal" aria-label="Close" onclick="window.location.href='{{ route('del-wish', ['id' => $product->id ]) }}'">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <div class="pagination-container text-center border-top">
                            <div class="center-pagination">
                                <nav aria-label="Page navigation example">
                                    
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection

