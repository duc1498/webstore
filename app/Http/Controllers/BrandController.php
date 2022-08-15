<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $filter_type = $data['filter_type'] ?? 2;
            if(Auth::user()->role_id ==1) {
                if($filter_type == 1){
                    $brand = Brand::withTrashed()->latest()->paginate(10);
                }elseif($filter_type == 2) {
                    $brand = Brand::latest()->paginate(10);
                }else {
                    $brand = Brand::onlyTrashed()->latest()->paginate(10);
                }
            }else {
                $brand = Brand::latest()->paginate(10);
            }
        return view('backend.brand.index', compact('brand','filter_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.brand.create');
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
        $data = $request->all();
        $data['slug'] = $request->input('name'); //slug
        if($request->hasFile('image')) { // kiem tra xem co image duoc chon khong
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
        $brand = Brand::create($data);

        return redirect()->route('admin.brand.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $brand = Brand::findOrFail($id);

        return view('backend.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data= $request->all();
        $brand = Brand::findOrFail($id);
        $data['slug'] = Str::slug($request->input('name')); //slug

        if($request->hasFile('image')) { // kiem tra xem co image duoc chon khong
            @unlink(public_path($brand->image));
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
        $brand->update($data);

        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $brand = Brand::find($id);
        // xóa ảnh cũ
        $checkExitProduct = Product::where('brand_id',$id)->first();
        if($checkExitProduct != null) {
            return response()->json([
                'success'=> false,
                'msg'=> 'xoá không thành công , tồn tại nhiều sản phẩm đang được thêm cho danh mục'
            ], 500);
        }
        if($brand) {
        @unlink(public_path($brand->image));
        Brand::destroy($id);
        return response()->json([
            'success' => true,
            'msg' => 'xoá thành công '
        ]);
    } else {
        return response()->json([
            'success' => false,
            'msg' => 'xoá không thành công '
        ], 500);
    }
}

public function restore($id)
{
    $brand = Brand::onlyTrashed()->findOrFail($id);
    $brand->restore();
        return response()->json([
            'status' => true,
            'msg' => 'Khôi phục thành công '
        ]);
}
}
