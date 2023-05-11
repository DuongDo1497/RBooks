<div class="item">
    <a href="{{ route('product.index', ['id' => $product->id, 'alias' =>$product->slug ]) }}">
        <div class="thumbnail">
            <img class="img-fluid" src="{{ empty($product->images->last()) ? asset(RBOOKS_NO_IMAGE_URL) : RBOOKS_IMAGE_URL . $product->images->last()->path }}" alt="">
            @if(!is_null($product->sale_price) && $product->sale_price != 0)
            <span class="promo-percent">{{ round(100 - ($product->sale_price / $product->cover_price * 100), 0) }}%</span>
            @endif
            <div class="icon-control">
                <span class="icon-control-item">
                    <i class="fa-solid fa-basket-shopping"></i>
                </span>
                <span class="icon-control-item">
                    <i class="fa-solid fa-eye"></i>
                </span>
                <span class="icon-control-item">
                    <i class="fa-solid fa-heart"></i>
                </span>
            </div>
        </div>
        <div class="detail">
            <div class="info reverse">
                <p class="author">{{ $product->author ?? "No Name" }}</p>
                <h5 class="name">{{ $product->name }}</h5>
            </div>
            <div class="rate">
                @if($product->comments->avg('rate') > 0)
                    @for($i = 0; $i < $product->comments->avg('rate'); $i++)
                        <span class="icon">
                            <img src="{{ asset('imgs/star.jpg') }}" alt="">
                        </span>
                    @endfor
                @else
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
                @endif
            </div>
            <div class="price">
                <p class="sale"><span class="number">{{ number_format($product->sale_price) }}</span> đ</p>
                @if(!is_null($product->sale_price) && $product->sale_price != 0)
                    <p class="promo">{{ number_format($product->cover_price) }} đ</p>
                @endif
            </div>
        </div>
    </a>
</div>