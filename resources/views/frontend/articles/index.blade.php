@extends('layouts.frontend')

@section('title', '記事一覧')

@section('content')
  @foreach ($articles as $article)
    <div class="card mb-2">
        <div class="card-header text-right">
        @foreach($article->categories as $c)
            <a class="btn btn-secondary" href="{{ route('frontend.articles.category', ['category' => $c->id]) }}" >#{{ $c->name }}</a>
        @endforeach
        </div>
        <div class="card-body">
            <h3 class="card-title"><a class="btn btn-light" href="{{ route('frontend.articles.show', ['article' => $article->id]) }}">{{$article->title}}</a></h3>
            <p class="card-text text-left">{{ $article->description }}</p>
            <div class="text-right mb-2">
                <a class="btn btn-light" href="{{ route('frontend.articles.show', ['article' => $article->id]) }}">{{ __('SHOW') }}</a>
            </div>
            <p class="card-text text-right text-secondary">{{$article->created_at }}</p>
      </div>
  </div>
  @endforeach
    {{ $articles->links() }}
@endsection
