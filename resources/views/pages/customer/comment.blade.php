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
                  <p class="number-id">{{ trans('home.Tài khoản của') }}</p>
                  <p class="name">{{ $customer->fullname }}</p>
                </div>
              </div>
              <div class="card-body account-menu">
                @include('pages.customer.partials.menu')
              </div>
            </div>
          </div>

          <div class="col-xxl-8">
            <div class="card account-body order-info">
              <div class="card-header">
                <h4 class="info-title">{{ trans('home.Sản phẩm đã mua') }}</h4>
              </div>
              <div class="card-body">
                <div class="product-bought-detail container">
                  @foreach ($comments as $comment)
                    <ul class="product-bought-list row row-cols-1 row-cols-sm-2 row-cols-md-4">
                      <li class="product-bought-item col-3">
                        <div class="product-bought-img">
                          <img src="{{ asset('imgs/sach.png') }}" alt="product">
                        </div>
                        <div class="product-bought-des"> <span
                            class="des-product-bought">{{ $comment->products->first()->name }}</span> </div>
                        <button class="write-comment-product btn-add" data-bs-toggle="modal"
                          data-bs-target="#modalComment">{{ trans('home.Viết nhận xét') }}</button>
                        @include('pages.customer.addcomment')
                      </li>
                    </ul>
                  @endforeach
                </div>
                <!-- <div class="product-pagination">
                                    <nav aria-label="Page navigation example">
                                        <div class="product-pagination-list">
                                            <ul class="pagination">
                                                <li class="page-item  ">
                                                    <a class="disable" href="#" aria-label="Previous">
                                                        <span class="pagination-icon" aria-hidden="true">
                                                            <i class="fa-solid fa-chevron-left"></i>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="page-item"><a class="" href="#">1</a></li>
                                                <li class="page-item "><a class="active" href="#">2</a></li>
                                                <li class="page-item "><a class="" href="#">3</a></li>
                                                <li class="page-item "><a class="" href="#">4</a></li>
                                                <li class="page-item "><a class="disable" href="#">....</a></li>
                                                <li class="page-item "><a class="" href="#">9</a></li>
                                                <li class="page-item">
                                                    <a class="" href="#" aria-label="Next">
                                                        <span class="pagination-icon" aria-hidden="true">
                                                            <i class="fa-solid fa-chevron-right"></i>
                                                        </span>
                                                    </a>
                                                </li>
                                        
                                            </ul>
                                        </div>
                                    </nav>
                                </div> -->
                <div class="pagination-container-comment">
                  <div class="center-pagination-comment">
                    <nav aria-label="Page navigation example">
                      {{ $comments->links() }}
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="customer-container" style="display: none;">
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
          <div class="product-bought">
            <div class="product-bought-header"><span class="h2">Sản phẩm đã mua</span></div>
            <hr>
            <div class="product-bought-detail container">
              @foreach ($comments as $comment)
                <ul class="product-bought-list row row-cols-1 row-cols-sm-2 row-cols-md-4">
                  <li class="product-bought-item col-3">
                    <div class="product-bought-img">
                      <img src="{{ asset('imgs/sach.png') }}" alt="product">
                    </div>
                    <div class="product-bought-des"> <span
                        class="des-product-bought">{{ $comment->products->first()->name }}</span> </div>
                    <button class="write-comment-product btn-add" data-bs-toggle="modal"
                      data-bs-target="#modalComment">Viết nhận xét</button>
                    @include('pages.customer.addcomment')
                  </li>
                </ul>
              @endforeach
            </div>
            <!-- <div class="product-pagination">
                            <nav aria-label="Page navigation example">
                                <div class="product-pagination-list">
                                    <ul class="pagination">
                                        <li class="page-item  ">
                                            <a class="disable" href="#" aria-label="Previous">
                                                <span class="pagination-icon" aria-hidden="true">
                                                    <i class="fa-solid fa-chevron-left"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="page-item"><a class="" href="#">1</a></li>
                                        <li class="page-item "><a class="active" href="#">2</a></li>
                                        <li class="page-item "><a class="" href="#">3</a></li>
                                        <li class="page-item "><a class="" href="#">4</a></li>
                                        <li class="page-item "><a class="disable" href="#">....</a></li>
                                        <li class="page-item "><a class="" href="#">9</a></li>
                                        <li class="page-item">
                                            <a class="" href="#" aria-label="Next">
                                                <span class="pagination-icon" aria-hidden="true">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                </span>
                                            </a>
                                        </li>
                                  
                                    </ul>
                                </div>
                            </nav>
                        </div> -->
            <div class="pagination-container-comment">
              <div class="center-pagination-comment">
                <nav aria-label="Page navigation example">
                  {{ $comments->links() }}
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
