<ul class="menu-parent">
  <li class="menu-parent-item">
    <a href="#" class="menu-parent-link">
      <span class="icon"><i class="fa-regular fa-user"></i></span>
      <span class="text">{{ trans('home.Tài khoản của tôi') }}</span>
    </a>

    <ul class="menu-child">
      <li class="menu-child-item">
        <a href="{{ route('customer') }}" class="menu-child-link">
          {{ trans('home.Thông tin') }}
        </a>
      </li>

      <li class="menu-child-item">
        <a href="{{ route('customer-addresses') }}" class="menu-child-link">
          {{ trans('home.Địa chỉ') }}
        </a>
      </li>

      <li class="menu-child-item">
        <a href="{{ route('customer-updatepassword') }}" class="menu-child-link">
          {{ trans('home.Đổi mật khẩu') }}
        </a>
      </li>
    </ul>
  </li>

  <li class="menu-parent-item">
    <a href="{{ route('customer-myinformation') }}" class="menu-parent-link">
      <span class="icon"><i class="fa-regular fa-bell"></i></span>
      <span class="text">{{ trans('home.Thông báo của tôi') }}</span>
    </a>
  </li>

  <li class="menu-parent-item">
    <a href="{{ route('customer-order') }}" class="menu-parent-link">
      <span class="icon"><i class="fa-solid fa-list"></i></span>
      <span class="text">{{ trans('home.Quản lý đơn hàng') }}</span>
    </a>
  </li>

  <li class="menu-parent-item">
    <a href="{{ route('customer-comment') }}" class="menu-parent-link">
      <span class="icon"><i class="fa-brands fa-opencart"></i></span>
      <span class="text">{{ trans('home.Sản phẩm đã mua') }}</span>
    </a>
  </li>

  <li class="menu-parent-item">
    <a href="{{ route('product-view') }}" class="menu-parent-link">
      <span class="icon"><i class="fa-regular fa-eye"></i></span>
      <span class="text">{{ trans('home.Sản phẩm đã xem') }}</span>
    </a>
  </li>

  <li class="menu-parent-item">
    <a href="{{ route('customer-favorite') }}" class="menu-parent-link">
      <span class="icon"><i class="fa-regular fa-heart"></i></span>
      <span class="text">{{ trans('home.Sản phẩm yêu thích') }}</span>
    </a>
  </li>
</ul>



<ul class="list-unstyled d-none">
  <li class="customer-menu-text pl-3"><a href="{{ route('customer') }}"><i class="fas fa-user"></i><span
        class="pl-3 pl-lg-2">{{ trans('home.Thông tin tài khoản') }}</span></a></li>
  <li class="customer-menu-text pl-3"><a href="{{ route('customer-myinformation') }}"><i class="fas fa-bell"></i><span
        class="pl-3 pl-lg-2">{{ trans('home.Thông báo của tôi') }}</span></a></li>
  <li class="customer-menu-text pl-3"><a href="{{ route('customer-order') }}"><i class="fas fa-list-ul"></i><span
        class="pl-3 pl-lg-2">{{ trans('home.Quản lý đơn hàng') }}</span></a></li>
  <li class="customer-menu-text pl-3"><a href="{{ route('customer-addresses') }}"><i
        class="fas fa-map-marker-alt"></i><span class="pl-3 pl-lg-2">{{ trans('home.Sổ địa chỉ') }}</span></a></li>
  <li class="customer-menu-text pl-3"><a href="{{ route('customer-comment') }}"><i class="fas fa-comments"></i><span
        class="pl-3 pl-lg-2">{{ trans('home.Nhận xét sản phẩm') }}</span></a></li>
  <li class="customer-menu-text pl-3"><a href="{{ route('product-view') }}"><i class="fa fa-eye"></i><span
        class="pl-3 pl-lg-2">{{ trans('home.Sản phẩm bạn đã xem') }}</span></a></li>
  <li class="customer-menu-text pl-3"><a href="{{ route('customer-favorite') }}"><i class="fa fa-heart"></i><span
        class="pl-3 pl-lg-2">{{ trans('home.Sản phẩm yêu thích') }}</span></a></li>
  <li class="customer-menu-text pl-3"><a href="{{ route('customer-question') }}"><i class="fas fa-question"></i><span
        class="pl-3 pl-lg-2">{{ trans('home.Hỏi đáp') }}</span></a></li>
  <li class="customer-menu-text pl-3"><a href="{{ route('customer-updatepassword') }}"><i class="fa fa-heart"></i><span
        class="pl-3 pl-lg-2">Thay đổi mật khẩu</span></a></li>
</ul>
