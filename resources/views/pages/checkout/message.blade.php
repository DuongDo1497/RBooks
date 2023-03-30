@extends('layouts.master')

@section('content')
<section id="cart-container">
    <div class="container cart-container-body border-bottom pb-4">
        <div class="row checkout-done-head">
            <div class="checkout-header">
                <img src="{{ asset('imgs/icon_order_thanh_cong.png') }}" alt="" class="cart-img">
                <h2 class="text-center" >ĐẶT HÀNG THÀNH CÔNG</h2>
                <p class="checkout-header-desc text-center">Cảm ơn bạn đã đặt hàng tại: <a href="/">RBooks</a></p>
            </div>
        </div>
        <div class="row checkout-done-body">
        @if ($errorCode == '-1')
          <!-- Đăng ký thông tin khách hàng bị lỗi -->
          <div class="message-success text-center">
            <h1 class="mb-5">
              <font size="5" color="#1a1f53">
                THÔNG TIN ĐĂNG KÝ BỊ LỖI !
              </font>
            </h1>

            <p class="mb-5"><b>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi. Vui lòng nhập lại
                thông tin đăng ký mới.</b></p>
          </div>
        @elseif($errorCode == '0')
          <!-- Đăng ký thông tin khách hàng thành công, thanh toán qua vi thành công -->
          <div class="message-success text-center">
            <h1 class="mb-5">
              <font size="5" color="#1a1f53">
                {{ mb_strtoupper($infor) }}
              </font>
            </h1>

            <p class="mb-5"><b>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi. Chúc bạn một ngày
                vui!</b><br><br><br><br><br><br><br></p>

          </div>
        @else
          <!-- Đăng ký thông tin khách hàng thành công, thanh toán qua vi bị lỗi -->
          <div class="message-success text-center">
            <h1 class="mb-5">
              <font size="5" color="#FF0000">
                {{ mb_strtoupper($infor) }}
              </font>
            </h1>

            <p class="mb-4"><b>Thông tin thanh toán bị lỗi, mời bạn thanh toán trực tiếp hoặc chuyển khoản để hoàn thành thủ tục đăng ký.</b></p>

            <p class="mb-5"><b>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi. Chúc bạn một ngày
                vui!</b></p>

          </div>
        @endif
        </div>
    </div>
</section>
@endsection