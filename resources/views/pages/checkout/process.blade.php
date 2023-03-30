@extends('layouts.master')

@section('content')
<div id="address-container">
    <form action="{{ route('checkout-processing') }}" role="form" method="post">
        {{ csrf_field() }}
        <div class="container pb-5">
            <div class="row process">
                <div class="col-sm-9 col-12 d-flex align-items-center clearfix process-header">
                    <div class="process-img float-left"><img src="{{ asset('imgs/logo_delevery_blue.png') }}" alt=""></div>
                    <span class="process-title ml-3">{{ trans('home.BƯỚC 3: ĐẶT MUA VÀ THANH TOÁN') }}</span>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-8 col-md-7 col-12 container-process">
                    <div class="h4 fz-title-process"><i class="fa-solid fa-truck checkout-icon-process"></i><span class="fw-bold">Chọn hình thức giao hàng</span></div>
                    <hr>
                    <div class="delevery_method">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="Checked" value="20000" name="delevery_method" checked="checked">
                            <label class="custom-control-label" for="Checked">{{ trans('home.Giao hàng tiêu chuẩn') }}</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="unchecked" value="25000" name="delevery_method">
                            <label class="custom-control-label" for="unchecked">{{ trans('home.Giao hàng nhanh') }}</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="unchecked-vin" value="0" name="delevery_method">
                            <label class="custom-control-label" for="unchecked-vin">{{ trans('home.Giao hàng Vinhomes Central Park') }}</label>
                        </div>
                        @if($total['totalQuantity'] < 2)
                            @foreach($carts as $cart)
                                @if($cart['product']['id'] == 1926)
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="getBook" value="{{ $address->city == 'Hồ Chí Minh' ? '30000' : 45000 }}" name="delevery_method">
                                    <label class="custom-control-label" for="getBook">{{ trans('home.Nhận sách miễn phí') }} (Tặng 1 cuốn sách "14 bí mật gia tăng tài chính mỗi ngày")</label>
                                </div>
                                @endif
                            @endforeach
                        @endif
                    </div>

                    <div class="h4 fz-title-process mt-5"><i class="fa-solid fa-credit-card checkout-icon-process"></i><span class="fw-bold">Chọn hình thức thanh toán</span></div>
                    <hr>
                    <div class="payment_method">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="payment_method_checked" value="1" name="payment_method" checked>
                            <label class="custom-control-label" for="payment_method_checked">{{ trans('home.Thanh toán tiền mặt khi nhận hàng') }}</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="payment_method_unchecked" value="2" name="payment_method">
                            <label class="custom-control-label" for="payment_method_unchecked">{{ trans('home.Thanh toán bằng chuyển khoản ngân hàng') }}</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="payment_method_unchecked" value="3" name="payment_method">
                            <label class="custom-control-label" for="payment_method_unchecked">Thanh toán qua ngân lượng</label>
                        </div>
                    </div>
                    <div class="custom-control custom-checkbox vat_method mt-4 mr-sm-2">
                        <input type="checkbox" class="custom-control-input" id="customControlVAT" name="checkVat">
                        <label class="custom-control-label" for="customControlVAT">{{ trans('home.Thông tin xuất hóa đơn VAT') }}</label>
                    </div>

                    <div class="content-vat">
                        <div class="vat-default" style="display:none">
                            <div class="row vat-name-company mb-4">
                                <div class="col-md-4 label-input-process"><b>Tên công ty </b>:</div>
                                <div class="col-md-8">
                                    <input type="text" placeholder="Ít nhất 2 từ" name="name_company" 
                                    id="name_company" class="form-control input-checkout" value="" minlength="2" maxlength="300" novalidate >
                                </div>
                            </div>
                            <div class="row vat-tax-code mb-4">
                                <div class="col-md-4 label-input-process"><b>Mã số thuế </b>:</div>
                                <div class="col-md-8">
                                    <input type="text" placeholder="Mã số thuế" name="code_vat" id="code_vat" class="form-control input-checkout" value="" minlength="10" novalidate >
                                </div>
                            </div>
                            <div class="row vat-address">
                                <div class="col-md-4 label-input-process"><b>Địa chỉ</b>:</div>
                                <div class="col-md-8">
                                    <input type="text" name="vat_address" placeholder="Nhập địa chỉ công ty( Bao gồm Phường/Xã, Quận/Huyện, Tỉnh/Thành phố nếu có)" id="address_vat" class="form-control input-checkout" maxlength="500"></input>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="custom-control mt-3 custom-checkbox gift_method mr-sm-2">
                        <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="check">
                        <label class="custom-control-label" for="customControlAutosizing">{{ Trans('home.Gửi quà tặng đến bạn bè, người thân') }}</label>
                    </div>

                    <div class="content-gift">
                        <div class="h4 label-gift-info">{{ Trans('home.Thông tin quà tặng') }}</div>
                        <!-- @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                {{$err}}<br>
                                @endforeach
                            </div>
                        @endif -->
                        <div class="gift-default ">
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" value="20000" name="gift_fee" class="custom-control-input" id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">Thiệp mừng + Gói quà <span style="font-weight: bold;">(20.000đ)</span></label>
                                <p class="des-gift">* Thiệp mừng được chọn ngẫu nhiên trong 100 mẫu do RBooks thiết kế.</p>
                            </div>
                            <div class="row gift-from-to mb-4">
                                <div class="col-md-4 title-from label-input-process"><b>Gửi từ </b>:</div>
                                <div class="col-md-3">
                                    <input type="text" placeholder="Tên người gửi" name="sendername" id="from_birthday" class="form-control input-checkout" value="" minlength="1" maxlength="30" >
                                </div>
                                <div class="col-lg-2 col-md-4 title-to label-input-process label-process__reciever"><b>Tới </b>:</div>
                                <div class="col-md-3">
                                    <input type="text" placeholder="Tên người nhận" name="recipientname" id="to_birthday" class="form-control input-checkout" value="" minlength="1" maxlength="30" >
                                </div>
                            </div>
                            <div class="row gift-address mb-4">
                                <div class="col-lg-4 col-md-4 label-input-process"><b>Địa chỉ người nhận </b>:</div>
                                <div class="col-md-8">
                                    <input type="text" placeholder="Địa chỉ người nhận" name="address_to" id="address" class="form-control input-checkout" value="" minlength="10" maxlength="300" >
                                </div>
                            </div>
                            <div class="row gift-number mb-4">
                                <div class="col-lg-4 col-md-4 label-input-process"><b>Số điện thoại </b>:</div>
                                <div class="col-md-8">
                                    <input type="text" placeholder="Số điện thoại người nhận" name="phone_to" id="number" class="form-control input-checkout" value="" required pattern="(\+84|0)\d{9}" >
                                </div>
                            </div>
                            <div class="row gift-message">
                                <div class="col-lg-4 col-md-4 label-input-process"><b>Lời nhắn </b>:</div>
                                <div class="col-md-8">
                                    <textarea  type="text" name="message"  placeholder="Ví dụ: Chúc mừng sinh nhật bạn. (Tối đa 500 ký tự)" id="mess_birthday" class="form-control input-checkout" maxlength="500" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="h4 p-3">{{ trans('home.3. Thông tin liên hệ') }}</div> -->
                    
                </div>
                <div class="col-lg-4 col-md-5 col-12" style="padding-left:2rem">
                    <div class="total_cart form-coupon total_cart--info">
                        <div class="process-address">
                            <div class="process-address-title " id="title">Giao tới @if(Auth::check())<button type="button" class="float-right btn btn-default"  onclick="window.location.href='{{ route('edit-address', ['id' => $address->id ]) }}'">Thay đổi</button>@endif</div>
                            <hr>
                            <input type="text" name="address_id" hidden="true" value="{{ $address->id }}">
                            <div >
                                <ul class="list-unstyled p-2">
                                    <div class="customer-name-phone">
                                        <li class="customer-name"><b>{{ $address->fullname }}</b></li>
                                        <input id="phone-customer-checkout" type="hidden" value="{{ $address->phone }}">
                                        <li ><span class="vertical-line"></span><span class="textarea customer-phone" > {{ $address->phone }}</span></li>
                                    </div>
                                    @if($address->ward == NULL && $address->district == NULL && $address->city == NULL)
                                        <li ></b><span class="textarea customer-address"> {{ $address->address }}</span></li>
                                    @else
                                        <li ></b><span class="textarea customer-address"> {{ $address->address }}, {{ trans ('home.phường')}} {{ $address->ward }}, {{ trans('home.quận')}} {{ $address->district }}, {{ $address->city }}</span></li>
                                    @endif
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="total_cart process-price form-coupon">
                        <div class="product-price">
                            <div class="product-price-title" id="title">Thông tin đơn hàng</div>
                            
                            <div id="price">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="col-sm-8">Số lượng</div> 
                                        <div class="col-sm-4">{{ $total['totalQuantity'] }}</div>
                                    </li>

                                    <!-- <li ><b>{{ trans('home.Tổng tiền') }}: <span class="float-right top-total">{{ number_format($total['total_cv_price'] ) }} đ</span></b></li> -->

                                    <li >
                                        <div class="col-sm-8">{{ trans('home.Tiết kiệm') }}</div> 
                                        <div class="float-right price_sale col-sm-4" id="discount" data-dis="{{ round((1-($total['totalPrice'] / $total['total_cv_price'])) * 100, 0) }}%"><span  >{{ number_format($total['total_cv_price'] - $total['totalPrice']) }} đ</span></span></li>

                                    <li >
                                       <div class="col-sm-8">Tạm tính</div>
                                       <div class="float-right price_sell col-sm-4" id="prices" data-price="{{ $total['totalPrice'] }}" style="color: #000; font-size: 14px;">
                                    {{ number_format($total['totalPrice']) }} đ</div></li>

                                    <!-- <li ><b>{{ trans('home.Phí vận chuyển:') }} <span class="float-right price_sell" id="fee-ship" style="color: #000; font-size: 14px;"></span></b></li> -->

                                    <li class="gift-fee" style="display: none;"><b>{{ trans('home.Phí gói quà:') }} <span class="float-right gift-fee-package" id="gift-fee-id" ></span></b></li>
                                    
                                    <li style="border:none" >
                                        <div class="col-sm-8">Tổng tiền</div> 
                                        <span class="float-right price_sell price_sell--total" id="total">{{ number_format($total['totalPrice']) }} đ</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="btn-process-checkout">
                        <button type="button" class="btn btn-default btn-process-continue"  onclick="window.location.href='/'">Tiếp tục mua hàng</button>
                        <button type="submit" class="btn btn-danger btn-process-buynow" id="btn-order">Thanh toán</button>
                    
                    </div>
                    
                    <div class="form-coupon process-discount">
                    <div class="process-discount-title">{{ trans('home.Mã giảm giá / Quà tặng') }}</div>
                    
                    <div class="input-group input-group-discount">
                        @if(!isset($total['coupon']))
                            <input type="text" name="key-coupon" class="form-control input-coupon-process" id="key-coupon">
                            <div class="input-group-append">
                                <button id="btn-coupon" class="btn btn-default btn-coupon-process" type="button">{{ trans('home.Áp dụng') }}</button>
                            </div>
                        @endif
                    </div>
                    @if(isset($total['coupon']))
                        <div class="alert-success mt-3 text-center p-2"><span>{{ trans('home.Đã sử dụng coupon') }}</span></div>
                    @endif
                    <div class="alert-info mt-3"><span id="message"></span></div>
                </div>
                </div>
            </div>

        </div>
    </form>
