@extends('layouts.master')
@section('content')

<div class="about-rbooks">
	<div class="container py-5">
		<div class="about-rbooks-content">
			<h1 class="text-center font-weight-bold mb-5">{{trans('home.HỒ SƠ NĂNG LỰC') }}</h1>
			<!-- <p class="text-justify">{{trans('home.Mọi người vẫn luôn trầm trồ trước sự thành công, giàu có của Oprah Winfrey, Warren Buffett, Bill Gates, Elon Musk, Mark Zuckerberg,… Nhưng bạn có biết họ đều là những người đam mê đọc sách không?') }}</p>

			<p class="text-justify">{{trans('home.Bên cạnh những dòng sách kinh điển thì những dòng sách mới nào sẽ đáp ứng nhu cầu của đọc giả Việt Nam giai đoạn hiện nay? Liệu kiến thức nền tảng trong sách Quản lý tài chính về thoát khỏi nợ nần, tiết kiệm tiền nghỉ hưu, quản lý ngân sách gia đình,… có thật sự cần thiết?') }}</p>

			<p class="text-justify">{{trans('home.Nếu chỉ trăn trở mà không hành động thì mãi cũng chẳng giải quyết được vấn đề. Sau 11 năm hoạt động trong lĩnh vực tài chính, ngày 29/5/2014 bà Phạm Thị Ngọc Châu đã thành lập Công ty TNHH R Books.') }}</p>

			<p class="text-justify">{{trans('home.Với nhiều ý tưởng của người kinh doanh kết hợp với niềm đam mê sách, bà Phạm Thị Ngọc Châu (đại diện Công ty TNHH R Books) và ông Peter Pham (đại diện cho One Road Research và Phoenix Global Management) đã ký kết lễ hợp tác phát triển vào ngày 14/8/2016. Thông qua đó, cả hai đều muốn xây dựng một R Books trở thành đơn vị sách chuyên về lĩnh vực quản lý tài chính cá nhân uy tín, chất lượng, tôn trọng luật bản quyền tại Việt Nam và Quốc tế.') }}</p> -->
			<ul class="about-rbooks-list">
				<li>
					<h5>{{trans('home.Tên công ty') }}:</h5> <span>{{trans('home.Công ty TNHH R Books') }}</span>
					<p>- {{trans('home.Tên giao dịch: R Books Co., LTD') }}</p>
				</li>
				<li>
					<h5>{{trans('home.Địa chỉ') }}</h5> <span>{{trans('home.L4-42.OT05 (Officetel) , Tòa Landmark 4 Vinhomes Central Park, Số 720A Điện Biên Phủ, Phường 22, Quận Bình Thạnh, Tp Hồ Chí Minh.') }}</span>
				</li>
				<li>
					<h5>Hotline:</h5> <span>{{trans('home.028 3636 4405') }} {{trans('home.hoặc') }} {{trans('home.08 4966 4005') }} (Viber/Skype/Zalo)</span>
				</li>
				<li>
					<h5>Logo R Books:</h5>
					<img class="img-fluid" src="{{ asset('/imgs/logo_blue.png') }}" alt="R books Logo" title="RBooks.VN">
					<p class="text-justify">{{trans('home.Dựa trên điểm nhấn cuốn sách thể hiện ngọn lửa tri thức, ngọn lửa trí tuệ; Logo RBooks thể hiện là một biểu tượng hạt giống tri thức đang nảy mầm mang đến niềm tin, kiến thức và cơ hội thay đổi cuộc đời cho mỗi độc giả Việt Nam.') }}</p>
				</li>
				<li>
					<h5>Slogan</h5>
					<p>{{trans('home.Nâng tầm tri thức') }}.</p>
					<!-- <img class="img-fluid" src="{{ asset('/imgs/logo_blue.png') }}" alt="R books Logo" title="RBooks.VN" width="300"> -->
				</li>
				<li>
					<h5>{{trans('home.Tầm nhìn') }}</h5>
					<p>{{trans('home.Trở thành công ty sách dẫn đầu về lĩnh vực Tài chính cá nhân tại Việt Nam.') }}</p>
				</li>
				<li>
					<h5>{{trans('home.Sứ mệnh') }}</h5>
					<p>{{trans('home.RBooks mang hạt giống tri thức, trí tuệ của nhân loại đến độc giả Việt Nam và Quốc Tế.') }}</p>
				</li>
				<li>
					<h5>{{trans('home.Định hướng phát triển doanh nghiệp') }}</h5>
					<p>{{trans('home.Phát hành sách Tiếng Việt và Tiếng Anh trên thị trường Việt Nam và Quốc Tế.') }}</p>
				</li>
				<li>
					<h5>{{trans('home.Giá trị cốt lõi') }}: 4R</h5>
					<p class="text-justify">- {{trans('home.Đọc sách') }}: {{trans('home.RBooks mong muốn mỗi một độc giả đều sẽ được trải qua 4 cung bậc cảm xúc khi đọc một cuốn sách mình yêu thích: Đọc, Hiểu, Cảm, Ngộ.') }}</p>
					<p class="text-justify">- {{trans('home.Xác thực') }}: {{trans('home.Sách là sản phẩm có tính chất văn hóa và chứa đựng tư tưởng, trí tuệ của tác giả. RBooks tôn trọng Quyền tác giả, cam kết gửi đến độc giả những sách thật, 100% sách có bản quyền.') }}</p>
					<p class="text-justify">- {{trans('home.Ứng dụng') }}: {{trans('home.Cuộc sống luôn vận động. Tri thức luôn vận động. RBooks luôn lựa chọn những sách có giá trị, những sách có kiến thức ứng dụng thực tiễn. Sách của R Books sẽ cùng “chạy” với độc giả trên con đường xây dựng đời sống tài chính lành mạnh nhất có thể.') }}</p>
					<p class="text-justify">- {{trans('home.Thịnh vượng') }}: {{trans('home.Đích đến của R Books là: giàu tri thức, giàu tình cảm, giàu bản lĩnh và giàu cả về vật chất. Vì vậy, chú trọng phát triển dòng sách lĩnh vực Tài chính cá nhân chúng tôi mong muốn, mỗi độc giả sẽ tìm thấy con đường thịnh vượng cho chính mình.') }}</p>
				</li>
				<li>
					<h5>{{trans('home.Niềm tin doanh nghiệp') }}</h5>
					<p>- {{trans('home.Một sản phẩm chất lượng là một sản phẩm mang lại giá trị thực sự cho người dùng.') }}</p>
					<p>- {{trans('home.Mỗi một khách hàng dù nhỏ hay lớn đều là những khách hàng “giá trị nhất” của RBooks.') }}</p>
					<p>- {{trans('home.Luôn tuân thủ Quy luật cộng hưởng giữa khách hàng và doanh nghiệp.') }}</p>
					<p>- {{trans('home.Cho đi chính là cách nhanh nhất để đạt được mọi điều mình muốn.') }}</p>
				</li>
			</ul>
		</div>
	</div>
</div>


@endsection