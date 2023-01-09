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
                    <div class="pb-2"><span class="h5">{{ trans('home.SỔ ĐỊA CHỈ') }}</span></div>
                    <hr>
                    @if(session('thongbao'))
                            <div class= "alert alert-success">
                                {{session('thongbao')}}
                            </div>
                    @endif
                    <div class="pl-3 change-address">{{ trans('home.Bạn muốn giao hàng đến địa chỉ khác?') }} <a href="{{ route('create-address') }}">{{ trans('home.Thêm địa chỉ giao hàng mới') }}</a>
                    </div>
                    @foreach($customer->addresses as $address)
                        @if($address->default == 1)
                        <div class="customer-address-default mt-4">
                            <form action="{{ route('checkout-process') }}" role='form' method="post">
                                {{ csrf_field() }}
                                <input type="text" name="id" value="{{ $address->id }}" hidden="true">
                                <div class="customer-name">{{ $address->fullname }}<span class="small text-muted"> ({{ trans('home.mặc định') }})</span></div>
                                <div class="customer-address">{{ trans('home.Địa chỉ') }} {{ $address->address }}</div>
                                <div class="customer-number">{{ trans('home.Điện thoại') }} {{ $address->phone }}</div>
                                <div class="btn-address">
                                    <button type="button" class="btn btn-default" onclick="window.location.href='{{ route('edit-address', ['id' => $address->id ]) }}'" {{ $address->default != 1 ? "hidden = 'true'" : '' }}>{{ trans('home.Sửa') }}</button>
                                </div>
                            </form>
                        </div>
                        @else
                        <div class="customer-address-nodefault mt-4">
                            <form action="{{ route('checkout-process') }}" role='form' method="post">
                                {{ csrf_field() }}
                                <input type="text" name="id" value="{{ $address->id }}" hidden="true">
                                <div class="customer-name">{{ $address->fullname }}</div>
                                <div class="customer-address">{{ trans('home.Địa chỉ') }} {{ $address->address }}, {{ $address->ward }}, {{ $address->district }}, {{ $address->city }} </div>
                                <div class="customer-number">{{ trans('home.Điện thoại') }} {{ $address->phone }}</div>
                                <div class="btn-address">
                                    <button type="button" class="btn btn-default" onclick="window.location.href='{{ route('edit-address', ['id' => $address->id ]) }}'" {{ $address->default == 1 ? "hidden = 'true'" : '' }}> {{ trans('home.Địa chỉ mặc định') }}</button>
                                    <!-- <button type="button" class="btn btn-default">{{ $address->default == 1 ? 'Giao hàng' : 'Địa chỉ mặc định' }}</button> -->
                                    <button type="button" class="btn btn-default" onclick="window.location.href='{{ route('edit-address', ['id' => $address->id ]) }}'" {{ $address->default == 1 ? "hidden = 'true'" : '' }}>{{ trans('home.Sửa') }}</button>
                                    <button type="button" class="btn btn-default" onclick="window.location.href='{{ route('delete-address', ['id' => $address->id ]) }}'" {{ $address->default == 1 ? "hidden = 'true'" : '' }}>
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
@endsection
