@extends('layouts.master')

<style type="text/css">
	.info-buyer-box{
		margin: 0 auto;
		width: 75%;
	}

	.gender-item select.form-control{
		width: 40%;
		margin-left: 0;
		border: 1px solid #ced4da;
		height: calc(2.25rem + 2px) !important;
		padding: .375rem .75rem;
	}
</style>

@section('content')
<div id="address-container">
    <div class="container">
        <div class="row process">
            <div class="col-sm-9 col-12 d-flex align-items-center clearfix process-header">
                <div class="process-img float-left"><img src="{{ asset('imgs/truck-delivery.png') }}" alt=""></div>
                <span class="process-title ml-3">{{ trans('home.BƯỚC 2: ĐỊA CHỈ GIAO HÀNG') }}</span>
            </div>
        </div>
        <hr>

        @if(session('alert'))
            <div class="row alert alert-danger mt-2 mb-0">
                {{ session('alert') }}
            </div>
        @endif

        <div class="row">
        	<div class="col-sm-12">
		        <div class="info-buyer-box mt-4 mb-4 clearfix">
		        	<form action="{{ route('checkout-process') }}" role='form' method="post">
		        		{{ csrf_field() }}
		        		<div class="fullname-item">
		        			<div class="form-group row">
								<label class="col-sm-2 col-form-label"><b>Họ và tên:</b></label>
								<div class="col-sm-10">
									<input type="text" class="form-control fullname" name="fullname" maxlength="90" placeholder="Nhập họ và tên của bạn...." required>
								</div>
							</div>
		        		</div>

		        		<div class="birthday-item">
		        			<div class="form-group row">
								<label class="col-sm-2 col-form-label"><b>Ngày sinh:</b></label>
								<div class="col-sm-10">
									<input type="date" class="form-control birthday" name="birthday" placeholder="Nhập ngày sinh của bạn...." required>
								</div>
							</div>
		        		</div>

		        		<div class="gender-item">
		        			<div class="form-group row">
								<label class="col-sm-2 col-form-label"><b>Giới tính:</b></label>
								<div class="col-sm-10">
									<select class="form-control" name="gender">
								        <option value="">Chọn</option>
								        <option value="1">Nam</option>
								        <option value="0">Nữ</option>
								        <option value="2">Khác</option>
								    </select>
								</div>
							</div>
		        		</div>

		        		<div class="email-item">
		        			<div class="form-group row">
								<label class="col-sm-2 col-form-label"><b>Email:</b></label>
								<div class="col-sm-10">
									<input type="email" class="form-control email" name="email" placeholder="email@example.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
								</div>
							</div>
		        		</div>

		        		<div class="phone-item">
		        			<div class="form-group row">
								<label class="col-sm-2 col-form-label"><b>Số điện thoại:</b></label>
								<div class="col-sm-10">
									<input type="number" class="form-control phone" name="phone" maxlength="30" placeholder="Nhập số điện thoại của bạn...." required>
								</div>
							</div>
		        		</div>

		        		<div class="address-item">
		        			<div class="form-group row">
								<label class="col-sm-2 col-form-label"><b>Địa chỉ:</b></label>
								<div class="col-sm-10">
									<input type="text" class="form-control address" name="address" maxlength="250" placeholder="Nhập địa chỉ giao hàng...." required>
								</div>
							</div>
		        		</div>

		        		<div class="address-item">
		        			<div class="form-group row">
								<label class="col-sm-2 col-form-label"><b>Phường/Xã:</b></label>
								<div class="col-sm-10">
									<input type="text" class="form-control address" name="ward" maxlength="250" placeholder="Nhập phường/xã" required>
								</div>
							</div>
		        		</div>

		        		<div class="address-item">
		        			<div class="form-group row">
								<label class="col-sm-2 col-form-label"><b>Quận/Huyện:</b></label>
								<div class="col-sm-10">
									<input type="text" class="form-control address" name="district" maxlength="250" placeholder="Nhập quận/huyện" required>
								</div>
							</div>
		        		</div>
		        		<div class="gender-item">
		        			<div class="form-group row">
								<label class="col-sm-2 col-form-label"><b>Tỉnh/Tp:</b></label>
								<div class="col-sm-10">
									<select class="form-control address" name="city">
								        <option>Chọn</option>
		                                @foreach($cityprovinces as $cityprovince)
		                                    <option value="{{ $cityprovince->name }}">{{ $cityprovince->name }}</option>
		                                @endforeach
								    </select>
								</div>
							</div>
		        		</div>

		        		<button type="submit" class="btn btn-success float-right mt-4">Tiếp tục <i class="fas fa-arrow-right"></i></button>
		        	</form>
		        </div>
		    </div>
	    </div>

    </div>
</div>
@endsection
