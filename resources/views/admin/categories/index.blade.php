@extends('layouts.admin')

@section('title', '記事一覧')

@section('content')
    <div class="text-right mb-1">
        <a href="{{ route('admin.categories.create')}}" class="btn btn-dark">{{ __('CREATE') }}</a>
    </div>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">NAME</th>
          <th scope="col">SLUG</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
        <tr>
          <th scope="row">{{$category->id}}</th>
          <td>{{$category->name}}</td>
          <td>{{$category->slug}}</td>
          <td>
            <a class="btn btn-light" href="{{ route('admin.categories.show', ['category' => $category->id]) }}">{{ __('SHOW') }}</a>
            <a class="btn btn-light" href="{{ route('admin.categories.edit', ['category' => $category->id]) }}">{{ __('EDIT') }}</a>
            <form class="d-inline" action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="post">
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
