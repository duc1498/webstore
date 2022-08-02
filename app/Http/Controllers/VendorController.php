<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $vendor = Vendor::all();

        return view('backend.vendor.index', compact('vendor'));
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
    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        //
        $data= $request->all();
        $vendor = Vendor::findOrFail($id);

        // $article->title = $request->input('title');

        $data['slug'] = Str::slug($request->input('title')); //slug

        if($request->hasFile('image')) { // kiem tra xem co image duoc chon khong
            @unlink(public_path($vendor->image));
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
        $vendor->update($data);

        return redirect()->route('admin.vendor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}