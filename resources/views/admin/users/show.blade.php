@extends('layouts.admin')
@section('title', 'ユーザー詳細')
@section('content')

<div class="card">
  <div class="card-body">
      <h1 class="card-title">{{$user->name}}</h1>
      <p class="card-text">Email: {{$user->email}}</p>
      <p class="card-text">Role: {{ $user->getRoleNames() }}</p>
  </div>
</div>
<a href="{{ route('admin.users.index') }}">一覧に戻る</a>
@endsection
