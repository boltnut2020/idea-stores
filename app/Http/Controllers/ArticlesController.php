<?php

namespace App\Http\Controllers;

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
        $articles = Article::orderBy('id', 'desc')->paginate(5);
        // return $articles;
        return view('articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::with('childrenRecursive')->whereNull('parent_id')->get();
        return view('articles.create', ['categories' => $categories]);
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
        $article = new Article;
        // $requestにformからのデータが格納されているので、以下のようにそれぞれ代入する
        $article->title = $request->title;
        $article->description = $request->description;
        $article->content = $request->content;
        $article->display = $request->dispaly;
        // 保存
        $article->save();
        if ($request->has('categories')) {
            $article->categories()->sync($request->categories);
        }
        // 保存後 一覧ページへリダイレクト
        return redirect('/articles');
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
        $article = Article::find($id);
        // viewにデータを渡す
        return view('articles.show', ['article' => $article]);
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
        $article = Article::find($id);
        $categories = Category::with('childrenRecursive')->whereNull('parent_id')->get();
        $articleCategory = $article->categories()->where('article_id', $id)->pluck('category_id')->toArray();
        return view('articles.edit', ['article' => $article, 'categories' => $categories, 'articleCategory' => $articleCategory]);
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
        // idを元にレコードを検索して$articleに代入
        $article = Article::find($id);
        // editで編集されたデータを$articleにそれぞれ代入する
        $article->title = $request->title;
        $article->description = $request->description;
        $article->content = $request->content;
        $article->display = $request->display;
        // 保存
        $article->save();
        
        if ($request->has('categories')) {
            $article->categories()->sync($request->categories);
        }
        // 詳細ページへリダイレクト
        return redirect("/articles/".$id);
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
       $article = Article::find($id);
       // 削除
       $article->delete();
       // 一覧にリダイレクト
       return redirect('/articles');        
    }
}
