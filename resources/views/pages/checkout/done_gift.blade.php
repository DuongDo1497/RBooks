@extends('layouts.master')

@section('content')
<section id="cart-container">
    <div class="container background-white border-bottom pb-4">
        <div class="row checkout-done-head mt-3">
            <div class="col-md-12 text-center">
                <h2 class="text-success">Cảm ơn bạn đã mua hàng làm quà tặng</h2>
                <h5 class="text-danger">Quý khách vui lòng thanh toán trước ngày {{ Carbon\Carbon::create()->addDays(3)->format('d/m/Y') }} bằng cách chuyển khoản ngân hàng.</h5>
                <h5 class="text-danger">Thông tin chuyển khoản được gửi vào mail: {{ $gift->customer->email }}</h5>
            </div>
            <div class="col-md-12 text-center">
                <h4>Mã quà tặng của bạn: #{{ $gift->gift_number }}</h4>
                Bạn có thể quản lý và kiểm tra quà tặng của bạn tại: <a href="{{ route('customer-order') }}">Đơn hàng của tôi</a>
            </div>
        </div>
        <div class="row checkout-done-body">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <ul class="list-group">
                        <li class="list-group-item"><i class="fa fa-envelope-o" aria-hidden="true"></i><span> Thông báo về việc tiếp nhận. Yêu cầu đặt hàng làm quà tặng của bạn đã được gửi đến: </span><b>{{ $gift->customer->email }}</b></li>
                        <li class="list-group-item"><i class="fa fa-truck" aria-hidden="true"></i><span> Quà tặng của bạn sẽ được giao từ: </span><span class="payment-information strong-text"><b>{{ Carbon\Carbon::create()->addDays(3)->format('d/m/Y') }}  - {{ Carbon\Carbon::create()->addDays(5)->format('d/m/Y') }}</b></span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row checkout-done-footer justify-content-center mt-2">
        	<button class="btn btn-success mt-3" onclick="window.location.href='{{ route('home') }}'" > Tiếp tục mua hàng</button>
        </div>
    </div>
</section>
@endsection