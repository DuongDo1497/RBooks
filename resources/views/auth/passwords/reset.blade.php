@extends('layouts.master')
@section('email')

<h2>546546546546dfas</h2>

<div class="" id="forgotPassword">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <div><span class="h3">Đặt Lại Mật Khẩu123</span></div>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                @if (session('status'))
                <div class="alert alert-success">
                    Đổi password thành công!
                </div>
                @endif
                <form action="{{ route('password.reset') }}" method="post" class="form-horizontal p-3" role="form">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">

                        <input type="text" class="form-control" name="email"  placeholder="Email" required="true">
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                        <input type="password" class="form-control" id="password" name="password" placeholder="Password"/>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password"/>
                    </div>

                    <div class="float-right">
                        <input type="submit" class="btn btn-danger btn-modal" value="Reset Password" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection