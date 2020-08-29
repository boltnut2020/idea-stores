@extends('layouts.admin')

@section('title', '新規作成')

@section('content')
  <form action="/memos" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="title">メモ</label>
      <textarea class="form-control" type="text" name="memo" placeholder="メモを入力してください"></textarea>
      <input class="form-control" type="text" name="tag" placeholder="タグを入力してください">
      <small id="titleHelp" class="form-text text-muted">カテゴリのタイトルを入力します</small>
    </div>
    <div>
      <input class="btn btn-primary" type="submit" value="送信">
    </div>
  </form>
@endsection
