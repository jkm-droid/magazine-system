@extends('base.index')

@section('content')
    <section>
        <div class="container"  style="margin-top: 40px;">
            @if($magazines->isEmpty())
                <p class="text-center">No magazine found</p>
            @else
                <div class="row">
                    @foreach($magazines as $magazine)
                        <div class="col-md-3">
                            <img src="/magazine_covers/{{ $magazine->image }}" alt="" class="img-fluid" >
                            <h3 class="mt-1">{{ $magazine->issue }}</h3>
                        </div>

                        <div class="col-md-9">
                            <h3 class="put-black">In this <strong class="put-gold">Issue</strong></h3>
                            @foreach($magazine->magazine_articles as $mag_article)
                            <div class="card mb-3 border-0">
                                <div class="row g-0">
                                    <div class="col-md-2">
                                        <img src="/magazine_covers/{{ $mag_article->image }}" class="img-fluid" alt="..." >
                                    </div>
                                    <div class="col-md-10">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $mag_article->title }}</h5>
                                            <span class="card-text">{!! $mag_article->description !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    @endforeach
                </div>
            @endif
        </div>
    </section>

@endsection
