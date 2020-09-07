{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.admin')

{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', 'ユーザー詳細')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')

<div class="card">
  <div class="card-body">
      <h1 class="card-title">{{$user->name}}</h1>
      <p class="card-text">Email: {{$user->email}}</p>
      <p class="card-text">Role: {{ $user->getRoleNames() }}</p>
  </div>
</div>
<a href="/articles">一覧に戻る</a>
@endsection
