@extends('layouts.master')

@section('content')
<div id="customer-container">
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
            <div class="col-lg-9 col-md-10 col-8" id="banner-container">
                <div class="product-bought">
                    <div class="product-bought-header"><span class="h2">Sản phẩm đã mua</span></div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ trans('home.Đánh giá') }}</th>
                                <th width="40%">{{ trans('home.Nội dung đánh giá') }}</th>
                                <th>{{ trans('home.Sao') }}</th>
                                <th>{{ trans('home.Sản phẩm') }}</th>
                                <th>{{ trans('home.Ngày đánh giá') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Vòng lặp --}}
                            @foreach($comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td>
                                	@switch($comment->headding)
	                                    @case(1)
	                                        <span>Rất không hài lòng</span>
	                                        @break
	                                    @case(2)
	                                        <span>Không hài lòng</span>
	                                        @break
	                                    @case(3)
	                                        <span>Bình thường</span>
	                                        @break
	                                    @case(4)
	                                        <span>Hài Lòng</span>
	                                        @break
	                                    @default
	                                        <span>Rất hài lòng</span>
                                	@endswitch
                                </td>
                                <td class="text-justify">{{ $comment->content }}</td>
                                <td>{{ $comment->rate }}</td>
                                <td>{{ $comment->products->first()->name }}</td>
                                <td>{{ $comment->created_at }}</td>
                            </tr>
                            @endforeach
                            {{-- Hết vòng lặp --}}
                        </tbody>
                    </table>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">{{ $comments->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
@endsection
