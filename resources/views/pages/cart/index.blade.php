@extends('layouts.master')

@section('content')
<div class="section address-container" style="background-color: #f5f5f5;">
    <div class="container">
        @if (session('alert'))
        <div class="row alert alert-danger mt-2 mb-0">
            {{ session('alert') }}
        </div>
        @endif
        <div class="row">
            <!-- Cart detail -->
            <div class="col-lg-9 col-md-8 cart mt-3">
                <div class="title-cart" id="header-cart">
                    <h5>Giỏ hàng</h5>
                </div>
                @if($cart == null)
                <div class="text-center image-cart">
                    <img class="img-fluid" src="{{ asset('imgs/shopping-trolley.png') }}" alt="">
                </div>

                @else
                {{-- Vòng lặp --}}
                <table class="table-titlecart" width="100%">
                    <thead>
                        <tr>
                            <th class="text-start" width="40%">Sản phẩm</th>
                            <th width="15%">Đơn giá</th>
                            <th width="15%">Số lượng</th>
                            <th width="15%">Thành tiền</th>
                            <th>
                                <form method="POST" action="{{ route('cart-delete')}}" style="cursor:pointer;">
                                    @csrf
                                    @method ('DELETE')
                                    <div class="delete-all-confirm">
                                        Xóa tất cả
                                </form>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp  
                        @foreach($cart as $product)
                        <tr class="order-list" data-id="{{ $i++ }}">
                            <td class="order-list-book">
                                <div class="table-passion-book">
                                    <a href="{{ route('product.index', ['id' => $product['product']->id , 'alias' =>$product['product']->slug ]) }}">
                                        <img class="img-fluid rbooks-img-product" img src="{{ empty($product['product']->images->last()) ? asset(RBOOKS_NO_IMAGE_URL) : RBOOKS_IMAGE_URL . $product['product']->images->last()->path }}" alt="">
                                        <p class="book-title">{{ $product['product']->name }}</p>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <ul class="list-unstyled">
                                    <li class="price">{{ number_format($product['product']->cover_price,0,",",".") }} ₫</li>
                                    <li class="reduce">
                                        <i class="fa-solid  fa-arrow-trend-down"></i> Giá giảm {{ round(100 - ($product['product']->sale_price / $product['product']->cover_price * 100), 0) }}%
                                    </li>
                                    <!-- Giá khuyến mãi -->
                                    <input type="hidden" class="final-price" value="{{ number_format($product['product']->sale_price,0,',','.') }} ₫" hidden="true">
                                    <!-- Giá khuyến mãi -->
                                </ul>
                            </td>
                            <td>
                                <div class="group-quantity-cart btn-group">
                                    <button type="button" class="btn btn-number minus" data-type="minus"><i class="fa-solid fa-minus"></i></button>
                                    <input type="text" class="input-number {{ $i-1 }} text-center" id="number-quantity" value="{{ number_format($product['quantity']) }}" name="quantity" min="1" max="99" pattern="[0-9]*">
                                    <button type="button" class="btn btn-number plus" data-type="plus"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </td>
                            <td>
                                <p class="total" style="display: inline-block; color: #0578c4;">{{number_format($product['quantity']*$product['product']->sale_price,0,",",".")}} ₫</p>
                                <!-- Tổng tiền giá bìa -->
                                <input type="hidden" class="provisional" value='{{number_format($product["quantity"]*$product["product"]->cover_price,0,",",".")}} ₫'>
                                <!-- Tổng tiền giá bìa -->
                            </td>
                            <td>
                                <form method="POST" action="{{ route('cart-remove', ['id' => $product['product']->id ])}} ">
                                    @csrf
                                    @method ('DELETE')
                                    <div class=" delete-confirm" data-name="{{$product['product']->name}}">
                                        <i style="cursor:pointer;" class="fa-solid fa-trash-can"></i>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            {{-- Hết vòng lặp --}}

            <div class="col-lg-3 col-md-4 mt-3 right-cart">
                <div class="list-info-price">
                    @if(Auth::id())
                    <div class="list-info-pricei-title" id="title">
                        Giao tới

                        <button type="button" class="float-right btn btn-default"><a href="{{ route('customer-addresses') }}" style="color: #0578c4;"> Thay đổi</a></button>
                    </div>
                    <hr>
                    <input type="text" name="address_id" hidden="true">
                    <div>
                        <ul class="list-unstyled p-2">
                            <div class="customer-name-phone">
                                <li class="customer-name">
                                    {{$customer->fullname }}
                                </li>
                                <li>
                                    <span class="compartment"></span>
                                    <span class="textarea customer-phone">
                                        {{$customer->phone ?? 'Chưa có số điện thoại'}}
                                    </span>
                                </li>
                            </div>
                            <li>
                                <span class="textarea customer-address">{{$customer_address->address ?? 'Địa chỉ còn thiếu'}}</span>
                            </li>
                        </ul>
                        @else
                        <div class="list-info-pricei-title" id="title">
                            Giao tới

                        </div>
                        <hr>
                        <input type="text" name="address_id" hidden="true">
                        <div>
                            <ul class="list-unstyled p-2">
                                <div class="customer-name-phone">
                                    <li class="customer-name"><b>Họ và tên</b></li>
                                    <li>
                                        <span class="compartment"></span>
                                        <span style="cursor:pointer ;" class="textarea customer-phone" data-bs-toggle="modal" data-bs-target="#modalLogin"> Yêu cầu phải đăng nhập</span>
                                    </li>
                                </div>
                                <li>
                                    <span class="textarea customer-address">Yêu cầu phải đăng nhập</span>
                                </li>
                            </ul>
                            @endif
                        </div>
                    </div>
                    <div class="billing-information">
                        <div class="text-dark p-2" id="title-cart">Thông tin đơn hàng</div>
                        <div class="p-2 d-flex">
                            <div class="billing col-sm-8">Số lượng</div>
                            <div class="col-sm-4">
                                <span class="float-right" id="top_total"> {{ (!empty($cart)) ?  $total['totalQuantity'] : "(0)" }}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="p-2 d-flex">
                            <div class="billing col-sm-8">{{ trans('home.Tạm tính') }}</div>
                            <div class="col-sm-4">
                                <span class="float-right" id="sub_total">{{ (!empty($cart)) ? number_format($total['total_cv_price'],0,",",".") : 0 }} ₫</span>
                            </div>
                        </div>
                        <hr>
                        <div class="p-2 d-flex">
                            <div class="billing col-sm-8">{{ trans('home.Tiết kiệm') }}</div>
                            <div class="col-sm-4">
                                @if($cart == null)
                                <span class="text float-right" id="save_total" style="color: #fb5153;">
                                    (0 đ)
                                </span>
                                @else
                                <span class="text float-right" id="save_total" style="color: #fb5153;">{{ number_format($total['save_total'],0,",",".") }} đ</span>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="p-2 d-flex">
                            <div class="billing col-sm-7">{{ trans('home.Thành tiền cart') }} </div>
                            <div class="total-price col-sm-5">
                                <span class="total-price-cart float-right align-middle" id="total">{{ (!empty($cart)) ? number_format($total['totalPrice'],0,",",".") : 0 }} ₫</span>
                            </div>
                        </div>
                    </div>
                    <div class="btn-purchase">
                        <button class="btn-keep-buying"><a href="{{ route('products') }}" style="color: #0578c4;">Tiếp tục mua hàng</a> </button>
                        <button class="btn-pay" onclick="window.location.href = '{{ route('shipping') }}'" id="btn-buy-cart" {{ (!empty($cart)) ? "" : "disabled" }}> Thanh toán</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script src="{{ asset('/js/quantity-cart.js') }}"></script>

    <script>
        $('.delete-confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Bạn có muốn xóa quyển sách: ${name}?`,
                    buttons: ["Hủy", "Xóa"],
                    dangerMode: true,
                    className:"btn-del-cart"
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
    <script>
        $('.delete-all-confirm').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            swal({
                    title: `Bạn có muốn xóa tất cả sách trong giỏ hàng?`,
                    buttons: ["Hủy", "Xóa"],
                    dangerMode: true,
                    className:"btn-del-cart"
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
    <script>
        @if(session('error')) {
            toastr.error('{{session("error")}}');
        }
        @endif
    </script>
@endsection