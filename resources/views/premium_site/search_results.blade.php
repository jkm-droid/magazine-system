@extends('base.index')

@section('content')
    <section>
        <div class="container" style="margin-top: 40px; min-height: 200px;">
            @if($results->isEmpty())
                <p class="text-center put-red">No results found</p>
            @else
                <h3 class="put-black">Found <strong class="put-gold">Results</strong></h3>

                @foreach($results as $result)
                    <div style="background-color: goldenrod;  border-radius: 10px;">
                        <a href="{{ route('portal.full.article.show', $result->slug) }}" style="padding: 10px;">
                            <h5 class="put-black font-weight-bold">
                                {{ ++$i}}. {{ $result->title }}
                            </h5>
                            <p style="margin-left: 20px;" class="ml-4 text-white">{!! \Illuminate\Support\Str::limit(strip_tags($result->body), $limit = 100, $end = '...') !!}</p>
                        </a>
                    </div>
                    <br>
                @endforeach<br>

                {!! $results->links() !!}
            @endif
        </div>
    </section>
@endsection
