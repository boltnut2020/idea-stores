<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Memo;
use App\Tag;

class MemosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $memos = Memo::all();
        // return $videos;
        return view('memos.index', ['memos' => $memos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('memos.create');
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
        $memo = new Memo;
        // $requestにformからのデータが格納されているので、以下のようにそれぞれ代入する
        $memo->memo = $request->memo;
        // 保存
        $memo->save();

        if ( $request->has('tag') ) {
            $tagIds = Tag::bulkFirstOrCreate($request->tag);
            $memo->tags()->sync($tagIds);
        }
        
        // 保存後 一覧ページへリダイレクト
        return redirect('/memos');
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
//        $memo = Memo::find($id);
//        // viewにデータを渡す
//        return view('memos.show', ['memo' => $memo]);
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
        $memo = Memo::find($id);
        $tags = $memo->tags()->pluck('name')->toArray();
        return view('memos.edit', ['memo' => $memo]);
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
        $memo = Memo::find($id);
        $memo->memo = $request->memo;
        $memo->save();
        if ( $request->has('tag') ) {
            $tagIds = Tag::bulkFirstOrCreate($request->tag);
            $memo->tags()->sync($tagIds);
        }
        return redirect("/memos");
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
       $memo = Memos::find($id);
       // 削除
       $memo->delete();
       // 一覧にリダイレクト
       return redirect('/memos');        
    }
}
