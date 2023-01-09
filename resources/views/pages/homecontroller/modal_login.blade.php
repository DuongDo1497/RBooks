<div class="modal fade" id="modalLogin">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header-login">
                <form action="{{ route('login') }}" method="post" class="form-horizontal" id="formLogin">
                    @csrf
                    <!-- <div class="btn-close-login"><i class="fa-solid fa-xmark"></i></div> -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="form-login">Đăng nhập</h3>
                    </div>
                    <div class="form-group {{$errors->has('name') || $errors->has('password')  ? ' has-error' : '' }}">
                        <div class="form-group-email-password row">

                        
                            <input class="form-control" id="confirmEmail" type="text" name="name" placeholder="Tên tài khoản/Email" value="{{ old('name') }}" onkeyup="manageBtn(this)">                          
                
                            @if($errors->has('name')|| $errors->has('password') || $errors->has('email') )
                                <span class="form-message-email-password">
                                    <strong class="help-block">Sai tài khoản hoặc email hoặc mật khẩu </strong>
                                </span>
                            @endif

                            <span class="form-message-email-password"></span>
                        </div>
                        
                        <span class="form-message-email"></span>
                        <div class="form-group-email-password row ">

                        <input id="confirmPasswordLogin" type="password" name="password" placeholder="Mật khẩu" class="form-control" onkeyup="manageBtn(this)">

                         
                            <span style="cursor:pointer ;" class="absolute-password"><i class="fas fa-eye icon-eye-loginPwd eye-login "></i></span>
                            <span style="cursor:pointer ;" class="absolute-password"><i class="fas fa-eye-slash icon-eye-loginPwd eye-slash-login"></i></span>
                            <span class="form-message-email-password"></span>
                        </div>

                        <div class="form-group row p-9">
                            <div class="float-right">
                                <a href="{{ route('password.reset') }}" class="text-danger-Forgotpassword">Quên mật khẩu? </a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalRegister" class="text-danger-register">Đăng ký</a>
                            </div>
                        </div>
                        <button class="btn btn-login" id="btnLogin" type="submit" disabled>Đăng nhập</button>
                        <div class="modal-footerLogin p-2 pb-3 pt-9">
                            <div class="seperator"><b style="color: #666666;">
                                    <p>hoặc</p>
                                </b></div>
                            <a href="{{ route('facebook-login') }}"><i class="fa-brands fa-facebook"></i></a>
                            <a href="{{ route('google-login') }}"><i class="fa-brands fa-google-plus"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent


@if($errors->has('name')|| $errors->has('password') || $errors->has('email') )

    <script>
    $(function() {
       
        $('#modalLogin').modal('toggle');
    });
    </script>
@endif
@endsection
<script>
    function manageBtn(txt) {
        var btn = document.getElementById('btnLogin');
        if (confirmEmail.value != '' && confirmPasswordLogin.value != '') {
            btn.disabled = false;
        }
        else {
        btn.disabled = true;
        }
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mong muốn của chúng ta
        Validator({
            form: '#formLogin',
            formGroupSelector: '.form-group-email-password',
            errorSelector: '.form-message-email-password',
            rules: [
                Validator.isRequired('#confirmEmail'),
                Validator.isRequired('#confirmPasswordLogin'),
            ],
            onSubmit: function(data) {
                console.log(data);
            }
        });
    });
</script>
<div class="modal fade" id="modalForgotPassword">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header-forgot-password">
            </div>
        </div>
    </div>
</div>