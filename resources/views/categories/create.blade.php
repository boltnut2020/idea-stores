@extends('layouts.admin')

@section('title', '新規作成')

@section('content')
  <form action="/categories" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="title">タイトル</label>
      <input class="form-control" type="text" name="title" placeholder="カテゴリのタイトルを入力してください">
      <small id="titleHelp" class="form-text text-muted">カテゴリのタイトルを入力します</small>
    </div>
    <div class="form-group">
      <label for="title">slug</label>
      <input class="form-control" type="text" name="slug" placeholder="カテゴリのSlugを入力してください">
      <small id="titleHelp" class="form-text text-muted">[a-z 0-9 -_]が利用できます</small>
    </div>
    <div class="form-group">
      <label for="title">Parent Category</label>
      <select class="form-control" name="parent_id">
        <option value="">Select Parent Category </option>
        @foreach ($categories as $key => $value)
        <option value="{{ $key }}" {{ ( $key == $selectedId) ? 'selected' : '' }}> 
          {{ $value }} 
         </option>
        @endforeach    
      </select>
    </div>
    <div>
      <input class="btn btn-primary" type="submit" value="送信">
    </div>
  </form>
@endsection
