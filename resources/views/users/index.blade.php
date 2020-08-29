@extends('layouts.admin')

@section('title', '記事一覧')

@section('content')
    <div class="text-right mb-1">
        <a href="/users/create" class="btn btn-dark">{{ __('CREATE') }}</a>
    </div>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">NAME</th>
          <th scope="col">EMAIL</th>
          <th scope="col">ROLE</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr>
          <th scope="row">{{$user->id}}</th>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->getRoleNames()}}</td>
          <td>
            <a class="btn btn-light" href="/users/{{$user->id}}">{{ __('SHOW') }}</a>
            <a class="btn btn-light" href="/users/{{$user->id}}/edit">{{ __('EDIT') }}</a>
            <form class="d-inline" action="/users/{{$user->id}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <input class="btn btn-light" type="submit" name="" value="{{ __('DELETE') }}">
            </form>
    	  </td>
        </tr>
        @endforeach
    	</tbody>
    </table>
{{ $users->links() }}
@endsection
