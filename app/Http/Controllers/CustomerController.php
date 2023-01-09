<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\CustomerAddress;
use App\Customer;
use App\Comment;
use App\Company;
use App\Order;
use App\Product;
use App\Viewedproduct;
use App\Viewed_product;
use \Auth;
use App\Http\Requests\AddressValidate;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;

class CustomerController extends Controller
{
    public function __construct()
    {

        if (!session()->has('cart')) {
            session(['cart' => []]);
        }

        if (!session()->has('total')) {
            session(['total' => []]);
        }

        if (!session()->has('seen')) {
            session(['seen' => []]);
        }
    }
    public function index()
    {
        $total = session('total');
        if (!Auth::check()) {
            return redirect(route('home'))->with('alert', 'Xin vui lòng đăng nhập để vào thông tin tài khoản!');
        }
        $customer = Customer::where('user_id', Auth::id())->first();
      
        return view('pages.customer.index', ['customer' => $customer, 'total' => $total]);
    }

    public function create(Request $request)
    {
        $data = [
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'address' => $request->address,
            'ward' => $request->ward,
            'district' => $request->district,
            'city' => $request->city,
            'customer_id' => Auth::id(),
        ];
        if ($request->default == true) {
            $data['default'] = 1;
            $addresses = CustomerAddress::where('customer_id', $customer_id)->get();
            if (!empty($addresses)) {
                foreach ($addresses as $address) {
                    $address['default'] = 0;

                    $address->save();
                }
            }
        } else {
            $data['default'] = 0;
        }
        CustomerAddress::create($data);

        return $addresses = CustomerAddress::where('customer_id', $customer_id)->get();
    }

    public function order()
    {
        $total = session('total');
        if (!Auth::check()) {
            return redirect(route('home'))->with('alert', 'Xin vui lòng đăng nhập để vào thông tin tài khoản!');
        }
        $customer = Customer::where('user_id', Auth::id())->first();

        $orders = $customer->orders()->paginate(10);
        return view('pages.customer.order', ['customer' => $customer, 'orders' => $orders, 'total' => $total]);
    }

    public function detailGift($id)
    {
        $total = session('total');
        $customer = Customer::where('user_id', Auth::id())->first();

        $detailGift = Gift::find($id);
        return view('pages.customer.detailgift', ['customer' => $customer, 'detailGift' => $detailGift, 'total' => $total]);
    }

    public function detailOrder($id)
    {
        $total = session('total');
        $customer = Customer::where('user_id', Auth::id())->first();

        $detailOrder = Order::find($id);
        return view('pages.customer.detailorder', ['customer' => $customer, 'detailOrder' => $detailOrder, 'total' => $total]);
    }

    public function manageAddress()
    {
        $total = session('total');
        if (!Auth::check()) {
            return redirect(route('home'))->with('alert', 'Xin vui lòng đăng nhập để vào thông tin tài khoản!');
        }
        $customer = Customer::where('user_id', Auth::id())->first();
        return view('pages.customer.manageaddress', ['customer' => $customer, 'total' => $total]);
    }

    public function beforCreateAddress()
    {
        $total = session('total');
        $customer = Customer::where('user_id', Auth::id())->first();
        return view('pages.customer.addaddress', ['customer' => $customer, 'total' => $total]);
    }

    public function createAddress(AddressValidate $request)
    {

        $total = session('total');
        $customer = Customer::where('user_id', Auth::id())->first();

        $data = [
            'address' => $request->address,
            'ward' => $request->ward,
            'district' => $request->district,
            'city' => $request->city,
            'phone' => $request->phone,
            'fullname' => $request->fullname,
            'default' => $request->default,
            'customer_id' => $customer->id,
        ];
        CustomerAddress::create($data);

        if ($total['totalQuantity'] > 0) {
            return redirect()->route('shipping');
        } else {
            return redirect()->route('customer-addresses');
        }
        //return view('pages.customer.manageaddress', ['customer' => $customer]);
    }

    public function deleteAddress($id)
    {
        $total = session('total');
        CustomerAddress::find($id)->delete();
        $customer = Customer::where('user_id', Auth::id())->first();
        return redirect()->back();
        //return view('pages.customer.manageaddress', ['customer' => $customer]);
    }

