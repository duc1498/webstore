<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
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
                    $banner = Banner::withTrashed()->latest()->paginate(10);
                }elseif($filter_type == 2) {
                    $banner = Banner::latest()->paginate(10);
                }else {
                    $banner = Banner::onlyTrashed()->latest()->paginate(10);
                }
            }else {
                $banner = Banner::latest()->paginate(10);
            }
        return view('backend.banner.index',compact('banner', 'filter_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBannerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBannerRequest $request)
    {
        $data = $request ->all();
        $data['slug'] = Str::slug($request->input('title')); //slug

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
        Banner::create($data);

        return redirect()->route('admin.banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $banner = Banner::findOrFail($id);

        return view('backend.banner.edit' ,compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBannerRequest  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request , $id)
    {
        //
        $data = $request-> all();
        $banner= Banner::findOrFail($id);

        // $banner->title = $request->input('title');
        $data['slug'] = Str::slug($request->input('title')); //slug

        if($request->hasFile('image')) { // kiem tra xem co image duoc chon khong
            @unlink(public_path($banner->image));
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

        $data['is_active'] = 0;
        if($request->has('is_active')) { // kiem tra xem is_active co ton tai hay khong
            $data['is_active'] = $request->input('is_active');
        }

        $data['position'] = 0;
        if($request->has('position')) {
            $data['position'] = $request->input('position');
        }
        $banner-> update($data);

        return redirect()->route('admin.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        // xóa ảnh cũ
        if($banner) {
            @unlink(public_path($banner->image));
            Banner::destroy($id);
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
        $banner = Banner::onlyTrashed()->findOrFail($id);
        $banner->restore();
            return response()->json([
                'status' => true,
                'msg' => 'Khôi phục thành công '
            ]);
    }
}
