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
                    <div class="pb-2"><span class="h5">{{ trans('home.ĐƠN HÀNG CỦA TÔI') }}</span></div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ trans('home.Mã hàng') }}</th>
                                <th>{{ trans('home.Ngày mua') }}</th>
                                <th>{{ trans('home.PT thanh toán') }}</th>
                                <th>{{ trans('home.Tổng tiền') }}</th>
                                <th>{{ trans('home.Trạng thái') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Vòng lặp --}}
                            @foreach($orders as $order)
                            <tr>
                                <td><a href="{{ route('detail-order', [ 'id' => $order->id ]) }}">{{ $order->order_number }}</a></td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    @switch($order->payment_method)
                                        @case(1)
                                            {{ trans('home.Thanh toán tiền mặt khi nhận hàng') }}
                                            @break;
                                        @case(2)
                                            {{ trans('home.Thanh toán bằng chuyển khoản ngân hàng') }}
                                            @break;
                                    @endswitch
                                </td>
                                <td>{{ number_format($order->total) }} VNĐ</td>
                                <td>
                                    @switch($order->status)
                                        @case(1)
                                            <span class="alert-info">{{ trans('home.Đang soạn hàng') }}</span>
                                            @break;
                                        @case(2)
                                            <span class="alert-warning">{{ trans('home.Đang vận chuyển') }}</span>
                                            @break;
                                        @case(3)
                                            <span class="alert-success">{{trans('home.Giao hàng thành công') }}</span>
                                            @break;
                                        @case(4)
                                            <span class="alert-danger">{{ trans('home.Hủy đơn hàng') }}</span>
                                            @break;
                                    @endswitch
                                
                                </td>
                            </tr>
                            @endforeach
                            {{-- Hết vòng lặp --}}
                        </tbody>
                    </table>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <div class="pagination-container text-center border-top">
                            <div class="center-pagination">
                                <nav aria-label="Page navigation example">
                                    <!-- <ul class="pagination pagination-sm pt-2"> -->
                                    {{ $orders->links("pagination::bootstrap-4") }}
                                    <!-- </ul> -->
                                </nav>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
@endsection
