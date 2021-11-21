@if($author_articles->isEmpty())
@else
    <div class="justify-content-start mt-2 mb-3">
        <h4 class="mb-2"><strong class="put-black">More Articles</strong> from the <strong class="text-bold put-gold">Author</strong></h4>

        <div class="row row-cols-1 row-cols-md-4 g-4 mt-3">
            @foreach($author_articles as $author_article)
                <div class="col">
                    <div class="card h-100" style="border:none;">
                        <a href="{{ route('site.article.full.show', $author_article->slug) }}">
                            <div class="img-hover-zoom--slowmo">
                                <img src="/article_covers/{{ $author_article->image }}" class="card-img-top" alt="..." height="150">
                            </div>
                            <div class="card-body bg-dark">
                                @foreach($author_article->categories as $more_cat)
                                    <div class="text-white row">
                                        <h6>
                                            {{ \Illuminate\Support\Str::upper($more_cat->title) }}|
                                            <small style="font-size: 14px;">{{ \Illuminate\Support\Str::upper(date('d-m-Y', strtotime($author_article->created_at))) }}</small>
                                        </h6>

                                    </div>

                                @endforeach
                                <h5 class="card-title">
                                    <a class="text-warning" href="{{ route('site.article.full.show', $author_article->slug) }}">{{ $author_article->title }}</a>
                                </h5>
                                {{--                                                                                <p class="card-text">{!! \Illuminate\Support\Str::limit($author_article->body, 80, $end='...') !!}</p>--}}
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div><br>

    </div>
@endif



@if(!$leading_articles->isEmpty())
    <div class="row mx-auto mt-4 justify-content-center">
        <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner multi-item-carousel" role="listbox">
                <div class="carousel-item active">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <a href="">
                                    <img src="{{ asset('site_images/factory.jpg') }}" class="img-fluid" alt="" style="opacity: 0.4;">
                                </a>
                            </div>
                            <div class="card-img-overlay"><h2>Assembly</h2></div>
                        </div>
                    </div>
                </div>
                @foreach($leading_articles as $leading)
                    <div class="carousel-item">
                        <div class="col-md-3" >
                            <a href=" {{ route('site.article.full.show', $leading->slug) }}">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="article_covers/{{ $leading->image }}" class="img-fluid" alt="" style="opacity: 0.4;">
                                    </div>
                                    <div class="card-img-overlay">
                                        <h2>{{ $leading->title }}</h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
            <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon text-danger" aria-hidden="true"></span>
            </a>
        </div>
    </div>


    <script type="text/javascript">
        const inputEmail = document.getElementById('email');
        const btn = document.getElementById('subscribe-btn');

        inputEmail.addEventListener('input', function (){
            btn.disabled = (this.value === '');
        });

        // $(document).ready(function () {
        $('#subscribe-btn').click(function(e){
            e.preventDefault();

            var email = $('#email').val();
            if(email !== "") {

                $.ajax({
                    url: '/industrialising-africa/subscribe',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'email': email,
                    },
                    success: function (response) {
                        console.log(response.status);

                        if (response.status === 200) {
                            const msg = "You have successfully joined our news letter";
                            let content = '<small class="text-center" style="color: green;" ' + msg + '</small>';
                            $("#message-box").html(content);
                        }else{
                            const msg = "An error occurred";
                            let content = '<small class="text-center" style="color: red;" ' + msg + '</small>';
                            $("#message-box").html(content);
                        }

                    },

                    failure: function (response) {
                        console.log("something went wrong");
                    }
                });
            }else{
                let content = '<small class="text-center" style="color: red;" ' + "Error!Email cannot be empty" + '</small>';
                $("#message-box").html(content);
            }
        });
        // });

    </script>
