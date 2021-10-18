@extends('base.index')

@section('content')
    <section>
        <div class="container col-md-7" style="margin-top: 40px;">
            @if($results->isEmpty())
                <p>No results found</p>
            @else
                <h3>Found <strong class="text-secondary">Results</strong></h3>

                @foreach($results as $result)
                    <div style="background-color: gold;">
                        <a href="{{ route('site.article.full.show', $result->slug) }}" style="font-size: larger; padding: 10px;">
                            <h4 class="text-danger font-weight-bold">
                                {{ ++$i}}. {{ $result->title }}
                            </h4>
                            <p style="margin-left: 20px;" class="ml-4">{!! \Illuminate\Support\Str::limit($result->body, 200, $end='...') !!}</p>
                        </a>
                    </div>
                    <br>
                @endforeach<br>



                {!! $results->links() !!}
            @endif
        </div>
    </section>
@endsection
