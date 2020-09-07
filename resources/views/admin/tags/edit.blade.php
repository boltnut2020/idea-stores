@extends('layouts.admin')

@section('title', '新規作成')

@section('content')
  <form action="{{ route('admin.tags.update', ['tag' =>$tag->id]) }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="title">メモ</label>
      <textarea class="form-control" type="text" name="name" placeholder="タグを入力してください">{{ $tag->name }}</textarea>
      <small id="titleHelp" class="form-text text-muted">カテゴリのタイトルを入力します</small>
    </div>
    <div class="text-right">
      <input type="hidden" name="_method" value="patch">
      <input class="btn btn-primary" type="submit" value="保存">
    </div>

  </form>
@endsection
