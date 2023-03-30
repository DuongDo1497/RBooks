<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerAddress;
use App\Order;
use App\Export;
use App\Product;
use App\Category;
use App\Coupon;
use App\OrderAddress;
use App\Gift;
use App\Vat;
use App\User;
use App\CityProvince;
use App\MailSchedule;
use App\MailProduct;
use Session;
use Illuminate\Http\Request;
use \DB;
use \Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $total = session('total');
        $cart = session('cart');
    }

    public function shipping()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Bạn cần phải đăng nhập trước');
            return redirect(route('cart'));
            // return redirect(route('shipping-notlogin'));
        }
        if (empty(Customer::where('user_id', Auth::user()->id)->first()->addresses)) {
            return redirect(route('form-address'));
        } else {
            $addresses = Customer::where('user_id', Auth::user()->id)->first()->addresses;
        }
        $total = session('total');

        return view('pages.checkout.shipping', [
            'total' => $total,
            'addresses' => $addresses,
        ]);
    }

    public function shippingNotLogin()
    {
        $total = session('total');
        $cityprovinces = CityProvince::all();

        return view('pages.checkout.shipping_notLogin', [
            'cityprovinces' => $cityprovinces,
            'total' => $total,
        ]);
    }

/**
 * addToLog
 *
 * @author  linh
 * @param   string $somecontent
 * @access  public
 * @date    Jul 19, 2006 3:10:43 PM
 */
