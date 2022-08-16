<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $filter_type = $data['filter_type'] ?? 1;
            if(Auth::user()->role_id ==1) {
                if($filter_type == 1){
                    $article = article::withTrashed()->latest()->paginate(10);
                }elseif($filter_type == 2) {
                    $article = article::latest()->paginate(10);
                }else {
                    $article = article::onlyTrashed()->latest()->paginate(10);
                }
            }else {
                $article = article::latest()->paginate(10);
            }
        return view('backend.article.index', compact('filter_type', 'article'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $article = Article::all(); //Select *form categories

        return view('backend.article.create', compact('article','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorearticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $data = $request->all();
        $data['slug'] = $request->input('title'); //slug
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
        Article::create($data);

        return redirect()->route('admin.article.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $category = Category::all();

        return view('backend.article.edit' ,compact('article','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatearticleRequest  $request
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, $id)
    {

        $data= $request->all();
        $article = Article::findOrFail($id);

        // $article->title = $request->input('title');

        $data['slug'] = Str::slug($request->input('title')); //slug

        if($request->hasFile('image')) { // kiem tra xem co image duoc chon khong
            @unlink(public_path($article->image));
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
        $article->update($data);

        return redirect()->route('admin.article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        // xóa ảnh cũ
        if($article) {
        @unlink(public_path($article->image));

        Article::destroy($id);
        return true;
        } else return false;
    }

    public function restore($id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);

        $article->restore();
            return response()->json([
                'status' => true,
                'msg' => 'Khôi phục thành công '
            ]);
    }
}
