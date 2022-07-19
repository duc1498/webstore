<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
            //Lấy toàn bộ dữ liệu
            // $data = Category::all();
            //cách 2 : lấy đữ liệu mới nhất và phần trang
            $data = category::latest()->paginate(10);
            return view('backend.category.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = Category::all(); //Select *form categories

        return view('backend.category.create', compact('data'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
               // khới tạo modal va gan gia tri form cho nhung thuoc tinh cua doi tuong
               $category = new category();
               $category->name = $request->input('name');

               $category->slug = Str::slug($request->input('title')); //slug

               if($request->hasFile('image')) { // kiem tra xem co image duoc chon khong
                   //get File
                   $file = $request->file('image');
                   // dat ten cho file image
                   $filename = time(). '_'.$file->getClientOriginalName();
                   // dinh nghia duong dan upload file len
                   $path_upload = 'upload/category/';
                   // thuc hien upload file
                   $file->move($path_upload,$filename);
                   // luu lai ten
                   $category->image = $path_upload.$filename;
               }
               $category->parent_id = $request->input('parent_id');
               //trang thai
               $is_active = 0;
               //Trang thai
               if($request->has('is_active')) { // kiem tra xem is_active co ton tai hay khong
                   $is_active = $request->input('is_active');

               }
               //trang thai
               $category->is_active =  $is_active;
               //vi tri
               $position = 0;
               if($request->has('position')) {
                   $position = $request->input('position');
               }
               $category->position = $position;
               //luu
               $category->save();

               return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $model = category::findOrFail($id);
        $data = Category::all();
        return view('backend.category.edit' ,compact('model','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecategoryRequest  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {
        //
        $model = category::findOrFail($id);
        $model->name = $request->input('name');
        $model->slug = Str::slug($request->input('name')); //slug

        if($request->hasFile('image')) { // kiem tra xem co image duoc chon khong
            @unlink(public_path($model->image));
            //get File
            $file = $request->file('image');
            // dat ten cho file image
            $filename = time(). '_'.$file->getClientOriginalName();
            // dinh nghia duong dan upload file len
            $path_upload = 'upload/category/';
            // thuc hien upload file
            $file->move($path_upload,$filename);
            // luu lai ten
            $model->image = $path_upload.$filename;
        }
        $model->parent_id = $request->input('parent_id');
        //trang thai
        $is_active = 0;
        //Trang thai
        if($request->has('is_active')) { // kiem tra xem is_active co ton tai hay khong
            $is_active = $request->input('is_active');
        }
        //trang thai
        $model->is_active = $is_active;
        //vi tri
        $position = 0;
        if($request->has('position')) {
            $position = $request->input('position');
        }
        $model->position = $position;
        //luu
        $model->save();

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $banner = category::find($id);
        // xóa ảnh cũ
        if($banner) {
            @unlink(public_path($banner->image));
            category::destroy($id);
            return 1;
        } else return 0;
    }
}