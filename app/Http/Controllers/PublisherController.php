<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use DB;

class PublisherController extends Controller
{
    public function index(Request $request, $alias)
    {
        $id = 1;
    	$total = session('total');
        $locale = session('locale');
        $categories = Category::all();
        $publishers = Product::distinct()->where([
            ['publisher','<>','']
            ,
            ['status','=',1]
        ])->get(['publisher']);
        $products = Product::where('status','1')->where('publisher','=', $alias)->paginate(20);

        if($request->newest == "0") {
            $latest_prd = Product::where('status','1')->orderBy('id', 'DESC')->first();
                $products = Product::where('status','1')->whereBetween("created_at", [$latest_prd->created_at->subDays(100), $latest_prd->created_at])->where('publisher','=', $alias)->orderBy('id', 'DESC')->paginate(16);
        }

        else if($request->top_seller == "1"){
            $product_id = DB::table('order_product')->select('product_id', DB::raw('COUNT(product_id) as counter'))->groupBy('product_id')->havingRaw('COUNT(product_id) > 2')->get();

            foreach($product_id as $key => $values) {
                $pro_id[] = $values->product_id;
            }
            $products = Product::whereIn('id', $pro_id)->where('publisher','=', $alias)->paginate(16);
        }

        else if($request->discount == "2") {
            $products = Product::where('status', '1')->where('publisher','=', $alias)->orderBy('sale_price', 'DESC')->paginate(16);
        }

        else if($request->price_asc == "3") {
            $products = Product::where('status', '1')->where('publisher','=', $alias)->orderBy('sale_price', 'ASC')->paginate(16);
        }
        
        else if($request->price_desc == "4") {
            $products = Product::where('status', '1')->where('publisher','=', $alias)->orderBy('sale_price', 'DESC')->paginate(16);
            
        }
        return view('pages.shopping.publishercontroller.index', ['categories' => $categories, 'products' => $products, 'total' => $total, 'publishers' => $publishers, 'locale' => $locale]);
    }
}
