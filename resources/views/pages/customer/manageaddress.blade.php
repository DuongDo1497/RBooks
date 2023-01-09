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
                                <p class="number-id">Tài khoản của</p>
                                <p class="name">{{ $customer->fullname }}</p>
                            </div>
                        </div>
                        <div class="card-body account-menu">
                            @include('pages.customer.partials.menu')
                        </div>
                    </div>
                </div>

                <div class="col-xxl-8">
                    <div class="card account-body manager-address">
                        <div class="card-header">
                            <h4 class="profile-address">Địa chỉ của tôi</h4>
                            <button class="btn new-address" type="submit" data-bs-toggle="modal" data-bs-target="#modalAddAddress">+ THÊM ĐỊA CHỈ MỚI </button>
                        </div>
                        <div class="card-body">
                            @if(session('thongbao'))
                                <div class= "alert alert-success">
                                    {{session('thongbao')}}
                                </div>
                            @endif

                            @foreach($customer->addresses as $address)
                                @if($address->default == 1)
                                <div class="address-form">
                                    {{ csrf_field() }}
                                    <input type="text" name="id" value="{{ $address->id }}" hidden="true">
                                    <table style="width:100%">
                                        <tr>
                                            <th width="25%">Họ và tên</th>
                                            <td>{{ $address->fullname }}<span>
                                                <span class="badge badge-primary">Mặc định</span>
                                                <span class="btn-edit" ><a href="#"data-bs-toggle="modal" data-bs-target="#modalEditAddress"> Chỉnh sửa</a></span>
                                            </span></td>
                                        </tr>
                                        <tr>
                                            <th width="25%">Số điện thoại</th>
                                            <td>
                                                    {{ $address->phone }}
                                                    <span class="btn btn-default btn-set-default btn-set-default__disabled">Thiết lập mặc định</span>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="25%">Địa chỉ</th>
                                            <td>{{ $address->address }}</td>
                                        </tr>
                                        <!-- <tr>
                                           
                                            <th width="25%"></th>
                                            <td><a class="btn btn-link btn-edit" href="#" data-bs-toggle="modal" data-bs-target="#modalEditAddress">
                                                <div class="text">
                                                    Chỉnh sửa
                                                </div>
                                            </td>
                                        </tr> -->
                                    </table>
                                </div>
                                @else
                                <div class="address-form">
                                    {{ csrf_field() }}
                                    <input type="text" name="id" value="{{ $address->id }}" hidden="true">
                                    <table style="width:100%">
                                        <tr>
                                            <th width="25%">Họ và tên</th>
                                            <td>{{ $address->fullname }}<span>
                                                <!-- <span class="badge badge-primary"></span> -->
                                                <span class="btn-edit btn-edit__notdefault" ><a href="#"data-bs-toggle="modal" data-bs-target="#modalEditAddress"> Chỉnh sửa</a> <a href="#"data-bs-toggle="modal" data-bs-target="#modalDeleteAddress">Xóa</a></span>
                                            </span></td>
                                        </tr>
                                        <tr>
                                            <th width="25%">Số điện thoại</th>
                                            <td>
                                                    {{ $address->phone }}
                                                    <span class="btn btn-default btn-set-default btn-set-default__enabled">Thiết lập mặc định</span>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="25%">Địa chỉ</th>
                                            <td>{{ $address->address }}</td>
                                        </tr>
                                        
                                    </table>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="customer-container" style="display: none;">
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
                    <div class="profile-address"><span class="h3">Địa chỉ của tôi</span>
                        <button class="btn new-address" type="submit" data-bs-toggle="modal" data-bs-target="#modalAddAddress">+ THÊM ĐỊA CHỈ MỚI </button>
                    </div>
                    
                    <hr>
                    @if(session('thongbao'))
                            <div class= "alert alert-success">
                                {{session('thongbao')}}
                            </div>
                    @endif
                    <!-- <div class="pl-3 change-address">{{ trans('home.Bạn muốn giao hàng đến địa chỉ khác?') }} <a href="{{ route('create-address') }}">{{ trans('home.Thêm địa chỉ giao hàng mới') }}</a>
                    </div> -->
                    <div class="address-form">
                        <table style="width:100%">
                            <tr>
                                <th >Họ và tên</th>
                                <td>Lorem Ipsum</td>
                            </tr>
                            <tr>
                                <th >Số điện thoại</th>
                                <td>0000000000</td>
                            </tr>
                            <tr>
                                <th>Địa chỉ</th>
                                <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</td>
                            </tr>
                            <tr>
                                <th>  </th>
                                <td style="color: #0578c4;" ><a href="#" data-bs-toggle="modal" data-bs-target="#modalEditAddress">
                                    <div class="text">
                                        Chỉnh sửa
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Chỉnh sửa -->
<div class="modal fade" id="modalEditAddress">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-editaddress">
                <form method="post" class="form-editaddress" id="form">
                    <div class="editaddress">
                        <h5>Chỉnh sửa địa chỉ</h5>
                    </div>
                    <hr style="opacity: 0.1;">
                    <div class ="form-group-edit">
                        <div class = "form-group-editaddress">
                            <div class="text-name">
                                <label for="name" >Họ và tên</label>
                                    <input autocomplete="off" type="text" id="name" required>
                            </div>
                        </div>
                        <div class = "form-group-phone">
                            <div class="text-phone">
                                <label for="phone">Số điện thoại</label>
                                    <input autocomplete="off" type="text" id="phone" required pattern="(\+84|0)\d{9}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group-address">
                            <div class="text-address">
                                <div class="form-group-city">
                                    <div class="text-address-city">
                                        <label for="city">Tỉnh/Thành phố</label>
                                            <select autocomplete="off" type="text" id="city" required></select>
                                    </div>
                                </div>
                                <div class="form-group-district">
                                    <div class="text-address-district">
                                        <label for="district">Quận/Huyện</label>
                                            <select autocomplete="off" type="text" id="district" required></select>
                                    </div>
                                </div>
                                <div class="form-group-wards">
                                    <div class="text-address-wards">
                                        <label for="wards">Phường/Xã</label>
                                            <select autocomplete="off" type="text" id="wards" required></select>
                                    </div>
                                </div>
                    </div>
                    <div class = "form-group-specifically">
                            <div class="text-specifically">
                                <label for="specifically">Địa chỉ cụ thể</label>
                                    <input autocomplete="off" type="text" id="specifically" required>
                            </div>
                        </div>
                    </div>
                    <div class="float-default">
                        <label>
                            <input type="checkbox" checked="checked" name="remember"> Đặt làm địa chỉ mặc định
                        </label>  
                        <button onclick="functionOficeEditAddress()" style="float: right;" class="office-editaddress" type="button">Văn phòng</button>
                        <button onclick="functionHomeEditAddress()" style="float: right;" class="home-editaddress" type="button">Nhà riêng</button>
                    </div>
                    <hr style="opacity: 0.1;">
                    <div class="btn-backsave">
                        <button class="btn-back"><i class="fa-solid fa-arrow-rotate-left"></i> Quay lại</button>
                        <button class="btn-save"><i class="fa-solid fa-bookmark"></i> Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Thêm mới -->
