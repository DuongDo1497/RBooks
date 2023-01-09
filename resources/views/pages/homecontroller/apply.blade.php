<form role="form" action="{{ route('apply') }}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="modal fade" id="careerModal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header-register">
	        	<h5 class="modal-title-registerCV">Đăng ký CV</h5>
	      	</div>
		  <hr style="color: #0578c4;">
	      <div class="modal-body-register">
	          	<div class="form-group mb-3">
	                <label class="form-control-register">Tên ứng viên</label>
	                <input type="text" class="form-control-registerCV" placeholder="Tên ứng viên" name="fullname" required="">
	            </div>

	            <div class="form-group mb-3">
	                <label class="form-control-register">Số điện thoại</label>
	                <input type="text" class="form-control-registerCV" placeholder="Số điện thoại" name="phone" required pattern="(\+84|0)\d{9}">
	            </div>

	            <div class="form-group mb-3">
	                <label class="form-control-register">Email</label>
	                <input type="email" id="emails" class="form-control-registerCV" placeholder="Email" name="emails" required="">
	            </div>

	            <div class="form-group mb-3">
	                <label class="form-control-register">Giới tính</label>
                    <select class="form-control-registerCV select gender" name="gender">
                        <option value="0">Nữ</option>
                        <option value="1">Nam</option>
                        <option value="2">Khác</option>
                    </select>
	            </div>
	      </div>
		  <hr style="color: #0578c4;">
	      <div class="modal-footer-upload">
		  		<div class="form-group mb-0">
	            	<label class="mr-3">Upload CV</label>
	                <input style="cursor:pointer;" type="file" name="file_cv" required="">
	            </div>
	        <button type="submit" class="btn btn-primary">Gửi</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>