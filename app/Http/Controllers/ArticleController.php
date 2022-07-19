<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorearticleRequest;
use App\Http\Requests\UpdatearticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Article::all();
        $category = Category::all();
        return view('backend.article.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = Article::all(); //Select *form categories

        return view('backend.article.create', compact('data'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorearticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
          // khới tạo modal va gan gia tri form cho nhung thuoc tinh cua doi tuong
          $article = new Article();
          $article->title = $request->input('title');

          $article->slug = Str::slug($request->input('title')); //slug

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
              $article->image = $path_upload.$filename;
          }
          $article->url = $request->input('url');
          $article->summary = $request->input('summary');
          //loai
          $article->type = $request->input('type');
          //trang thai
          $is_active = 0;
          //Trang thai
          if($request->has('is_active')) { // kiem tra xem is_active co ton tai hay khong
              $is_active = $request->input('is_active');
          }
          //trang thai
          $article->is_active = $is_active;
          //vi tri
          $position = 0;
          if($request->has('position')) {
              $position = $request->input('position');
          }
          $article->position = $position;
          // mo ta
          $article->description = $request->input('description');

          $article->meta_title= $request->input('meta_title');

          $article->article_id = $request->input('article_id');


          $article->meta_description = $request->input('meta_description');
          //luu
          $article->save();

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
        //
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
    public function update(Request $request, $id)
    {
        //
        $article = Article::findOrFail($id);
        $article->title = $request->input('title');

        $article->slug = Str::slug($request->input('title')); //slug

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
            $article->image = $path_upload.$filename;
        }
        $article->url = $request->input('url');
        $article->summary = $request->input('summary');
        //loai
        $article->type = $request->input('type');
        //trang thai
        $is_active = 0;
        //Trang thai
        if($request->has('is_active')) { // kiem tra xem is_active co ton tai hay khong
            $is_active = $request->input('is_active');
        }
        //trang thai
        $article->is_active = $is_active;
        //vi tri
        $position = 0;
        if($request->has('position')) {
            $position = $request->input('position');
        }
        $article->position = $position;
        // mo ta
        $article->description = $request->input('description');

        $article->meta_title= $request->input('meta_title');

        $article->category_id = $request->input('category_id');

        $article->meta_description = $request->input('meta_description');
        //luu
        $article->save();

        return redirect()->route('admin.article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
