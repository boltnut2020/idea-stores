@extends('layouts.admin')

@section('title', '記事一覧')

@section('content')
    <div class="text-right mb-1">
        <a href="/memos/create" class="btn btn-dark fixed-button">{{ __('+') }}</a>
    </div>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <!--<th scope="col">#</th>-->
          <th scope="col">MEMO</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($memos as $memo)
        <tr>
          <!--<th scope="row">{{$memo->id}}</th>-->
          <td class="text-break">{!! $memo->displayHtml() !!}
            <div class="pt-1 small text-right">
                    {{ $memo->created_at }}
            </div>
            <div class="pt-1">
              @foreach ($memo->tags as $tag)
                <a class="small" href="{{ route('memos.tag', [$tag->id]) }}" >
                    {{ $tag->name }}
                </a>
              @endforeach
            </div>
          </td>
          <td>
            <a class="btn btn-light" href="/memos/create/{{$memo->id}}">{{ __('CREATE CHILD') }}</a>
            <a class="btn btn-light" href="/memos/{{$memo->id}}/edit">{{ __('SHOW/EDIT') }}</a>
            <form class="d-inline" action="/memos/{{$memo->id}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <input class="btn btn-light" type="submit" name="" value="{{ __('DELETE') }}">
            </form>
    	  </td>
        </tr>
        @if (request()->path() == "memos/thread/list")
        @foreach ($memo->childrenRecursive as $children)
        <tr>
          <!--<th scope="row">{{$memo->id}}</th>-->
          <td class="text-break pl-5">{!! $children->displayHtml() !!}
            <div class="pt-1 small text-right">
                    {{ $children->created_at }}
            </div>
            <div class="pt-1">
              @foreach ($children->tags as $tag)
                <a class="small" href="{{ route('memos.tag', [$tag->id]) }}" >
                    {{ $tag->name }}
                </a>
              @endforeach
            </div>
          </td>
          <td>
            <a class="btn btn-light" href="/memos/{{$children->id}}/edit">{{ __('SHOW/EDIT') }}</a>
            <form class="d-inline" action="/memos/{{$children->id}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <input class="btn btn-light" type="submit" name="" value="{{ __('DELETE') }}">
            </form>
    	  </td>
        </tr>
        @endforeach
        @endif
        @endforeach

    	</tbody>
    </table>
    {{ $memos->links() }}
@endsection
