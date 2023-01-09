@extends('layouts.master')

@section('content')
<div id="customer-container">
    <div class="container mt-3 mb-5">
        <div class="row">
            <div class="col-3 profile-menu">
                {{-- customer-name --}}
                <div class="row">
                    <div class="col-4 text-center">
                        <img src="{{ asset('imgs/person.png') }}" alt="">
                    </div>
                    <div class="col-8 p-0">
                        <div class="h6">Tài khoản của</div>
                        <div class="customer-name">{{ $customer->fullname }}</div>
                    </div>
                </div>
                <hr>
                <div>
                    @include('pages.customer.partials.menu')
                </div>
            </div>
            <div class="col-9">
                <div class="profile">
                    <div class="pb-2"><span class="h5">CÀI ĐẶT MẬT KHẨU</span></div>
                    <form action="#" class="mt-3" method="post">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>Mật khẩu hiện tại</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name="password_current" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="">Mật khẩu mới</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="">Mật khẩu mới</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name="password_confirm" required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
@endsection
