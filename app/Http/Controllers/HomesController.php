<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contact;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use App\Models\Article;

class HomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $setting = Setting::first();

        view()->share('setting', $setting);
    }
    public function index(Request $request)
    {

        return view('frontend.homes.home');
    }

    public function introduce ()
    {

        return view('frontend.layouts.about');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }
    public function contactPost(Request $request )
    {
        $data = $request-> all();
        $contactPost = new Contact();
        Contact::create($data);

        return view('frontend.homes.home', compact('contactPost'));
    }

    public function articles(Request $request)
    {
        $articles = Article::latest()->paginate(20);

        return view('frontend.layouts.articles', compact('articles'));
    }

    public function detailArticle($slug, Request $request)
    {
        $article = Article::where('slug', $slug)->where('id',$request->id)->where('is_active' , 1)->first();

        if ($article == null) {
            dd('not found');
        }
        return view('frontend.layouts.detail-article', compact('article'));
    }
}
