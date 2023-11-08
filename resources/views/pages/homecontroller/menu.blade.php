<div class="menu-default-wrap" style="display: none;">
  <div class="menu-category-icon">
    <a href="#"><i class="fa-solid fa-bars"></i></a>
  </div>

  <ul class="menu-default">
    <li class="menu-item">
      <a href="{{ route('home') }}" class="menu-link">{{ trans('home.Home') }}</a>
    </li>
    <li class="menu-item">
      <a href="{{ route('about-rbooks') }}" class="menu-link">{{ trans('home.About') }}</a>
    </li>
    <li class="menu-item">
      <a href="{{ route('products') }}" class="menu-link">{{ trans('home.Books') }}</a>
    </li>
    {{-- <li class="menu-item">
            <a href="{{ route('paper') }}" class="menu-link">{{trans('home.Paper')}}</a>
        </li> --}}
    {{-- <li class="menu-item">
            <a href="{{ route('recruitment') }}" class="menu-link">{{trans('home.Career')}}</a>
        </li> --}}
    <li class="menu-item">
      <a href="{{ route('contact') }}" class="menu-link">{{ trans('home.Contact') }}</a>
    </li>
  </ul>
</div>
