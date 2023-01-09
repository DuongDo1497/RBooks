<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
	        font-family: Arial,Helvetica,sans-serif;
    		font-size: 12px;
		}
		table {
			width: 100%;
		}

		table.table-hover tfoot td ul li{
			border-top: 1px solid #000;
			margin-left: 0;
		}

		.img-logo {
			width: 170px;
			height: 80x;
		}
		.logo {
			width: 445px;
		}
		/*.head{
			float: left;
		}*/

		.info{
			float: left;
		}
		.payment{
			width: 50%;
		}
		.address{
			width: 50%;
		}
    </style>
</head>
<body>
	<div class="content">
  		<header>
  			<div>
  				<div class="head logo">
  					<a href="rbooks.vn"><img class="img-logo" src="https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/238386_215831/logo%20%281%29.png" alt=""></a>
  				</div>
  			</div>
  			<hr>
    	</header>
	    <section>
	    	<br>
	    	<article>
	    		<div>
	    			<div class="font-weight-bold pt-3">
	    				Cảm ơn quý khách {{ $gift->senderName }} đã đặt hàng làm quà tặng tại RBooks.vn!
	    			</div>
	    			<div>
	    				RBooks.vn rất vui thông báo quà tặng #{{ $gift->gift_number }} của quý khách đã được tiếp nhận và đang trong quá trình xử lý.
	    			</div>
	    			<div>
	    				Quý khách vui lòng thanh toán bằng cách chuyển khoản trước ngày {{ Carbon\Carbon::create()->addDays(3)->format('d/m/Y') }}. RBooks.vn sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.
	    			</div>
	    			<div>
	    				Sau ngày {{ Carbon\Carbon::create()->addDays(4)->format('d/m/Y') }} nếu quý khách chưa thanh toán đơn hàng sẽ tự hủy.
	    			</div>
	    		</div>
	    		<h3 class="pt-3" style="border-bottom: 2px solid #ddd; color: #189eff">THÔNG TIN ĐƠN HÀNG #{{ $gift->gift_number }}</h3>
	    		<div class="row">
	    			<div class="info payment">
	    				<h4>Thông tin thanh toán</h4>
	    				<div>
	    					<div>{{ $gift->customer->fullname }}</div>
	    					<div>{{ $gift->customer->email }}</div>
	    					<div>{{ $gift->customer->phone }}</div>
	    				</div>
	    			</div>
	    			<div class="info address">
	    				<h4>Địa chỉ nhận hàng</h4>
	    				<div>
	    					<div>{{ $gift->recipientName }}</div>
	    					<div>{{ $gift->address }}</div>
	    					<div>{{ $gift->phone }}</div>
	    				</div>
	    			</div>
	    		</div>
	    		<div class="row">
	    			<div class="col">
	    				<div>Phương thức thanh toán: Chuyển khoản ngân hàng </div>
	    				<div>Thông tin tài khoản:  Số TK: 0071001101266 - Tên TK: Công Ty TNHH R Books  - Tên ngân hàng: Vietcombank - Chi nhánh: Hồ Chí Minh</div>
	    				<div>Thời gian giao hàng dự kiến: dự kiến giao hàng {{ Carbon\Carbon::create()->addDays(5)->format('d/m/Y') }}
	    				</div>
	    			</div>
	    		</div>
	    	</article>
	    	<article class="pt-3">
	    		<h3 style="border-bottom: 2px solid #ddd; color: #189eff">CHI TIẾT ĐƠN HÀNG</h3>
	    		<table class="table table-hover">
	    			<thead>
	    				<tr style="background-color: #189eff">
	    					<th style="width: 30%;">Sản phẩm</th>
	    					<th style="width: 10%;">Giá bán</th>
	    					<th style="width: 20%;">Giá khuyến mãi</th>
	    					<th style="width: 20%;">Tiết kiệm</th>
	    					<th style="width: 10%;">Số lượng</th>
	    					<th style="width: 10%;">Tạm tính</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    				{{-- vòng lặp --}}
	    				@foreach($gift->order->products as $product)
	    				<tr style="text-align: center;">
	    					<td>{{ $product->name }}</td>
	    					<td>{{ number_format($product->pivot->price) }}</td>
	    					<td>{{ number_format($product->sale_price) }}</td>
	    					<td>{{ number_format($product->pivot->discount) }}% ({{ number_format($product->cover_price -$product->sale_price) }} đ)</td>
	    					<td>{{ $product->pivot->quantity }}</td>
	    					<td>{{ number_format($product->pivot->total) }}</td>
	    				</tr>
	    				@endforeach
	    				{{-- hết  vòng lặp --}}
	    			</tbody>
	    			<tfoot>
	    				<td></td>
                        <td></td>
                        <td>
                            <ul style="list-style: none; padding-left: 0; margin: 0;">
                            	<li>Tổng giá bán: </li>
                                <li>Tiết kiệm: </li>
                                <li>Thành tiền: </li>

                                <li>Phí ship: </li>
                                @if($gift->order->gift_fee == 20000)
                                <li>Phí gói quà:</li>
                                @endif
                                <li>Tổng cộng: </li>
                            </ul>
                        </td>
                        <td>
                            <ul style="list-style: none; padding-left: 0; text-align: right; margin: 0;">
                            	<li>
                                    {{ number_format($gift->order->sub_total) }}
                                </li>
                                @if($gift->order['sub_total'] == 0)
                                	<li>
                                		100% (0 đ)
                                	</li>
                                @else
	                                <li>
	                                    {{ round((1-(($gift->order['sub_total'] - $gift->order['tax_total']) / $gift->order['sub_total'])) * 100, 0) }}%

	                                    ({{ number_format($gift->order['tax_total'])  }} đ)
	                                </li>
                                @endif
                                <li>
                                    {{ number_format($gift->order->sub_total - $gift->order->tax_total) }}
                                </li>
                                <li>
                                    {{ number_format($gift->order->ship_total) }}
                                </li>
                                @if($gift->order->gift_fee)
                                <li>
                                    {{ number_format($gift->order->gift_fee) }}
                                </li>
                                @endif
                                <li class="h4 text-danger">
                                    {{ number_format($gift->order->total) }}
                                </li>
                            </ul>
                        </td>
	    			</tfoot>
	    		</table>
	    	</article>
	    	<div style="padding-left: 5px">
	    		<div></div>
				<div>
					Mọi thắc mắc, quý khách vui lòng liên hệ info@rbooks.vn, hoặc gọi số điện thoại 08 4966 4005 (8h-21h cả T7,CN) để tư vấn tốt nhất từ nhân viên chăm sóc khách hàng.
				</div>
				<div>RBooks.vn cảm ơn quý khách!</div>
	    	</div>
	    </section>
	</div>
</body>
</html>