<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Auth;


class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::where('display', true)->orderBy('id', 'desc')->paginate(10);;
        return view('articles.index', ['articles' => $articles]);
    }

    public function thread()
    {

        $memos = Memo::whereHas('users', function($query) {
            $query->where('users.id', Auth::id());
        })->with(['childrenRecursive' => function($query) {
            $query->orderBy('updated_at', 'desc')->take(100);
        }])->whereNull('parent_id')->orderBy('updated_at', 'desc')->paginate(10);

        return view('memos.index', ['memos' => $memos]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tag($id)
    {
        //
        $memos = Memo::whereHas('tags', function($query) use($id){
            $query->where('tags.id', $id);

        })->whereHas('users', function($query) {
            $query->where('users.id', Auth::id());

        })->orderBy('id', 'desc')->paginate(10);

        // return $videos;
        return view('memos.index', ['memos' => $memos]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        // viewにデータを渡す
        return view('articles.show', ['article' => $article]);
    }
}
