@extends('layouts.admin')

@section('title', 'タグ一覧')

@section('content')
    <div class="text-right mb-1">
        <a href="/tags/create" class="btn btn-dark">{{ __('CREATE') }}</a>
    </div>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">NAME</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($tags as $tag)
        <tr>
          <th scope="row">{{$tag->id}}</th>
          <td>{{$tag->name}}</td>
          <td>
            <a class="btn btn-light" href="/tags/{{$tag->id}}/edit">{{ __('SHOW/EDIT') }}</a>
            <form class="d-inline" action="/tags/{{$tag->id}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <input class="btn btn-light" type="submit" name="" value="{{ __('DELETE') }}">
            </form>
    	  </td>
        </tr>
        @endforeach
    	</tbody>
    </table>
  </div>
@endsection
