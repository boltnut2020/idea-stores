{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.admin')

{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', '記事詳細')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')

<div class="card">
  <div class="card-body">
      <h1 class="card-title">{{$article->title}}</h1>
      <p class="card-text">{{$article->description}}</p>
      <p class="card-text">{{$article->content}}</p>
  </div>
</div>
<a href="/articles">一覧に戻る</a>
@endsection
