<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Comment;
use App\Question;
use App\Customer;
use App\Category;
use App\Order;
use App\Answer;
use App\CustomerProductLike;
use App\CustomerQALike;
use App\CustomerCommentThank;
use App\AnswerComment;
use \Auth;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $seen = session('seen');
        $total = session('total');
        $product = Product::find($request->id);
        $commentsRate1 = $product->comments->where('status', '1')->where('rate','=',1);
        $commentsRate2 = $product->comments->where('status', '1')->where('rate','=',2);
        $commentsRate3 = $product->comments->where('status', '1')->where('rate','=',3);
        $commentsRate4 = $product->comments->where('status', '1')->where('rate','=',4);
        $commentsRate5 = $product->comments->where('status', '1')->where('rate','=',5);
        $rating = $product->comments->where('status', '1')->avg('rate');
        $rating = round($rating);
        $customer = Customer::where('user_id', Auth::id())->first();
        $rates = Comment::where('customer_id', $customer->id )->paginate(10);
        $banrate = $product->comments->where('rate','>=',1)->where('customer_id', $customer->id );
        $orders = $customer->orders()->paginate(10); 
        $checkorders = $product->orders->where('status','=',6)->where('customer_id', $customer->id);
        // dd(count($checkorders));
        
        $comments = $product->comments->where('status', '1');
        $questions = Question::where([['product_id', $request->id],['status', '1']])->with('answers')->get();

        $productBestSales = Product::where('status','1')->inRandomOrder()->limit(6)->get();

        $productCategory = Category::where('id', $product->categories->where('status','1')->random()->id)->first()->products->take(6);

        if(Auth::check()){
            $customer = Customer::where('user_id', Auth::id())->first();
            $seen = $customer->products; // lấy ra 3 sản phẩm mới xem
            session(['seen' => $seen]);
            if($customer->products()->where('product_id', $product->id)->first() == null) {
                $customer->products()->attach($product->id);
            }

        }
        else{
            $seen[] = $product;

            session()->put('seen', $seen);
            session()->save();
        }
        $seenProduct = collect(session('seen'))->sortKeysDesc()->take(3);
        $like = $request->id;

        

        return view('pages.shopping.productcontroller.index', [
            'product' => $product,
            'productBestSales' => $productBestSales,
            'productCategory' => $productCategory,
            'total' => $total,
            'comments' => $comments,
            'questions' => $questions,
            'seenProduct' => $seenProduct,
            'commentsRate1' => $commentsRate1,
            'commentsRate2' => $commentsRate2,
            'commentsRate3' => $commentsRate3,
            'commentsRate4' => $commentsRate4,
            'commentsRate5' => $commentsRate5,
            'rating' => $rating,
            'rates' => $rates,
            'banrate' => $banrate,
            'orders' => $orders,
            'checkorders' => $checkorders,
            'like' => $like
        ]);
    }
    public function ajaxcomment(Request $request)
    {
        $customer = Customer::where('user_id', Auth::id())->first();

        $product = Product::find($request->id);

        if ($request->get('query') == "All") {

            $comments = $product->comments->where('status', '1');

        } else {

            $comments = $product->comments
                        ->where('rate', $request->get('query'))
                        ->where('status', '1');
        }
        return response()->json(['comments' => $comments, 'customer' => $customer]);
    }

    public function comment(Request $request)
    {
        $customer = Customer::where('user_id',Auth::id())->first();
        $data = [
            'customer_id' => $customer->id,
            'headding' => $request->rate,
            'content' => $request->content,
            'rate' => $request->rate,
            'status' => 1
        ];

        $comment = Comment::create($data);
        $comment->products()->attach($request->id);

        return redirect()->back();
    }

    public function thanksComment(Request $request)
    {
        if(!Auth::check()) {
            return response()->json(['msg' => 'Vui lòng đăng nhập để thực hiện chức năng này!']);
        } else {
            $customer = Customer::where('user_id', Auth::id())->first();

            if($customer->commentthanks()->where('comment_id', $request->id_tks)->first() == null){
                $datathank = CustomerCommentThank::create([
                    'customer_id' => $customer->id,
                    'comment_id' => $request->id_tks
                ]);
                return response()->json(['msg' => 'Bạn đã cảm ơn nhận xét!']);
            }
            else {
                return response()->json(['msg' => 'Bạn đã cảm ơn nhận xét rồi']);
            }
        }
    }

    public function answerComment(Request $request)
    {
        if(!Auth::check()) {

            return response()->json(['msg' => 'Xin vui lòng đăng nhập để thực hiện chức năng này!']);

        } elseif($request->answer_cmt == null) {

            return response()->json(['msg' => 'Bạn chưa nhập câu trả lời!']);

        } else {

            $customer = Customer::where('user_id', Auth::id())->first();
            $data = [
                'answer_cmt' => $request->answer_cmt,
                'comment_id' => $request->id_cmt,
                'customer_id' => $customer->id,
                'status' => 0
            ];
            $answer_cmt = AnswerComment::create($data);
            return response()->json(['msg' => 'Rbooks cảm ơn câu trả lời của bạn và vui lòng đợi quản trị viên phê duyệt!']);

        }
    }

    public function question(Request $request)
    {
        $customer = Customer::where('user_id',Auth::id())->first();
        $data = [
            'customer_id' => $customer->id,
            'product_id' => $request->id,
            'question' => $request->question,
            'status' => 0
        ];

        $question = Question::create($data);

        return redirect()->back();
    }

    public function reply($id)
    {
        $total = session('total');
        $questions = Question::where('id', $id)->first();

        return view('pages.shopping.productcontroller.replyquestion', ['total' => $total, 'questions' => $questions]);
    }

    public function likeQuestion(Request $request)
    {
        if(!Auth::check()) {
            return response()->json(['msg' => 'Vui lòng đăng nhập để thực hiện chức năng này!']);
        }
        else {
            $customer = Customer::where('user_id', Auth::id())->first();
            $question = Question::where('id', $request->id)->first();
            if($customer->likequestions()->where('question_id', $request->id)->get()->isNotEmpty()){
                return response()->json(['msg' => 'Bạn đã thích câu hỏi này!']);
            }
            else {
                $like_question = CustomerQALike::create([
                    'customer_id' => $customer->id,
                    'question_id' => $request->id,
                    'answer_id' => 0,
                    'like_question' => 1,
                    'like_answer' => 0,
                ]);

                return response()->json(['msg' => 'Đã thích']);

            }
        }
    }

    public function likeAnswer(Request $request)
    {
        if(!Auth::check()) {
            return response()->json(['msg' => 'Vui lòng đăng nhập để thực hiện chức năng này!']);
        } else {
            $customer = Customer::where('user_id', Auth::id())->first();
            $answer = Answer::where('id', $request->id)->first();
            if($customer->likeanswers()->where('answer_id', $request->id)->get()->isNotEmpty()){
                return response()->json(['msg' => 'Bạn đã thích câu trả lời này!']);
            } else {
                $like_answer = CustomerQALike::create([
                    'customer_id' => $customer->id,
                    'question_id' => 0,
                    'answer_id' => $request->id,
                    'like_question' => 0,
                    'like_answer' => 1,
                ]);
                return response()->json(['msg' => 'Đã thích']);
            }
        }
    }

    public function answer(Request $request)
    {
        if(!Auth::check()) {
            return redirect()->back()->with('alert', 'Xin vui lòng đăng nhập để thực hiện chức năng này');
        }
        else {
            $customer = Customer::where('user_id', Auth::id())->first();
            $data = [
                'answer' => $request->answer,
                'question_id' => $request->question_id,
                'customer_id' => $customer->id,
                'status' => 0
            ];
            $answer = Answer::create($data);
            return redirect()->back()->with('success','Câu trả lời của bạn đã gửi và vui lòng đợi quản trị viên phê duyệt!');
        }
    }

    public function wish($id)
    {
        //$product = Product::find($request->id);
        if(!Auth::check()) {
            return response()->json(['msg' => 'Vui lòng đăng nhập để thực hiện chức năng này!']);
        }
        else {
            $customer = Customer::where('user_id', Auth::id())->first();

            if($customer->productlikes()->where('product_id', $id)->first() == null){
                $datawish = CustomerProductLike::create([
                    'customer_id' => $customer->id,
                    'product_id' => $id
                ]);
                return response()->json(['msg' => 'Đã thêm yêu thích']);
            }
            else {
                return response()->json(['msg' => 'Bạn đã yêu thích rồi']);
            }
        }
    }

    public function del_wish($id)
    {
        CustomerProductLike::where('product_id', $id)->delete();
        //$customer = Customer::where('user_id', Auth::id())->first();
        return redirect()->back();
    }

    public function getQuantity($id)
    {
        $productWarehouse = Product::find($id)->warehouses->first();
        return json_encode($productWarehouse->pivot->quantity);
    }

}
