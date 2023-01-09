@extends('layouts.master')

<style type="text/css">
	.btn-career:focus {
		box-shadow: none !important;
	}

	.select2-container {
		width: 100% !important;
	}

	.select2-container .select2-selection--single {
		height: 40px !important;
	}

	.select2-container--default .select2-selection--single {
		border: 1px solid #ced4da !important;
	}

	.select2-container--default .select2-selection--single .select2-selection__rendered {
		line-height: 40px !important;
	}

	.select2-container--default .select2-selection--single .select2-selection__arrow {
		height: 40px !important;
	}
</style>

@section('content')

<div class="recruitment-main">
	<div class="container">
		<div class="row">

			<div class="col-lg-12 col-md-12">
				@if(session('msg'))
				<div class="alert alert-success mb-5">
					{{session('msg')}}
				</div>
				@endif
				<!-- Start Styles. Move the 'style' tags and everything between them to between the 'head' tags -->
				<div class="recruitment">
					<h4 style="padding: 0 0 2rem 0;">Tuyển dụng các vị trí sau:</h4>
					<table class="table-recruitment" width="100%">
						<thead>
							<tr>
								<th>STT</th>
								<th>Vị trí tuyển dụng</th>
								<th width="20%">Số lượng (người)</th>
								<th width="20%">Hạn nộp hồ sơ</th>
								<th> </th>
							</tr>
						</thead>

						<tbody>
							@php
							$i = 1
							@endphp
							@foreach($recruitments as $recruitment)
							<tr>

								<td>{{$i}}</td>
								<td>{{$recruitment->vacancies}}</td>
								<td>{{$recruitment->quantity}}</td>
								@if($recruitment->status==1)
								<td>{{date("d/m/Y", strtotime($recruitment->application_deadline))}}</td>
								@elseif($recruitment->status==2)
								<td class="text-danger">{{date("d/m/Y", strtotime($recruitment->application_deadline))}}</td>
								@endif
								<td>

									<a href="{{ route('recruitment-detail',['id'=>$recruitment->id]) }}">Xem chi tiết</a>
								</td>
							</tr>
							@php
							$i++
							@endphp
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<script type="text/javascript">
	var $disabledResults = $(".gender");
	$disabledResults.select2();
</script>
@endsection