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
                    <div class="card account-body order-info">
                        <div class="card-header">
                            <h4 class="info-title">Quản lý đơn hàng</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" >
                                <thead class="table-thead">
                                    <tr>
                                        <th scope="col" >Mã đơn hàng</th>
                                        <th style="width: 15%;">Ngày mua</th>
                                        <th scope="col" >PT thanh toán</th>
                                        <th scope="col">Tổng tiền</th>
                                        <th scope="col" >Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody class="table-body">
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            <a class="text-primary text-uppercase" href="{{ route('detail-order', [ 'id' => $order->id ]) }}">
                                                {{ $order->order_number }}
                                            </a>
                                        </td>
                                        <td style="word-break: break-word;">{{ $order->created_at }}</td>
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
                                        <td class="text-primary">{{ number_format($order->total) }} đ</td>
                                        <td align="right">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="customer-container" style="display: none">
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
                <div class="order-info">
                    <div class="pb-1 manage-order"><span class="h5">Quản Lý Đơn Hàng</span></div>
                    <hr>
                    <table class="table table-striped" >
                        <thead class="table-thead">
                            <tr>
                                <th scope="col" >Mã đơn hàng</th>
                                <th scope="col" >Ngày mua</th>
                                <th scope="col" >PT thanh toán</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col" >Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <tr>
                                <td class="text-primary text-uppercase">QWEERTER</td>
                                <td>12/1231</td>
                                <td>thamh toán tiền mặt khi nhận hàng</td>
                                <td class="text-primary">123455</td>
                                <td align="right">
                                    <span class="alert-info" >Đang soạn hàng</span>
                                </td>
                            </tr>
                            <tr>    
                                <td class="text-primary text-uppercase">QWEERTW</td>
                                <td>12/1231</td>
                                <td>thamh toán tiền mặt khi nhận hàng</td>
                                <td class="text-primary">123455</td>
                                <td align="right">
                                     <span class="alert-warning">Đang vận chuyển</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-primary text-uppercase">QWEERTWER</td>
                                <td>12/1231</td>
                                <td>thamh toán tiền mặt khi nhận hàng</td>
                                <td class="text-primary">123455</td>
                                <td align="right">
                                     <span class=" alert-success">Giao hàng thành công</span>   
                                </td>
                            </tr>
                            <tr class="table-tbody-tr">
                                <td class="text-primary text-uppercase">QWEERTW</td>
                                <td>12/1231</td>
                                <td>thamh toán tiền mặt khi nhận hàng</td>
                                <td class="text-primary">123455</td>
                                <td align="right">
                                 <span class=" alert-danger">Hủy đơn hàng</span> 
                                </td>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
                <!-- <div class="row mt-3">
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
@endsection
