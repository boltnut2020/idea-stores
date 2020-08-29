@extends('layouts.admin')

@section('title', '記事詳細')

@section('content')
  <h1>{{$category->title}}</h1>
  <p>{{$category->slug}}</p>
  <br><br>
  <a href="/categories">一覧に戻る</a>
@endsection
