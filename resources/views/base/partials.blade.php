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

    <!----multi item carousel--->
    <div class="container text-center mt-4">
        <h2 class="font-weight-light">
            <strong class="put-gold">Publication</strong> <span style="color: black;">Section Stories</span>
        </h2>
        @if(!$categories->isEmpty())
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
                        @foreach($categories as $category)
                            <div class="carousel-item">
                                <div class="col-md-3" >
                                    <a href=" {{ route('site.category.all.articles.show', $category->slug) }}">
                                        <div class="card">
                                            <div class="card-img">
                                                <img src="category_covers/{{ $category->image }}" class="img-fluid" alt="" style="opacity: 0.4;">
                                            </div>
                                            <div class="card-img-overlay">
                                                <h2>{{ $category->title }}</h2>
                                                @foreach($category->articles as $cat_article)
                                                    @if($loop->first)
                                                        <h4>{{ $cat_article->title }}</h4>
                                                    @endif
                                                @endforeach
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
        @else
            <div class="row mx-auto mt-4 justify-content-center">
                <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner multi-item-carousel" role="listbox">
                        <div class="carousel-item active">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-img">
                                        <a href="">
                                            <img src="{{ asset('site_images/factory.jpg') }}" class="img-fluid" alt="" >
                                        </a>
                                    </div>
                                    <div class="card-img-overlay"><h2>Manufacturing</h2></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <a href="#contacts">
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{ asset('site_images/download.jpeg') }}" class="img-fluid" alt="" >
                                        </div>
                                        <div class="card-img-overlay"><h2>Assembly</h2></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="{{ asset('site_images/green.jpg') }}" class="img-fluid" alt="" >
                                    </div>
                                    <div class="card-img-overlay"><h2>Green Energy</h2></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="{{ asset('site_images/logistics.jpeg') }}" class="img-fluid" alt="" >
                                    </div>
                                    <div class="card-img-overlay"><h2>Logistics</h2></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="{{ asset('site_images/transport.jpg') }}" class="img-fluid" alt="" >
                                    </div>
                                    <div class="card-img-overlay"><h2>Transport</h2></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="{{ asset('site_images/corporate-finance.jpg') }}" class="img-fluid" alt="" >
                                    </div>
                                    <div class="card-img-overlay"><h2>Corporate Finance</h2></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        @endif
        <h5 class="mb-4 fw-light">Industrialising Africa Publication</h5>
    </div>
    <!----end multi item carousel---->

    <!----magazine images section------>
    <section id="portfolio" class="portfolio">
        <div class="container">

            <div class="text-center">
                <h2 class="mt-0 mb-4" style="color: goldenrod; font-weight: bold;">Publication <span class="text-dark">Gallery</span></h2>

            </div>
            <div class="row portfolio-container">

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('/site_images/magazine_cover.jpeg') }}" loading="lazy" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Magazine Cover</h4>
                            <div class="portfolio-links">
                                <a href="{{ asset('/site_images/magazine_cover.jpeg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="">
                                    <i class="bx bx-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('/site_images/magazine_cover_3.jpg') }}" loading="lazy" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Magazine</h4>
                            <div class="portfolio-links">
                                <a href="{{ asset('/site_images/magazine_cover_3.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="">
                                    <i class="bx bx-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('/site_images/social_media_flyer.jpg') }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Magazine</h4>
                            <div class="portfolio-links">
                                <a href="{{ asset('/site_images/social_media_flyer.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="">
                                    <i class="bx bx-plus"></i></a>
                                <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('/site_images/logistics-transport.jpg') }}" loading="lazy" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Logistics & Transport</h4>
                            <div class="portfolio-links">
                                <a href="{{ asset('/site_images/logistics-transport.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="">
                                    <i class="bx bx-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('/site_images/assembly.jpg') }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Assembly Line</h4>
                            <div class="portfolio-links">
                                <a href="{{ asset('/site_images/assembly.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="">
                                    <i class="bx bx-plus"></i></a>
                                <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('/site_images/factory.jpg') }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Manufacturing</h4>
                            <div class="portfolio-links">
                                <a href="{{ asset('/site_images/factory.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title=""><i class="bx bx-plus"></i></a>
                                <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('/site_images/logistics0.jpg') }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Logistics</h4>
                            <div class="portfolio-links">
                                <a href="{{ asset('/site_images/logistics0.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title=""><i class="bx bx-plus"></i></a>
                                <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('/site_images/benefits-of-green.jpg') }}" loading="lazy" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Green Energy Benefits</h4>
                            <div class="portfolio-links">
                                <a href="{{ asset('/site_images/benefits-of-green.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="">
                                    <i class="bx bx-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('/site_images/magazine_back_front_image.jpeg') }}" loading="lazy" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Green Energy Benefits</h4>
                            <div class="portfolio-links">
                                <a href="{{ asset('/site_images/magazine_back_front_image.jpeg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="">
                                    <i class="bx bx-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('/site_images/magazine_image.jpeg') }}" loading="lazy" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Green Energy Benefits</h4>
                            <div class="portfolio-links">
                                <a href="{{ asset('/site_images/magazine_image.jpeg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="">
                                    <i class="bx bx-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-----end magazine images section------>
