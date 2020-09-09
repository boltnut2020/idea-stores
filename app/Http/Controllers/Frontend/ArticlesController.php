<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;
use App\Category;
use App\ArticleCategory;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articles = Article::where('display', true)->orderBy('id', 'desc')->paginate(5);
        // return $articles;
        return view('articles.index', ['articles' => $articles]);
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
        // 引数で受け取った$idを元にfindでレコードを取得
        $article = Article::where('display', true)->find($id);
        if (!$article) abort(404);
        // viewにデータを渡す
        return view('articles.show', ['article' => $article]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category($id)
    {
        //
        $articles = Article::whereHas('categories', function($query) use($id){
            $query->where('categories.id', $id);

        })->orderBy('id', 'desc')->paginate(10);

        return view('articles.index', ['articles' => $articles]);
    }

}
