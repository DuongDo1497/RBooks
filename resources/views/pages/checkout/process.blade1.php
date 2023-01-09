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
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="h4 p-3">{{ trans('home.1. Chọn hình thức giao hàng') }}</div>
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
                            <label class="custom-control-label" for="unchecked-vin">{{ trans('home.Giao hàng Vinhomes Central Park') }}</label> <p class="elevery_vin_detail">( {{ trans('home.Chi tiết chương trình') }} <a href="{{ route('vinhomes') }}" target="_blank">{{ trans('home.Xem tại đây') }}</a>)</p>
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

                    <div class="h4 p-3">{{ trans('home.2. Chọn hình thức thanh toán') }}</div>
                    <div class="payment_method">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="payment_method_checked" value="1" name="payment_method" checked>
                            <label class="custom-control-label" for="payment_method_checked">{{ trans('home.Thanh toán tiền mặt khi nhận hàng') }}</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="payment_method_unchecked" value="2" name="payment_method">
                            <label class="custom-control-label" for="payment_method_unchecked">{{ trans('home.Thanh toán bằng chuyển khoản ngân hàng') }}</label>
                        </div>
                    </div>
                    <div class="custom-control custom-checkbox vat_method mr-sm-2">
                        <input type="checkbox" class="custom-control-input" id="customControlVAT" name="checkVat">
                        <label class="custom-control-label" for="customControlVAT">{{ trans('home.Thông tin xuất hóa đơn VAT') }}</label>
                    </div>

                    <div class="content-vat">
                        <div class="vat-default">
                            <div class="row vat-name-company mb-4">
                                <div class="col-md-4"><b>Tên công ty </b>:</div>
                                <div class="col-md-8">
                                    <input type="text" placeholder="Ít nhất 2 từ" name="name_company" id="name_company" class="form-control" value="" minlength="2" maxlength="300" novalidate >
                                </div>
                            </div>
                            <div class="row vat-tax-code mb-4">
                                <div class="col-md-4"><b>Mã số thuế </b>:</div>
                                <div class="col-md-8">
                                    <input type="number" placeholder="Mã số thuế" name="code_vat" id="code_vat" class="form-control" value="" minlength="10" novalidate >
                                </div>
                            </div>
                            <div class="row vat-address mb-4">
                                <div class="col-md-4"><b>Địa chỉ</b>:</div>
                                <div class="col-md-8">
                                    <textarea type="text" name="vat_address" placeholder="Nhập địa chỉ công ty(bao gồm Phường/Xã, Quận/Huyện, Tỉnh/Thành phố nếu có)" id="address_vat" class="form-control" maxlength="500"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="custom-control custom-checkbox gift_method mr-sm-2">
                        <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="check">
                        <label class="custom-control-label" for="customControlAutosizing">{{ Trans('home.Gửi quà tặng đến bạn bè, người thân') }}</label>
                    </div>

                    <div class="content-gift">
                        <div class="h4 p-3">{{ Trans('home.Thông tin quà tặng') }}</div>
                        <!-- @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                {{$err}}<br>
                                @endforeach
                            </div>
                        @endif -->
                        <div class="gift-default">
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" value="20000" name="gift_fee" class="custom-control-input" id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">Thiệp mừng + Gói quà <span style="font-weight: bold;">(20.000đ)</span></label>
                                <p class="des-gift">* Thiệp mừng được chọn ngẫu nhiên trong 100 mẫu do RBooks thiết kế.</p>
                            </div>
                            <div class="row gift-from-to mb-4">
                                <div class="col-md-3 title-from"><b>Gửi từ </b>:</div>
                                <div class="col-md-3">
                                    <input type="text" placeholder="Tên người gửi" name="sendername" id="from_birthday" class="form-control" value="" minlength="1" maxlength="30" >
                                </div>
                                <div class="col-lg-2 col-md-3 title-to"><b>Tới </b>:</div>
                                <div class="col-md-3">
                                    <input type="text" placeholder="Tên người nhận" name="recipientname" id="to_birthday" class="form-control" value="" minlength="1" maxlength="30" >
                                </div>
                            </div>
                            <div class="row gift-address mb-4">
                                <div class="col-lg-3 col-md-4"><b>Địa chỉ người nhận </b>:</div>
                                <div class="col-md-8">
                                    <input type="text" placeholder="Địa chỉ người nhận" name="address_to" id="address" class="form-control" value="" minlength="10" maxlength="300" >
                                </div>
                            </div>
                            <div class="row gift-number mb-4">
                                <div class="col-lg-3 col-md-4"><b>Số điện thoại </b>:</div>
                                <div class="col-md-8">
                                    <input type="number" placeholder="Số điện thoại người nhận" name="phone_to" id="number" class="form-control" value="" minlength="9" >
                                </div>
                            </div>
                            <div class="row gift-message">
                                <div class="col-lg-3 col-md-4"><b>Lời nhắn </b>:</div>
                                <div class="col-md-8">
                                    <textarea type="text" name="message" placeholder="Ví dụ: Chúc mừng sinh nhật bạn. (Tối đa 300 ký tự)" id="mess_birthday" class="form-control" maxlength="500" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="h4 p-3">{{ trans('home.3. Thông tin liên hệ') }}</div>
                    <div class="hotline">
                        <div class="row">
                            <!--<div class="col-4"><img class="img-hotline" src="{{ asset('imgs/support-24h.png') }}" alt=""></div>
                            <div class="col-8">
                                <ul class="list-unstyled">
                                    <li class="text-hotline">Hotline</li>
                                    <li class="phone-hotline">028 3636 0440</li>
                                    <li class="work-time">8h - 21h, cả T7 & CN</li>
                                </ul>
                            </div>-->

                            <div class="col-lg-4 col-md-12 col-12">
                                <div class="icon icon-hotline"><i class="fas fa-phone"></i></div>
                                <p><span style="font-weight: bold;">Hotline:</span> 08 4966 400</p>
                            </div>
                            <div class="col-lg-4 col-md-12 col-12">
                                <div class="icon icon-mail"><i class="fas fa-envelope"></i></div>
                                <p><span style="font-weight: bold;">Email:</span> info@rbooks.vn</p>
                            </div>
                            <div class="col-lg-4 col-md-12 col-12">
                                <div class="icon icon-time"><i class="fas fa-clock"></i></div>
                                <p>Monday-Friday: 8AM – 5PM<br>Saturday: 8AM – 12PM<br>Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5 col-12">
                    <div class="total_cart mt-5 form-coupon">
                        <div class="process-address">
                            <div class="h5 pb-1" id="title">{{ trans ('home.Địa chỉ giao hàng') }} @if(Auth::check())<button type="button" class="float-right btn btn-default"  onclick="window.location.href='{{ route('edit-address', ['id' => $address->id ]) }}'">{{ trans ('home.Sửa') }}</button>@endif</div>
                            <hr>
                            <input type="text" name="address_id" hidden="true" value="{{ $address->id }}">
                            <div class="pt-1">
                                <ul class="list-unstyled p-2">
                                    <li class="customer-name"><b>{{ $address->fullname }}</b></li>
                                    @if($address->ward == NULL && $address->district == NULL && $address->city == NULL)
                                        <li class="pt-1"><b>{{ trans ('home.Địa chỉ') }}</b><span class="textarea"> {{ $address->address }}</span></li>
                                    @else
                                        <li class="pt-1"><b>{{ trans ('home.Địa chỉ') }}</b><span class="textarea"> {{ $address->address }}, {{ trans ('home.phường')}} {{ $address->ward }}, {{ trans('home.quận')}} {{ $address->district }}, {{ $address->city }}</span></li>
                                    @endif
                                    <li class="pt-1"><b>{{ trans ('home.Điện thoại') }}</b><span class="textarea"> {{ $address->phone }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="total_cart mt-2 form-coupon">
                        <div class="product-price">
                            <div class="h5 pb-2" id="title">{{ trans('home.Đơn Hàng') }} ({{ $total['totalQuantity'] }} {{ trans('home.sản phẩm') }})<!-- <button class="float-right btn btn-default">Sửa</button> --></div>
                            <hr>
                            <div id="price">
                                <ul class="list-unstyled p-2">
                                    <li class="pt-2"><b>{{ trans('home.Tổng tiền') }}: <span class="float-right top-total">{{ number_format($total['total_cv_price'] ) }} đ</span></b></li>

                                    <li class="pt-2"><b>{{ trans('home.Tiết kiệm') }}: <span class="float-right price_sale" id="discount" data-dis="{{ round((1-($total['totalPrice'] / $total['total_cv_price'])) * 100, 0) }}%">{{ round((1-($total['totalPrice'] / $total['total_cv_price'])) * 100, 0) }}% <span class="text-danger" >({{ number_format($total['total_cv_price'] - $total['totalPrice']) }} đ)</span></span></b></li>

                                    <li class="pt-2"><b>{{ trans('home.Thành tiền') }}: <span class="float-right price_sell" id="prices" data-price="{{ $total['totalPrice'] }}" style="color: #000; font-size: 14px;">
                                    {{ number_format($total['totalPrice']) }} đ</span></b></li>

                                    <li class="pt-2"><b>{{ trans('home.Phí vận chuyển:') }} <span class="float-right price_sell" id="fee-ship" style="color: #000; font-size: 14px;"></span></b></li>

                                    <li class="pt-2 gift-fee" style="display: none;"><b>{{ trans('home.Phí gói quà:') }} <span class="float-right gift-fee-package" id="gift-fee-id" ></span></b></li>
                                    <hr>
                                    <li class="pt-2"><b>{{ trans('home.Tổng thành tiền:') }} <span class="float-right price_sell" id="total">{{ number_format($total['totalPrice']) }} đ</span></b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 mb-3">
                        <button type="submit" class="btn" id="btn-order">{{ trans('home.MUA NGAY') }}</button>
                        <div class="mt-2">({{ Trans('home.Xin vui lòng kiểm tra lại đơn hàng trước khi Đặt Mua') }})</div>
                    </div>
                    <div class="mt-2 form-coupon">
                    <div>{{ trans('home.Mã giảm giá / Quà tặng') }}</div>
                    <hr>
                    <div class="input-group">
                        @if(!isset($total['coupon']))
                            <input type="text" name="key-coupon" class="form-control" id="key-coupon" placeholder="{{ trans('home.Nhập ở đây ...') }}">
                            <div class="input-group-append">
                                <button id="btn-coupon" class="btn btn-default btn-coupon" type="button">{{ trans('home.Áp dụng') }}</button>
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
