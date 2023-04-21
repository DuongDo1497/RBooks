<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Question;
use App\Answer;
use App\Career;
use App\Recruitment;
use Illuminate\Database\Eloquent\Collection;
use Session;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $categories = Category::all();
        view()->share('categories', $categories);

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

    public function index(Request $request)
    {
        
        $categories = Category::get();
        $total = session('total');
        $seen = collect(session('seen'))->sortKeysDesc()->take(4);
        $locale = session('locale');

        $products = Product::all();
        $productOneSale = array();
        $maxDiscount = 0;

        foreach ($products as $product) {
            if ($product->status == 1) {
                if (round(100 - (($product->sale_price / $product->cover_price) * 100), 0) > $maxDiscount) {
                    $maxDiscount = round(100 - (($product->sale_price / $product->cover_price) * 100), 0);
                    $productOneSale = $product;
                }
            }
        }

        // Top three featured
        $topThree = Product::orderBy('created_at', 'DESC')->where('status', '1')->take(3)->get();

        //show product index
        //$topWeek = Product::inRandomOrder()->limit(4)->get();  //Top week
        $topWeek = Category::where('slug', 'sach-ban-chay')->first()->products()->orderBy('id', 'DESC')->where('status', '1')->take(6)->get();
        //$top = Product::inRandomOrder()->limit(4)->get(); // Top
        $top = Category::where('slug', 'sach-moi-phat-hanh')->first()->products()->orderBy('id', 'DESC')->where('status', '1')->take(6)->get();
        //$orderBefore = Product::inRandomOrder()->limit(4)->get(); // Top order
        $orderBefore = Category::where('slug', 'sach-combo')->first()->products()->orderBy('id', 'DESC')->where('status', '1')->take(8)->get();
        //$topSale = Product::inRandomOrder()->limit(4)->get(); // Top sale
        $topSale = Category::where('slug', 'sach-giam-gia')->first()->products()->orderBy('id', 'DESC')->where('status', '1')->take(6)->get();
        //$topCombo = Product::orderBy('id', 'DESC')->limit(5)->get(); // Top combo
        $topCombo = Category::where('slug', 'sach-sap-phat-hanh')->first()->products()->orderBy('id', 'DESC')->where('status', '1')->take(8)->get();
        $topNewEconomy = Category::where('slug', 'sach-kinh-te')->first()->products()->orderBy('id', 'DESC')->where('status', '1')->take(4)->get();

        // /dd(is_null($topNewEconomy->first()->images));

        return view('pages.homecontroller.index', [
            'categories' => $categories,
            'topWeek' => $topWeek,
            'top' => $top,
            'orderBefore' => $orderBefore,
            'topSale' => $topSale,
            'topCombo' => $topCombo,
            'topNewEconomy' => $topNewEconomy,
            'total' => $total,
            'locale' => $locale,
            'productOneSale' => $productOneSale,
            'topThree' => $topThree,
            'seen' => $seen,
        ]);
    }

    public function search(Request $request)
    {
    
        $locale = session('locale');
        // $publishers = Product::distinct()
        //     ->where([
        //         ['publisher', '<>', ''],
        //         ['status', '=', 1]
        //     ])->get(['publisher']);
            $products = Product::orderBy('created_at', 'DESC')->paginate(12);

        if($keyword = request()->keyword){
        $products1 = Product::orderBy('created_at', 'DESC')->where( 'name', 'like', '%'.$request->keyword.'%')->paginate(12);
        $products2 = Product::orderBy('created_at', 'DESC')->where( 'slug', 'like', '%'.$request->keyword.'%')->paginate(12);
        }   
        // dd($request->all());
 
        // if ($request->newest == "0") {
        //     $latest_prd = Product::where('status', '1')->orderBy('id', 'DESC')->first();
        //     $data = Product::where('status', '1')->whereBetween("created_at", [$latest_prd->created_at->subDays(100), $latest_prd->created_at])->where('name', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->paginate(16);
        // } else if ($request->top_seller == "1") {
        //     $product_id = DB::table('order_product')->select('product_id', DB::raw('COUNT(product_id) as counter'))->groupBy('product_id')->havingRaw('COUNT(product_id) > 2')->get();
        //     foreach ($product_id as $key => $values) {
        //         $id[] = $values->product_id;
        //     }

        //     $data = Product::whereIn('id', $id)->where('name', 'like', '%' . $request->keyword . '%')->paginate(16);
        // } else if ($request->discount == "2") {
        //     $data = Product::where('status', '1')->where('name', 'like', '%' . $request->keyword . '%')->orderBy('sale_price', 'DESC')->paginate(16);
        // } else if ($request->price_asc == "3") {
        //     $data = Product::where('status', '1')->where('name', 'like', '%' . $request->keyword . '%')->orderBy('sale_price', 'ASC')->paginate(16);
        // } else if ($request->price_desc == "4") {
        //     $data = Product::where('status', '1')->where('name', 'like', '%' . $request->keyword . '%')->orderBy('sale_price', 'DESC')->paginate(16);
        // }
        return view('pages.homecontroller.search', compact('products'),
         [
            // 'publishers' => $publishers,
     
            'keyword' => $request->keyword,
            'locale' => $locale,
            'products1' => $products1,
            'products2' => $products2
        ]);
    }

    public function aboutRbooks()
    {
        $total = session('total');
        return view('pages.homecontroller.aboutRbooks', ['total' => $total]);
    }

    public function recruitment()
    {
        $total = session('total');
        $recruitments = Recruitment::where('status', '!=', 0)->get();
        return view('pages.homecontroller.recruitment', [
            'total' => $total,
            'recruitments' => $recruitments,
        ]);
    }

    public function recruitmentDetail($id)
    {
        $recruitment = Recruitment::find($id);

        $total = session('total');

        return view('pages.homecontroller.recruitmentDetail', [
            'total' => $total,
            'recruitment' => $recruitment,
        ]);
    }

    public function postApply(Request $request)
    {
        $file = $request->file('file_cv');
        if ($file == null) {
            $file = 'cv_apply/';
            $file_cvPDF = substr($file, 8);
        } else {
            $file_cv = $file->getClientOriginalName();
            $file_cvPDF = 'cv_apply/' . $file_cv;
            $file->move(public_path('rbooks-vn-management/public/cv_apply/'), $file_cvPDF);
        }

        $data = [
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'apply_position' => $request->apply_position,
            'file_cv' => $file_cvPDF,
            'status' => 0,
            'updated_user_id' => 0
        ];
        Career::create($data);
        return redirect()->back()->with('msg', 'Rbooks cảm ơn bạn đã ứng tuyển vào công ty. Công ty sẽ liên lạc với bạn sớm nhất có thể!');
    }

    public function shipping()
    {
        $total = session('total');
        return view('pages.homecontroller.shipping', ['total' => $total]);
    }

    public function payment()
    {
        $total = session('total');
        return view('pages.homecontroller.payment', ['total' => $total]);
    }

    public function privacy()
    {
        $total = session('total');
        return view('pages.homecontroller.privacy', ['total' => $total]);
    }

    public function order()
    {
        $total = session('total');
        return view('pages.homecontroller.order', ['total' => $total]);
    }

    // public function postLang(Request $request)
    // {
    //     Session::set('locale', $request->locale);
    //     return redirect()->back();
    // }

    public function products()
    {
        $total = session('total');
        $locale = session('locale');

        $categories = Category::all();
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->paginate(12);

        return view('pages.homecontroller.products', ['total' => $total, 'categories' => $categories, 'products' => $products, 'locale' => $locale]);
    }

    public function paper()
    {
        $total = session('total');
        return view('pages.homecontroller.paper', ['total' => $total]);
    }

    public function contact()
    {
        $total = session('total');

        return view('pages.homecontroller.contact', ['total' => $total]);
    }
}
