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
        if ($request->check == "on") {
            $this->mailGift($gift);
            return redirect(route('checkout-done-gift', ['id' => $gift->id]));
        } else {
            $this->mailOrder($order);
            return redirect(route('checkout-done', ['id' => $order->id]));
        }
    }

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
