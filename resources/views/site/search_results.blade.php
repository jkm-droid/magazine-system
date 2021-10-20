@extends('base.index')

@section('content')
    <section>
        <div class="container" style="margin-top: 40px;">
            @if($results->isEmpty())
                <p>No results found</p>
            @else
                <h3>Found <strong class="text-secondary">Results</strong></h3>

                @foreach($results as $result)
                    <div style="background-color: gold;  border-radius: 10px;">
                        <a href="{{ route('site.article.full.show', $result->slug) }}" style="padding: 10px;">
                            <h5 class="text-danger font-weight-bold">
                                {{ ++$i}}. {{ $result->title }}
                            </h5>
                            <p style="margin-left: 20px;" class="ml-4">{!! \Illuminate\Support\Str::limit(strip_tags($result->body), $limit = 100, $end = '...') !!}</p>
                        </a>
                    </div>
                    <br>
                @endforeach<br>

                {!! $results->links() !!}
            @endif
        </div>
    </section>
@endsection
