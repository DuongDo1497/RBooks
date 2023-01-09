@extends('layouts.master')

@section('content')
<div class="section section-account">
    <div class="container">
        <div class="account-wrap">
            <div class="row">
                <div class="col-xxl-4">
                    <div class="card account-sidebar">
                        <div class="card-header account-info">
                            <div class="avatar"></div>
                            <div class="info">
                                <p class="number-id">Tài khoản của</p>
                                <p class="name">{{ $customer->fullname }}</p>
                            </div>
                        </div>
                        <div class="card-body account-menu">
                            @include('pages.customer.partials.menu')
                        </div>
                    </div>
                </div>

                <div class="col-xxl-8">
                    <div class="card account-body profile">
                        <div class="card-header">
                            <h4 class="info-title">Thông tin của tôi</h4>
                            <p class="desc-info">Quản lý thông tin để bảo mật tài khoản</p>
                        </div>
                        <div class="card-body">
                            @if(Session::has('thongbao'))
                            <div class="alert alert-success">{{Session::get('thongbao')}}</div>
                            @endif
                            <form action="{{route('customer-update')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3 label-input">
                                            <label>{{ trans('home.Họ và tên') }}</label>
                                        </div>
                                        <div class="col-sm-6">

                                            <input type="input" class="form-control input-info input-info--name" name="name" value="{{ $customer->fullname }}" placeholder="Nhập họ và tên">
                                        </div>
                                    </div>
                                    <div class="msg-err-nameInfo">
                                        <div class="col-sm-3"></div>
                                        <p class="col-sm-6 msg-err-name">Vui lòng điền vào mục này</p>
                                    </div>

                                </div>
                                <div class="form-group mt-3">
                                    <div class="row">
                                        <div class="col-sm-3 label-input">
                                            <label>Giới tính</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <select class="form-control input-info " name="gender">
                                                <option value="{{$customer->gender}}">@if ($customer->gender==1)
                                                    Nữ
                                                    @else Nam
                                                    @endif</option>
                                                @for($i=0;$i < 2;$i++) @if($customer->gender != $i)
                                                    <option value="{{$i}}">@if ($i==1)
                                                        Nữ
                                                        @else Nam
                                                        @endif
                                                    </option>
                                                    @endif
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="msg-err-nameInfo">

                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="row">
                                        <div class="col-sm-3 label-input">
                                            <label for="">{{ trans('home.Ngày sinh') }}</label>
                                        </div>
                                        <input type="hidden" id="full-dob-info" value="{{ $customer->birthday }}">
                                        <div id="dropdown-info-dob" class="info-dob col-sm-6">
                                            <span>
                                                <select name="day" id="day-info-customer">
                                                </select>
                                            </span>
                                            <span>
                                                <select name="month" id="month-info-customer"></select>
                                            </span>
                                            <span>
                                                <select name="year" id="year-info-customer">Year:</select>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="row">
                                        <div class="col-sm-3 label-input">
                                            <label for="">{{ trans('home.Số điện thoại') }}</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- <input type="text" class="form-control input-info input-info__phone" name="phone" value="{{ $customer->phone }} 0349016282"> -->
                                            <input type="text" class="form-control input-info input-info__phone" name="phone" value="{{ $customer->phone }}" disabled="true">
                                        </div>
                                        <div class="col-sm-3 btn-info-change">
                                            <a data-bs-toggle="modal" data-bs-target="#infoPhone" class="btn-change--phone">Thay đổi</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="row">
                                        <div class="col-sm-3 label-input">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-sm-4 mr-2">
                                            <input id="user-phone-info" type="input" class="form-control input-info input-info__phone" name="email" title="{{ $customer->email }}" value="{{ $customer->email }}" disabled="true">
                                            <input type="input" class="form-control input-info" name="email" value="{{ $customer->email }}" hidden="true">
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="row">
                                        <div class="col-sm-3 label-input">
                                            <label>Tên công ty</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="input" class="form-control input-info " name="name_company" value="{{$customer->companies->name ?? ''}}" placeholder="Nhập tên công ty">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="row">
                                        <div class="col-sm-3 label-input">
                                            <label>Địa chỉ công ty</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="input" class="form-control input-info" name="address_company" value="{{$customer->companies->address_company ?? ''}}" placeholder="Nhập địa chỉ công ty">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="row">
                                        <div class="col-sm-3 label-input">
                                            <label>Mã số thuế</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="input" class="form-control input-info" name="vat_code" value="{{$customer->companies->code_vat ?? ''}}" placeholder="Nhập mã số thuế">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-4">
                                    <div class="row">
                                        <div class="col-sm-3 label-input">
                                        </div>
                                        <div class="col-sm-6">
                                            <button class="btn btn-danger btn-save-info " type="submit">Lưu</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="customer-container" style="display: none;">
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
                    @include('pages.customer.partials.menu')
                </div>
            </div>
            <div class="col-lg-9 col-md-10 col-8">
                <div class="profile">
                    @if(Session::has('thongbao'))
                    <div class="alert alert-success">{{Session::get('thongbao')}}</div>
                    @endif

                    <form action="{{route('customer-update')}}" class="mt-3" method="post">
                        @csrf
                        <div class="pb-2"><span class="h5">
                                <div class="fw-bold info-title">Thông tin của tôi</div>
                            </span></div>
                        <p class="desc-info">Quản lý thông tin để bảo mật tài khoản</p>
                        <hr>
                        <div class="form-group mt-5">
                            <div class="row">
                                <div class="col-sm-2 label-input">
                                    <label>{{ trans('home.Họ và tên') }}</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="input" class="form-control input-info" name="name" value="{{ $customer->fullname }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <div class="row">
                                <div class="col-sm-2 label-input">
                                    <label for="">{{ trans('home.Ngày sinh') }}</label>
                                </div>
                                <div class="info-dob col-sm-6">
                                    <!-- <select name="year" id="year-info-customer" size="1"></select>

                                    <select name="month" id="month-info-customer" size="1"></select>

                                    <select name="day" id="day-info-customer" size="1">
                                    <option value=" " selected="selected">-- Ngày --</option>
                                    </select> -->
                                    <span>
                                        <select name="day" id="day-info-customer"></select>
                                    </span>
                                    <span>
                                        <select name="month" id="month-info-customer"></select>
                                    </span>
                                    <span>
                                        <select name="year" id="year-info-customer">Year:</select>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-sm-2 label-input">
                                    <label for="">{{ trans('home.Số điện thoại') }}</label>
                                </div>
                                <div class="col-sm-4">
                                    <!-- <input type="text" class="form-control input-info input-info__phone" name="phone" value="{{ $customer->phone }} 0349016282"> -->
                                    <input type="text" class="form-control input-info input-info__phone" name="phone" value=" 0349016282" disabled="true">
                                </div>
                                <div class="col-sm-2 btn-info-change">
                                    <a data-bs-toggle="modal" data-bs-target="#infoPhone">Thay đổi</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <div class="row">
                                <div class="col-sm-2 label-input">
                                    <label>Email</label>
                                </div>
                                <div class="col-sm-4">
                                    <input id="user-phone-info" type="input" class="form-control input-info input-info__phone" name="email" title="cccccccccccccccccccccccccccccc@gmail.com" value="cccccccccccccccccccccccccccccc@gmail.com" disabled="true">
                                    <input type="input" class="form-control input-info" name="email" value="{{ $customer->email }}" hidden="true">
                                </div>
                                <div class="col-sm-2 btn-info-change">
                                    <a data-bs-toggle="modal" data-bs-target="#infoEmail">Thay đổi</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-sm-2 label-input">
                                    <label>Tên công ty</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="input" class="form-control input-info " name="name_company" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <div class="row">
                                <div class="col-sm-2 label-input">
                                    <label>Địa chỉ công ty</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="input" class="form-control input-info" name="address_company" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <div class="row">
                                <div class="col-sm-2 label-input">
                                    <label>Mã số thuế</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="input" class="form-control input-info" name="vat_code" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <div class="row">
                                <div class="col-sm-2 label-input">
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-danger btn-save-info" type="submit">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- Modal đổi sdt-->
<div class="modal fade" id="infoPhone" tabindex="-1" aria-labelledby="infoPhoneLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('customer-update-phone')}}" class="mt-3" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="infoPhoneLabel">Cập nhật số điện thoại</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(empty($customer->phone))
                    <input type="text" name="phone" class="form-control input-info input-change_phone  input-info__change" placeholder="Nhập số điện thoại bạn nào!!!"  required pattern="(\+84|0)\d{9}">
                    @else
                    <input type="text" name="phone" class="form-control input-info input-change_phone " value="{{$customer->phone}}"  required pattern="(\84|0)\d{9}">

                    @endif
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-secondary btn-close__info" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-change-info">Thay đổi</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal đổi email-->
<div class="modal fade" id="infoEmail" tabindex="-1" aria-labelledby="infoEmailLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoEmailLabel">Cập nhật Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control input-info input-info__change">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-close__info" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-change-info">Thay đổi</button>
            </div>
        </div>
    </div>
</div>