@extends('layouts.admin')

@section('title', 'タグ一覧')

@section('content')
    <div class="text-right mb-1">
        <a href="{{ route('admin.tags.create')}}" class="btn btn-dark">{{ __('CREATE') }}</a>
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
          <td>
            <a class="small" href="{{ route('admin.memos.tag', [$tag->id]) }}" >{{$tag->name}}</a>
          </td>
          <td>
            <a class="btn btn-light" href="{{ route('admin.tags.edit', ['tag' => $tag->id]) }}">{{ __('SHOW/EDIT') }}</a>
            <form class="d-inline" action="{{ route('admin.tags.destroy', ['tag' => $tag->id]) }}" method="post">
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
