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
            <div class="col-lg-9 col-md-10 col-8">
                <div class="profile">
                    <div class="pb-2"><span class="h5">HỎI ĐÁP</span></div>
                    <hr>
                    @foreach($customer->questions as $question)
                    <div class="list-question-box">
                        <div class="list-question-items clearfix">
                            <div class="group-left clearfix d-sm-block d-none">
                                <div class="item text-center">
                                    <p class="number-like">{{ $question->likequestions->count() }}</p>
                                    <p class="text">Thích</p>
                                </div>
                                <div class="item text-center">
                                    <p class="number-comment">{{ $question->answers->where('status', '1')->count() }}</p>
                                    <p class="text">Trả lời</p>
                                </div>
                            </div>
                            <div class="group-right">
                                <p class="date">{{ $question->created_at }}</p>
                                <p class="name"><a href="<?php echo e(route('product.index', ['id' => $question->products->id, 'alias' =>$question->products->slug ])); ?>">{{ $question->products->name }}</a></p>
                                <div class="content">{{ $question->question }}</div>
                                @foreach($question->answers->where('status', '1') as $answer)
                                    <div class="reply"><span class="font-weight-bold">Trả lời: </span>{{ $answer->answer }} - <span class="customer font-weight-bold"> {{ $answer->customer['fullname'] == null ? "Rbooks" : $answer->customer['fullname'] }}</span> đã trả lời</div>
                                @endforeach
                            </div>
                            <div class="group-mobile clearfix d-sm-none d-block">
                                <div class="like-mb float-left pr-2"><span class="icons"><i class="fas fa-heart"></i></span> <span class="text">{{ $question->likequestions->count() }}</span></div>
                                <div class="comment-mb"><span class="icons"><i class="fas fa-comments"></i></span> <span class="text">{{ $question->answers->count() }}</span></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
@endsection



