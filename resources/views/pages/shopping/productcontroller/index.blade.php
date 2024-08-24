@extends('layouts.master')

@section('content')
  <div class="wrapper">
    <div class="section section-product-detail">
      <div class="container">
        <div class="product-detail-wrap">
          <div class="product-detail-service">
            <div class="row">
              <div class="col-lg-5 col-xxl-4">
                <div class="gallery-image">
                  <div class="gallery-big-image">
                    <img id="img-active"
                      src="{{ empty($product->images->last()) ? asset(RBOOKS_NO_IMAGE_URL) : RBOOKS_IMAGE_URL . $product->images->last()->path }}"
                      class="img-fluid">
                  </div>
                  <div class="gallery-small-image">
                    @if (!empty($product->images))
                      @foreach ($product->images->where('deleted_at', '==', null) as $image)
<span class="item">
                          <img src="{{ RBOOKS_IMAGE_URL . $image->path }}" class="img-fluid thumbnail">
                        </span>
@endforeach
@endif
                  </div>
                </div>
              </div>

              <div class="col-lg-7 col-xxl-8">
                <div class="product-detail-control">
                  <h4 class="title">
                    {{ $product->name }}
                  </h4>

                  <div class="type">
                    <p class="author">
                      {{-- Tác giả: --}} <span>{{ $product->author ?? 'No Name' }}</span> 
                    </p>
                    <div class="rate">
                      @if (empty($comments->first()))
<span class="icon">
                          <img src="{{ asset('imgs/none_star.jpg') }}" alt="">
                        </span>
                        <span class="icon">
                          <img src="{{ asset('imgs/none_star.jpg') }}" alt="">
                        </span>
                        <span class="icon">
                          <img src="{{ asset('imgs/none_star.jpg') }}" alt="">
                        </span>
                        <span class="icon">
                          <img src="{{ asset('imgs/none_star.jpg') }}" alt="">
                        </span>
                        <span class="icon">
                          <img src="{{ asset('imgs/none_star.jpg') }}" alt="">
                        </span>
