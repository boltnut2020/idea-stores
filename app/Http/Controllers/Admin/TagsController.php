<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tag;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tags = Tag::whereHas('users', function($query) {
			$query->where('users.id', Auth::id());
		})->get();
        // return $videos;
        return view('tags.index', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tags.create');
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
        // モデルからインスタンスを生成
        $tag = new Tag;
        // $requestにformからのデータが格納されているので、以下のようにそれぞれ代入する
        $tag->name = $request->name;
        // 保存
        $tag->save();

        $tag->users()->sync(Auth::id());
        // 保存後 一覧ページへリダイレクト
        return redirect()->route('admin.tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function show($id)
//    {
//        //
//        // 引数で受け取った$idを元にfindでレコードを取得
//        $tag = Tags::find($id);
//        // viewにデータを渡す
//        return view('tags.show', ['tag' => $tag]);
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $tag = Tag::find($id);
        if (!$tag->users->contains(Auth::id())) {
            return false;
        }
        return view('tags.edit', ['tag' => $tag]);
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
        $tag = Tag::find($id);
        if (!$tag->users->contains(Auth::id())) {
            return false;
        }
        $tag->name = $request->name;
        $tag->save();
        $tag->users()->sync(Auth::id());
        return redirect()->route('admin.tags.index');
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
        // idを元にレコードを検索
        $tag = Tag::find($id);
        if (!$tag->users->contains(Auth::id())) {
            return false;
        }
       // 削除
       $tag->delete();
       // 一覧にリダイレクト
       return redirect()->route("admin.tags.index");
    }
}