    //Thứ 7: 3/1/19
    public function getEditAddress($id)
    {
        $total = session('total');
        $customer_address = CustomerAddress::find($id);
        return view('pages.customer.editAddress', ['customer_address' =>  $customer_address, 'total' => $total]);
    }
    public function postEditAddress($id, AddressValidate $request)
    {
        $total = session('total');
        $customer_address = CustomerAddress::find($id);
        $customer_address->customer_id = $customer_address->customer_id;
        $customer_address->address = $request->address;
        $customer_address->ward = $request->ward;
        $customer_address->district = $request->district;
        $customer_address->city = $request->city;
        $customer_address->phone = $request->phone;
        $customer_address->fullname = $request->fullname;

        if ($request->default == true) {
            $customer_address->default = 1;
            $addresses = CustomerAddress::find($id)->get();
            if (!empty($addresses)) {
                foreach ($addresses as $address) {
                    $address->default = 0;
                    $address->save();
                }
            }
        } else {
            $customer_address->default = 0;
        }
        $customer_address->save();
        if ($total['totalQuantity'] > 0) {
            return redirect()->route('shipping');
        } else {
            return redirect()->route('customer-addresses')->with('thongbao', 'Sửa thành công');
        }
        //CustomerAddress::find($id)->update($data);
        //return view('pages.customer.editAddress', ['customer' => $customer]);
    }
    //T2 4/3/19
    public function postUpdateCustomer(Request $request)
    {

        $getValueBirthday = $request->year . "-" . ($request->month + 1) . "-" . $request->day;

        $customer_update = Customer::where('user_id', Auth::id())->first();
        $customer_update->fullname = $request->name;
        $customer_update->slug =  Str::slug($customer_update->fullname);
        $customer_update->birthday = $getValueBirthday;
        $customer_update->gender = $request->gender;
        $customer_update->email = $request->email;
        $customer_update->phone = $request->phone;
        $customer_update->user_id = $customer_update->user_id;
        $customer_update->updated_user_id = $customer_update->updated_user_id;
        $customer_update->save();
        $company = Company::where('customer_id',  $customer_update->id)->first();
        if ($company == null) {
            $company = new Company();
            $company->name = $request->name_company;
            $company->code_vat = $request->vat_code;
            $company->address_company = $request->address_company;
            $company->customer_id = $customer_update->id;
        } else {
            $company->name = $request->name_company;
            $company->code_vat = $request->vat_code;
            $company->address_company = $request->address_company;
        }
        $company->save();
        return redirect()->back()->with('thongbao', 'Sửa thành công');
    }

    public function postUpdatePhone(Request $request)
    {
        $customer_update = Customer::where('user_id', Auth::id())->first();
        $customer_update->phone = $request->phone;
        $customer_update->save();
        return redirect()->back()->with('thongbao', 'Sửa thành công');
    }
    public function changePassword(Request $request)
    {
        # code...
    }

    public function comment()
    {

        $total = session('total');
        $customer = Customer::where('user_id', Auth::id())->first();
        $comments = Comment::where('customer_id', $customer->id)->paginate(10);
        return view('pages.customer.comment', ['customer' => $customer, 'comments' => $comments, 'total' => $total]);
    }

    public function question()
    {
        $total = session('total');
        $customer = Customer::where('user_id', Auth::id())->first();
        return view('pages.customer.question', ['customer' => $customer, 'total' => $total]);
    }

    public function favorite()
    {
        $total = session('total');
        $customer = Customer::where('user_id', Auth::id())->first();
        $productlikes =  $customer->productlikes()->paginate(12);
        return view('pages.customer.favorite', compact('products'), ['customer' => $customer, 'total' => $total, 'productlikes' => $productlikes]);
    }
    public function updatepassword()
    {
        $customer = Customer::where('user_id', Auth::id())->first();
        return view('pages.customer.updatepassword', ['customer' => $customer]);
    }

    public function passes($attribute, $value)
    {
        return Hash::check($value, auth()->user()->password);
    }
    public function putUpdatePassword(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'old_password' => function ($attribute, $value, $fail) {
                    if (!\Hash::check($value, auth()->user()->password)) {
                        return $fail(__('Mật khẩu không khớp với mật khẩu hiện tại'));
                    }
                },
            ]
        );
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::where('id', Auth::id())->first();
        $user->password = Hash::make($request->newpassword);
        $user->save();
        session()->flash('success', 'Đổi mật khẩu thành công');
        return redirect()->route('home');
    }

    public function productview(Request $request)
    {
        $total = session('total');   
        $customer = Customer::where('user_id', Auth::id())->first();
        $products = $customer->products()->paginate(12);
        // dd($products);
        return view('pages.customer.productview',compact('products'),
         [
            'customer' => $customer,
          'total' => $total,
           'products' => $products 
        ]);
    }

    public function myinformation()
    {
        $customer = Customer::where('user_id', Auth::id())->first();
        return view('pages.customer.myinformation', ['customer' => $customer]);
    }
}
