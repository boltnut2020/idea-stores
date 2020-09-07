@extends('layouts.admin')

@section('title', '記事一覧')

@section('content')
    <div class="text-right mb-1">
        <a href="{{ route('admin.articles.create') }}" class="btn btn-dark">{{ __('CREATE') }}</a>
    </div>
  @foreach ($articles as $article)
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">{{$article->title}}</h5>
            <p>{{$article->article_id}}</p>
            <div class="text-right">
                <a class="btn btn-light" href="{{ route('admin.articles.show', ['article' => $article->id]) }}">{{ __('SHOW') }}</a>
                <a class="btn btn-light" href="{{ route('admin.articles.edit', ['article' => $article->id]) }}">{{ __('EDIT') }}</a>
                <form class="d-inline" action="{{ route('admin.articles.destroy', ['article' => $article->id]) }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <input class="btn btn-light" type="submit" name="" value="{{ __('DELETE') }}">
                </form>
            </div>
      </div>
  </div>
  @endforeach
    {{ $articles->links() }}
@endsection
