@extends('layouts.master')

@section('content')
<div id="customer-container">
    <div class="container mt-3 mb-5">
        <div class="row">
            <div class="col-lg-3 col-md-2 col-4 d-none d-sm-block">
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
            <div class="col-lg-9 col-md-10 col-12">
                <div class="profile">
                    <div class="pb-2"><span class="h5">ĐƠN HÀNG CỦA TÔI</span></div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col">
                            <h6 class="customer-name">THÔNG TIN VẬN CHUYỂN</h6>
                            <div class="row mt-3 customer-info-ship">
                                <div class="col-sm-6 col-12">
                                     <ul class="list-unstyled">
                                        <li class="pb-2"><b>Tên người giao hàng: </b>RBooks.vn</li>
                                        <li><b>SĐT người giao hàng: </b>08 4966 4005</li>
                                    </ul>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div><b>Trạng thái giao hàng:</b>
                                        @if( $detailOrder->status == '1' )
                                            <span class="text-info"> Đang soạn hàng</span>
                                        @elseif($detailOrder->status == '2')
                                            <span class="text-primary"> Đang vận chuyển</span>
                                        @elseif($detailOrder->status == '3')
                                            <span class="text-success"> Giao hàng thành công</span>
                                        @elseif($detailOrder->status == '4')
                                            <span class="text-danger"> Hủy đơn hàng</span>
                                        @endif
                                    </div>
                                    @if( $detailOrder->status == '1')
                                        <div>
                                            {{-- <button class="btn btn-danger" onclick="window.location.href = '{{ route('cancel-orders', ['id' => $detailOrder->id ]) }}'"> Hủy đơn hàng</button> --}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-4">
                        <div class="col-sm-6 col-12">
                            <h6 class="customer-name">ĐỊA CHỈ NGƯỜI NHẬN</h6>
                            @if($detailOrder->gift_address_id == 0)
                            <ul class="total-customer-order">
                                <li><b>Họ và tên: </b>{{ $detailOrder->deliveryAddress->fullname }}</li>
                                <li><b>Địa chỉ: </b>
                                    {{
                                        $detailOrder->deliveryAddress->address .' - phường '.
                                        $detailOrder->deliveryAddress->ward .' - quận '.
                                        $detailOrder->deliveryAddress->district .' - thành phố '. 
                                        $detailOrder->deliveryAddress->city
                                    }}
                                </li>
                                <li><b>Số điện thoại: </b>{{ $detailOrder->deliveryAddress->phone }}</li>
                            </ul>
                            @else
                            <ul class="total-customer-order">
                                <li><b>Họ và tên: </b>{{ $detailOrder->GiftAddress->recipientName }}</li>
                                <li><b>Địa chỉ: </b>
                                    {{
                                        $detailOrder->GiftAddress->address
                                    }}
                                </li>
                                <li><b>Số điện thoại: </b>{{ $detailOrder->GiftAddress->phone }}</li>
                            </ul>
                            @endif
                        </div>
                        <div class="col-sm-6 col-12">
                            <h6 class="customer-name">HÌNH THỨC GIAO HÀNG & THANH TOÁN</h6>
                            <ul class="total-customer-order">
                                <li><b>Hình thức giao hàng: </b>{{ ($detailOrder->ship_total == 20000) ? "Giao hàng tiêu chuẩn": "Giao hàng nhanh" }}</li>
                                <li><b>Hình thức thanh toán: </b>{{ ($detailOrder->payment_method == 1) ? "Thanh toán khi nhận hàng" : "Thanh toán chuyển khoản ngân hàng" }}</li>
                                <li><b>Tình trạng đơn hàng: </b>
                                    @if( $detailOrder->status == '1' )
                                        <span class="text-info">Đang soạn hàng</span>
                                    @elseif($detailOrder->status == '2')
                                        <span class="text-primary">Đang vận chuyển</span>
                                    @elseif($detailOrder->status == '3')
                                        <span class="text-success">Hoàn thành</span>
                                    @elseif($detailOrder->status == '4')
                                        <span class="text-danger">Đơn hàng đã hủy</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-3 product-list-purchased">
                        <div class="col-sm-12">
                            <h6 class="customer-name">DANH SÁCH SẢN PHẨM ĐÃ MUA</h6>
                            <table class="table table-striped table-hover list-pro-desktop">
                                <thead>
                                    <th>Thông tin sản phẩm</th>
                                    <th>Giá bán</th>
                                    <th>Giá khuyến mãi</th>
                                    <th>Số lượng</th>
                                    <th>Tạm tính</th>
                                </thead>
                                @foreach($detailOrder->products as $product)
                                <tbody>
                                    <td>
                                        <ul class="list-unstyled">
                                            <li> Mã sản phẩm: {{ $product->id }} </li>
                                            <li> Tên sách: {{ $product->name }}</li>
                                        </ul>
                                    </td>
                                    <td>{{ number_format($product->cover_price) }}</td>
                                    <td>{{ number_format($product->sale_price) }}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <td>{{ number_format($product->sale_price * $product->pivot->quantity) }}</td>
                                </tbody>
                                @endforeach
                                <tfoot>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <ul class="list-unstyled total-customer-order">
                                            <li>
                                                <b>Tổng tiền: </b>
                                            </li>
                                            <li>
                                                <b>Tiết kiệm: </b>
                                            </li>
                                            <li>
                                                <b>Thành tiền: </b>
                                            </li>
                                            <li>
                                                <b>Phí vận chuyển: </b>
                                            </li>
                                            @if($detailOrder->gift_fee == 20000)
                                            <li>
                                                <b>Phí gói quà</b>
                                            </li>
                                            @endif
                                            <li>
                                                <b>Tổng thành tiền: </b>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled total-customer-order">
                                            <li>
                                                {{ number_format($detailOrder->sub_total) }} đ
                                            </li>
                                            <li>
                                                {{
                                                    round((1-(($detailOrder->sub_total - $detailOrder->tax_total) / $detailOrder->sub_total)) * 100, 0)
                                                }}%
                                                ({{
                                                    number_format($detailOrder->tax_total)
                                                }} đ)
                                            </li>
                                            <li>
                                                {{ number_format($detailOrder->sub_total - $detailOrder->tax_total) }} đ
                                            </li>
                                            <li>
                                                {{ number_format($detailOrder->ship_total) }} đ
                                            </li>
                                            @if($detailOrder->gift_fee == 20000)
                                            <li>
                                                {{ number_format($detailOrder->gift_fee) }} đ
                                            </li>
                                            @endif
                                            <li class="h4 text-danger">
                                                {{ number_format($detailOrder->total) }} đ
                                            </li>
                                        </ul>
                                    </td>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div style="height: 20px;"></div>
            </div>
        </div>
    </div>
</div>
<hr>
@endsection
