@extends('layouts.master')

@section('content')
<div id="address-container">
    <div class="container">
        @if (session('alert'))
            <div class="row alert alert-danger mt-2 mb-0">
                {{ session('alert') }}
            </div>
        @endif
        <div class="row mb-5">
            <div class="col-lg-9 col-md-8 cart mt-3">
                <div class="p-1 product-page" id="header-cart">
                    {{ trans('home.GIỎ HÀNG') }} : {{ (!empty($cart)) ? "(" . $total['totalQuantity'] . ")" : "(0)" }} {{trans('home.sản phẩm')}}
                </div>
                @if($cart == null)
                    <hr>
                    <div class="text-center image-cart">
                        <img class="img-fluid" src="{{ asset('imgs/empty.png') }}" alt="">
                    </div>
                @else
                {{-- Vòng lặp --}}
                <hr>

                <table class="table-striped table-hover m-3 row d-none d-lg-block">
                    <div class="pt-1"><span class="alert-danger error"></span></div>
                    <tbody class="col-md-12 d-md-none d-lg-block">
                    @foreach($cart as $product)
                        <tr class="row header-cart" id="{{  $product['product']->id }}">
                            <td class="col-lg-2 col-md-2">
                                <a href="{{ route('product.index', ['id' => $product['product']->id , 'alias' =>$product['product']->slug ]) }}">
                                    <img class="p-1 img-fluid rbooks-img-product" img src="{{ empty($product['product']->images->last()) ? asset(RBOOKS_NO_IMAGE_URL) : RBOOKS_IMAGE_URL . $product['product']->images->last()->path }}" alt="">
                                </a>
                            </td>
                            <td class="col-lg-5 col-md-6 float-left mt-4">
                                <ul class="list-unstyled clearfix" id="cart-product">
                                    <li class="h6">
                                        <a href="{{ route('product.index', ['id' => $product['product']->id , 'alias' =>$product['product']->slug ]) }}">{{ $product['product']->name }}</a>
                                        </li>
                                    <li>Cung cấp bởi <a href="#">Rbooks</a></li>
                                    <li>
                                        <a class="float-left" href="{{ route('cart-remove', ['id' => $product['product']->id ]) }}">Xóa</a>
                                    </li>
                                </ul>

                            </td>
                            <td class="col-lg-2 col-md-2 col-6 pt-4">
                                <ul class="list-unstyled">
                                    <li class="h5">{{ number_format($product['product']->sale_price) }} ₫</li>
                                    <li><del>{{ number_format($product['product']->cover_price) }} ₫</del></li>
                                </ul>
                            </td>
                            <td class=" col-lg-3 col-md-2 col-6 mt-4">
                                <div class="btn-group float-right quantity-product">
                                    <button type="button" class="btn btn-number" data-type="minus">-</button>
                                    <input type="text" class="quantityWarehouse" name="quantityWarehouse" hidden="true" value="{{ $product['product']->product_warehouse->where('warehouse_id','2')->first()->quantity }}">
                                    <input type="number" class="input-number text-center" id="number-quantity" style="width: 50px" value="{{ $product['quantity'] }}" name="quantity" min="1" max="100" pattern="[0-9]*">
                                    <button type="button" class="btn btn-number" data-type="plus">+</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="bg-cart-page-mobile cart-droplist d-block d-md-block d-lg-none">
                    <!-- <div class="pt-1"><span class="alert-danger error"></span></div> -->
                    <div class="list-product-cart">
                        <ul class="list-product-item">
                            @foreach($cart as $product)
                            <li class="item header-cart d-flex align-items-center clearfix" id="{{  $product['product']->id }}">
                                <a href="{{ route('product.index', ['id' => $product['product']->id , 'alias' =>$product['product']->slug ]) }}">
                                    <img class="p-1 img-fluid rbooks-img-product" img src="{{ empty($product['product']->images->last()) ? asset(RBOOKS_NO_IMAGE_URL) : RBOOKS_IMAGE_URL . $product['product']->images->last()->path }}" alt="">
                                </a>
                                <div class="product-detail-item">
                                    <div class="product-detail-top">
                                        <a class="float-right" href="{{ route('cart-remove', ['id' => $product['product']->id]) }}"><i class="fas fa-trash"></i></a>
                                        <p class="product-name">{{ $product['product']->name }}</p>
                                    </div>
                                    <div class="product-detail-bottom" id="cart-product">
                                        <div class="list-unstyled">
                                            <span class="sale-price">{{ number_format($product['product']->cover_price) }} ₫</span>
                                            <span class="final-price">{{ number_format($product['product']->sale_price) }} ₫</span>
                                        </div>
                                        <div class="btn-group float-right quantity-product">
                                            <button type="button" class="btn btn-number" data-type="minus">-</button>
                                            <input type="text" class="quantityWarehouse" name="quantityWarehouse" hidden="true" value="{{ $product['product']->product_warehouse->where('warehouse_id','2')->first()->quantity }}">
                                            <input type="number" class="input-number text-center" id="number-quantity" style="width: 50px" value="{{ number_format($product['quantity']) }}" name="quantity" min="1" max="100" pattern="[0-9]*">
                                            <button type="button" class="btn btn-number" data-type="plus">+</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
            {{-- Hết vòng lặp --}}

            <div class="col-lg-3 col-md-4 mt-3 right-cart">
                <div class="list-info-price">
                    <div class="h5 text-dark p-2" id="title-cart">{{ trans('home.Thông tin thanh toán') }}</div>
                    <div class="p-2">{{ trans('home.Tổng tiền') }}: <b><span class="float-right" id="top_total">
                    {{ (!empty($cart)) ? number_format($total['total_cv_price'] ) : 0 }} đ
                    </span></b></div>
                    <div class="p-2">{{ trans('home.Tiết kiệm') }}:
                        <b>
                            @if($cart == null)
                                <span class="text-danger float-right" id="save_total">
                                    (0 đ)
                                </span>
                                <span class="float-right price_sale mr-2" id="">
                                    0%
                                </span>
                            @else

                                <span class="text-danger float-right" id="save_total">
                                    ({{ number_format($total['save_total']) }} đ)
                                </span>
                                <span class="float-right price_sale mr-2" id="">
                                    - {{ round((1-($total['totalPrice'] / $total['total_cv_price'])) * 100, 0) }}%
                                </span>

                            @endif
                        </b>
                    </div>
                    <div class="p-2">{{ trans('home.Tạm tính') }}: <b><span class="float-right" id="sub_total">{{ (!empty($cart)) ? number_format($total['totalPrice']) : 0 }} đ</span></b></div>
                    <div class="p-2 border-top mt-4">
                        {{ trans('home.Thành tiền cart') }}: <span class="total-price-cart float-right align-middle" id="total">{{ (!empty($cart)) ? number_format($total['totalPrice']) : 0 }} đ</span>
                    </div>
                    <div class="p-2" style="color: red; text-align: justify;">(Miễn phí giao hàng toàn quốc cho tất cả đơn hàng từ 200.000 VNĐ.)</div>
                </div>
                <div class="mt-3 text-center">
                    <button type="button" class="btn btn-xs btn-cart" onclick="window.location.href = '{{ route('shipping') }}'" id="btn-buy-cart" {{ (!empty($cart)) ? "" : "disabled" }}>{{ trans('home.Tiến hành đặt hàng') }}</button>
                </div>
                <!--<div class="mt-3 text-center">
                    <button type="button" class="btn btn-thank btn-cart">Gửi quà tặng</button>
                </div>-->
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-9 col-md-8 form-gift">
                <div class="book-seen-cart h4 pl-2">{{ trans('home.SÁCH ĐỀ XUẤT') }}</div>
                <div class="row category-books-row">
                    {{-- Lặp Sản phẩm đề xuất --}}
                    @foreach($suggest as $product)
                    <div class="col-lg-3 col-md-6 col-6 category-books">
                        @include('pages.homecontroller.product-a-page')

                    </div>
                    @endforeach
                    {{-- Hết lặp --}}
                </div>
            </div>
            <div class="col-lg-3 col-md-4 list-product-seen">
                <div class="h5"><span>{{ trans('home.Sản phẩm đã xem') }}</span></div>
                <hr>
                <!-- <ul class="list-unstyled">
                    {{-- Lặp Sản phẩm đã xem --}}
                    @foreach($seenProducts as $product)
                    <li class="row m-1 pt-2 pb-2">
                        <div class="col-md-5">
                            <a href="{{ route('product.index', ['id' => $product->id, 'alias' =>$product->slug ]) }}">
                                <img src="{{ empty($product->images->last()) ? asset(RBOOKS_NO_IMAGE_URL) : RBOOKS_IMAGE_URL . $product->images->last()->path }}" class="img-fluid">
                            </a>
                            @if(!empty($product->sale_price) && $product->sale_price != 0)
                                <div class="coupon-home">{{ round(100 - ($product->sale_price / $product->cover_price * 100), 0) }}%</div>
                            @endif
                        </div>
                        <div class="col-md-7 pl-0">
                            <div class="product-name pt-3">
                                <span class="text-dark h6"><a href="{{ route('product.index', ['id' => $product->id, 'alias' =>$product->slug ]) }}"><p class="product-name">{{ $product->name }}</p></a></span>
                            </div>
                            <div class="price">
                                @if(!is_null($product->sale_price))
                                    <span class="price float-right"><del>{{ number_format($product->cover_price) }}</del> đ</span>
                                    <span class="h6 text-danger final-price">{{ number_format($product->sale_price) }} đ</span>
                                @else
                                    <span class="text-danger final-price">{{ number_format($product->cover_price) }} đ</span>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
                    {{-- Hết lặp --}}

                </ul> -->

                <ul class="book-list list-unstyled">
                    @foreach($seenProducts as $product)
                    <li class="product-hover p-1">
                        <div class="thumbnail img-home">
                            <a href="{{ route('product.index', ['id' => $product->id, 'alias' =>$product->slug ]) }}">
                                <img src="{{ empty($product->images->last()) ? asset(RBOOKS_NO_IMAGE_URL) : RBOOKS_IMAGE_URL . $product->images->last()->path }}" class="img-fluid img-home">
                            </a>
                            @if(!empty($product->sale_price) && $product->sale_price != 0)
                                <div class="coupon-home">{{ round(100 - ($product->sale_price / $product->cover_price * 100), 0) }}%</div>
                            @endif
                        </div>
                        <div class="content">
                            <h4><a href="{{ route('product.index', ['id' => $product->id, 'alias' =>$product->slug ]) }}"><p class="product-name">{{ $product->name }}</p></a></a></h3>
                            <div id="author"></div>
                            <p><span class="price">{{ number_format($product->cover_price) }} đ</span><span class="final-price">{{ number_format($product->sale_price) }} đ</span></p>
                        </div>
                    </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function(){
        $('.header-cart').mousedown(function(e){
            e.preventDefault();

            var id = $(this).attr('id');
            var input = $(this).find('#number-quantity');
            var quantityWarehouse =  $(this).find('.quantityWarehouse').val();
            var currentVal = parseInt(input.val());

            $(this).find('.btn-number').unbind().click(function(e){
                e.preventDefault();
                type = $(this).attr('data-type');

                if (!isNaN(currentVal)) {
                    if(type == 'minus') {
                        if(currentVal > input.attr('min')) {
                            input.val(currentVal - 1);

                            changeInputQuantity(id, currentVal - 1, quantityWarehouse);
                        }
                    } else {
                        if(currentVal < input.attr('max')) {
                            input.val(currentVal + 1);

                            changeInputQuantity(id, currentVal + 1, quantityWarehouse);
                        }
                    }
                } else {
                    input.val(0);
                }
            });
        });

        function changeInputQuantity(id, quantity, quantityWarehouse) {
            if(parseInt(quantity) > parseInt(quantityWarehouse)) {
                $('.error').text('Số lượng bạn nhập nhiều hơn tồn kho');
                // $('#error-mobile').text('Số lượng bạn nhập nhiều hơn tồn kho');
            }
            else {
                $.get('{{ route('cart-update') }}' , { id: id, quantity: quantity }, function(data) {
                  let total_cv_price = formatNumber(data.total_cv_price);
                  $('#header-cart').html('GIỎ HÀNG : '+ '(' + data.totalQuantity + ')' + ' sản phẩm');
                  $('#top_total').html(formatNumber(total_cv_price) + ' đ');
                  $('#save_total').html(formatNumber('('+ data.save_total +' đ)'));
                  $('#sub_total').html(formatNumber(data.totalPrice) + ' đ');
                  $('#total').html(formatNumber(data.totalPrice) + ' đ');
                });
                $('.error').text('');

            }
        }

        function formatNumber (num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
        }

        $('#btn-coupon').click(function(){
            var key = $('#key-coupon').val();
            console.log(key);
        });
    });
</script>
@endsection
