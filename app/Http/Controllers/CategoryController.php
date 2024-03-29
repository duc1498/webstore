<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
        if (Auth::user()->role_id == 1) {
            if ($filter_type == 1) {
                $category = Category::withTrashed()->latest()->paginate(10);
            } elseif ($filter_type == 2) {
                $category = Category::latest()->paginate(10);
            } else {
                $category = Category::onlyTrashed()->latest()->paginate(10);
            }
        } else {
            $category = Category::latest()->paginate(10);
        }
        return view('backend.category.index', compact('category', 'filter_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $category = Category::all(); //Select *form categories
        // dd($category);
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
        if ($request->hasFile('image')) { // kiem tra xem co image duoc chon khong
            //get File
            $file = $request->file('image');
            // dat ten cho file image
            $filename = time() . '_' . $file->getClientOriginalName();
            // dinh nghia duong dan upload file len
            $path_upload = 'upload/category/';
            // thuc hien upload file
            $file->move($path_upload, $filename);
            // luu lai ten
            $data['image'] = $path_upload . $filename;
        }
        //  trang thai
        $data['is_active'] = 0;
        if ($request->has('is_active')) { // kiem tra xem is_active co ton tai hay khong
            $data['is_active'] = $request->input('is_active');
        }
        // trang thai
        // $category->is_active =  $is_active;
        // vi tri
        $data['position'] = 0;
        if ($request->has('position')) {
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
        return view('backend.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecategoryRequest  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecategoryRequest $request, $id)
    {

        $data = $request->all();
        $category = Category::findOrFail($id);
        $data['slug '] = Str::slug($request->input('name')); //slug
        if ($request->hasFile('image')) { // kiem tra xem co image duoc chon khong
            @unlink(public_path($category->image));
            //get File
            $file = $request->file('image');
            // dat ten cho file image
            $filename = time() . '_' . $file->getClientOriginalName();
            // dinh nghia duong dan upload file len
            $path_upload = 'upload/category/';
            // thuc hien upload file
            $file->move($path_upload, $filename);
            // luu lai ten
            $data['image'] = $path_upload . $filename;
        }
        //trang thai
        $data['is_active'] = 0;
        if ($request->has('is_active')) {
            $data['is_active'] = $request->input('is_active');
        };
        //vi tri
        $position = 0;
        if ($request->has('position')) {
            $data['position'] = $request->input('position');
        }
        // $category->position = $position;
        //luu
        $category->update($data);

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
        $checkExitproduct = Product::where('category_id', $id)->first();
        if ($checkExitproduct != null) {
            return response()->json([
                'success' => false,
                'msg' => 'xoá không thành công , tồn tại nhiều sản phẩm đang được thêm cho danh mục'
            ], 500);
        }
        // xóa ảnh cũ
        if ($category) {
            @unlink(public_path($category->image));
            Category::destroy($id);
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
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return response()->json([
            'status' => true,
            'msg' => 'Khôi phục thành công '
        ]);
    }
}
