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
            //Lấy toàn bộ dữ liệu
            // $data = Category::all();
            //cách 2 : lấy đữ liệu mới nhất và phần trang
            $category = Category::latest()->paginate(10);
            return view('backend.category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all(); //Select *form categories

        return view('backend.category.create', compact('category'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecategoryRequest $request)
    {
        $data = $request->all();
            // khới tạo modal va gan gia tri form cho nhung thuoc tinh cua doi tuong
            // $category = new Category();
               $data['slug'] = Str::slug($request->input('name')); //slug
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
                   $data['image'] = $path_upload.$filename;
               }
            //  trang thai
               $data['is_active'] = 0;
               if($request->has('is_active')) { // kiem tra xem is_active co ton tai hay khong
                   $data['is_active'] = $request->input('is_active');
               }
            // trang thai
            // $category->is_active =  $is_active;
            // vi tri
               $data['position'] = 0;
               if($request->has('position')) {
                   $data['position'] = $request->input('position');
               }
            //  $category->position = $position;
            //  luu
            Category::create($data);

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
        $category = Category::findOrFail($id);
        $categories = Category::all();
        return view('backend.category.edit' ,compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecategoryRequest  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecategoryRequest $request , $id)
    {

        $data = $request->all();
        $category = Category::findOrFail($id);
        $data['slug ']= Str::slug($request->input('name')); //slug
        if($request->hasFile('image')) { // kiem tra xem co image duoc chon khong
            @unlink(public_path($category->image));
            //get File
            $file = $request->file('image');
            // dat ten cho file image
            $filename = time(). '_'.$file->getClientOriginalName();
            // dinh nghia duong dan upload file len
            $path_upload = 'upload/category/';
            // thuc hien upload file
            $file->move($path_upload,$filename);
            // luu lai ten
            $data['image'] = $path_upload.$filename;
        }
        //trang thai
        $data['is_active'] = 0;
        if($request->has('is_active')) {
            $data['is_active']=$request->input('is_active');
        };
        //vi tri
        $position = 0;
        if($request->has('position')) {
            $data['position'] = $request->input('position');
        }
        // $category->position = $position;
        //luu
        $category ->update($data);

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
        $category = Category::find($id);
        // xóa ảnh cũ
        if($category) {
            @unlink(public_path($category->image));
            Category::destroy($id);
            return 1;
        } else return 0;
    }
}
