<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\category;
use App\Models\brand;
use App\Models\vendor;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $product = Product::all();
        $product = Product::Paginate(10);

        return view('backend.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::all();
        $user = User::all();
        $category = Category::all();
        $brand = Brand::all();
        $vendor = Vendor::all();
        return view('backend.product.create' ,compact('product','category','user','brand','vendor'));
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
        $data = $request ->all();
        $data['slug'] = Str::slug($request->input('name')); //slug

        if($request->hasFile('image')) { // kiem tra xem co image duoc chon khong
            //get File
            $file = $request->file('image');
            // dat ten cho file image
            $filename = time(). '_'.$file->getClientOriginalName();
            // dinh nghia duong dan upload file len
            $path_upload = 'upload/banner/';
            // thuc hien upload file
            $file->move($path_upload,$filename);
            // luu lai ten
            $data['image'] = $path_upload.$filename;
        }
        //trang thai
        $data['is_active'] = 0;
        //Trang thai
        if($request->has('is_active')) {
            $data['is_active'] = $request->input('is_active');
        }

        $data['position'] = 0;
        if($request->has('position')) {
            $data['position'] = $request->input('position');
        }
        $data['is_hot'] = $request->input('position') ?? 0 ;
        $data['price'] = Str::remove(',', $request->input('price'));
        $data['sale'] = Str::remove(',', $request->input('sale'));
        $product=Product::create($data);
        return redirect()->route('admin.product.index');
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
        $product = Product::findOrFail($id);
        $user = User::all();
        $category = Category::all();
        $brand = Brand::all();
        $vendor = Vendor::all();
        return view('backend.product.edit' ,compact('product','category','user','brand','vendor'));
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
        $data= $request->all();
        $product = Product::findOrFail($id);

        // $article->title = $request->input('title');

        $data['slug'] = Str::slug($request->input('name')); //slug

        if($request->hasFile('image')) { // kiem tra xem co image duoc chon khong
            @unlink(public_path($product->image));
            //get File
            $file = $request->file('image');
            // dat ten cho file image
            $filename = time(). '_'.$file->getClientOriginalName();
            // dinh nghia duong dan upload file len
            $path_upload = 'upload/article/';
            // thuc hien upload file
            $file->move($path_upload,$filename);
            // luu lai ten
            $data['image'] = $path_upload.$filename;
        }

        $data['is_active'] = 0;
        if($request->has('is_active')) {
            $data['is_active'] = $request->input('is_active');
        };
        $data['position'] = 0;
        if($request->has('position')) {
            $data['position'] = $request->input('position');
        }
        $data['is_hot'] = $request->input('position') ?? 0 ;
        $data['price'] = Str::remove(',', $request->input('price'));
        $data['sale'] = Str::remove(',', $request->input('sale'));
        $product->update($data);

        return redirect()->route('admin.product.index');
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
        $product = Product::find($id);
        // xóa ảnh cũ

        if($product) {
        @unlink(public_path($product->image));
        Product::destroy($id);
        return true;
        } else return false;
    }
}
