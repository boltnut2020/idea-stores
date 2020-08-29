@extends('layouts.admin')

@section('title', '新規作成')

@section('content')
  <form action="/memos/{{ $memo->id }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="title">メモ</label>
      <textarea class="form-control" type="text" name="memo" placeholder="メモを入力してください">{{ $memo->memo }}</textarea>
      <input class="form-control" type="text" name="tag" placeholder="タグを入力してください" value="{{ implode(",", $memo->tags()->pluck('name')->toArray()) }}">
      <small id="titleHelp" class="form-text text-muted">カテゴリのタイトルを入力します</small>
    </div>
    <div>
      <input type="hidden" name="_method" value="patch">
      <input type="submit" value="保存">
    </div>

  </form>
@endsection
