@extends('layouts.master')
@section('content')
  <div class="main-contact">
    <div class="container">
      <div class="contact-us">
        <div class="form-contact-us">
          <h4 class="contact">{{ trans('home.Liên hệ với chúng tôi') }}</h4>
          <form class="form-contact-us-customer">
            <div class="name-phone">
              <input class="name" type="text" name="username" placeholder="{{ trans('home.Họ và tên') }}" required>
              <input class="phone" type="phone" name="phone" placeholder="{{ trans('home.Số điện thoại') }}"
                pattern="(\+84|0)\d{9}" required>
            </div>
            <input class="email" id="email" type="email" name="email" placeholder="Email"
              pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
            <textarea class="message-content" rows="5" type="text" name="message-content"
              placeholder="{{ trans('home.Nội dung tin nhắn') }}" required></textarea>
            <button class="btn-send">{{ trans('home.Gửi') }} <i class="fa-solid fa-paper-plane"></i></button>
          </form>
        </div>
        <div class="form-contact-time">
          <div class="form-contact-item calendar">
            <img class="icon-calendar" src="{{ 'imgs/icon-calendar.png' }}" alt="">
            <div class="calendar-timeday">
              <p class="time">8 AM - 5 PM <b class="day">( {{ trans('home.Thứ 2 - Thứ 6') }} )</b></p>
              <p class="time">8 AM - 12 PM <b class="day">( {{ trans('home.Thứ 7') }} ) -
                  {{ trans('home.Chủ nhật nghỉ') }}</b></p>
            </div>
          </div>
          <div class="form-contact-item form-contact-address">
            <i class="fa-solid fa-location-dot"></i>
            <p class="icon-address-title">
              {{ trans('home.Vinhomes Central Park, 720A Điện Biên Phủ, phường 22, quận Bình Thạnh, TP Hồ Chí Minh.') }}
            </p>
          </div>
          <div class="form-contact-item form-contact-email">
            <i class="fa-solid fa-envelope"></i>
            <p class="icon-email-title"> info@rbooks.vn</p>
          </div>
          <div class="form-contact-item form-contact-call">
            <i class="fa-solid fa-phone-volume"></i>
            <p class="icon-call-title">08 4966 4005 (Viber/Skype/Zalo)</p>
          </div>
        </div>
      </div>
      <div class="map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.2346918063818!2d106.71941042591331!3d10.79332870887995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528a98f124785%3A0x61f3bc81b7ef4017!2zVmluaG9tZXMgVMOibiBD4bqjbmcsIFBoxrDhu51uZyAyMiwgQsOsbmggVGjhuqFuaCwgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1721899095057!5m2!1svi!2s"
          width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
          tabindex="0"></iframe>
      </div>
    </div>
  </div>
@endsection
