<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use App\Models\Article;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Product;
use App\Cart;
use Illuminate\Support\Str;

class HomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $categories;
    public function __construct()
    {
        $setting = Setting::first();
        // Lấy dữ liệu - Danh mục, có trạng thái là hiển thị
        $this->categories = Category::where(['is_active' => 1])->get();
        $banners = Banner::where(['is_active' => 1])
            // where('type', 5)
            //->orderBy('created_at')
            ->orderBy('id')
            ->get();

        View::share('categories', $this->categories);
        View::share('setting', $setting);
        View::share('banners', $banners);
        // view()->share('setting', $setting);
    }
    public function index(Request $request)
    {

        $list = []; // chứa danh sách sản phẩm  theo danh mục

        foreach ($this->categories as $key => $parent) {
            if ($parent->parent_id == 0) { // check danh mục cha
                $ids = []; // tạo chứa các id của danh cha + danh mục con trực thuộc / danh mục con

                $ids[] = $parent->id; // id danh mục cha

                $sub_menu = [];
                foreach ($this->categories as $child) {
                    if ($child->parent_id == $parent->id) {
                        $sub_menu[] = $child;
                        $ids[] = $child->id; // thêm phần tử vào mảng
                    }
                } // ids = [1,7,8,9,..]

                $list[$key]['category'] = $parent; // điện thoại, tablet
                $list[$key]['sub_category'] = $sub_menu; // điện thoại, tablet

                // SELECT * FROM `products` WHERE is_active = 1 AND is_hot = 0 AND category_id IN (1,7,9,11) ORDER BY id DESC LIMIT 10
                $list[$key]['products'] = Product::where(['is_active' => 1, 'is_hot' => 0])
                    ->whereIn('category_id', $ids)
                    ->limit(8)
                    ->orderBy('id', 'desc')
                    ->get();
            }
        }

        return view('frontend.home', ['list' => $list]);
    }

    public function introduce()
    {

        return view('frontend.introduce');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function contact()
    {

        return view('frontend.contact');
    }
    public function contactPost(Request $request)
    {
        $data = $request->all();
        Contact::create($data);

        return redirect('/lien-he')->with('msgContact', 'Gửi liên hệ thành công !');
    }

    public function articles(Request $request)
    {
        $articles = Article::latest()->paginate(20);

        return view('frontend.articles', compact('articles'));
    }

    public function detailArticle($slug, Request $request)
    {
        $article = Article::where('slug', $slug)->where('is_active', 1)->first();

        if ($article == null) {
            dd(404);
        }
        return view('frontend.detail-article', compact('article'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->where('is_active', 1)->first();

        if ($category == null) {
            dd(404);
        }

        $ids[] = $category->id; // khai báo mảng chứa các mã danh mục cần tìm kiếm chưa các sản phẩm

        foreach ($this->categories as $child) {
            if ($child->parent_id == $category->id) {
                $ids[] = $child->id; // thêm id của danh mục con vào mảng ids

                foreach ($this->categories as $sub_child) {
                    if ($sub_child->parent_id == $child->id) {
                        $ids[] = $child->id;
                    }
                }
            }
        }

        // step 2 : lấy list sản phẩm theo thể loại
        $products = Product::where('is_active', 1)
            ->whereIn('category_id', $ids)
            ->latest()
            ->paginate(15);

        return view('frontend.category', ['category' => $category, 'products' => $products]);
    }

    public function product(Request $request, $slug)
    {
        $product = Product::where('is_active', 1)->where('slug', $slug)->first();

        if ($product == null) {
            dd(404);
        }

        return view('frontend.product', ['product' => $product]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('kwd');

        $slug = Str::slug($keyword);

        $products = Product::where('is_active', 1)
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->get();

        $totalResult = $products->count();

        return view('frontend.search', [
            'products' => $products,
            'totalResult' => $totalResult,
            'keyword' => $keyword ? $keyword : ''
        ]);
    }

    public function cart()
    {
        $cartItems = \Cart::getContent();

        $total = \Cart::getTotal();

        return view('frontend.cart', compact('cartItems', 'total'));
    }

    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);

        session()->flash('success', 'Thêm vào giỏ hàng thành công');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {

        if ($request->ajax()) {

            $cartItems = \Cart::getContent();
            foreach ($cartItems as $key => $value) {
                $ids = $value["id"];
            };
            if ($ids > 0) {
                \Cart::remove([
                    'id' => $request->id,
                ]);
            };
            $total = \Cart::getTotal();
            $request->session()->put("Cart", $cartItems);
            $productId = $request->id;
            return response()->json(['success' => true, 'total' => $total]);
        }

        return response()->json(['success' => false]);
    }

    public function getPayment(Request $request)
    {
        $total = \Cart::getTotal();

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/webstore/public/cart";
        $vnp_TmnCode = "C5D4P6J8"; //Mã website tại VNPAY
        $vnp_HashSecret = "EYKQSVQRXDQIADNIOVBIKYKTUJSFDGZH"; //Chuỗi bí mật

        $vnp_TxnRef = Str::random(14); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'thanh toán đơn hàng';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $total * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'BIDV';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
    }
}
