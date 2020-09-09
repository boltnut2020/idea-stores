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
            <h5 class="card-title"><a class="btn btn-light" href="{{ route('frontend.articles.show', ['article' => $article->id]) }}">{{$article->title}}</a></h5>
            <p class="card-text text-left">{{ $article->description }}</p>
            <p class="card-text text-right">{{$article->created_at }}</p>
            <div class="text-right">
                <a class="btn btn-light" href="{{ route('frontend.articles.show', ['article' => $article->id]) }}">{{ __('SHOW') }}</a>
            </div>
      </div>
  </div>
  @endforeach
    {{ $articles->links() }}
@endsection
