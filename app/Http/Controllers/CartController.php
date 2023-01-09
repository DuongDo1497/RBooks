<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Category;
use App\Customer;
use App\CustomerAddress;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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

        $customer = Customer::where('user_id', Auth::id())->first();

        $customer_address = CustomerAddress::where('customer_id', $customer->id)->first();

        $cart = $this->getCart();

        $suggest = Product::inRandomOrder()->limit(4)->get();
        $total = session('total');
        // dd($total);
        $seenProducts = collect(session('seen'))->sortKeysDesc()->take(3);

        // dd($total);
        return view('pages.cart.index', [
            'cart' => $cart,
            'total' => $total,
            'suggest' => $suggest,
            'seenProducts' => $seenProducts,
            'customer' => $customer,
            'customer_address' => $customer_address,
        ]);
    }

    public function getCart()
    {
        return session('cart');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCart(Request $request)
    {
        $cart = $this->getCart();
        $product = Product::find($request->id);

        $attr = [
            'quantity' => $request->quantity,
            'totalQuantity' => $request->quantity,
            'product' => $product,
            'cover_price' => $product->cover_price,
            //'total_cv_price' => $product->cover_price * $request->quantityWarehouse
            'save_total' => $product->cover_price - $product->sale_price,
        ];
        // kiểm tra giá sản phẩm có khuyến mãi không
        if ($product->sale_price > 0 || $product->sale_price != "") {
            $attr['price'] = $product->sale_price;
            $attr['cover_price'] = $product->cover_price;
            $attr['total_price'] = $attr['price'] * $request->quantity;
            $attr['total_cv_price'] = $attr['cover_price'] * $request->quantity;
            // $attr['cover_price'] = $attr['cv_price'] * $request->quantity;
            $attr['save_total'] = ($attr['cover_price'] * $request->quantity) - ($attr['price'] * $request->quantity);
        } else {
            $attr['price'] = $product->cover_price;
            $attr['cover_price'] = $product->cover_price;
            $attr['total_price'] = $attr['price'] * $request->quantity;
            // $attr['cover_price'] = $attr['cv_price'] * $request->quantity;
            $attr['total_cv_price'] = $attr['cover_price'] * $request->quantity;
            //$attr['save_total'] = round((1-(($attr['price'] * $request->quantity) / ($attr['cover_price'] * $request->quantity))) * 100, 0);
        }
        // kiểm tra id sản phẩm có tồn tại chưa
        if (isset($cart[$product->id])) {
            $cart[$product->id]['price'] = $attr['price'];
            $cart[$product->id]['cover_price'] = $attr['cover_price'];
            $cart[$product->id]['quantity'] += $attr['quantity'];
            $cart[$product->id]['totalQuantity'] += $attr['totalQuantity'];
            $cart[$product->id]['total_price'] += $attr['total_price'];
            $cart[$product->id]['total_cv_price'] += $attr['total_cv_price'];
            $cart[$product->id]['save_total'] += $attr['save_total'];

            session(['cart' => $cart]);
        } else {
            $cart[$product->id] = $attr;
            session(['cart' => $cart]);
        }

        $this->getTotalCart();

        return redirect()->route('cart');
    }

    public function remove($id)
    {
        $cart = $this->getCart();
        unset($cart[$id]);
        session(['cart' => $cart]);

        $this->getTotalCart();

        return redirect(route('cart'));
    }

    public function deleteCart()
    {
        $cart = [];
        session(['cart' => $cart]);
        session(['total' => []]);
        return redirect(route('cart'));
    }

    public function getSubTotal()
    {
        return 0;
    }
    public function getTotalCoverPrice()
    {
        $total = 0;

        $cart = $this->getCart();

        foreach ($cart as $item) {
            $total += $item['total_cv_price'];
        }

        return $total;
    }

    public function getTotalPrice()
    {
        $total = 0;

        $cart = $this->getCart();
        foreach ($cart as $item) {
            $total += $item['total_price'];
        }

        return $total;
    }
    public function getSaveTotal()
    {
        $total = 0;

        $cart = $this->getCart();
        foreach ($cart as $item) {
            $total += $item['save_total'];
        }

        return $total;
    }

    public function getTotalQuantity()
    {
        $total = 0;
        $cart = $this->getCart();
        foreach ($cart as $item) {
            $total += $item['quantity'];
        }
        return $total;
    }

    public function update($product, $quantity)
    {
        $cart = $this->getCart();
        // dd($cart);
        $attr = [
            'totalQuantity' => $quantity,
            'quantity' => $quantity,
            'price' => $cart[$product->id]['price'],
            'total_price' => $cart[$product->id]['price'] * $quantity,
            'product' => $product,
            'cover_price' => $cart[$product->id]['cover_price'],
            'total_cv_price' => $cart[$product->id]['cover_price'] * $quantity,
            'save_total' => ($cart[$product->id]['cover_price'] * $quantity) - ($cart[$product->id]['price'] * $quantity),
        ];
        $cart[$product->id] = $attr;
        session(['cart' => $cart]);

        return $this->getTotalCart();
    }

    public function getTotalCart()
    {
        $total = [
            'totalQuantity' => $this->getTotalQuantity(),
            'totalPrice' => $this->getTotalPrice(),
            //'cart_cv_price' => $this->getTotalCoverPrice(),
            'total_cv_price' => $this->getTotalCoverPrice(),
            'save_total' => $this->getSaveTotal(),
        ];
        session(['total' => $total]);
        return $total;
    }

    public function updateAjax(Request $request)
    {
        $product = Product::find($request->id);
        $get_total = $this->update($product, $request->quantity);
        return response()->json($get_total);
    }

    // public function getTotalAjax()
    // {
    //     $total = session('total');
    //     return response()->json($total);
    // }
}