</div>
<hr>
@endsection

@section('script')

<script>
    $(function(){
        $('#customControlAutosizing').click(function() {
            var checkbox_gift = $('#customControlAutosizing').prop("checked");
            if (checkbox_gift) {
                $('.content-gift').slideDown();
                $('#from_birthday').prop('required','required');
                $('#to_birthday').prop('required','required');
                $('#number').prop('required','required');
                $('#address').prop('required','required');
                $('#message_birthday').prop('required','required');
            }else{
                $('.content-gift').slideUp();
                $('#from_birthday').removeAttr('required');
                $('#to_birthday').removeAttr('required');
                $('#number').removeAttr('required');
                $('#address').removeAttr('required');
                $('#message_birthday').removeAttr('required');
            }
        })
        var giftfee = $('#customControlInline:checked').val();
        if (giftfee) {
            $('.gift-fee').show();
            $('#gift-fee-id').text("20,000 đ");
        }
        var giftshow = $('#customControlAutosizing:checked').val();
        if (giftshow) {
            $('.content-gift').slideDown();
            $('#from_birthday').prop('required','required');
            $('#to_birthday').prop('required','required');
            $('#number').prop('required','required');
            $('#address').prop('required','required');
            $('#message_birthday').prop('required','required');
        }

        function checkDelivery($data) {
            var prices = parseInt($('#prices').attr('data-price'));
            var discount = parseInt($('#discount').attr('data-dis'));
            //var discount_total = parseInt($('#discount_total').attr('data-distotal'));
            if(prices >= 200000){
                $('#fee-ship').text('0 đ');
                $('#customControlInline').click(function() {
                    var gift = $('#customControlInline').prop("checked");
                    if (gift) {
                        $('.gift-fee').show();

                        $('#gift-fee-id').text('20,000 đ');
                        var total = prices + 20000;
                        $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                    }else{
                        $('.gift-fee').hide();
                        $('#fee-ship').text('0 đ');
                        var total = prices + 0;
                        $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                    }
                })

            }
            else{

                if($data == 20000){
                    $('#fee-ship').text('20,000 đ');
                    $('#discount').text(discount.toLocaleString().replace('.','.') + '%');
                    $('#prices').text(prices.toLocaleString().replace('.','.') + ' đ');
                    //$('#discount_total').text(discount_total.toLocaleString().replace('.','.') + ' đ');
                    var total = prices + 20000;
                    var gifts = $('#customControlInline').prop("checked");
                    if(gifts){
                        var total = prices + 40000;
                        $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                    }
                    $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                    $('#customControlInline').click(function() {
                        var gift = $('#customControlInline').prop("checked");
                        if (gift) {
                            $('.gift-fee').show();
                            $('#gift-fee-id').text('20,000 đ');
                            $('#fee-ship').text('20,000 đ');
                            var total = prices + 40000;
                            $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                        }else{
                            $('.gift-fee').hide();
                            $('#gift-fee-id').text('20,000 đ');
                            $('#fee-ship').text('20,000 đ');
                            var total = prices + 20000;
                            $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                        }
                    })
                }
                else if($data == 25000){
                    $('#fee-ship').text('25,000 đ');
                    $('#discount').text(discount.toLocaleString().replace('.','.') + '%');
                    $('#prices').text(prices.toLocaleString().replace('.','.') + ' đ');
                    //$('#discount_total').text(discount_total.toLocaleString().replace('.','.') + ' đ');
                    var total = prices + 25000;
                    var gifts = $('#customControlInline').prop("checked");
                    if(gifts){
                        var total = prices + 45000;
                        $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                    }
                    $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                    $('#customControlInline').click(function() {
                        var gift = $('#customControlInline').prop("checked");
                        if (gift) {
                            $('.gift-fee').show();
                            $('#gift-fee-id').text('20,000 đ');
                            $('#fee-ship').text('25,000 đ');
                            var total = prices + 45000;
                            $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                        }else{
                            $('.gift-fee').hide();
                            $('#fee-ship').text('25,000 đ');
                            var total = prices + 25000;
                            $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                        }
                    })
                } else if($data == 30000 || $data == 45000){
                    if($data == 30000) {
                        $('#fee-ship').text('30,000 đ');
                        $('#discount').text('100%');
                        $('#prices').text('0 đ');
                        var total = 30000;
                        var gifts = $('#customControlInline').prop("checked");
                        if(gifts){
                            var total = prices + 50000;
                            $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                        }
                        $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                        $('#customControlInline').click(function() {
                            var gift = $('#customControlInline').prop("checked");
                            if (gift) {
                                $('.gift-fee').show();
                                $('#gift-fee-id').text('20,000 đ');
                                $('#fee-ship').text('30,000 đ');
                                var total = 50000;
                                $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                            }else{
                                $('.gift-fee').hide();
                                $('#fee-ship').text('30,000 đ');
                                var total = 30000;
                                $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                            }
                        })
                    } else {
                        $('#fee-ship').text('45,000 đ');
                        $('#discount').text('100%');
                        $('#prices').text('0 đ');
                        var total = 45000;
                        var gifts = $('#customControlInline').prop("checked");
                        if(gifts){
                            var total = prices + 65000;
                            $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                        }
                        $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                        $('#customControlInline').click(function() {
                            var gift = $('#customControlInline').prop("checked");
                            if (gift) {
                                $('.gift-fee').show();
                                $('#gift-fee-id').text('20,000 đ');
                                $('#fee-ship').text('40,000 đ');
                                var total = 65000;
                                $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                            }else{
                                $('.gift-fee').hide();
                                $('#fee-ship').text('40,000 đ');
                                var total = 40000;
                                $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                            }
                        })
                    }
                } else {
                    $('#fee-ship').text('0 đ');
                    $('#discount').text(discount.toLocaleString().replace('.','.') + '%');
                    $('#prices').text(prices.toLocaleString().replace('.','.') + ' đ');
                    //$('#discount_total').text(discount_total.toLocaleString().replace('.','.') + ' đ');
                    var total = prices + 0;
                    var gifts = $('#customControlInline').prop("checked");
                    if(gifts){
                        var total = prices + 20000;
                        $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                    }
                    $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                    $('#customControlInline').click(function() {
                        var gift = $('#customControlInline').prop("checked");
                        if (gift) {
                            $('.gift-fee').show();
                            $('#gift-fee-id').text('20,000 đ');
                            $('#fee-ship').text('0 đ');
                            var total = prices + 20000;
                            $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                        }else{
                            $('.gift-fee').hide();
                            $('#fee-ship').text('0 đ');
                            var total = prices + 0;
                            $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
                        }
                    })
                }
            }
        }
        @if(isset($total['coupon'])){
            checkDelivery($('[name="delevery_method"]:checked').val());
        } @else {
            checkDelivery(20000);
        } @endif

        $("input[name='delevery_method']").change(function(e){
            e.preventDefault();
            $data = $(this).val();
            checkDelivery($data);
        });

        // 19/3/19
        // $('#unchecked').change(function(){
        //     var prices = parseInt($('#prices').attr('data-price'));
        //     if(prices >= 300000){
        //         $('#fee-ship').text('0 đ');
        //         $('#customControlInline').click(function() {
        //             var gift = $('#customControlInline').prop("checked");
        //             if (gift) {
        //                 $('.gift-fee').show();
        //                 $('#gift-fee-id').text('20,000 đ');
        //                 $('#fee-ship').text('0 đ');
        //                 var total = prices + 20000;
        //                 $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
        //             }else{
        //                 $('.gift-fee').hide();
        //                 $('#fee-ship').text('0 đ');
        //                 $('#gift-fee-id').text('20,000 đ');
        //                 var total = prices + 0;
        //                 $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
        //             }
        //         })
        //     }
        //     else{
        //         $('#fee-ship').text('25,000 đ');
        //         var total = prices + 25000;
        //         var gifts = $('#customControlInline').prop("checked");
        //         if(gifts){
        //             var total = prices + 45000;
        //             $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
        //         }
        //         $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
        //         $('#customControlInline').click(function() {
        //             var gift = $('#customControlInline').prop("checked");
        //             if (gift) {
        //                 $('.gift-fee').show();
        //                 $('#fee-ship').text('25,000 đ');
        //                 $('#gift-fee-id').text('20,000 đ');
        //                 var total = prices + 45000;
        //                 $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
        //             }else{
        //                 $('.gift-fee').hide();
        //                 $('#fee-ship').text('25,000 đ');
        //                 var total = prices + 25000;
        //                 $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
        //             }
        //         })
        //     }
        // });

        // $('#unchecked-vin').change(function(){
        //     var prices = parseInt($('#prices').attr('data-price'));
        //     $('#fee-ship').text('0 đ');
        //     var total = prices + 0;
        //     var gifts = $('#customControlInline').prop("checked");
        //     if(gifts){
        //         var total = prices + 20000;
        //         $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
        //     }
        //     $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
        //     $('#customControlInline').click(function() {
        //         var gift = $('#customControlInline').prop("checked");
        //         if (gift) {
        //             $('.gift-fee').show();
        //             $('#gift-fee-id').text('20,000 đ');
        //             $('#fee-ship').text('0 đ');
        //             var total = prices + 20000;
        //             $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
        //         }else{
        //             $('.gift-fee').hide();
        //             $('#gift-fee-id').text('20,000 đ');
        //             $('#fee-ship').text('0 đ');
        //             var total = prices + 0;
        //             $('#total').text(total.toLocaleString().replace('.','.') + ' đ');
        //         }
        //     })
        // });
        // @if($total['totalPrice'] < 200000){
        //     var feeship = $('[name="delevery_method"]:checked').val();
        // }@else{
        //     var feeship = 0;
        // }@endif

        $('.btn-coupon').click(function() {
            var key_coupon = $('#key-coupon').val();

            $.get('{{ route('checkout-coupon') }}', {key: key_coupon }, function(data) {
                console.log(data);
                var feeship = $('[name="delevery_method"]:checked').val();
                $('#message').text(data.msg);
                // console.log(parseInt(data.total + feeship));
                $('#prices').text(data.total.toLocaleString().replace('.',',') + ' đ');

                var gift = $('#customControlInline').prop("checked");
                console.log(gift);
                if (data.total >= 200000){
                    if (gift) {
                        var giftfee = $('#customControlInline:checked').val();
                        $('#fee-ship').text("0 đ");
                        $('.gift-fee').show();
                        $('#gift-fee-id').text("20,000 đ");
                        $('#total').text((parseInt(giftfee) + parseInt(data.total)).toLocaleString().replace('.',',') + ' đ');
                    } else {
                        $('#fee-ship').text(parseInt(feeship));
                        $('#total').text((parseInt(data.total)).toLocaleString().replace('.',',') + ' đ');
                    }
                } else {
                    if (gift) {
                        var giftfee = $('#customControlInline:checked').val();
                        $('#fee-ship').text((parseInt(feeship)).toLocaleString().replace(',',',') + ' đ');
                        $('.gift-fee').show();
                        $('#gift-fee-id').text("20,000 đ");
                        $('#total').text((parseInt(giftfee) + parseInt(data.total) + parseInt(feeship)).toLocaleString().replace('.',',') + ' đ');
                    } else {
                        $('#fee-ship').text((parseInt(feeship)).toLocaleString().replace(',',',') + ' đ');
                        $('#total').text((parseInt(data.total) + parseInt(feeship)).toLocaleString().replace('.',',') + ' đ');
                    }
                }
                location.reload();

            })
        })

        $('#customControlVAT').click(function() {
            var checkbox_gift = $('#customControlVAT').prop("checked");
            if (checkbox_gift) {
                $('.content-vat').slideDown();
                $('#name_company').prop('required','required');
                $('#code_vat').prop('required','required');
                $('#address_vat').prop('required','required');
            }else{
                $('.content-vat').slideUp();
                $('#name_company').removeAttr('required');
                $('#code_vat').removeAttr('required');
                $('#address_vat').removeAttr('required');
            }
        })

    });
</script>

@endsection