@else
@for ($i = 0; $i < $comments->avg('rate'); $i++)
                        <span class="icon">
                          <img src="{{ asset('imgs/star.jpg') }}" alt="Đánh giá">
                        </span>
                      @endfor
                    @endif
                  </div>
                </div>

                <div class="info">
                  <div class="price">
                    <p class="sale"><span class="number">{{ number_format($product->sale_price) }}</span> đ</p>
                    <p class="promo">{{ number_format($product->cover_price) }} đ</p>
                  </div>
                  <p class="des">
                    {{ $product->excerpt }}
                  </p>
                </div>

                <div class="order">
                  <div class="order-wrap">
                    <form method="get" action="{{ route('cart-add') }}">
                      {{ csrf_field() }}
                      <input type="hidden" name="id" value="{{ $product->id }}" />
                      <div class="quantity-wrap">
                        <p>{{ trans('home.Số lượng') }}</p>
                        <div class="quantity-group btn-group">
                          <button type="button" class="btn btn-number minus" data-type="minus"><i
                              class="fa-solid fa-minus"></i></button>
                          <input type="text" class="input-number text-center" id="number-quantity" value="1"
                            name="quantity" min="1" max="100" pattern="[0-9]*">
                          <button type="button" class="btn btn-number plus" data-type="plus"><i
                              class="fa-solid fa-plus"></i></button>
                        </div>
                      </div>

                      <div class="quantity-control">
                        <div class="cart-group">
                          @if ($product->product_warehouse->where('warehouse_id', '2')->first()->quantity > 0)
                            <button type="submit"
                              {{ $product->product_warehouse->where('warehouse_id', '2')->first()->quantity ? '' : 'disabled' }}
                              class="btn btn-default" id="btn-buy">
                              <img class="img-fluid" src="{{ '/imgs/icon-shopping-cart-bl.svg' }}" alt=""
                                srcset="">
                              {{ trans('home.Thêm giỏ hàng') }}
                            </button>
                          @else
                            <button type="submit" class="btn btn-default"
                              id="btn-buy">{{ trans('home.ĐẶT TRƯỚC') }}</button>
                          @endif
                        </div>
                        <div class="quantity-warehouse d-none">
                          <!-- (Số lượng còn trong kho: {{ $product->product_warehouse->where('warehouse_id', '2')->first()->quantity }}) -->
                          @if ($product->product_warehouse->where('warehouse_id', '2')->first()->quantity > 0)
                            <input type="text" hidden="true" id="quantityWarehouses"
                              value="{{ $product->product_warehouse->where('warehouse_id', '2')->first()->quantity }}">
                          @else
                            <input type="text" hidden="true" id="quantityWarehouses"
                              value="{{ $product->product_warehouse->where('warehouse_id', '1')->first()->quantity }}">
                          @endif
                        </div>
                        {{-- <div class="wishlist">
                            <a href="#" class="btn btn-primary add-to-wishlist" data-bs-toggle="modal"
                              data-bs-target="#getFormLike">
                              <span class="wishlist-icon">
                                <i class="fa-regular fa-heart"></i>
                              </span>
                            </a>
                          </div> --}}
                      </div>
                    </form>
                  </div>
                  <!-- <span id="error" class="alert alert-danger"></span> -->
                  <div id="error"></div>
                </div>

                <div class="social-share">
                  <p class="title">Share:</p>
                  <div class="icon">
                    <a href="#" class="item">
                      <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a href="#" class="item">
                      <i class="fa-brands fa-youtube"></i>
                    </a>
                  </div>
                </div>

                {{-- <div class="promo-info">
                    <img class="img-fluid image-promo" src="{{ asset('imgs/promo-info.png') }}" alt="">
                    <div class="info-detail">
                      <h5 class="title">Dịch vụ & Khuyến mãi kèm theo</h5>
                      <div class="content">
                        <ul>
                          <li>
                            <p>Trải nghiệm dịch vụ Bookcare để được bọc sách Plastic cao cấp. <a
                                href="#">{{ trans('home.Xem chi tiết') }}</a></p>
                          </li>

                          <li>
                            <p>Miễn phí giao hàng toàn quốc cho đơn hàng từ 300.000 ( Áp dụng từ 1/1/2019) <a
                                href="https://rbooks.vn/shipping-method">{{ trans('home.Xem chi tiết') }}</a></p>
                          </li>

                          <li>
                            <p>Dịch vụ tặng quà, cùng thông điệp của riêng bạn. <a href="#gift-popup"
                                class="open-popup-link">{{ trans('home.Xem chi tiết') }}</a></p>
                          </li>
                        </ul>

                        <div id="gift-popup" class="white-popup mfp-hide">
                          <h5 class="gift-title">TẶNG QUÀ CÙNG THÔNG ĐIỆP CỦA RIÊNG BẠN</h5>
                          <p class="my-4s">Còn gì ý nghĩa hơn tặng đến người bạn yêu quý những cuốn sách giá trị cùng
                            lời nhắn gửi được in trên chiếc thiệp xinh xắn. R Books hân hạnh được giúp bạn trao gửi yêu
                            thương với dịch vụ tặng quà, gửi thiệp.</p>
                          <p style="font-weight: bold; margin-bottom: 0;">Bạn chỉ cần:</p>
                          <ul>
                            <li><span><i class="fas fa-check"></i></span>Lựa chọn sản phẩm yêu thích để gửi tặng.</li>
                            <li><span><i class="fas fa-check"></i></span>Trong mục “Thanh toán”, click chọn “Gói quà
                              tặng”.</li>
                            <li><span><i class="fas fa-check"></i></span>Điền lời chúc yêu thương của riêng bạn.</li>
                          </ul>
                          <p style="font-weight: bold; margin-bottom: 0; margin-top: 15px;">Lợi ích của dịch vụ:</p>
                          <ul>
                            <li><span><i class="fas fa-check"></i></span>Tiết kiệm thời gian, chi phí: R Books cam kết
                              chất lượng từ khâu lựa chọn sản phẩm, bao gói kĩ lưỡng xinh đẹp; đến giao tận tay người
                              nhận.</li>
                            <li><span><i class="fas fa-check"></i></span>Chi phí trọn gói chỉ với <span
                                style="font-weight: bold;">20,000đ</span>.</li>
                            <li style="text-align: center;"><img class="py-4 img-fluid"
                                src="{{ asset('/imgs/gift-3.png') }}"></li>
                            <li><span><i class="fas fa-check"></i></span>Giấy gói quà và thiệp tặng được lựa chọn từ hơn
                              100 mẫu khác nhau của R Books.</li>
                            <li style="text-align: center;"><img class="py-4 img-fluid"
                                src="{{ asset('/imgs/gift-1.png') }}"></li>
                            <li><span><i class="fas fa-check"></i></span>Hóa đơn không kèm giá.</li>
                            <li style="text-align: center;"><img class="py-4 img-fluid"
                                src="{{ asset('/imgs/gift-2.png') }}"></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section section-product-promotion">
    <div class="container">
      <div class="product-promotion-wrap">
        <p class="title"><b>{{ trans('home.Dịch vụ & Khuyến mãi kèm theo') }}</b>
          ({{ trans('home.Áp dụng cho các sản phẩm sách RBooks') }})</p>
        <div class="promo-list">
          <div class="promo-item">
            <img class="img-fluid" src="{{ '/imgs/promo-product-img-1.jpg' }}" alt="" srcset="">
            <div class="promo-item__content">
              <p>{{ trans('home.Miễn phí giao hàng toàn quốc') }}</p>
              <p>{{ trans('home.Đơn hàng 300.000 đ') }}</p>
            </div>
          </div>
          <div class="promo-item">
            <img class="img-fluid" src="{{ '/imgs/promo-product-img-2.jpg' }}" alt="" srcset="">
            <div class="promo-item__content">
              <p>{{ trans('home.Trải nghiệm dịch vụ Bookcare') }}</p>
              <p>{{ trans('home.Bọc sách Plastic cao cấp') }}</p>
            </div>
          </div>
          <div class="promo-item">
            <img class="img-fluid" src="{{ '/imgs/promo-product-img-3.jpg' }}" alt="" srcset="">
            <div class="promo-item__content">
              <p>{{ trans('home.Dịch vụ') }}</p>
              <p>{{ trans('home.Gói quà tặng') }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section section-product-info">
    <div class="container">
      <div class="product-info-wrap">
        <div class="product-detail-nav">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description"
                type="button" role="tab" aria-controls="description"
                aria-selected="true">{{ trans('home.Mô tả') }}</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail" type="button"
                role="tab" aria-controls="detail"
                aria-selected="false">{{ trans('home.Chi tiết sản phẩm') }}</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#video" type="button"
                role="tab" aria-controls="video" aria-selected="false">Video</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="comment-tab" data-bs-toggle="tab" data-bs-target="#comment" type="button"
                role="tab" aria-controls="comment" aria-selected="false">
                <span class="text">{{ trans('home.Đánh giá') }} </span>
                <span class="badge bg-danger">{{ $comments->count() }}</span>
              </button>
            </li>
          </ul>

          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
              <div class="des-wrap">
                {!! $product->description !!}
              </div>
              <button type="button" class="btn btn-primary read-more"></button>
            </div>

            <div class="tab-pane fade" id="detail" role="tabpanel" aria-labelledby="detail-tab">
              <h4 class="title">{{ trans('home.Thông tin chi tiết') }}</h4>
              <table class="table table-striped detail-info">
                <tbody>
                  <tr>
                    <th>{{ trans('home.Tác giả') }}:</th>
                    <td>{{ $product->author }}</td>
                  </tr>

                  <tr>
                    <th>{{ trans('home.Kích thước') }}:</th>
                    <td>{{ $product->size }}</td>
                  </tr>

                  <tr>
                    <th>{{ trans('home.Số trang') }}:</th>
                    <td>{{ $product->paper }}</td>
                  </tr>

                  <tr>
                    <th>{{ trans('home.Loại bìa') }}:</th>
                    <td>Bìa cứng</td>
                  </tr>

                  <tr>
                    <th>{{ trans('home.Năm xuất bản') }}:</th>
                    <td>{{ $product->publishing_year }}</td>
                  </tr>

                  <tr>
                    <th>{{ trans('home.Nhà phát hành') }}:</th>
                    <td>{{ $product->publisher }}</td>
                  </tr>

                  <tr>
                    <th>{{ trans('home.Nhà xuất bản') }}:</th>
                    <td>{{ $product->pub_company }}</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
              {{ trans('home.Không có dữ liệu') }}
            </div>

            <div class="tab-pane fade" id="comment" role="tabpanel" aria-labelledby="comment-tab">
              <div class="comment-wrap">
                <div class="comment-header">
                  <div class="icon">
                    <img class="img-fluid" src="{{ asset('imgs/icon-comment.png') }}" alt="">
                  </div>
                  <h4 class="title">
                    {{ trans('home.Đánh giá - Nhận xét từ khách hàng') }}
                  </h4>
                </div>
                <div class="comment-body">
                  <div class="comment-statistic">
                    <div class="item">
                      <div class="comment-point">
                        <p class="point">{{ $rating }}.0</p>
                        <div class="info">
                          @if (empty($comments->first()))
                            <div class="quantity">
                              <span class="quantity-num">0</span> {{ trans('home.nhận xét') }}
                            </div>
                            <div class="rate">
                              <img class="img-fluid" src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
                              <img class="img-fluid" src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
                              <img class="img-fluid" src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
                              <img class="img-fluid" src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
                              <img class="img-fluid" src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá">
                            </div>
                          @else
                            <div class="quantity">
                              <span class="quantity-num">{{ $comments->count() }}</span>
                              {{ trans('home.nhận xét') }}
                            </div>
                            <div class="rate">
                              @for ($i = 0; $i < $comments->avg('rate'); $i++)
                                <img class="img-fluid" src="{{ asset('imgs/star.jpg') }}" alt="Đánh giá">
                              @endfor
                            </div>
                          @endif
                        </div>
                      </div>
                      {{-- @if (Auth::check() && !empty(count($checkorders)))
                        <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal"
                          data-bs-target="#modalComment">
                          {{ trans('home.Viết nhận xét') }}
                        </button>
                      @endif --}}
                      <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal"
                          data-bs-target="#modalComment">
                          {{ trans('home.Viết nhận xét') }}
                        </button>
                      @include('pages.shopping.productcontroller.addcomment')
                    </div>
                    <div class="item">
                      <div class="comment-progress">
                        <div class="progress-item">
                          <div class="rate" data-rate="5"></div>
                          <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                            </div>
                          </div>
                          <p class="quantity">{{ $commentsRate5->count() }}</p>
                        </div>

                        <div class="progress-item">
                          <div class="rate" data-rate="4"></div>
                          <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                            </div>
                          </div>
                          <p class="quantity">{{ $commentsRate4->count() }}</p>
                        </div>

                        <div class="progress-item">
                          <div class="rate" data-rate="3"></div>
                          <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                            </div>
                          </div>
                          <p class="quantity">{{ $commentsRate3->count() }}</p>
                        </div>

                        <div class="progress-item">
                          <div class="rate" data-rate="2"></div>
                          <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                            </div>
                          </div>
                          <p class="quantity">{{ $commentsRate2->count() }}</p>
                        </div>

                        <div class="progress-item">
                          <div class="rate" data-rate="1"></div>
                          <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                            </div>
                          </div>
                          <p class="quantity">{{ $commentsRate1->count() }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="comment-list">
                @foreach ($product->comments as $comment)
                  <div class="item">
                    <img class="img-fluid avatar" src="{{ asset('imgs/user-avt-comment.png') }}" alt="">
                    <div class="content">
                      <h5 class="name mb-3">
                        {{ $comment->customer->fullname }}
                      </h5>
                      <div class="rate mb-2">
                        @for ($i = 0; $i < $comment->rate; $i++)
                          <img class="img-fluid" src="{{ asset('imgs/star.jpg') }}" alt="Đánh giá">
                        @endfor
                      </div>
                      <p class="text mb-2">
                        {{ $comment->content }}
                      </p>
                      <p class="time">
                        {{ $comment->created_at->format('d/m/Y') }}
                      </p>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section section-books-topic">
    <div class="container">
      <div class="product-carousel">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{ trans('home.Sách cùng chủ đề') }}</h5>
          </div>
          <div class="card-body">
            <div class="owl-carousel owl-theme product product-detail-list vertical flex-nowrap">
              @foreach ($productCategory as $product)
                @include('pages.homecontroller.product-a-page')
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section section-books-topic">
    <div class="container">
      <div class="product-carousel">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{ trans('home.Sách bán chạy') }}</h5>
          </div>
          <div class="card-body">
            <div class="owl-carousel owl-theme product product-detail-list vertical flex-nowrap">
              @foreach ($productBestSales as $product)
                @include('pages.homecontroller.product-a-page')
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection


@section('script')
  <script src="{{ asset('/js/quantity-product.js') }}"></script>
@endsection
