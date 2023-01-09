@extends('layouts.master')

<style type="text/css">
	.btn-career:focus{
		box-shadow: none !important;
	}

	.select2-container{
		width: 100% !important;
	}

	.select2-container .select2-selection--single{
		height: 40px !important;
	}

	.select2-container--default .select2-selection--single{
		border: 1px solid #ced4da !important;
	}

	.select2-container--default .select2-selection--single .select2-selection__rendered{
		line-height: 40px !important;
	}

	.select2-container--default .select2-selection--single .select2-selection__arrow{
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
				<!-- <iframe frameborder="0" src="https://drive.google.com/file/d/1kYkzHQ48KbxFsxmE-Vpz2cG91hLC9vPg/preview"></iframe> -->

				<div class="recruitment">
					<h2>{{trans('home.TUYỂN DỤNG') }}</h2>

					<table class="table table-bordered desktop mt-5" width="100%">
						<thead>
							<tr>
								<th><b>{{trans('home.STT') }}</b></th>
								<th width="50%"><b>{{trans('home.Vị trí tuyển dụng') }}</b></th>
								<th><b>{{trans('home.Số lượng (người)') }}</b></th>
								<th><b>{{trans('home.Hạn nộp hồ sơ') }}</b></th>
							</tr>
						</thead>

						<tbody>
							<!-- <tr>
								<td>1</td>
								<td><a href="{{ route('recruitment-detail') }}" target="_blank">NHÂN VIÊN VIẾT SÁCH (WRITER)</a></td>
								<td>5</td>
								<td><b class="text-danger">01/07/2020 (Hết hạn)</b></td>
							</tr> -->

							<tr>
								<td>1</td>
								<td><a href="#">IT</a></td>
								<td>3</td>
								<td><b class="text-danger">01/07/2020 ({{trans('home.Hết hạn') }})</b></td>
							</tr>
						</tbody>
					</table>

					<table class="table table-bordered mobile mt-5" width="100%">
						<thead>
							<tr>
								<th width="5%"><b>STT</b></th>
								<th><b>Chi tiết tuyển dụng</b></th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td>1</td>
								<td>
									<a href="{{ route('recruitment-detail') }}" target="_blank">NHÂN VIÊN VIẾT SÁCH (WRITER)</a>
									<p class="mb-0"><b>Số lượng:</b> 5</p>
									<p class="mb-0"><b>Hạn nộp hồ sơ:</b> <b class="text-danger">01/07/2020 (Hết hạn)</b></p>
								</td>
							</tr>

							<tr>
								<td>2</td>
								<td>
									<a href="#">IT</a>
									<p class="mb-0"><b>Số lượng:</b> 5</p>
									<p class="mb-0"><b>Hạn nộp hồ sơ:</b> <b class="text-danger">01/07/2020 (Hết hạn)</b></p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<button type="button" class="btn btn-primary btn-career mt-5" data-toggle="modal" data-target="#careerModal" style="width: 100%; background-color: #283b91; border: 1px solid #283b91;">ỨNG TUYỂN NGAY BÂY GIỜ</button>
			</div>

		</div>
	</div>
</div>

<form role="form" action="{{ route('apply') }}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="modal fade" id="careerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Đăng ký CV</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	          	<div class="form-group mb-3">
	                <label>Tên ứng viên</label>
	                <input type="text" class="form-control" placeholder="Tên ứng viên" name="fullname" required="">
	            </div>

	            <div class="form-group mb-3">
	                <label>Số điện thoại</label>
	                <input type="number" class="form-control" placeholder="Số điện thoại" name="phone" required="">
	            </div>

	            <div class="form-group mb-3">
	                <label>Email</label>
	                <input type="text" class="form-control" placeholder="Email" name="email" required="">
	            </div>

	            <div class="form-group mb-3">
	                <label class="d-block">Giới tính</label>
                    <select class="form-control select2 gender" name="gender">
                        <option>Chọn giới tính</option>
                        <option value="0">Nữ</option>
                        <option value="1">Nam</option>
                        <option value="2">Khác</option>
                    </select>
	            </div>

	            <div class="form-group mb-3">
	                <label>Vị trí ứng tuyển</label>
	                <input type="text" class="form-control" placeholder="Vị trí ứng tuyển" name="apply_position"  required="">
	            </div>

	            <div class="form-group mb-0">
	            	<label class="mr-3">Upload CV</label>
	                <input type="file" name="file_cv" required="">
	            </div>

	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary" style="background-color: #283b91; border: 1px solid #283b91;">Gửi</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<script type="text/javascript">
	var $disabledResults = $(".gender");
	$disabledResults.select2();
</script>
@endsection
