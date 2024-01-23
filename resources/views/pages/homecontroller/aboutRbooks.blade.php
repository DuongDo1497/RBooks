@extends('layouts.master')
@section('content')
  <div class="wrapper">
    <div class="section section-about-Rbooks">
      <div class="container">
        <div class="about-wrap">
          <div class="about-wrap-img">
            <img class="img-fluid" src="{{ 'imgs/about_img.png' }}" alt="">
          </div>
          <div class="about-wrap-content">
            <h4 class="about-title">
              {{ trans('home.Giới thiệu') }}
            </h4>
            <div class="about-content-item">
              <!-- <img src="{{ 'imgs/about_building.png' }}" alt=""> -->
              <i class="about-content-icon fa-solid fa-building"></i>
              <span>{{ trans('home.Công Ty TNHH R Books') }}</span>
            </div>
            <div class="about-content-item">
              <!-- <img src="{{ 'imgs/about_building_direct.png' }}" alt=""> -->
              <i class="about-content-icon fa-solid fa-location-dot"></i>
              <span>{{ trans('home.Vinhomes Central Park, 720A Điện Biên Phủ, phường 22, quận Bình Thạnh, TP Hồ Chí Minh.') }}</span>
            </div>
            <div class="about-content-item">
              <!-- <img src="{{ 'imgs/about_phone_img.png' }}" alt=""> -->
              <i class="about-content-icon fa-solid fa-phone-volume"></i>
              <span>0918 90 55 00 {{ trans('home.hoặc') }} 08 4966 4005 (Viber/Skype/Zalo)</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section section-about-content">
      <div class="container container-content">
        <div class="about-content-wrap">

          <div class="about-logo">
            <h4>Slogan</h4>
            <p>
              <img class="icon-ngoac" src="{{ 'imgs/icon_mo_ngoac.png' }}" alt="">
              {{ trans('home.Nâng tầm tri thức') }}
              <img class="icon-ngoac" src="{{ 'imgs/icon_dong_ngoac.png' }}" alt="">
            </p>
          </div>

          <div class="about-content-slogan">
            <div class="content-slogan-item border-rl-2">
              <div class="content-slogan border-rl-2">
                <div class="content-slogan__image"><img src="{{ 'imgs/icon_slogan.png' }}" alt=""></div>
                <h4>Slogan</h4>
                <p>{{ trans('home.Dựa trên điểm nhấn cuốn sách thể hiện ngọn lửa tri thức, ngọn lửa trí tuệ') }}</p>
                <p>
                  {{ trans('home.Logo RBooks thể hiện là một biểu tượng hạt giống tri thức đang nảy mầm mang đến niềm tin, kiến thức và cơ hội thay đổi cuộc đời cho mỗi độc giả Việt Nam.') }}
                </p>
              </div>
            </div>

            <div class="content-slogan-item border-rr-2">
              <div class="content-slogan border-rr-2">
                <div class="content-slogan__image"><i class="fa-solid fa-eye"></i></div>
                <!-- <div class="content-slogan__image"><img src="{{ 'imgs/icon_tam_nhin.png' }}" alt=""></div> -->
                <h4>{{ trans('home.Tầm nhìn') }}</h4>
                <p>{{ trans('home.Trở thành công ty sách dẫn đầu về lĩnh vực Tài chính cá nhân tại Việt Nam.') }}</p>
              </div>
            </div>

            <div class="content-slogan-item">
              <div class="content-slogan">

                <div class="content-slogan__image"><i class="fa-solid fa-fire"></i></div>
                <h4 class="mh-70">{{ trans('home.Sứ mệnh') }}</h4>
                <p>
                  {{ trans('home.RBooks mang hạt giống tri thức, trí tuệ của nhân loại đến độc giả Việt Nam và Quốc Tế.') }}
                </p>

              </div>
            </div>

            <div class="content-slogan-item">
              <div class="content-slogan">

                <div class="content-slogan__image"><i
                    style=" margin-top: -0.8rem;"class="fa-solid fa-arrow-up-right-dots"></i></div>
                <h4 style="margin-top: 1.8rem;">{{ trans('home.Định hướng phát triển doanh nghiệp') }}</h4>
                <p>{{ trans('home.Phát hành sách Tiếng Việt và Tiếng Anh trên thị trường Việt Nam và Quốc Tế.') }}</p>
              </div>
            </div>

            <div class="content-slogan-item border-rlb-2">
              <div class="content-slogan border-rlb-2">
                <div class="content-slogan__image"><i class="fa-solid fa-gem"></i></div>
                <h4>{{ trans('home.Giá trị cốt lõi') }}: 4R</h4>
                <p><span class="fw-bold">Read (Đọc sách)</span>:
                  {{ trans('home.RBooks mong muốn mỗi một độc giả đều sẽ được trải qua 4 cung bậc cảm xúc khi đọc một cuốn sách mình yêu thích: Đọc, Hiểu, Cảm, Ngộ.') }}
                </p>
                <p><span class="fw-bold">Real (Xác thực)</span>:
                  {{ trans('home.Sách là sản phẩm có tính chất văn hóa và chứa đựng tư tưởng, trí tuệ của tác giả. RBooks tôn trọng Quyền tác giả, cam kết gửi đến độc giả những sách thật, 100% sách có bản quyền.') }}
                </p>
                <p><span class="fw-bold">Run (Ứng dụng)</span>:
                  {{ trans('home.Cuộc sống luôn vận động. Tri thức luôn vận động. RBooks luôn lựa chọn những sách có giá trị, những sách có kiến thức ứng dụng thực tiễn. Sách của RBooks sẽ cùng “chạy” với độc giả trên con đường xây dựng đời sống tài chính lành mạnh nhất có thể.') }}
                </p>
                <p><span class="fw-bold">Rich (Thịnh vượng)</span>:
                  {{ trans('home.Đích đến của R Books là: giàu tri thức, giàu tình cảm, giàu bản lĩnh và giàu cả về vật chất. Vì vậy, chú trọng phát triển dòng sách lĩnh vực Tài chính cá nhân chúng tôi mong muốn, mỗi độc giả sẽ tìm thấy con đường thịnh vượng cho chính mình.') }}
                </p>

              </div>
            </div>

            <div class="content-slogan-item border-rrl-2">
              <div class="content-slogan border-rrl-2">
                <div class="content-slogan__image"><i class="fa-solid fa-heart-pulse"></i></div>
                <h4>{{ trans('home.Niềm tin doanh nghiệp') }}</h4>
                <p>{{ trans('home.Một sản phẩm chất lượng là một sản phẩm mang lại giá trị thực sự cho người dùng.') }}
                </p>
                <p>
                  {{ trans('home.Mỗi một khách hàng dù nhỏ hay lớn đều là những khách hàng “giá trị nhất” của RBooks.') }}
                </p>
                <p>{{ trans('home.Luôn tuân thủ Quy luật cộng hưởng giữa khách hàng và doanh nghiệp.') }}</p>
                <p>{{ trans('home.Cho đi chính là cách nhanh nhất để đạt được mọi điều mình muốn.') }}</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection
