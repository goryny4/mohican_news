<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\News;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $news = News::with('category');

        if ($request->ajax()) {
            // вьюха для ajax содержит только rows, а не всю таблицу со скриптами
            return view('manager.rows', [
                'news' => $news->get()
            ]);
        } else {
            return view('manager.index', [
                'news' => $news->get(),
                'categories'=>Category::all(),
            ]);
        }

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
        if (\request()->ajax()) {
            $news = new News();
            $news->title = \request('title');
            $news->full_text = \request('full_text');
            $news->category_id = \request('category_id');
            $news->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (\request()->ajax()) {
            return News::findOrFail($id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


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
        if (\request()->ajax()) {
            $news = News::findOrFail($id);
            $news->title = \request('title');
            $news->full_text = \request('full_text');
            $news->category_id = \request('category_id');
            $news->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\request()->ajax()) {
            return News::destroy($id);
        }
    }
}
