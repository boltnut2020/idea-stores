<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Memo;
use App\Tag;
use App\User;
use App\Traits\AutoLink; 
use Illuminate\Support\Facades\Auth;


class MemosController extends Controller
{
    use AutoLink;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $memos = Memo::orderBy('id', 'desc')->paginate(10);;
        $memos = Memo::whereHas('users', function($query) {
			$query->where('users.id', Auth::id());
		})->orderBy('id', 'desc')->paginate(10);
        // return $videos;
        return view('memos.index', ['memos' => $memos]);
    }

    public function thread()
    {
        //$memos = Memo::with('childrenRecursive')->whereNull('parent_id');
        //return view('memos.index', ['memos' => $memos]);
        // $memos = Memo::orderBy('id', 'desc')->paginate(10);;
        $memos = Memo::whereHas('users', function($query) {
			$query->where('users.id', Auth::id());
		})->with('childrenRecursive')->whereNull('parent_id')->orderBy('updated_at', 'desc')->paginate(10);
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
        if ($request->has('parent_id')) {
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
        // $memo = Memo::find($id);
        // viewにデータを渡す
        // return view('memos.show', ['memo' => $memo]);
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
