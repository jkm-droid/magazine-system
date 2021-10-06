@extends('base.index')

@section('content')
    @if($results->isEmpty())
        <p>No results found</p>
    @else
        <h3>Found <strong class="text-secondary">Results</strong></h3>
        @foreach($results as $result)
            <h4 class="text-warning font-weight-bold">
                <a href="{{ route('article.full.show', $result->slug) }}">{{ ++$i}}. {{ $result->title }}</a>
            </h4>
            <p style="margin-left: 20px;" class="ml-4">{!! \Illuminate\Support\Str::limit($result->body, 200, $end='...') !!}</p>
        @endforeach

        {!! $results->links() !!}
    @endif
@endsection
