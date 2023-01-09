@extends('layouts.master')
@section('content')
<div class="forgotPassword" id="forgotPassword" style="background-color: #f5f5fa;padding: 7rem 0px 5rem 0rem;">
    <div class="modal-content-forgot-password">
        <div class="modal-content-forgotPassword">
            <!-- Modal body -->
            <div class="modal-body">
                <h4 class="modal-body-forgotPassword">Quên mật khẩu?</h4>
                <form action="{{ route('password.email') }}" method="post" class="form-horizontal-forgotPassword p-3" role="form">
                    {{ csrf_field() }}
                    <div class="form-group-forgotPassword">
                        <input type="text" class="form-control-email" name="email"  placeholder="Vui lòng nhập email mà bạn đã đăng ký">
                    </div>
                    <div class="float-right-forgotPassword">
                        <button class="btn btn-danger btn-modal" type="submit">Gửi yêu cầu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection