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
            <div class="checkout-body">
                <p>Mã số đơn hàng của bạn là:</p>
                <div class="id-done-order">#{{ $order->order_number }}</div>
                <!-- <h4>{{ trans('home.Mã đơn hàng của bạn:') }} #{{ $order->order_number }} <a href="{{ route('detail-order', ['id' => $order->id]) }}">{{ trans('home.THEO DÕI ĐƠN HÀNG') }}</a></h4> -->

                <!-- {{ trans('home.Bạn có thể quản lý và kiểm tra đơn hàng của bạn tại:') }} <a href="{{ route('customer') }}">{{ trans('home.Tài khoản của tôi') }}</a> <a href="{{ route('customer-order') }}">{{ trans('home.Đơn hàng của tôi') }}</a> -->
            </div>
            <div class="btn-check-done">
            <!--  -->
                <button type="button" class="btn btn-default btn-order-tracking"  onclick="window.location.href='{{ route('customer-order') }}'">Theo dõi đơn hàng</button>
                <button type="button" class="btn btn-default btn-order-continue"  onclick="window.location.href='/'">Tiếp tục mua hàng</button>
            </div>
            <div class="check-done-footer">
                <p>{{ trans('home.Đơn hàng của bạn sẽ được giao từ:') }} </span><span class="payment-information strong-text"><b>{{ Carbon\Carbon::create()->format('d/m/Y') }}  - {{ Carbon\Carbon::create()->addDays(5)->format('d/m/Y') }}</b></p>
                <p>{{ trans('home.Bạn có thể quản lý và kiểm tra đơn hàng của bạn tại:') }} <a href="{{ route('customer') }}">{{ trans('home.Tài khoản của tôi') }}</a> <a href="{{ route('customer-order') }}">{{ trans('home.Đơn hàng của tôi') }}</a></p>
                <p><span> Thông báo về việc tiếp nhận. Yêu cầu đặt hàng của bạn đã được gửi đến: </span><b class="payment-information">{{ $order->customer->email }}</b></p>
            </div>
        </div>
        <!-- <div class="row checkout-done-footer justify-content-center mt-2">
        	<button class="btn btn-success mt-3" onclick="window.location.href='{{ route('home') }}'" > {{ trans('home.Tiếp tục mua hàng') }}</button>
        </div> -->
    </div>
</section>
@endsection