@extends('layouts.master')

@section('content')
<section id="customer-container">
    <div class="container mt-3 mb-5">
        <div class="row" id="menu">
            <!-- <div class="col-md-3 no-padding-right no-padding-left border" id="main-navigation-container">
                @include('pages.customer.partials.menu')
            </div> -->

            <div class="col-lg-3 col-md-2 col-4">
                {{-- customer-name --}}
                <div class="profile-menu">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-12 text-center customer-avatar">
                            <img src="{{ asset('imgs/person.png') }}" alt="">
                        </div>
                        <div class="col-lg-8 col-md-12 col-12 p-0">
                            <div class="h6 d-none d-sm-none d-md-none d-lg-block">Tài khoản của</div>
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
                    <h3>Thêm địa chỉ nhận hàng</h3>
                    <hr>
                    <div class="col-md-8 mt-3 pr-1 pl-2">
                        <form method="post" action="{{ route('store-address') }}">
                            <div class="col">
                                <div class="form-group">
                                    <label>Họ và tên(*)</label>
                                    <input type="text" name="fullname" class="form-control" value="{{ old('fullname') }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Số điện thoại(*)</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Tỉnh/Thành phố(*)</label>
                                    <input type="text" name="city" class="form-control" value="{{ old('city') }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Quận/Huyện(*)</label>
                                    <input type="text" name="district" class="form-control" value="{{ old('district') }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Phường/Xã(*)</label>
                                    <input type="text" name="ward" class="form-control" value="{{ old('ward') }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Địa chỉ(*)</label>
                                    <input type="text" name="address" class="form-control" placeholder="Nhập số nhà, tên đường (nếu có)" value="{{ old('address') }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="custom-control custom-checkbox justify-content-center">
                                    <input type="checkbox" class="custom-control-input" name="default" id="def_checks" value="1">
                                    <label class="custom-control-label" for="def_checks"> Sử dụng địa chỉ này làm mặc định.</label>
                                </div>
                            </div>
                            <div class="col mt-2">
                            {{ csrf_field() }}
                            @if ($errors->any())
                                <ul style="list-style-type: none; padding: 0;">
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            <div class="alert alert-danger">{{ $error }}</div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            </div>
                            <div class="row justify-content-center mb-2 mt-4 btn-add-address">
                                <button class="btn btn-default">Thêm</button>
                                <!-- <button class="btn btn-default">Quay lại</button> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container -->
</section>
@endsection
