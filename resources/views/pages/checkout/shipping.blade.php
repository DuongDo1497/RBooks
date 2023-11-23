@extends('layouts.master')

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
      <!-- <div class="h4">2. Địa chỉ giao hàng</div> -->
      <p class="mb-3">{{ trans('home.Chọn địa chỉ giao hàng có sẵn bên dưới') }}:</p>
      <div class="pl-3 address-question">{{ trans('home.Bạn muốn giao hàng đến địa chỉ khác?') }} <a
          href="{{ route('create-address') }}">{{ trans('home.Thêm địa chỉ giao hàng mới') }}</a>
      </div>
      @if (session('alert'))
        <div class="row alert alert-danger mt-2 mb-0">
          {{ session('alert') }}
        </div>
      @endif
      @foreach ($addresses as $address)
        @if ($address->default == 1)
          <div class="customer-address-default mt-4">
            <form action="{{ route('checkout-process') }}" role='form' method="post">
              {{ csrf_field() }}
              <input type="text" name="id" value="{{ $address->id }}" hidden="true">
              <div class="customer-address-list">
                <div class="customer-item">
                  <div class="customer-name">{{ $address->fullname }}</div>
                  <div class="customer-address">{{ trans('home.Địa chỉ') }}: {{ $address->address }}</div>
                  <div class="customer-number">{{ trans('home.Điện thoại') }}: {{ $address->phone }}</div>
                  <div class="btn-address">
                    <button type="submit" class="btn btn-info">{{ trans('home.Giao đến địa chỉ này') }}</button>
                    <button type="button" class="btn btn-default"
                      onclick="window.location.href='{{ route('edit-address', ['id' => $address->id]) }}'"
                      {{ $address->default == 0 ? "hidden = 'true'" : '' }}>{{ trans('home.Sửa') }}</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        @else
          <div class="customer-address-nodefault mt-4 mb-3">
            <form action="{{ route('checkout-process') }}" role='form' method="post">
              {{ csrf_field() }}
              <input type="text" name="id" value="{{ $address->id }}" hidden="true">
              <div class="customer-name">{{ $address->fullname }}</div>
              <div class="customer-address">{{ trans('home.Địa chỉ') }} {{ $address->address }}</div>
              <div class="customer-number">{{ trans('home.Điện thoại') }} {{ $address->phone }}</div>
              <div class="btn-address">
                <button type="submit" class="btn btn-default">{{ trans('home.Giao đến địa chỉ này') }}</button>
                <button type="button" class="btn btn-default"
                  onclick="window.location.href='{{ route('edit-address', ['id' => $address->id]) }}'"
                  {{ $address->default != 0 ? "hidden = 'true'" : '' }}>{{ trans('home.Sửa') }}</button>
                <button type="button" class="btn btn-default"
                  onclick="window.location.href='{{ route('delete-address', ['id' => $address->id]) }}'"
                  {{ $address->default != 0 ? "hidden = 'true'" : '' }}><i class="fa fa-trash"
                    aria-hidden="true"></i></button>
              </div>
            </form>
          </div>
        @endif
      @endforeach
    </div>
  </div>
@endsection
