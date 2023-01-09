<div id="main-content">
	<section id="main-product">
		<div class="container">
		@include('pages.shopping.productcontroller.addcomment')
			<div class="row">
				<div class="col-xl-3 col-lg-3 col-md-4" id="product-cover">
					<!-- <div class="text-right product-read">
						<a href="#" data-toggle="" data-target=""><img src="{{ asset('imgs/read.png') }}"></a>
					</div> -->
					<div class="product-cover">
						<a href="#">
							<img id="img-active" src="{{ empty($product->images->last()) ? asset(RBOOKS_NO_IMAGE_URL) : RBOOKS_IMAGE_URL . $product->images->last()->path }}" class="img-fluid">
						</a>
					</div>
					<div class="product-small-cover">
						<!-- <a href="#">
							<img src="{{ empty($product->images->last()) ? asset(RBOOKS_NO_IMAGE_URL) : RBOOKS_IMAGE_URL . $product->images->last()->path }}" class="img-fluid thumbnail">
						</a> -->
						@if(!empty($product->images))
							@foreach($product->images->where('deleted_at', '==' , NULL) as $image)
								<a href="#">
									<img src="{{ RBOOKS_IMAGE_URL . $image->path  }}" class="img-fluid thumbnail">
								</a>
							@endforeach
						@endif
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-8" id="product-summary">
					<h1 class="h3 pt-4 product-page">{{ $product->name }}</h1>
					<!-- <ul class="product-summary-info list-unstyled p-3 mt-4">
						<li>Tác giả: <span class="font-weight-bold product_status"> {{ $product->author }}</span></li>
						<li>Số trang: <span class="font-weight-bold product_status"> {{ $product->paper }}</span></li>
						<li>Kích thước: <span class="font-weight-bold product_status">  {{ $product->size }}</span></li>
						<li>Năm xuất bản: <span class="font-weight-bold product_status"> {{ $product->publishing_year }}</span></li>
						<li>Nhà xuất bản: <span class="font-weight-bold product_status"> {{ $product->pub_company }}</span></li>
						<li>Nhà phát hành: <span class="font-weight-bold product_status"> {{ $product->publisher }}</span></li>
					</ul> -->
					<div class="product-summary-info">
						<div class="row d-none" style="margin: 0;">
							<div class="col-sm-5 col-6 clearfix"><span class="product-properties">{{trans('home.Tác giả')}} </span><span class="font-weight-bold product_status"> {{ $product->author }}</span></div>
							<div class="col-sm-7 col-6 clearfix"><span class="product-properties-right">{{trans('home.Kích thước')}} </span><span class="font-weight-bold product_status right"> {{ $product->size }}</span></div>
							<div class="col-sm-5 col-6 clearfix"><span class="product-properties">{{trans('home.Số trang')}} </span><span class="font-weight-bold product_status"> {{ $product->paper }}</span></div>
							<div class="col-sm-7 col-6 clearfix"><span class="product-properties-right">{{trans('home.Nhà phát hành')}} </span><span class="font-weight-bold product_status right"> {{ $product->publisher }}</span></div>
							<div class="col-sm-5 col-6 clearfix"><span class="product-properties">{{trans('home.Năm XB')}} </span><span class="font-weight-bold product_status"> {{ $product->publishing_year }}</span></div>
							<div class="col-sm-7 col-6 clearfix"><span class="product-properties-right">{{trans('home.Nhà xuất bản')}} </span><span class="font-weight-bold product_status right"> {{ $product->pub_company }}</span></div>
						</div>

						<table class="table table-borderless border" width="100%">
							<tbody>
								<tr>
									<th><b>Tác giả:</b></th>
									<td>{{ $product->author }}</td>
									<th><b>Kích thước:</b></th>
									<td>{{ $product->size }}</td>
								</tr>

								<tr>
									<th><b>Số trang:</b></th>
									<td>{{ $product->paper }}</td>
									<th><b>Nhà phát hành:</b></th>
									<td>{{ $product->publisher }}</td>
								</tr>

								<tr>
									<th><b>Nhà xuất bản:</b></th>
									<td>{{ $product->pub_company }}</td>
									<th><b>Năm xuất bản:</b></th>
									<td>{{ $product->publishing_year }}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="product-fb-like">
						<div id="fb-root"></div>
						<script>(function(d, s, id) {
						var js, fjs = d.getElementsByTagName(s)[0];
						if (d.getElementById(id)) return;
						js = d.createElement(s); js.id = id;
						js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.1&appId=2108197189464413&autoLogAppEvents=1';
						fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
						<div class="fb-like" data-href="{{ url()->full() }}" data-layout="standard" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
					</div>
					<div class="product-star clearfix">
						@if(empty($comments->first()))
							<div class="rate-star">
								<img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
								<img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
								<img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
								<img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
								<img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
							</div>
							<div class="rate-review">
								<span>{{trans('home.0 (đánh giá)')}}</span>
							</div>
						@else
							<div class="rate-star">
								@for($i = 0; $i < $comments->avg('rate'); $i++)
									<img class="pb-2" src="{{ asset('imgs/star.jpg') }}" alt="Đánh giá">
									{{-- <img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá"> --}}
								@endfor
							</div>
							<div class="rate-review clearfix">
								<span>({{ $comments->count() }} {{trans('home.đánh giá')}})</span>
							</div>
						@endif
					</div>
					<div class="product-descriptions pt-2">
						<div class="justify-content-center">
							<div id="excerpt">
								<p>{{ $product->excerpt }}</p>
								<!-- <p class="collapse text-justify" id="collapseSummary">
									{{ $product->excerpt }}
								</p>
								<a class="collapsed" data-toggle="collapse" href="#collapseSummary" aria-expanded="false" aria-controls="collapseSummary">
								</a> -->
							</div>
						</div>
					</div>
					<div id="break"></div>
					<div class="info-included">
						<h5 class="pt-3">Dịch vụ & Khuyến mãi kèm theo</h5>
						<div class="row pt-3">
							<div class="col-xl-1 col-2 pr-0">
								<img src="{{ asset('imgs/tick.png') }}" alt="">
							</div>
							<div class="col-xl-11 col-10 pl-0">
								<p>Trải nghiệm dịch vụ Bookcare để được bọc sách Plastic cao cấp. <a href="#">{{trans('home.Xem chi tiết')}}</a></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xl-1 col-2 pr-0">
								<img src="{{ asset('imgs/tick.png') }}" alt="">
							</div>
							<div class="col-xl-11 col-10 pl-0">
								<p>Miễn phí giao hàng toàn quốc cho đơn hàng từ 200.000 ( Áp dụng từ 1/1/2019) <a href="https://rbooks.vn/shipping-method">{{trans('home.Xem chi tiết')}}</a></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xl-1 col-2 pr-0">
								<img src="{{ asset('imgs/tick.png') }}" alt="">
							</div>
							<div class="col-xl-11 col-10 pl-0">
								<p>Dịch vụ tặng quà, cùng thông điệp của riêng bạn. <a href="#gift-popup" class="open-popup-link">{{trans('home.Xem chi tiết')}}</a></p>
							</div>
							<div id="gift-popup" class="white-popup mfp-hide">
								<h5 class="gift-title">TẶNG QUÀ CÙNG THÔNG ĐIỆP CỦA RIÊNG BẠN</h5>
								<p class="my-4s">Còn gì ý nghĩa hơn tặng đến người bạn yêu quý những cuốn sách giá trị cùng lời nhắn gửi được in trên chiếc thiệp xinh xắn. R Books hân hạnh được giúp bạn trao gửi yêu thương với dịch vụ tặng quà, gửi thiệp.</p>
								<p style="font-weight: bold; margin-bottom: 0;">Bạn chỉ cần:</p>
								<ul>
									<li><span><i class="fas fa-check"></i></span>Lựa chọn sản phẩm yêu thích để gửi tặng.</li>
									<li><span><i class="fas fa-check"></i></span>Trong mục “Thanh toán”, click chọn “Gói quà tặng”.</li>
									<li><span><i class="fas fa-check"></i></span>Điền lời chúc yêu thương của riêng bạn.</li>
								</ul>
								<p style="font-weight: bold; margin-bottom: 0; margin-top: 15px;">Lợi ích của dịch vụ:</p>
								<ul>
									<li><span><i class="fas fa-check"></i></span>Tiết kiệm thời gian, chi phí: R Books cam kết chất lượng từ khâu lựa chọn sản phẩm, bao gói kĩ lưỡng xinh đẹp; đến giao tận tay người nhận.</li>
									<li><span><i class="fas fa-check"></i></span>Chi phí trọn gói chỉ với <span style="font-weight: bold;">20,000đ</span>.</li>
									<li style="text-align: center;"><img class="py-4 img-fluid" src="{{ asset('/imgs/gift-3.png') }}"></li>
									<li><span><i class="fas fa-check"></i></span>Giấy gói quà và thiệp tặng được lựa chọn từ hơn 100 mẫu khác nhau của R Books.</li>
									<li style="text-align: center;"><img class="py-4 img-fluid" src="{{ asset('/imgs/gift-1.png') }}"></li>
									<li><span><i class="fas fa-check"></i></span>Hóa đơn không kèm giá.</li>
									<li style="text-align: center;"><img class="py-4 img-fluid" src="{{ asset('/imgs/gift-2.png') }}"></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-3 col-lg-3 col-md-12 pt-4" id="product-shipping">
					<div class="product-price">
						<div class="h5 text-dark" id="title">{{trans('home.Thông tin thanh toán')}}</div>
						<div id="break"></div>
						<div id="price">
							<ul class="list-unstyled p-2">
								<li class="pt-2"><b>{{trans('home.Giá bìa')}}<span class="float-right price_cover"><del>{{ number_format($product->cover_price) }}</del> đ</span></b></li>
								<li class="pt-2"><b>{{trans('home.Giá bán')}}<span class="float-right price_sell">{{ number_format($product->sale_price) }} đ</span></b></li>
								<li class="pt-2"><b>{{trans('home.Tiết kiệm')}}<span class="float-right price_sale"><span class="text-danger">@if(!is_null($product->sale_price) && $product->sale_price != 0)
									-{{ round((1-($product->sale_price / $product->cover_price)) * 100, 0) }}% </span>({{ number_format($product->cover_price - $product->sale_price) }} đ)</span></b>
									@endif
								</li>
								<li class="pt-2"><b>{{trans('home.Chất lượng sách')}}</b><span class="float-right price_sale">{{trans('home.Loại')}} A</span></li>
							</ul>
						</div>
						<div id="break"></div>
						<form method="get" action="{{ route('cart-add') }}" class="mt-2">
							{{ csrf_field() }}
							<input type="hidden" name="id" value="{{ $product->id }}" />
							<div id="quantity">
								<ul class="list-unstyled p-2">

									@if($product->product_warehouse->where('warehouse_id','2')->first()->quantity > 0)
									<li class="pt-2">
										<img class="mb-2" src="{{ asset('imgs/tick.png') }}" alt="Thích sách">
										<span class="product_status"><b>{{trans('home.Có hàng')}}</b></span>
									</li>
									@elseif($product->product_warehouse->where('warehouse_id','1')->first()->quantity > 0)
										<span class="product_status"><b>Sắp phát hành</b></span>
									@else
										<span class="product_status" style="color : red; font-weight: bold"><b>{{trans('home.Hết hàng')}}</b></span>
									@endif
									<li class="pt-4"><b>{{trans('home.Số lượng')}}</b>
										<div class="btn-group float-right">
											<button type="button" class="btn btn-number" data-type="minus">-</button>
												<input type="number" class="input-number text-center" id="number-quantity" style="width: 50px" value="0" name="quantity" min="1" max="100" pattern="[0-9]*">
											<button type="button" class="btn btn-number" data-type="plus">+</button>
										</div>
									</li>
								</ul>
							</div>
							<div class="text-center text-danger"><!-- (Số lượng còn trong kho: {{ $product->product_warehouse->where('warehouse_id','2')->first()->quantity }}) -->
								@if($product->product_warehouse->where('warehouse_id','2')->first()->quantity > 0)
									<input type="text" hidden="true" id="quantityWarehouses" value="{{ $product->product_warehouse->where('warehouse_id','2')->first()->quantity }}">
								@else
									<input type="text" hidden="true" id="quantityWarehouses" value="{{ $product->product_warehouse->where('warehouse_id','1')->first()->quantity }}">
								@endif
							</div>
							<div class="text-center mt-4 mb-3">
								<div class="p-1 pb-2"><span id="error" class="alert-danger"></span></div>
								@if($product->product_warehouse->where('warehouse_id','2')->first()->quantity > 0)
									<button type="submit" {{ ($product->product_warehouse->where('warehouse_id','2')->first()->quantity ) ? "" : "disabled" }} class="btn font-weight-bold" id="btn-buy">{{trans('home.MUA NGAY')}}</button>
								@else
									<button type="submit" class="btn font-weight-bold" id="btn-buy">ĐẶT TRƯỚC</button>
								@endif
							</div>
						</form>
					</div>
					<div class="product-customer">
						<div class="product-like-read float-right mt-4 d-none">
							<div class="row pr-3">
								<img class="img-fluid pr-1" src="{{ asset('imgs/like-product.png') }}" alt="Thích sách">
								<img class="img-fluid" src="{{ asset('imgs/readed-product.png') }}" alt="Đã xem">
							</div>
						</div>
						<div class="product-commitment float-right mt-3 d-none">
							<img class="img-fluid" src="{{ asset('imgs/cam-ket.png') }}" alt="Cam kết">
						</div>

						<div class="wishlist my-3">
							<a href="#" data-toggle="modal" data-target="#getFormLike" class="add-to-wishlist rounded p-1 d-block text-center" style="border: 1px solid #283b91;">
								<span class="wishlist-icon" style="color: #283b91;">
									<i class="icofont-heart"></i>
								</span>
								<span class="wishlist-description wisthlist" style="color: #283b91;">{{trans('home.Thêm vào yêu thích')}}</span>
							</a>
						</div>

					</div>
				</div>
			</div>

			{{-- <div class="product-detail mt-5" id="product-detail">
				<h3><u>THÔNG TIN CHI TIẾT</u></h3>
				<div class="row">
					<div class="col-md-9 pl-4 pt-2">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td class="title-detail">Công ty phát hành</td>
									<td>NXB Trẻ</td>
								</tr>
								<tr>
									<td class="title-detail">Nhà xuất bản</td>
									<td>Nhà Xuất Bản Trẻ</td>
								</tr>
								<tr>
									<td class="title-detail">Kích thước</td>
									<td>13 x 20 cm</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col"></div>
				</div>
			</div> --}}

			<div class="product-introduce mt-4" id="product-introduc">
				<h3 class="h6 product-page">{{trans('home.GIỚI THIỆU SÁCH')}}</h3>
				<div class="line">
					<img src="{{ asset('imgs/u.png') }}" alt="">
				</div>
				<div class="row">
					<div class="col-xl-12 pt-2">
						<div class="justify-content-center">
							<div id="description">
								{!! $product->description !!}
								<!-- <div id="collapseDescription" class="collapse">{!! $product->description !!}</div>

								<a class="collapsed" data-toggle="collapse" href="#collapseDescription" aria-expanded="false" aria-controls="collapseDescription">
								</a> -->
							</div>

							<!-- <div class="collapse" id="collapseExample">
							  <div class="card card-body">
								{!! $product->description !!}
							  </div>
							</div>
							<p>
							  <a class="btn btn-primary read-more" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
								<span class="text">Đọc thêm</span>
							  </a>
							</p> -->

							<!-- <div class="content">{!! $product->description !!}</div>
							<p class="show_hide" data-content="toggle-text">Đọc thêm</p> -->
						</div>
					</div>
				</div>
			</div>

			<div class="list-product-with-author mt-4" id="list-product-with-author">
				<h3 class="h6 product-page">{{trans('home.SÁCH CÙNG CHỦ ĐỀ')}}</h3>
				<div class="line">
					<img src="{{ asset('imgs/u.png') }}" alt="">
				</div>
				<div class="row pt-2">
					@foreach($productCategory as $product)
					<div class="col-xl-2 col-md-4 col-6 category-books">
						@include('pages.homecontroller.product-a-page')
					</div>
					@endforeach
				</div>
			</div>

			<div class="list-product-with-author mt-4" id="list-product-with-author">
				<h3 class="h6 product-page">{{trans('home.SÁCH ĐANG BÁN CHẠY')}}</h3>
				<div class="line">
					<img src="{{ asset('imgs/u.png') }}" alt="">
				</div>
				<div class="row pt-2">
					@foreach($productBestSales as $product)
					<div class="col-xl-2 col-lg-3 col-md-4 col-6 category-books">
						@include('pages.homecontroller.product-a-page')
					</div>
					@endforeach
				</div>
			</div>

			<div class="product-customer-ask mt-4">
				<h3 class="h6 product-page">HỎI, ĐÁP VỀ SẢN PHẨM</h3>
				<div class="mt-2 header-comment">
					@foreach ($questions as $question)
					<div class="question-answer-content">
						<div class="items row">

							<div class="col-sm-1 col-1 like text-center d-sm-block d-none">
								<p class="number-like">{{ $question->likequestions->count() }}</p>
								<p class="text">Thích</p>
							</div>
							<div class="col-sm-11 col-12 content">
								<p class="title-question">{{ $question->question }}</p>
								@foreach($question->answers->where('status', '1') as $answer )
									<p class="content-question text-justify pr-2">{{ $answer->answer }}</p>
								<p class="date-question font-weight-bold">{{ $answer->customer['fullname'] == null ? "Rbooks" : $answer->customer['fullname'] }} trả lời vào {{ $answer->created_at }}</p>
								@endforeach
								<p class="action">
									<a href="javascript:void(0)" data-id="{{$question->id}}" class="like_question action-like" data-toggle="modal" data-target="#getFormLike"><i class="fas fa-thumbs-up"></i><span>Thích</span></a>
									<a href="{{ route('reply-question', ['id' => $question->id]) }}" class="action-rep"><i class="fas fa-reply-all"></i><span>Trả lời</span></a>
									<span class="action-count-mb pl-3 d-sm-none">
										<span class="icons" style="color: red;"><i class="fas fa-heart"></i></span> <span class="text">{{ $question->likequestions->count() }}</span>
									</span>
								</p>
							</div>
						</div>
					</div>
					@endforeach
					@if(Auth::check())
					<form action="{{ route('product-question') }}" method="post" accept-charset="utf-8">
						{{ csrf_field() }}
						<div class="question-answer-form row">
							<div class="col-sm-10 col-12">
								<input type="text" hidden="true" name="id" value="{{ $like }}">
								<input type="text" name="question" id="content_QA" data-product="" class="form-control" value="" placeholder="Hãy đặt câu hỏi liên quan đến sản phẩm..." required="required">
							</div>
							<div class="col-sm-2 col-12">
								<button type="submit" class="question btn btn-primary btn-add-question">Gửi câu hỏi</button>
							</div>
						</div>
					</form>
					@else
					<form action="#" method="post" accept-charset="utf-8">
						<div class="question-answer-form row">
							<div class="col-md-10 col-sm-10 col-12">
								<input type="text" hidden="true" name="id" value="{{ $like }}">
								<input type="text" name="question" id="content_QA" data-product="" class="form-control" value="" placeholder="Hãy đặt câu hỏi liên quan đến sản phẩm..." required="required">
							</div>
							<div class="col-md-2 col-sm-2 col-12">
								<button type="button" data-toggle="modal" data-target="#modalComment" class="question btn btn-primary btn-add-question">Gửi câu hỏi</button>
							</div>
						</div>
					</form>
					@endif
					<div class="question-answer-help">
						<p>Các câu hỏi thường gặp về sản phẩm:</p>
						<p>- Chế độ bảo hành cùng cách thức vận chuyển sản phẩm này thế nào?</p>
						<p>- Kích thước sản phẩm này ?</p>
						<p>- Sản phẩm này có dễ dùng không ?</p>
						<p>Các câu hỏi liên quan đến sản phẩm hư hỏng, cần đổi trả, v.v ... vui lòng liên hệ hotline: 08 4966 4005</p>
					</div>
				</div>
			</div>

			<div class="product-customer-comment mt-5" id="product-customer-comment">
				<h3 class="h6 product-page">{{trans('home.KHÁCH HÀNG NHẬN XÉT')}}</h3>
				<div class="row mt-2 header-comment">
					<div class="col-md-3 text-center">
						<div class="h6 pt-2 mb-0">{{trans('home.Đánh Giá Trung Bình')}}</div>
						@if(empty($comments->first()))
							<div class="total-review-point">0/5</div>
							<img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
							<img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
							<img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
							<img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
							<img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
							<div class="pt-2">
								(0 {{trans('home.Comments')}})
							</div>
						@else
							<div class="total-review-point">{{ number_format($comments->avg('rate')) }}/5</div>
							<div>

								@for($i = 0; $i < number_format($comments->avg('rate')); $i++)
									<img src="{{ asset('imgs/star.jpg') }}" alt="Đánh giá">
									{{-- <img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá"> --}}
								@endfor

							</div>
							<div class="pt-2">
								<a href="#">({{ $comments->count() }} {{trans('home.Comments')}})</a>
							</div>
						@endif
					</div>
					<div class="col-md-6 text-center pt-5 text-nowrap">
						{{-- <img src="{{ asset('imgs/total-point.jpg') }}" alt="Tổng đánh giá"> --}}
						<button class="btn btn-group btn-star bg-white border" data-index="All">{{trans('home.All')}}</button>
						<button class="btn btn-group btn-star ml-xl-2 ml-md-1 bg-white border" data-index="5">{{trans('home.5 star')}}</button>
						<button class="btn btn-group btn-star ml-xl-2 ml-md-1 bg-white border" data-index="4">{{trans('home.4 star')}}</button>
						<button class="btn btn-group btn-star ml-xl-2 ml-md-1 bg-white border" data-index="3">{{trans('home.3 star')}}</button>
						<button class="btn btn-group btn-star ml-xl-2 ml-md-1 bg-white border" data-index="2">{{trans('home.2 star')}}</button>
						<button class="btn btn-group btn-star ml-xl-2 ml-md-1 bg-white border" data-index="1">{{trans('home.1 star')}}</button>
					</div>
					{{ csrf_field() }}
					<div class="col-md-3 text-center">
						<div class="pt-4">{{trans('home.Chia sẻ nhận xét về sản phẩm')}}</div>
						<button type="button" data-toggle="modal" data-target="#modalComment" class="btn btn-comment">{{trans('home.Viết nhận xét của bạn')}}</button>
					</div>
				</div>
				<div id="com" class="list-comment">

				</div>
			</div>
		</div>
	</section>
</div>

<!-- Thông báo like -->
<div class="modal fade" id="getFormLike" tabindex="-1" role="dialog">
	<form action="" enctype="multipart/form-data" method="POST">
	  <div class="modal-dialog" role="document">
		<div class="modal-content border-0">
		  <div class="modal-header" style="background-color: #283b91; padding: .5rem;">
			<h5 class="modal-title" style="color: #fff;">Thông báo</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true" style="color: #fff;">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div class="text-center text-danger"><span id="like_message"></span></div>
		  </div>
		</div>
	  </div>
	</form>
</div>

<div id="box-cmt" class="d-none">
    <div class="row pb-0 cmt_box">
    	<div class="col-md-2 col-12 text-center">
    		<img src="{{ asset('imgs/avatar_default.png') }}" class="comment-avatar" alt="">
    		__cmt_date__
    		__name__
    	</div>
    	<div class="col-md-10 col-12">
    		<div class="text-nowrap">
    			__stars__
    			__status__
    		</div>
    		<div class="comment">
    			__comment__
    		</div>
    		<div class="row">
    			<div class="col-sm-2 col-3 pt-2">
    				__answer__
    			</div>

    			<!-- <div class="col-sm-2 col-3 pt-2"><a href="#" style="color: #283b91;"><i class="fas fa-share"></i> Share</a></div> -->

	    		__thanks__

    			<div class="col-sm-4 col-0"></div>
    		</div>
            <div class="reply-comment">
                __sendanswer__
            </div>
            <div class="replies">
            	__replies__
            </div>
    	</div>
    </div>
<hr>
</div>

<div id="send_answer" class="d-none">
	<form action="" method="POST">
	    <div class="row">
	        <div class="col-sm-10 col-12">
	            __answer_cmt__
	        </div>
	        <div class="col-sm-2 col-12">
	            __send__
	        </div>
	    </div>
	</form>
</div>

<div id="reply_box" class="d-none">
	<div class="replies-item">
		<div class="row py-0">
			<div class="col-md-1 col-12 replies-avatar">
				__img__
			</div>
			<div class="col-md-11 col-12 replies-content">
				<p class="font-weight-bold replies-name mb-0">__name__</p>
				<p class="replies-text">__reply__</p>
			</div>
		</div>
	</div>
</div>

<div id="no-com" class="d-none">
	<h5 class="text-center mt-4">{{trans('home.Hiện tại chưa có nhận xét !!!')}}</h5>
</div>

<!-- End thông báo like -->