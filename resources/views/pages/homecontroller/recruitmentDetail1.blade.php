@extends('layouts.master')

@section('content')
<div class="recruitment-detail-main">
	<div class="container">
		<div class="row">

			<div class="col-lg-12 col-md-12">
				<div class="recruitment-detail">
					<h2>{{$recruitment->title}} ({{$recruitment->vacancies}})</h2>

					<table class="table table-bordered mt-5" width="100%">
						<tbody>
							<tr>
								<th colspan="2"><b>CHI TIẾT CÔNG VIỆC</b></th>
							</tr>

							<tr>
								<th><b>Vị trí</b></th>
								<td>{{$recruitment->title}} ({{$recruitment->vacancies}})</td>
							</tr>

							<tr>
								<th><b>Số lượng</b></th>
								<td>{{$recruitment->quantity}}</td>
							</tr>

							<tr>
								<th><b>Quyền lợi</b></th>
								<td>
									<ul>
										<li>{{$recruitment->job_description->benefit}}</li>
									</ul>
								</td>
							</tr>

							<tr>
								<th><b>Mô tả công việc</b></th>
								<td>
									<ul>
										<li>{{$recruitment->job_description->introduction}}</li>
									</ul>
								</td>
							</tr>

							<tr>
								<th><b>Yêu cầu công việc</b></th>
								<td>
									<ul>
										<li>{{$recruitment->job_description->requirements}}</li>
									</ul>
								</td>
							</tr>

							<tr>
								<th><b>Yêu cầu khác</b></th>
								<td>
									<ul>
										<li>{{$recruitment->job_description->orther_requirements}}</li>
									</ul>
								</td>
							</tr>

							<tr>
								<th colspan="2"><b>LIÊN HỆ (Lưu ý: Chỉ nhận hồ sơ qua email hoặc ứng tuyển trực tiếp trên website.)</b></th>
							</tr>

							<tr>
								<th><b>Tiêu đề email</b></th>
								<td>VỊ TRÍ ỨNG TUYỂN – [tên ứng viên]</td>
							</tr>

							<tr>
								<th><b>Người liên hệ</b></th>
								<td>Ms.Kim Ngân</td>
							</tr>

							<tr>
								<th><b>Địa chỉ</b></th>
								<td>L4-42.OT05, Landmark 4 Vinhomes Central Park, 720A Điện Biên Phủ, P.22, Q.Bình Thạnh, Tp.HCM</td>
							</tr>

							<tr>
								<th><b>Email</b></th>
								<td>info@rbooks.vn</td>
							</tr>

							<tr>
								<th><b>Điện thoại</b></th>
								<td>0918 475 500 / 0918 435 005</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection