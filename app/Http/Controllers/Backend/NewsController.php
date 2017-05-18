<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use App\Http\Requests\Backend\NewsPostRequest;
use App\Http\Requests\Backend\NewsPutRequest;
use Session;
use Storage;
use File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('id', 'DESC')->with('category', 'adminUser')->paginate();
        return view('backend.news.index', compact('news'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request of news
     *
     * @return \Illuminate\Http\Response
     */
    public function store(NewsPostRequest $request)
    {
        $news = new News($request->all());
        $news ->admin_user_id = Auth()->user()->id;
        $news ->slug = str_slug($news->title);
        $news ->save();
        Session::flash('success', trans('messages.news_create_success'));
        return redirect()->route('admin.news.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id of news
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news =  News::findOrFail($id);
        return view('backend.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request of news
     * @param int                      $id      of news
     *
     * @return \Illuminate\Http\Response
     */
    public function update(NewsPutRequest $request, $id)
    {
        $news = News::findOrFail($id);
        $news ->admin_user_id = $news->adminUser->id;
        $news ->slug = str_slug($request->title);
        $news->fill($request->all());
        $news->update();
        Session::flash('success', trans('messages.news_edit_success'));
        return redirect()->route('admin.news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id of news
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        News::findOrFail($id)->delete();
        Session::flash('success', trans('messages.news_delete_success'));
        return redirect()->route('admin.news.index');
    }
}