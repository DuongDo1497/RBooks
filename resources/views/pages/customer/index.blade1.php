@extends('layouts.master')

@section('content')
<div id="customer-container">
    <div class="container mt-3 mb-5">
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
            <div class="col-lg-9 col-md-10 col-8">
                <div class="profile">
                    @if(Session::has('thongbao'))
                        <div class="alert alert-success">{{Session::get('thongbao')}}</div>
                    @endif

                    <form action="{{route('customer-update')}}" class="mt-3" method="post">
                        @csrf
                        <div class="pb-2"><span class="h5">{{ trans('home.THÔNG TIN TÀI KHOẢN') }}</span></div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>{{ trans('home.Họ và tên') }}</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="input" class="form-control" name="name" value="{{ $customer->fullname }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="">{{ trans('home.Ngày sinh') }}</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" name="birthday" value="{{ $customer->birthday }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="">{{ trans('home.Số điện thoại') }}</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="phone" value="{{ $customer->phone }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>Email</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="input" class="form-control" name="email" value="{{ $customer->email }}" disabled="true">
                                    <input type="input" class="form-control" name="email" value="{{ $customer->email }}" hidden="true">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="pb-2"><span class="h5">{{ trans('home.THÔNG TIN CÔNG TY') }}</span></div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>Tên công ty</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="input" class="form-control" name="name_company" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>Địa chỉ công ty</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="input" class="form-control" name="address_company" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>Mã số thuế</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="input" class="form-control" name="vat_code" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-default" type="submit">{{ trans('home.Cập nhật') }}</button>
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