<div class="modal fade" id="modalAddAddress">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-addaddress">
                <form method="post" class="form-addaddress" id="form">
                    <div class="addaddress">
                        <h5>Thêm địa chỉ mới</h5>
                    </div>
                    <hr style="opacity: 0.1;">
                    <div class ="form-group-edit">
                        <div class = "form-group-editaddress">
                            <div class="text-name">
                                <label for="name" >Họ và tên</label>
                                    <input autocomplete="off" type="text" id="name" required>
                            </div>
                        </div>
                        <div class = "form-group-phone">
                            <div class="text-phone">
                                <label for="phone">Số điện thoại</label>
                                    <input autocomplete="off" type="text" id="phone" required pattern="(\+84|0)\d{9}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group-address">
                            <div class="text-address">
                                <div class="form-group-city">
                                    <div class="text-address-city">
                                        <label for="city">Tỉnh/Thành phố</label>
                                            <select autocomplete="off" type="text" id="city" required></select>
                                    </div>
                                </div>
                                <div class="form-group-district">
                                    <div class="text-address-district">
                                        <label for="district">Quận/Huyện</label>
                                            <select autocomplete="off" type="text" id="district" required></select>
                                    </div>
                                </div>
                                <div class="form-group-wards">
                                    <div class="text-address-wards">
                                        <label for="wards">Phường/Xã</label>
                                            <select autocomplete="off" type="text" id="wards" required></select>
                                    </div>
                                </div>
                    </div>
                    <div class = "form-group-specifically">
                            <div class="text-specifically">
                                <label for="specifically">Địa chỉ cụ thể</label>
                                    <input autocomplete="off" type="text" id="specifically" required>
                            </div>
                        </div>
                    </div>
                    <div class="float-default">
                            <label>
                                <input type="checkbox" checked="checked" name="remember"> Đặt làm địa chỉ mặc định
                            </label>  
                            <button onclick="functionOficeAddress()" style="float: right;" class="office-address" type="button">Văn phòng</button>
                            <button onclick="functionHomeAddress()" style="float: right;" class="home-address" type="button">Nhà riêng</button>
                    </div>
                    <hr style="opacity: 0.1;">
                    <div class="btn-backsave">
                        <button class="btn-back"><i class="fa-solid fa-arrow-rotate-left"></i> Quay lại</button>
                        <button class="btn-save"><i class="fa-solid fa-bookmark"></i> Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Xóa -->
<div class="modal fade" id="modalDeleteAddress"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body">
        Bạn có thật sự muốn xóa?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-default">Xóa</button>
      </div>
    </div>
  </div>
</div>
