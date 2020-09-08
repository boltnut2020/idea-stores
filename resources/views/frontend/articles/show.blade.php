@extends('layouts.frontend')

@section('title', '記事詳細')

@section('content')

<div class="card">
  <div class="card-body">
      <h1 class="card-title">{{$article->title}}</h1>
      <p class="card-text">{{$article->description}}</p>
      <p class="card-text">{{$article->content}}</p>
      <p class="card-text text-right">{{$article->created_at}}</p>
  </div>
</div>
<div class="text-right mt-2">
    <a class="btn btn-dark" href="{{ route('frontend.articles.index') }}">一覧に戻る</a>
</div>
@endsection