function addToLog($somecontent) {
    $is_debug = true;
    if ($is_debug){
        $filename = 'log.txt';
        $somecontent = $somecontent."\n";
        $handle = fopen($filename, 'a');
        fwrite($handle, $somecontent);
        fclose($handle);
    }
}

    public function beforProcess(Request $request)
    { 
        if (!Auth::check()) {
            $custt = Customer::where('email', $request->email)->first();
            if ($custt == NULL) {
                $cus = Customer::create([
                    'fullname' => $request->fullname,
                    'birthday' => $request->birthday,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);

                $cus_address = CustomerAddress::create([
                    'customer_id' => $cus->id,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'fullname' => $request->fullname,
                    'ward' => $request->ward,
                    'district' => $request->district,
                    'city' => $request->city,
                ]);
            } else {
                if ($custt->email == $request->email) {
                    $cus = $custt;
                } else {
                    $cus = Customer::create([
                        'fullname' => $request->fullname,
                        'birthday' => $request->birthday,
                        'gender' => $request->gender,
                        'email' => $request->email,
                        'phone' => $request->phone,
                    ]);
                }

                $cus_address = CustomerAddress::create([
                    'customer_id' => $cus->id,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'fullname' => $request->fullname,
                    'ward' => $request->ward,
                    'district' => $request->district,
                    'city' => $request->city,
                ]);
            }
        }

        if (Auth::check()) {
            $customer = Customer::where('user_id', Auth::id())->first();
        } else {
            $customer = Customer::where('id', $cus_address->customer_id)->first();
        }

        $total = session('total');
        if ($total['totalQuantity'] > 0) {
            if (Auth::check()) {
                $address = CustomerAddress::find($request->id);
            } else {
                $address = CustomerAddress::where('customer_id', $customer->id)->get()->last();
            }
            return view('pages.checkout.process', [
                'total' => $total,
                'address' => $address,
                'customer' => $customer,
                'carts' => session('cart'),
            ]);
        } else {
            return redirect()->back()->with('alert', 'Bạn chưa đặt hàng!');
        }
    }

    public function afterProcess(Request $request)
    {
        $address = CustomerAddress::find($request->address_id);
        $carts = session('cart');
        $total = session('total');

        $addres = "";
        if (Auth::check()) {
            $addres = $address->address . " - " . "Phường/Xã: " . $address->ward . " - " . "Quận/Huyện: " . $address->district . " - " . "Tỉnh/Tp " . $address->city;
        } else {
            $addres = $address->address;
        }
            
        $order = DB::transaction(function () use ($request, $address, $carts, $total) {
            $countGift = Gift::where('created_at', Carbon::now())->count() + 1;

            if ($request->check == 'on') {
                $gift_data = ([
                    'gift_number' => "QT" . (Carbon::now()->format('dmyHi') . (string)$countGift),
                    'senderName' => $request->sendername,
                    'recipientName' => $request->recipientname,
                    'address' => $request->address_to,
                    'phone' => $request->phone_to,
                    'message' => $request->message,
                    'customer_id' => Auth::id() != NULL ? Customer::where('user_id', Auth::id())->first()->id : $address->customer_id,
                ]);
                $gift = Gift::create($gift_data);
            }

            $delivery_address = OrderAddress::create([
                'address' => $address->address,
                'ward' => $address->ward,
                'district' => $address->district,
                'city' => $address->city,
                'fullname' => $address->fullname,
                'phone' => $address->phone,
                'email' => $address->customers->email,
                'note' => $address->note,
            ]);

            $billing_address = OrderAddress::create([
                'address' => $address->address,
                'ward' => $address->ward,
                'district' => $address->district,
                'city' => $address->city,
                'fullname' => $address->fullname,
                'phone' => $address->phone,
                'email' => $address->customers->email,
                'note' => $address->note,
            ]);

            $payment_method = $request->check == 'on' ? 2 : $request->payment_method;

            $countOrder = Order::where('created_at', Carbon::now())->count() + 1;
            //$subtotal = (int) $total['totalPrice'];
            $ship = $total['totalPrice'] >= 200000 ? 0 : $request->delevery_method;
            $sub_cover_price = $total['total_cv_price'];
            $sub_total = $total['total_cv_price'];
            $tax_total = $total['total_cv_price'] - $total['totalPrice'];

            if ($request->delevery_method == 30000 || $request->delevery_method == 45000) {
                $totaled = $request->delevery_method;
            } else {
                $totaled = $total['totalPrice'] <= 200000 ? $total['totalPrice'] + $request->delevery_method : $total['totalPrice'];
            }

            $gift_fee =  $request->gift_fee == null ? 0 : $request->gift_fee;

            //Kiểm tra KH có muốn xuất hóa đơn VAT hay không
            $note = $request->checkVat == 'on' ? "Cần xuất hóa đơn VAT" : NULL;
            $order = Order::create([
                'order_number' => (Carbon::now()->format('dmyHi') . (string)$countOrder),
                'customer_id' => Auth::id() != NULL ? Customer::where('user_id', Auth::id())->first()->id : $address->customer_id,
                'warehouse_id' => 2,
                'sub_cover_price' => $sub_cover_price,
                'sub_total' => $sub_total,
                'tax_rate' => 0,
                'tax_total' => $tax_total,
                'ship_total' => $ship,
                'gift_fee' => $gift_fee,
                'total' => $totaled + $gift_fee,
                'status' => 1,
                'note' => $note,
                'delivery_address_id' => $delivery_address->id,
                'billing_address_id' => $billing_address->id,
                'gift_address_id' => !isset($gift) ? 0 : $gift->id + 1,
                'payment_method' => $payment_method,
                'delivery_method' => $request->delivery_method,
                //'customerOrderId' => Input::get('username'),
                //'orderRef' => Input::get('username'),
            ]);

            if (Auth::id() != NULL) {
                $customer = Customer::where('user_id', Auth::id())->first();
            } else {
                $customer = $address->customer_id;
            }

            $order->customer()->associate($customer);
            $order->save();

            //Thêm đơn hàng phiếu xuất
            $recordlast = Export::get()->last();
            if ($recordlast == NULL) {
                $recordlastt = 1;
            } else {
                $recordlastt = (int) $recordlast->export_code + 1;
            }

            $stt = sprintf("%03d", $recordlastt);

            $day_export = $order->created_at->format('d');
            $month_export = $order->created_at->format('m');
            $year_export = $order->created_at->format('Y');
            $date = $day_export . "." . $month_export . "." . $year_export;

            if (Auth::check()) {
                $addres = $address->address . " - " . "Phường/Xã: " . $address->ward . " - " . "Quận/Huyện: " . $address->district . " - " . "Tỉnh/Tp " . $address->city;
            } else {
                $addres = $address->address;
            }

            $export = Export::create([
                'order_id' => $order->id,
                'export_code' => $stt,
                'warehouse_export_code' => "XRB." . $order->id . ".XHW.KHOVH." . $date,
                'status' => "MOI_TAO",
                'note' => "KHACH_LE",
                'supplier_id' => 32,
                'agencies' => "Khách lẻ - " . $address->fullname,
                'phone' => $address->phone,
                'address' => $addres,
                'warehouse_id' => 2,
                'updated_user_id' => 130,
                'quantity'  => $total['totalQuantity'],
                'sub_total' => $sub_cover_price,
                'ship_total' => $ship,
                'gift_fee' => $gift_fee,
                'total'  => $totaled + $gift_fee,
                'discount'  => $tax_total,
            ]);
            $export->save();

            //Thêm thông tin hóa đơn VAT
            if ($request->checkVat == 'on') {
                $vat_data = ([
                    'name_company' => $request->name_company,
                    'code_vat' => $request->code_vat,
                    'address_company' => $request->vat_address,
                    'order_id' => $order->id,
                ]);
                $vat = Vat::create($vat_data);
            }

            //dd($total);
            foreach ($carts as $product) {
                $export_products[$product['product']->id] = [
                    'order_id' => $order->id,
                    'price' => $product['cover_price'],
                    'quantity' => $product['quantity'],
                    'discount' => 100 - ($product['price'] / $product['cover_price']) * 100,
                    'discount_total' => $product['save_total'],
                    'sub_total' => $product['cover_price'] * $product['quantity'],
                    'total' => $product['total_price'],
                    'product_id' => $product['product']->id,
                ];
            }
            $export->products()->attach($export_products);
            //$sub_total = $product['quantity'] * $product['cover_price'];

            // kiểm tra đơn hàng có sử dụng mã giảm giá không
            if (isset($total['coupon'])) {
                $coupon = Coupon::find($total['coupon']);
                if (Auth::id() != NULL) {
                    $customer = Customer::where('user_id', Auth::id())->first();
                    $coupon->customers()->attach($customer->id);
                } else {
                    $customer = $address->customer_id;
                    $coupon->customers()->attach($customer->id);
                }

                $coupon->update(['quantitied' => $coupon->quantitied - 1]);
            }

            // Thêm sản phẩm vào đơn hàng trong CSDL
            foreach ($carts as $product) {
                $products[$product['product']->id] = [
                    'product_id' => $product['product']->id,
                    'quantity' => $product['quantity'],
                    'price' => $product['cover_price'],
                    'sub_total' => $product['cover_price'] * $product['quantity'],
                    'total' => $product['total_price'],
                    'discount' => 100 - ($product['price'] / $product['cover_price']) * 100,
                    'discount_total' => $product['save_total'],
                ];

                $productWarehouse = Product::find($product['product']->id)->warehouses()->where('warehouse_id', '2')->first();

                if (!is_null($productWarehouse)) {

                    $productWarehouse_id2 = Product::find($product['product']->id)->warehouses()->where('warehouse_id', '2')->first();
                    $productWarehouse_id1 = Product::find($product['product']->id)->warehouses()->where('warehouse_id', '1')->first();
                    if ($productWarehouse_id2->pivot->quantity - $product['quantity'] > 0) {
                        Product::find($product['product']->id)->warehouses()->updateExistingPivot(2, ['quantity' => $productWarehouse_id2->pivot->quantity - $product['quantity']]);
                    } else {
                        Product::find($product['product']->id)->warehouses()->updateExistingPivot(1, ['quantity' => $productWarehouse_id1->pivot->quantity - $product['quantity']]);
                    }

                    //Trừ số lượng kho Tổng
                    // Product::find($product['product']->id)->warehouses()->updateExistingPivot(1, ['quantity' => $productWarehouse_id1->pivot->quantity - $product['quantity']]);

                }
            }

            $order->products()->attach($products);
            return $order;
        });

        $countGift = Gift::where('created_at', Carbon::now())->count() + 1;

        if ($request->check == 'on') {
            $gift_data = ([
                'gift_number' => "QT" . (Carbon::now()->format('dmyHi') . (string)$countGift),
                'senderName' => $request->sendername,
                'recipientName' => $request->recipientname,
                'address' => $request->address_to,
                'phone' => $request->phone_to,
                'message' => $request->message,
                'customer_id' => Auth::id() != NULL ? Customer::where('user_id', Auth::id())->first()->id : $address->customer_id,
                'order_id' => $order->id,
            ]);
            $gift = Gift::create($gift_data);
        }

        //Thanh toan qua alepay
        if ($request->payment_method == "3"){
            $customer = Customer::where('user_id', Auth::id())->first();
            
            $orderInfo = "Thanh toán đơn hàng " . $order->order_number;
            $amount = $order->total . "";
            $orderId = "Đơn hàng số " . $order->id;
            $customer_id = $customer->id;
            $buyerName = $customer->fullname;
            $buyerEmail = $customer->email;
            $buyerPhone = $customer->phone . " " . $address->phone;
            $buyerAddress = $addres . "";

            $url = "https://rbooks.vn";
            $returnUrl = "$url/resultPayment";
            $notifyurl = "$url/ipnPayment";

            $result = $this->processSendRequestToALEPAY($orderId, $orderInfo, $amount, $returnUrl, $notifyurl, $buyerName, $buyerEmail, $buyerPhone, $buyerAddress);
           
            if (!empty($result->code)) {
                if ($result->code == '000') {//Xu ly alepay thanh cong
                    if ($request->check == "on") {
                        $this->mailGift($gift);
                    } else {
                        $this->mailOrder($order);
                    }

                    return redirect($result->checkoutUrl);
                } else {
                    $error = 3;
                    $message = $result->message;
                    return view('pages.checkout.message', ['errorCode' => $error, 'infor' => $message]);
                }
            }
        }else{
            if ($request->check == "on") {
                $this->mailGift($gift);
                return redirect(route('checkout-done-gift', ['id' => $gift->id]));
            } else {
                $this->mailOrder($order);
                return redirect(route('checkout-done', ['id' => $order->id]));
            }
        }
    }

    /********* Thanh toan qua alopay ************************************************************/
    public function resultPayment(Request $request)
    {
        $errorCode = $request->errorCode;
        $transactionCode = $request->transactionCode;

        $retData = $this->checkResultSendRequestToALEPAY($transactionCode);
        $error = $retData['error'];
        $message = $retData['message'];   
        $orderId = $retData['orderCode'];

        return view('pages.checkout.message', ['errorCode' => $error, 'infor' => $message]);

    }    

    public function ipnPayment(Request $request)
    {
        $error = "2";
        $message = "Thanh toán bị hủy.";
        return view('pages.checkout.message', ['errorCode' => $error, 'infor' => $message]);
    } 

    /**
     * Xu ly thong tin gui request toi he thong ALEPAY
     *
     * @author  linh
     * @param   string $somecontent
     * @access  public
     * @date    April 19, 2020 3:10:43 PM
     */
    function processSendRequestToALEPAY($orderId, $orderInfo, $amount, $returnUrl, $notifyurl, $buyerName, $buyerEmail, $buyerPhone, $buyerAddress)
    {
        //Thong tin key ma hoa lay tu config alepays
        $apiKey = config('alepays.apiKey');
        $encryptKey = config('alepays.encryptKey');
        $checksumKey = config('alepays.checksumKey');
        $url_request_payment = config('alepays.url_request_payment');
     
        $data = array();
        $data['tokenKey'] = $apiKey;
        $data['returnUrl'] = $returnUrl;
        $data['cancelUrl'] = $notifyurl;
        $data['customMerchantId'] = 'Rbooks';
        $data['amount'] = intval(preg_replace('@\D+@', '', $amount));
        $data['orderCode'] = $orderId;
        $data['currency'] = "VND";
        $data['orderDescription'] = $orderInfo;
        $data['totalItem'] = 1;
        $data['buyerName'] = trim($buyerName);
        $data['buyerEmail'] = trim($buyerEmail);
        $data['buyerPhone'] = trim($buyerPhone);
        $data['buyerAddress'] = trim($buyerAddress);
        $data['buyerCity'] = trim('TP.HCM');
        $data['buyerCountry'] = trim('VN');
        $data['checkoutType'] = 3; // Thanh toán the quoc te, noi dia, tra gop
        $data['month'] = 3;
        $data['paymentHours'] = 48; //48 tiếng :  Thời gian cho phép thanh toán (tính bằng giờ)
        $data['allowDomestic'] = true;
    
        $signature = $this->makeSignature($data, $checksumKey);
        $data['signature'] = $signature;

        $result = $this->execPostRequest($url_request_payment, json_encode($data));
        $jsonResult = json_decode($result);  // decode json
    
        return $jsonResult;
        
    }
    
    /**
     * Kiem tra ket qua sau khi thanh toan ALEPAY => thanh cong hay that bai
     *
     * @author  linh
     * @param   string $somecontent
     * @access  public
     * @date    April 19, 2020 3:10:43 PM
     */
    function checkResultSendRequestToALEPAY($transactionCode)
    {
        //Thong tin key ma hoa lay tu config alepays
        $apiKey = config('alepays.apiKey');
        $encryptKey = config('alepays.encryptKey');
        $checksumKey = config('alepays.checksumKey');
        $url_request_payment = config('alepays.url_request_payment');
        $url_get_transaction_info = config('alepays.url_get_transaction_info');    
    
        $data = array();
        $data['tokenKey'] = $apiKey;
        $data['transactionCode'] = $transactionCode;
        $signature = $this->makeSignature($data, $checksumKey);
        $data['signature'] = $signature;
        
        $result = $this->execPostRequest($url_get_transaction_info, json_encode($data));
        $jsonResult = json_decode($result);  // decode json
        
        $error = ''; $message = ''; $orderId = '';   
        if ($jsonResult->code == '000') {
            $error = '0';
            $message = 'Thanh toán dịch vụ thành công.';
            $orderCode = $jsonResult->orderCode;
        } else {
            $error = '2';
            $message = 'Thanh toán lỗi: ' . $jsonResult->message;
        }
    
        $data = ['error' => $error,'message' => $message,'orderCode' => $orderCode];
    
        return $data;
    }

    /**
     * Thu vien thanh toan MOMO
     *
     * @author  linh
     * @access  public
     * @date    April 19, 2020 3:10:43 PM
     */
    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    
    /**
     * Thu vien makeSignature
     *
     * @author  linh
     * @access  public
     * @date    April 19, 2020 3:10:43 PM
     */
    function makeSignature($data, $hash_key)
    {
        $hash_data = '';
        ksort($data);
        $is_first_key = true;
        foreach ($data as $key => $value) {
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }
            if (!$is_first_key) {
                $hash_data .= '&' . $key . '=' . $value;
            } else {
                $hash_data .= $key . '=' . $value;
                $is_first_key = false;
            }
        }
    
        $signature = hash_hmac('sha256', $hash_data, $hash_key);
        return $signature;
    }
    /********* Ket thuc Thanh toan qua alopay ************************************************************/
    
    public function done($id)
    {
        $order = Order::findOrFail($id);
        session(['cart' => []]);
        session(['total' => ['totalQuantity' => 0]]);

        return view('pages.checkout.done', ['order' => $order]);
    }
    public function done_gift($id)
    {
        $gift = Gift::findOrFail($id);
        session(['cart' => []]);
        session(['total' => ['totalQuantity' => 0]]);

        return view('pages.checkout.done_gift', ['gift' => $gift]);
    }
    public function mailGift(Gift $gift)
    {
        Mail::send('mail.gift_order', ['gift' => $gift], function ($message) use ($gift) {
            $message->from('rbookscorp@gmail.com', 'RBooks.vn');
            $message->to($gift->customer->email)->subject('Thông tin quà tặng')->cc('chaupham@lamians.com')->bcc('info@rbooks.vn')->bcc('rbookscorp@gmail.com');
        });
    }
    public function mailOrder(Order $order)
    {
        Mail::send('mail.order', ['order' => $order], function ($message) use ($order) {
            $message->from('rbookscorp@gmail.com', 'RBooks.vn');
            $message->to($order->customer->email)->subject('Đặt hàng thành công')->cc('chaupham@lamians.com')->bcc('info@rbooks.vn')->bcc('rbookscorp@gmail.com');
        });
    }

    public function coupon(Request $request)
    {
        $total = session('total');
        $customer_id = Customer::where('user_id', Auth::id())->first()->id;

        $coupon = Coupon::where([['key', $request->key], ['status', 1]])->first();

        if (!isset($total->coupon)) {
            if (is_null($coupon)) {
                return response()->json(['msg' => 'Mã khuyến mãi không tồn tại']);
            }
            if ($coupon->quantitied <= 0) {
                return response()->json(['msg' => 'Số lượng mã giảm giá đã hết']);
            } else {
                if ($coupon->customers()->wherePivot('customer_id', $customer_id)->get()->isNotEmpty()) {
                    return response()->json(['msg' => "Bạn đã sử dụng mã giảm giá này"]);
                } elseif (isset($total['coupon'])) {
                    return response()->json(['msg' => "Bạn đã sử dụng mã giảm giá này"]);
                } else {
                    $total_cv_price = $total['total_cv_price'];

                    $total_coupon = $total_cv_price - (($total_cv_price / 100) * $coupon->percent);

                    $total['totalPrice'] = $total_coupon;
                    $total['coupon'] = $coupon->id;

                    session(['total' => $total]);

                    return response()->json([
                        'msg' => "Áp dụng mã khuyến mãi thành công",
                        'total' => $total_coupon,
                    ]);
                }
            }
        } else {
            return response()->json(['msg' => "Mã đã áp dụng"]);
        }
    }

    public function vinhomes()
    {
        $categories = Category::get();
        $total = session('total');
        $seen = collect(session('seen'))->sortKeysDesc()->take(4);

        //show product index
        //$topWeek = Product::inRandomOrder()->limit(4)->get();  //Top week
        $topWeek = Category::where('slug', 'sach-ban-chay')->first()->products()->orderBy('id', 'DESC')->where('status', '1')->take(4)->get();
        //$top = Product::inRandomOrder()->limit(4)->get(); // Top
        $top = Category::where('slug', 'sach-moi-phat-hanh')->first()->products()->orderBy('id', 'DESC')->where('status', '1')->take(4)->get();
        //$orderBefore = Product::inRandomOrder()->limit(4)->get(); // Top order
        $orderBefore = Category::where('slug', 'sach-combo')->first()->products()->orderBy('id', 'DESC')->where('status', '1')->take(4)->get();
        //$topSale = Product::inRandomOrder()->limit(4)->get(); // Top sale
        $topSale = Category::where('slug', 'sach-giam-gia')->first()->products()->orderBy('id', 'DESC')->where('status', '1')->take(4)->get();
        //$topCombo = Product::orderBy('id', 'DESC')->limit(5)->get(); // Top combo
        $topCombo = Category::where('slug', 'sach-sap-phat-hanh')->first()->products()->orderBy('id', 'DESC')->where('status', '1')->take(4)->get();
        $topNewEconomy = Category::where('slug', 'sach-kinh-te')->first()->products()->orderBy('id', 'DESC')->where('status', '1')->take(10)->get();

        // /dd(is_null($topNewEconomy->first()->images));

        return view('pages.checkout.vinhomes', [
            'categories' => $categories,
            'topWeek' => $topWeek,
            'top' => $top,
            'orderBefore' => $orderBefore,
            'topSale' => $topSale,
            'topCombo' => $topCombo,
            'topNewEconomy' => $topNewEconomy,
            'total' => $total,
            'seen' => $seen
        ]);
    }
}
