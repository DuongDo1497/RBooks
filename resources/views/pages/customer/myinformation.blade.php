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
            <div class="card account-body notification">
              <div class="card-header">
                <h4 class="info-title">{{ trans('home.Thông báo của tôi') }}</h4>
              </div>
              <div class="card-body">
                <ul class="notifyMy-list">
                  <li class="notifyMy-item">
                    <div class="notify-icon">
                      <img class="notify-icon-notify" src="{{ asset('imgs/notification.png') }}" alt="icon thông báo">
                    </div>
                    <div class="notify-detail">
                      <p class="assess">{{ trans('home.Đánh giá sản phẩm') }}</p>
                      <span class="notify-infoOrder">
                        Đơn hàng <b>#4543563455</b> đã hoàn thành .Vui lòng đánh giá sản phẩm để giúp người khác hiểu hơn
                        về sản phẩm nhé!.
                      </span>
                    </div>
                  </li>
                  <li class="notifyMy-item">
                    <div class="notify-icon">
                      <img class="notify-icon-notify" src="{{ asset('imgs/notification.png') }}" alt="icon thông báo">
                    </div>
                    <div class="notify-detail">
                      <p class="assess">{{ trans('home.Đánh giá sản phẩm') }}</p>
                      <span class="notify-infoOrder">
                        Đơn hàng <b>#4543563455</b> đã hoàn thành .Vui lòng đánh giá sản phẩm để giúp người khác hiểu hơn
                        về sản phẩm nhé!.
                      </span>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="customer-container" style="display: none;">
    <div class="container mt-5 mb-5">
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
          <div class="myInfo">
            <div class="header-myInfo">
              <span class="h2">Thông báo của tôi</span>
            </div>
            <hr>
            <div class="notify-my">
              <ul class="notifyMy-list">
                <li class="notifyMy-item">
                  <div class="notify-icon">
                    <img class="notify-icon-notify" src="{{ asset('imgs/notification.png') }}" alt="icon thông báo">
                  </div>
                  <div class="notify-detail">
                    <p class="assess">Đánh giá sản phẩm</p>
                    <span class="notify-infoOrder">
                      Đơn hàng <b>#4543563455</b> đã hoàn thành .Vui lòng đánh giá sản phẩm để giúp người khác hiểu hơn về
                      sản phẩm nhé!.
                    </span>
                  </div>
                </li>
                <li class="notifyMy-item">
                  <div class="notify-icon">
                    <img class="notify-icon-notify" src="{{ asset('imgs/notification.png') }}" alt="icon thông báo">
                  </div>
                  <div class="notify-detail">
                    <p class="assess">Đánh giá sản phẩm</p>
                    <span class="notify-infoOrder">
                      Đơn hàng <b>#4543563455</b> đã hoàn thành .Vui lòng đánh giá sản phẩm để giúp người khác hiểu hơn về
                      sản phẩm nhé!.
                    </span>
                  </div>
                </li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
@endsection
