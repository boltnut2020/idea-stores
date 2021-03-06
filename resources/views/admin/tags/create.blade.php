@extends('layouts.admin')

@section('title', '新規作成')

@section('content')
  <form action="{{ route('admin.tags.store')}}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="title">タグ</label>
      <input class="form-control" type="text" name="name" placeholder="タグを入力してください" />
    </div>
    <div class="text-right">
      <input class="btn btn-primary" type="submit" value="送信">
    </div>
  </form>
@endsection
