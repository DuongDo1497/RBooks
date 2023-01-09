<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <style type="text/css" media="screen">
        body {
			margin: 0;
			padding: 0;
			background: #555;
		}
		.content {
			max-width: 768px;
		    margin: auto;
		    background: white;
		    padding: 10px;
	        font-family: 'Roboto', sans-serif;
    		font-size: 15px;
		}
		table {
			width: 100%;
		}

		footer::after{
			display: block;
		    content: "";
		    clear: both;
		}

		.info{
			float: left;
			padding: 0 2% 15px 2%;
		}
		.payment{
			width: 46%;

		}
		.address{
			width: 46%;
		}
    </style>
</head>
<body>
	<div class="content">
  		<header>
  			<div>
  				<div class="head logo">
  					<a href="rbooks.vn"><img src="https://rbooks.vn/public/imgs/banners/RB-header-order.jpg" alt="" style="width: 100%;"></a>
  				</div>
  			</div>
    	</header>

	    <section>

	    	<article>
	    		<div>
	    			<p>
	    				Chúc mừng bạn đã đăng ký thành công nhận sách miễn phí: "14 Bí mật gia tăng tài chính mỗi ngày".
	    			</p>
	    			<p>
	    				Bạn <b>{{$username}}</b> thân mến,<br><br>
	    				RBooks rất vui mừng thông báo Quà tặng sẽ được gửi đến bạn trong thời gian sớm nhất. RBooks sẽ liên lạc cho bạn ngay sau khi cuốn sách được in xong. Cùng RBooks đón đợi siêu phẩm bất ngờ này nhé!<br><br>

						Mọi thắc mắc, bạn có thể gửi thông tin về:<br>
						<b>Email:</b> info@rbooks.vn<br>
						<b>Phone/Zalo/Viber:</b> 084 666 4005<br>
						<b>Facebook:</b>  http://m.me/rbooks.vn<br>
						RBooks rất vui được hỗ trợ bạn!<br><br>

						Nếu bạn cảm thấy những bí mật này hữu ích, hãy chia sẻ quà tặng này để người thân, bạn bè của bạn cùng nhận được quà tặng này bạn nhé!<br>

						Link đăng ký nhận quà: <a href="https://rbooks.vn/">https://rbooks.vn/</a> hoặc <a href="http://m.me/rbooks.vn">http://m.me/rbooks.vn</a><br><br>

						<b>Chúc bạn một ngày tốt đẹp!</b><br>
						<b>Thanks and Best regards,</b><br><br>
						<b>Sách RBooks.</b>
	    			</p>
	    		</div>
	    	</article>

	    	<article>
	    		<div style="padding-top: 20px;">
					<div style="text-align: justify;">
						Khi nào bạn muốn đăng ký nhận lại thông tin, vui lòng truy cập vào website: <b>www.rbooks.vn</b> để đăng ký thành viên bạn nhé.
					</div>
		    	</div>
	    	</article>
	    </section>

	    <footer>

	    	<div style="width: 30%; float: right; padding-top: 60px;">
	    		<img src="https://rbooks.vn/imgs/logo_blue.png" alt="" style="width: 100%;">
	    	</div>
	    </footer>

	</div>
</body>
</html>