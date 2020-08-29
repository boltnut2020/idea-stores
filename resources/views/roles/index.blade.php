@extends('layouts.admin')

@section('title', '記事一覧')

@section('content')
    <div class="text-right mb-1">
        <a href="/roles/create" class="btn btn-dark">{{ __('CREATE') }}</a>
    </div>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">NAME</th>
          <th scope="col">GUARD_NAME</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($roles as $role)
        <tr>
          <th scope="row">{{$role->id}}</th>
          <td>{{$role->name}}</td>
          <td>{{$role->guard_name}}</td>
          <td>
            <a class="btn btn-light" href="/roles/{{$role->id}}/edit">{{ __('EDIT') }}</a>
            <form class="d-inline" action="/roles/{{$role->id}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <input class="btn btn-light" type="submit" name="" value="{{ __('DELETE') }}">
            </form>
    	  </td>
        </tr>
        @endforeach
    	</tbody>
    </table>
{{ $roles->links() }}
@endsection
