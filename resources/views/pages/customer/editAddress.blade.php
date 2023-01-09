@extends('layouts.master')

@section('content')
<section id="customer-container">
    <div class="container">
        <div class="row" id="menu">
            <!-- <div class="col-md-3 col-4 no-padding-right no-padding-left border" id="main-navigation-container">
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
                            <div class="h6 d-none d-sm-none d-md-none d-lg-block">{{ trans('home.Tài khoản của') }}</div>
                            <div class="customer-name">{{ $customer_address->fullname }}</div>
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
                    <div class="pb-2"><span class="h5">{{ trans('home.Sửa') }} {{ trans('home.địa chỉ nhận hàng') }}</span></div>
                    @if(session('thongbao'))
                            <div class= "alert alert-success">
                                {{session('thongbao')}}
                            </div>
                    @endif
                    <hr>
                    <form method="post" action="">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" >
                        {{ csrf_field() }}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <div class="col">
                                <div class="form-group">
                                    <label>{{ trans('home.Họ và tên') }}</label>
                                    <input type="text" name="fullname" class="form-control" value="{{ $customer_address->fullname }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>{{ trans('home.Số điện thoại') }}</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $customer_address->phone }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    {{-- {{ Form::select('city', $cities) }} --}}
                                    <label>{{ trans('home.Tỉnh/Thành phố') }}</label>
                                    <input type="text" name="city" class="form-control" value="{{ $customer_address->city }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>{{ trans('home.Quận/Huyện') }}</label>
                                    <input type="text" name="district" class="form-control" value="{{ $customer_address->district }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>{{ trans('home.Phường/Xã') }}</label>
                                    <input type="text" name="ward" class="form-control" value="{{ $customer_address->ward }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>{{ trans('home.Địa chỉ') }}</label>
                                    <input type="text" name="address" class="form-control" value="{{ $customer_address->address }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="custom-control custom-checkbox justify-content-center">
                                    <input type="checkbox" class="custom-control-input" name="default" id="def_checks" value="1">
                                    <label class="custom-control-label" for="def_checks"> {{ trans('home.Sử dụng địa chỉ này làm mặc định.') }}</label>
                                </div>
                            </div>
                        <div class="row justify-content-center mb-2 mt-4">
                            <button type="submit" class="btn btn-default" style="margin-left: 10px;">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.container -->
</section>
@endsection
