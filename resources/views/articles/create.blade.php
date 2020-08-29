@extends('layouts.admin')

@section('title', '新規作成')

@section('content')

<form action="/articles" method="post">
<div class="row">
  <div class="col-9">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="title">タイトル</label>
      <input class="form-control" type="text" name="title" placeholder="タイトルを入力してください">
      <small id="titleHelp" class="form-text text-muted">記事のタイトルを入力します</small>
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <input class="form-control" type="text" name="description" placeholder="概要を入力してください">
      <small id="descriptionHelp" class="form-text text-muted">記事の概要を入力します</small>
    </div>
    <div class="form-group">
      <label for="content">Content</label>
      <textarea class="form-control" name="content" placeholder="本文を入力してください"></textarea>
      <small id="contentHelp" class="form-text text-muted">記事の本文を入力します</small>
    </div>
    <div class="form-group">
      <label for="content">Dispaly</label>
      <input type="checkbox" name="dispaly" value="1" />
      <small id="contentHelp" class="form-text text-muted">表示</small>
    </div>

    <div>
      <input class="btn btn-primary" type="submit" value="送信">
    </div>
  </div>
  <div class="col-3">
	
    <ul class="list-group">
    @foreach ($categories as $category)
        <li class="list-group-item">
            {{ $category->name }}
            <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                    {{ in_array("web",[],true) ? 'checked="checked"' : ''}}>
        </li>
    	@foreach ($category->childrenRecursive as $children)
            <li class="list-group-item">>>
                {{ $children->name }}
                <input type="checkbox" name="categories[]" value="{{ $children->id }}" 
                    {{ in_array("web",[],true) ? 'checked="checked"' : ''}}>
            </li>
        @endforeach
    @endforeach
    </ul>
  </div>
</div>
</form>
@endsection
