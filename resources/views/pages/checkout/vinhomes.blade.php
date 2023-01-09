@extends('layouts.master')

@section('content')

<div class="vinhomes-wrapper py-3">
	<div class="container">
		<div class="vinhomes-content m-auto">
			<div class="vinhomes-title mb-4">
				<h4 class="text-center" style="color: #283b91;">TƯNG BỪNG CHƯƠNG TRÌNH VINHOMES ĐỆ NHẤT TIÊU CỤC<br> GIAO SÁCH SIÊU TỐC – CƠN LỐC SÁCH HAY</h4>
			</div>
			<div class="vinhomes-center">
				<p>RBooks trân trọng gửi đến bạn đọc chương trình siêu SHOCK. Duy nhất chỉ có tại Vinhomes.</p>
				<p>Vinhomes Đệ nhất tiêu cục là chương trình dành riêng cho quý cư dân, cộng đồng Vinhomes Central Park, nơi các cao thủ RBooks sẽ gửi đến bạn những cuốn sách hay nhất cùng những phần quà vô cùng giá trị.</p>
				<p class="m-auto vinhomes-images"><img src="{{ asset('public/imgs/banners/banner_2.jpg') }}" class="img-fluid"></p>
				<p><b style="color: #283b91;">ĐỪNG THAM GIA</b>, nếu bạn không muốn:</p>
				<div class="row">
					<div class="col-sm-4 col-12">
						<p>Miễn phí giao sách đến tận căn hộ cho quý cư dân Vinhomes.</p>
						<p class="m-auto" style="width: 70%; margin-bottom: 20px !important;"><img src="{{ asset('public/imgs/sale-off-VH (1).png') }}" class="img-fluid"></p>
					</div>
					<div class="col-sm-4 col-12">
						<p>Rút ngắn thời gian giao hàng: Giao hàng thần tốc chỉ trong 30 phút.</p>
						<p class="m-auto" style="width: 70%; margin-bottom: 20px !important;"><img src="{{ asset('public/imgs/sale-off-VH (2).png') }}" class="img-fluid"></p>
					</div>
					<div class="col-sm-4 col-12">
						<p>Giảm đến 50% những tựa sách nổi tiếng nhất.</p>
						<p class="m-auto" style="width: 70%; margin-bottom: 20px !important;"><img src="{{ asset('public/imgs/sale-off-VH.png') }}" class="img-fluid"></p>
					</div>
				</div>
				<p>- Lựa chọn hàng nghìn đầu sách hay mỗi giờ, mua sách thả ga, bất chấp bão giá.</p>
				<p>- Khám phá thế giới sách tặng mỗi tuần tại Facebook Group: <a href="https://www.facebook.com/groups/rbooks.vn/">Cộng Đồng SÁCH Vinhomes Central Park.</a></p>
				<p class="m-auto vinhomes-images"><img src="{{ asset('public/imgs/vinhomes-cover.jpg') }}" class="img-fluid"></p>
				<!-- <p><b style="color: #283b91;">ĐẶC BIỆT HƠN</b>, bạn có muốn là người đầu tiên sở hữu tấm VÉ XEM PHIM miễn phí từ Rbooks, cho những bộ phim đình đám nhất trên toàn cụm rạp CGV ???</p>
				<p>Nhận ngay vé CGV miễn phí cho bất kỳ bộ phim bạn yêu thích với đơn hàng từ 299K.</p>
				<p class="m-auto vinhomes-images"><img src="{{ asset('public/imgs/VH-cgv.png') }}" class="img-fluid"></p> -->
				<p style="color: #283b91;">Làm thế nào để <b>THAM GIA</b> ???</p>
				<p>Thật đơn giản, nhanh tay đặt sách tại:</p>
				<p><b>Website</b>: <a href="http://rbooks.vn/">http://rbooks.vn/</a></p>
				<p><b>Email</b>: info@rbooks.vn</p>
				<p><b>Facebook</b>: R Books Corp: <a href="https://www.facebook.com/rbooks.vn/">https://www.facebook.com/rbooks.vn/</a></p>
				<p><ins>Bước 1:</ins> Cung cấp thông tin cần thiết để RBooks giao hàng tốt nhất cho bạn</p>
				<p>
					<span class="d-block">- Chọn sách cần đặt.</span>
					<span class="d-block">- Địa chỉ chi tiết căn hộ của bạn tại Vinhomes Central Park.</span>
					<span class="d-block">- Số điện thoại chính xác của bạn.</span>
				</p>
				<p><ins>Bước 2:</ins> Chờ nhận hàng, kiểm tra và thanh toán.</p>
				<p>Tháng 8 này, hãy để cơn lốc của RBooks cuốn bay cái nóng mùa hè, khuấy động những tháng ngày đẹp nhất của bạn với hàng nghìn đầu sách HOT nhất về kinh tế, tài chính, tư duy, sức khỏe, khoa học, cha mẹ, thiếu nhi,…</p>
				<p>Còn chờ gì nữa, “TRIỂN” thôi nào!</p>
				<p><ins>Lưu ý:</ins></p>
				<p>Vui lòng đặt sách trong giờ làm việc để được các cao thủ RBooks giao ngay đúng hẹn</p>
				<p>Giờ làm việc:	 8h - 17h (Thứ 2 - Thứ 6) và 8h - 12h (Thứ 7)</p>
			</div>
			<div class="vinhomes-product">
				<div class="vinhomes-combo">
					<div class="product-title clearfix">
	                	<h4>
	                		{{trans('home.Hot Combo')}}
	                		<a href="{{ route('shopping-top-combo.index') }}" class="float-right see-more">{{trans('home.ViewMore')}}</a>
	                	</h4>
	                </div>
	                <div class="row">
	                    @foreach($orderBefore as $product)
	                    <div class="col-sm-3 col-6 product-hover">
	                        <div class="item">
	                            @include('pages.homecontroller.product-a-page')
	                        </div>
	                    </div>
	                    @endforeach
	                </div>
				</div>
				<div class="vinhomes-selling">
					<div class="product-title clearfix">
	                	<h4>
	                		{{trans('home.Most Sold')}}
	                		<a href="{{ route('shopping-best-sale.index') }}" class="float-right see-more">{{trans('home.ViewMore')}}</a>
	                	</h4>
	                </div>
	                <div class="row">
	                    @foreach($topWeek as $product)
	                    <div class="col-sm-3 col-6 product-hover">
	                        <div class="item">
	                            @include('pages.homecontroller.product-a-page')
	                        </div>
	                    </div>
	                    @endforeach
	                </div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection