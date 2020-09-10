@extends('layouts.admin')
@section('title', 'Profile')
@section('content')

<div class="card">
  <div class="card-body">
      <h1 class="card-title">{{$profile->name}}</h1>
      <h1 class="card-title">{{$profile->description}}</h1>
  </div>
</div>
<a href="{{ route('admin.home') }}">HOMEに戻る</a>
@endsection
