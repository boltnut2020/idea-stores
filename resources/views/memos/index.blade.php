@extends('layouts.admin')

@section('title', '記事一覧')

@section('content')
    <div class="text-right mb-1">
        <a href="/memos/create" class="btn btn-dark">{{ __('CREATE') }}</a>
    </div>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">MEMO</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($memos as $memo)
        <tr>
          <th scope="row">{{$memo->id}}</th>
          <td>{{$memo->memo}}</td>
          <td>
            <a class="btn btn-light" href="/memos/{{$memo->id}}/edit">{{ __('SHOW/EDIT') }}</a>
            <form class="d-inline" action="/memos/{{$memo->id}}" method="post">
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
