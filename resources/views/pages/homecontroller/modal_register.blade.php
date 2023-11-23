<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- <div class="modal-content__border"> -->
      <!-- Modal Header -->
      <!-- <div class="btn-close-register"  ><i class="fa-solid fa-xmark"></i></div> -->
      <div class="modal-header mrl-32">
        <h3>{{ trans('home.Đăng ký') }}</h3>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form class="form" id="formRegister" action="{{ route('register') }}" method="POST"
          class="form-horizontal p-3">
          @csrf
          <div class="form-group row ">
            <input type="text" id="ursRegister" class="form-control txt-field " name="name" autofocus
              placeholder="{{ trans('home.Tên tài khoản/Email') }}">
            <span><i class="icon-input fa-solid fa-user"></i></span>
            <span class="invalid-feedback" role="alert" id="nameError">
              <strong></strong>
            </span>
          </div>
          <small class="msg_user">Error Message</small>

          <div class="form-group row">
            <input type="email" id="emailRegister" class="form-control txt-field " name="email" placeholder="Email">
            <span><i class="icon-input fa-solid fa-envelope"></i></span>
            <span class="invalid-feedback" role="alert" id="emailError">
              <strong></strong>
            </span>
          </div>
          <small class="msg_email">Error Message</small>

          <div class="form-group row">
            <input type="password" id="pwdRegister" class="form-control txt-field" name="password"
              placeholder="{{ trans('home.Mật khẩu') }}">
            <span><i id="icon-pwd" class="icon-input fa-solid fa-eye icon-eye-pwd eye-pwd"></i></i></span>
            <span><i id="icon-pwd" class="icon-input fa-solid fa-eye-slash icon-eye-pwd eye-slash-pwd"></i></i></span>
            <!-- <small>Error Message</small> -->
          </div>
          <small class="msg_pwd">Error Message</small>

          <div class="form-group row">
            <input type="password" id="confirmRegister" class="form-control txt-field" name="password_confirmation"
              placeholder="{{ trans('home.Xác nhận mật khẩu') }}">
            <span><i id="icon-rePwd" class="icon-input fa-solid fa-eye icon-eye-rePwd eye-rePwd"></i></i></span>
            <span><i id="icon-rePwd"
                class="icon-input fa-solid fa-eye-slash icon-eye-rePwd eye-slash-rePwd"></i></i></span>
            <!-- <small>Error Message</small> -->
          </div>
          <small class="msg_confirm">Error Message</small>

          <div class="float-right row ">
            <button type="submit" class="btn btn-danger btn-modal w-100">{{ trans('home.Đăng ký') }}</button>
            <!-- <input type="submit" class="btn btn-danger btn-modal w-100" value="Đăng ký" /> -->
          </div>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer p-2 pt-3">
        <div class="seperator"><b style="color: #666666;">
            <p>{{ trans('home.hoặc') }}</p>
          </b></div>
        <a href="{{ route('facebook-login') }}"><i class="icon-fb fa-brands fa-facebook"></i></a>
        <a href="{{ route('google-login') }}"><i class="icon-gg fa-brands fa-google-plus"></i></a>
        <!-- <a href="{{ route('facebook-login') }}"><img class="img-fluid" src="{{ asset('imgs/login_fb.png') }}" alt=""></a>
                <a href="{{ route('google-login') }}"><img class="img-fluid" src="{{ asset('imgs/login_gg.png') }}" alt=""></a> -->
      </div>
      <!-- </div> -->
    </div>
  </div>
</div>


@section('script')
  @parent

  <script>
    $(function() {
      $('#formRegister').submit(function(e) {

        let isValidEmail = checkRequired(email);
        let isValidLengthUrs = checkLength(username, 6, 15);
        let isValidLengthPwd = checkLength(password, 6, 25);
        let isValidLengthConfirm = checkLength(password2, 6, 25);
        if (isValidEmail === true) {
          isValidEmail = checkEmail(email);
        }
        //let isValidEmail = checkEmail(email);
        let isValidSamePwd = checkPasswordMatch(password, password2);
        console.log(isValidLengthUrs + " " + isValidLengthPwd + " " +
          isValidLengthConfirm + " " +
          isValidEmail + " " + isValidSamePwd);

        if (!isValidLengthUrs || !isValidLengthPwd ||
          !isValidLengthConfirm ||
          !isValidEmail || !isValidSamePwd) {
          e.preventDefault();
          return 0;
        }


        let formData = $(this).serializeArray();
        e.preventDefault();
        $(".invalid-feedback").children("strong").text("");
        $("#formRegister input").removeClass("is-invalid");
        $.ajax({
          method: "POST",
          headers: {
            Accept: "application/json"
          },
          url: "{{ route('register') }}",
          data: formData,
          success: () => window.location.assign("{{ route('home') }}"),
          error: (response) => {
            if (response.status === 422) {
              //Thông báo lỗi   
              let errors = response.responseJSON.errors;
              Object.keys(errors).forEach(function(key) {
                if (key === "name") {
                  showError(username, "Tài khoản đã tồn tại")

                }
                if (key === "email") {
                  showError(email, "Email đã tồn tại")

                }
                // $("#" + key + "Input").addClass("is-invalid");
                // $("#" + key + "Error").children("strong").text(errors[key][0]);
              });
            } else {

              window.location.reload();
            }
          }
        })

      });
    })
  </script>
@endsection
