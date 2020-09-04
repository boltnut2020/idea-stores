@extends('layouts.admin')

@section('title', '新規作成')

@section('content')
  <form action="/memos" method="post">
    {{ csrf_field() }}
    <input class="form-control" type="hidden" name="parent_id" value="{{ $id }}">
    <div class="form-group">
      <label for="title">メモ</label>
      <textarea rows="4" class="form-control" type="text" name="memo" placeholder="メモを入力してください"></textarea>
    </div>
    <div class="form-group">
      <input class="form-control" type="text" name="tag" placeholder="タグを入力してください">
    </div>
    <div class="text-right">
      <input class="btn btn-primary" type="submit" value="送信">
    </div>
  </form>
@endsection
