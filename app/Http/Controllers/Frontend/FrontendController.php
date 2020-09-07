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
        $articles = Article::orderBy('id', 'desc')->paginate(10);;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        //
        return view('memos.create', ['id' => $id]);
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
        $memo->parent_id = $request->parent_id;
        // 保存
        $memo->save();
        if ( $request->has('tag') ) {
            $tagIds = Tag::bulkFirstOrCreate($request->tag);
            $memo->tags()->sync($tagIds);
            $user = User::find(Auth::id());
            $user->tags()->attach($tagIds);
        }
        $memo->users()->sync(Auth::id());
        if ($request->filled('parent_id')) {
            $memo->updateParentDate($request->parent_id);
            return redirect('/memos/thread/list');
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
    public function show($id)
    {
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
        $memo = Memo::find($id);
        if (!$memo->users->contains(Auth::id())) {
            return false;
        }
        
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
        if (!$memo->users->contains(Auth::id())) {
            return false;
        }
        $memo->memo = $request->memo;
        // $memo->parent_id = $request->parent_id;
        $memo->updated_at = now();
        $memo->save();

        if ( $request->has('tag') ) {
            $tagIds = Tag::bulkFirstOrCreate($request->tag);
            $memo->tags()->sync($tagIds);
            $user = User::find(Auth::id());
            $user->tags()->attach($tagIds);
            
        }

        $userIds = [];
        $userIds[] = Auth::id();        
        $memo->users()->sync($userIds);

        if ($memo->parent_id) {
            $memo->updateParentDate($memo->parent_id);
            return redirect("/memos/thread/list");
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
       $memo = Memo::find($id);
        if (!$memo->users->contains(Auth::id())) {
            return false;
        }
       // 削除
       $memo->delete();
       // 一覧にリダイレクト
       return redirect('/memos');        
    }
}
