    @extends('layouts.master')

    @section('content')
      <div class="section section-account">
        <div class="container">
          <div class="account-wrap">
            <div class="row">
              <div class="col-xxl-4">
                <div class="card account-sidebar">
                  <div class="card-header account-info">
                    <div class="avatar"></div>
                    <div class="info">
                      <p class="number-id">{{ trans('home.Tài khoản của') }}</p>
                      <p class="name">{{ $customer->fullname }}</p>
                    </div>
                  </div>
                  <div class="card-body account-menu">
                    @include('pages.customer.partials.menu')
                  </div>
                </div>
              </div>

              <div class="col-xxl-8">
                <div class="card account-body update-password">
                  <div class="card-header">
                    <h4 class="info-title">{{ trans('home.Đổi mật khẩu') }}</h4>
                    <p class="desc-info">
                      {{ trans('home.Để bảo mật tài khoản , vui lòng không chia sẻ mật khẩu cho người khác') }}</p>
                  </div>
                  <div class="card-body">
                    <form id="form-update-password" class="form-update-pass" method="POST"
                      action="{{ route('customer-putUpdatePassword', ['id' => Auth()->user()->id]) }}">
                      @csrf
                      @method('PUT')

                      <div class="form-update">
                        <lable class="form-update-lable">{{ trans('home.Mật khẩu hiện tại') }}</lable>
                        <input id="password-current" class="input-update-pass" type="password" name="old_password"
                          require=true />

                        <span class="update-pass-hide"><i
                            class=" fa-solid fa-eye-slash icon-eye-rePwdUpda eye-slash-rePwdUpdate"></i></span>
                        <span class="update-pass-show"><i
                            class=" fa-solid fa-eye icon-eye-rePwdUpda eye-rePwdUpdate"></i></span>
                        <!-- <a href="#" class="forgot-pass">Quên mật khẩu?</a> -->
                      </div>
                      @if ($errors->has('old_password'))
                        <div class="text-danger update-password-error">{{ $errors->first('old_password') }}</div>
                      @endif
                      <p class="update-pass-curent"></p>

                      <div class="form-update form-update-passnew">
                        <lable class="form-update-lable">{{ trans('home.Mật khẩu mới') }}</lable>
                        <input id="password-new" class="input-update-pass" type="password" name="new_password"
                          require=true />
                        <span class="update-pass-show"><i id="icon-rePwd"
                            class=" fa-solid fa-eye icon-eye-rePwdUpdaNew eye-rePwdUpdateNew"></i></span>
                        <span class="update-pass-hide"><i id="icon-rePwd"
                            class=" fa-solid fa-eye-slash icon-eye-rePwdUpdaNew eye-slash-rePwdUpdateNew"></i></span>
                      </div>
                      <p id="StrengthDisp" class="update-pass-curent update-pass-curentnew"></p>
                      <div class="form-update form-update-passconfirm">
                        <lable class="form-update-lable">{{ trans('home.Xác nhận mật khẩu') }}</lable>
                        <input id="password-new1" class="input-update-pass" type="password" name="newpassword"
                          require=true />
                        <span class="update-pass-show"><i id="icon-rePwd"
                            class=" fa-solid fa-eye icon-eye-rePwdUpdaNew1 eye-rePwdUpdateNew1"></i></span>
                        <span class="update-pass-hide"><i id="icon-rePwd"
                            class=" fa-solid fa-eye-slash icon-eye-rePwdUpdaNew1 eye-slash-rePwdUpdateNew1"></i></span>
                      </div>
                      <p class="update-pass-curent update-pass-curentnew1"></p>
                      <button class="btn-update-pass" type="submit">{{ trans('home.Xác nhận') }}</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="customer-container" style="display: none;">
        <div class="container mt-5 mb-5">
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
              <div class="update-pass">


                <div class="pb-2">
                  <span class="h2">Đổi mật khẩu</span>
                  <p class="update-pass-p">Để bảo mật tài khoản , vui lòng không chia sẻ mật khẩu cho người khác</p>
                </div>
                <hr>

                <form id="form-update-password" class="form-update-pass" method="POST"
                  action="{{ route('customer-putUpdatePassword', ['id' => Auth()->user()->id]) }}">
                  @csrf
                  @method('PUT')

                  <div class="form-update">
                    <lable class="form-update-lable">Mật khẩu hiện tại</lable>
                    <input id="password-current" class="input-update-pass" type="password" name="old_password"
                      require=true />

                    <span class="update-pass-hide"><i
                        class=" fa-solid fa-eye-slash icon-eye-rePwdUpda eye-slash-rePwdUpdate"></i></span>
                    <span class="update-pass-show"><i
                        class=" fa-solid fa-eye icon-eye-rePwdUpda eye-rePwdUpdate"></i></span>
                    <!-- <a href="#" class="forgot-pass">Quên mật khẩu?</a> -->
                  </div>
                  @if ($errors->has('old_password'))
                    <div class="text-danger update-password-error">{{ $errors->first('old_password') }}</div>
                  @endif
                  <p class="update-pass-curent"></p>

                  <div class="form-update form-update-passnew">
                    <lable class="form-update-lable">Mật khẩu mới</lable>
                    <input id="password-new" class="input-update-pass" type="password" name="new_password"
                      require=true />
                    <span class="update-pass-show"><i id="icon-rePwd"
                        class=" fa-solid fa-eye icon-eye-rePwdUpdaNew eye-rePwdUpdateNew"></i></span>
                    <span class="update-pass-hide"><i id="icon-rePwd"
                        class=" fa-solid fa-eye-slash icon-eye-rePwdUpdaNew eye-slash-rePwdUpdateNew"></i></span>
                  </div>
                  <p id="StrengthDisp" class="update-pass-curent update-pass-curentnew"></p>
                  <div class="form-update form-update-passconfirm">
                    <lable class="form-update-lable">Xác nhận mật khẩu</lable>
                    <input id="password-new1" class="input-update-pass" type="password" name="newpassword"
                      require=true />
                    <span class="update-pass-show"><i id="icon-rePwd"
                        class=" fa-solid fa-eye icon-eye-rePwdUpdaNew1 eye-rePwdUpdateNew1"></i></span>
                    <span class="update-pass-hide"><i id="icon-rePwd"
                        class=" fa-solid fa-eye-slash icon-eye-rePwdUpdaNew1 eye-slash-rePwdUpdateNew1"></i></span>
                  </div>
                  <p class="update-pass-curent update-pass-curentnew1"></p>
                  <button class="btn-update-pass" type="submit">Xác nhận</button>
                </form>
              </div>

            </div>
          </div>
        </div>
      </div>
    @endsection

    @section('script')
      <script>
        @if (session('success'))
          {
            toastr.success('{{ session('success') }}');
          }
        @endif
      </script>
    @endsection
