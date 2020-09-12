@extends('layouts.frontend')

@section('title', $article->title . ' | ')
@section('description', $article->description . ' | ')

@section('ogp')
<meta name="twitter:card" content="{{ $article->title }}" />
<meta name="twitter:site" content="@boltnut2020" />
<meta name="twitter:creator" content="@boltnut2020" />
<meta property="og:url" content="https://idea-stores.herokuapp.com" />
<meta property="og:title" content="{{ $article->title }}" />
<meta property="og:description" content="{{ $article->description }}" />
<meta property="og:image" content="" />
@endsection

@section('content')
<div class="card">
  <div class="card-body">
      <h1 class="card-title mt-3 mb-5">{{$article->title}}</h1>
      <p class="card-text">{{$article->content}}</p>
      <p class="card-text text-right">{{$article->created_at}}</p>
  </div>
</div>
<div class="text-right mt-2">
    <a class="btn btn-dark" href="{{ route('frontend.articles.index') }}">一覧に戻る</a>
</div>
@endsection
