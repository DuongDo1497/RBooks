<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Order;
use App\OrderProduct;
use DB;
// use Carbon\Carbon;

class CategoryController extends Controller
{
    public function index(Request $request, $id, $alias) 
    {
        //dd($request->price_asc);
        $locale = session('locale');
        $total = session('total');
        $categories = Category::all();
        $publishers = Product::distinct()
        ->where([
            ['publisher','<>','']
            ,
            ['status','=',1]
        ])->get(['publisher']);

        // $products = Product::where('status','1')->whereHas('categories', function($q) use($id) {
        //         $q->where('category_id', $id);
        //     })->orderBy('id', 'DESC')->paginate(20);

        $products = Product::where('status','1')->whereHas('categories', function($q) use($id) {
                $q->where('category_id', $id);
            })->orderBy('id', 'DESC')->paginate(20);
        
        if($request->newest == "0") {
            $latest_prd = Product::where('status','1')->orderBy('id', 'DESC')->first();
                $products = Product::where('status','1')->whereBetween("created_at", [$latest_prd->created_at->subDays(100), $latest_prd->created_at])->whereHas('categories', function($q) use($id) {
                $q->where('category_id', $id);
            })->paginate(16);
        }

        else if($request->top_seller == "1"){
            $product_id = DB::table('order_product')->select('product_id', DB::raw('COUNT(product_id) as counter'))->groupBy('product_id')->havingRaw('COUNT(product_id) > 1')->get();

            if(!empty($product_id)) {
                $pro_id[] = null;
            } else {
                foreach($product_id as $key => $values) {
                    $pro_id[] = $values->product_id;
                }
            }
            $products = Product::whereIn('id', $pro_id)->whereHas('categories', function($q) use($id) {
                $q->where('category_id', $id);
            })->paginate(16);
        }

        else if($request->discount == "2") {
            $products = Product::where('status', '1')->whereHas('categories', function($q) use($id) {
                $q->where('category_id', $id);
            })->orderBy('sale_price', 'DESC')->paginate(16);
        }

        else if($request->price_asc == "3") {
            $products = Product::where('status', '1')->whereHas('categories', function($q) use($id) {
                $q->where('category_id', $id);
            })->orderBy('sale_price', 'ASC')->paginate(16);
        }
        
        else if($request->price_desc == "4") {
            $products = Product::where('status', '1')->whereHas('categories', function($q) use($id) {
                $q->where('category_id', $id);
            })->orderBy('sale_price', 'DESC')->paginate(16);
        }
        //16/3/19
        // $top = Category::where('slug', 'sach-moi-phat-hanh')->first()->products()->orderBy('publishing_year', 'DESC')->where('status','1')->take(4)->get();
        return view('pages.shopping.categorycontroller.index', ['categories' => $categories, 'products' => $products, 'total' => $total, 'publishers' => $publishers, 'locale' => $locale]);
    }
}

