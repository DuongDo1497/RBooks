@extends('layouts.master')

@section('content')

<div class="reply-question">
	<div class="container py-5">
		<div class="reply-question-box">
			<div class="row">
				<div class="col-sm-9 col-12 reply-question-content">
					<h4 class="title-question">{{ $questions->question }}</h4>
					<hr>
					@if (session('alert'))
			            <div class="row alert alert-danger mt-2 mb-0">
			                {{ session('alert') }}
			            </div>
			            <hr>
			        @endif
			        @if(session('success'))
						<div class="alert alert-success">{{ Session('success')}}</div>
					@endif
					<form action="{{ route('answer') }}" method="post" accept-charset="utf-8">
                        {{ csrf_field() }}
						<div class="row pb-3">
							<div class="col-sm-10 col-12">
								<input type="text" hidden="true" name="question_id" value="{{ $questions->id }}">
	                            <input type="text" name="answer" id="content" data-product="" class="form-control" value="" placeholder="Hãy đặt câu trả lời liên quan đến sản phẩm..." required="required">
	                        </div>
	                        <div class="col-sm-2 col-12 text-center mt-3 mt-sm-0">
	                            <button type="submit" class="btn btn-primary btn-add-question" style="background-color: #283b91; border: 1px solid #283b91;">Gửi câu trả lời</button>
	                        </div>
						</div>
					</form>
					<h5 class="title">CÁC CÂU TRẢ LỜI</h5>
					<hr>
					@foreach($questions->answers->where('status', '1') as $answer)
					<div class="reply row">
						<div class="col-sm-1 col-1 like text-center d-sm-block d-none">
                            <p class="number-like" style="font-size: 24px;">{{ $answer->likeanswers->count() }}</p>
                            <p class="text">Thích</p>
                        </div>
						<div class="col-sm-11 col-8 clearfix">
							<h6 class="name font-weight-bold">{{ $answer->customer['fullname'] == null ? "Rbooks" : $answer->customer['fullname'] }}</h6>
							<p class="content-question text-justify pr-2">{{ $answer->answer }}</p>
							<p class="action float-left"><a href="javascript:void(0)" data-id="{{ $answer->id }}" data-toggle="modal" data-target="#getFormLike" class="action-like" style="color: #283b91;"><i class="fas fa-thumbs-up"></i><span> Thích</span></a></p>
							<span class="action-count-mb pl-3 d-sm-none">
                                <span class="icons" style="color: red;"><i class="fas fa-heart"></i></span> <span class="text">{{ $answer->likeanswers->count() }}</span>
                            </span>
						</div>
						<div class="col-4 d-sm-none d-block">
							<a href="<?php echo e(route('product.index', ['id' => $questions->products->id, 'alias' =>$questions->products->slug ])); ?>">
								<span class="name-books font-weight-bold pr-1 d-sm-none d-block" style="font-size: 15px; color: #283b91;">Tên sách:</span>
								<span style="color: #000;">{{ $questions->products->name }}</span>
							</a>
						</div>
					</div>
					@endforeach
				</div>
				<div class="col-sm-3 col-12 reply-question-img d-sm-block d-none">
					<a href="<?php echo e(route('product.index', ['id' => $questions->products->id, 'alias' =>$questions->products->slug ])); ?>" style="color: #283b91;">
						<img src="{{  RBOOKS_IMAGE_URL . $questions->products->images->last()->path }}" class="img-fluid">
						<h6>{{ $questions->products->name }}</h6>
					</a>
				</div>
			</div>
		</div>
	</div>
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
<!-- End thông báo -->
@endsection

@section('script')
<script>
	$(function(){
		$('.action-like').click(function(){
			var id = $(this).data('id');
			$.get('{{ route('like-answer') }}', { id:id }, function(data){
				$('#like_message').text(data.msg);
			})
		})
	});
</script>
@endsection