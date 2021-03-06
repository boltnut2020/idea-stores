@extends('layouts.admin')

@section('title', '新規作成')

@section('content')
  <form action="{{ route('admin.memos.patch',['memo' => $memo->id]) }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="title">メモ</label>
      <textarea rows="4" class="form-control" type="text" name="memo" placeholder="メモを入力してください">{{ $memo->memo }}</textarea>
    </div>
    <div class="form-group">
      <input class="form-control" type="text" name="tag" placeholder="タグを入力してください" value="{{ implode(",", $memo->tags()->pluck('name')->toArray()) }}">
    </div>

    <div class="text-right">
      <input type="hidden" name="_method" value="patch">
      <input class="btn btn-primary" type="submit" value="保存">
    </div>

  </form>
@endsection
