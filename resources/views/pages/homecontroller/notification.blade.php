@extends('layouts.master')

@section('content')
<section id="cart-container">
    <div class="container background-white pb-4">
        <div class="row checkout-done-head mt-3">
            <div class="col-md-12 text-center mb-3">
                <h2 class="text-success">Cảm ơn bạn đã đăng ký nhận sách!</h2>
            </div>
            <div class="col-md-12">
                <h5 class="text-center mb-2">RBooks đã gửi thông tin xác nhận đăng ký thành công qua email của bạn.</h5>
                <p class="text-center">Bạn vui lòng kiểm tra email và phản hồi lại cho RBooks nếu chưa nhận được thông báo hoặc có bất cứ sự cố nào xảy ra.</p>
                <h6 class="text-center mt-3"><b>Trân trọng cảm ơn!</b></h6>
            </div>
        </div>
        <div class="row checkout-done-footer justify-content-center mt-2">
        	<button class="btn btn-success mt-3" onclick="window.location.href='http://rbooks.vn/resources/views/pages/shopping/c2/sach-moi-phat-hanh.html'" >Xem thêm sách hay</button>
        </div>
    </div>
</section>
@endsection