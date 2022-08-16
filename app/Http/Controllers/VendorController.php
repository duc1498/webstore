<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use Illuminate\Support\Str;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SoftDeletes;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $vendor = Vendor::all();
        $data = $request->all();
        $filter_type = $data['filter_type'] ?? 1;
            if(Auth::user()->role_id ==1) {
                if($filter_type == 1){
                    $vendor = Vendor::withTrashed()->latest()->paginate(10);
                }elseif($filter_type == 2) {
                    $vendor = Vendor::latest()->paginate(10);
                }else {
                    $vendor = Vendor::onlyTrashed()->latest()->paginate(10);
                }
            }else {
                $vendor = Vendor::latest()->paginate(10);
            }
        return view('backend.vendor.index', compact('vendor','filter_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $vendor = Vendor::all();

        return view('backend.vendor.create' , compact('vendor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVendorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorRequest $request)
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
              $path_upload = 'upload/vendor/';
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
        $vendor= Vendor::create($data);

        return redirect()->route('admin.vendor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //
        $vendor = Vendor::findOrFail($id);
        return view('backend.vendor.edit' , compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVendorRequest  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorRequest $request, $id)
    {
        //
        $data= $request->all();

        $vendor = Vendor::findOrFail($id);

        // $vendor->title = $request->input('title');

        $data['slug'] = Str::slug($request->input('title')); //slug

        if($request->hasFile('image')) { // kiem tra xem co image duoc chon khong
            @unlink(public_path($vendor->image));
            //get File
            $file = $request->file('image');
            // dat ten cho file image
            $filename = time(). '_'.$file->getClientOriginalName();
            // dinh nghia duong dan upload file len
            $path_upload = 'upload/vendor/';
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
        $vendor->update($data);

        return redirect()->route('admin.vendor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $vendor = Vendor::find($id);
        $checkEditProduct = Product::where('vendor_id',$id)->first();
        if($checkEditProduct != null) {
            return response()->json ([
                'success'=> false,
                'msg'=>'xoá không thành công , tồn tại nhiều sản phẩm đang được thêm cho danh mục',
            ],500);
        }
         // xóa ảnh cũ
         if($vendor) {
            @unlink(public_path($vendor->image));
            Vendor::destroy($id);
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
        $vendor = Vendor::onlyTrashed()->findOrFail($id);
        $vendor->restore();
            return response()->json([
                'status' => true,
                'msg' => 'Khôi phục thành công '
            ]);
    }
}
