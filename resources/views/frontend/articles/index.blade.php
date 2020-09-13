@extends('layouts.frontend')

@section('title', '記事一覧' . '|')

@section('content')
  @foreach ($articles as $article)
    <div class="card mb-3">
        <div class="card-body">
            <h2 class="card-title"><a class="text-light" href="{{ route('frontend.articles.show', ['article' => $article->id]) }}">{{$article->title}}</a></h2>
            <p class="card-text text-left mb-3">{{ $article->description }}</p>

            <div class="row">
                <div class="col-6">
                    <p class="">
                        @foreach($article->categories as $c)
                            <a class="btn btn-dark" href="{{ route('frontend.articles.category', ['category' => $c->id]) }}" >#{{ $c->name }}</a>
                        @endforeach
                    </p>
                </div>
                <div class="col-6">
                    <p class="card-text text-right text-secondary">{{$article->created_at }}</p>
                </div>
            </div>
      </div>
  </div>
  @endforeach
    {{ $articles->links() }}
@endsection
