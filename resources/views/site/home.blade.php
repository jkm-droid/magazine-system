@extends('base.index')

@section('content')
    <!--    welcome area--->
    <section id="hero" class="d-flex align-items-center"  >
        <div class="container position-relative">
            <div class="row justify-content-center">

                <div class="col-xl-7 col-md-7 col-lg-9 text-center">
                    <h2>Welcome to:</h2>
                    <h1 class="text-dark">Industrialising <span  class="put-gold">Africa</span> Publication</h1>
                    <h3 class="text-danger quote-danger" style="font-style: italic;">

                        "A dynamic information aggregation and dissemination ecosystem catalysing Industrialisation in Africa"

                    </h3>
                    <h2 class="text-dark" id="text"></h2>

                    <div id="cursor" ></div><br>

                    <div class="text-center introduction">
                        <button class="btn btn-lg put-gold" style="background-color: black; box-shadow: 0 0 30px goldenrod;">
                            <a class="nav-link ml-4 put-gold text-uppercase" href="{{ route('show.register') }}">Read Current Edition</a>
                        </button>
                        <br><br>
                        <button class="btn btn-lg put-gold" style="background-color: black; box-shadow: 0 0 30px goldenrod;">
                            <a class="nav-link ml-4 put-gold text-uppercase" href="https://order.industrialisingafrica.com/user/order.php">get hardcopy Edition</a>
                        </button>
                    </div>
                </div>

                <div class="col-xl-5 col-md-5 col-lg-3 introduction-image">
                    <img src="{{ asset('/site_images/magazine_cover.jpeg') }}" loading="lazy" class="img-fluid" alt="">
                </div>

            </div>

            <div class="icon-boxes">
                <h4 class="text-center"><strong class="put-gold">Lead</strong> Stories</h4>

                @if($leading_articles)
                    <div class="row row-cols-1 row-cols-md-4 g-4 mt-3">
                        @foreach($leading_articles as $leading)
                            <div class="col">
                                <div class="card h-100 icon-box" style="border:none;">
                                    <a href="{{ route('site.article.full.show', $leading->slug) }}">
                                        <div class="">
                                            <img src="/article_covers/{{ $leading->image }}" class="card-img-top" alt="..." height="150">
                                        </div>
                                        <div class="card-body background-black">
                                            <h5 class="card-title">
                                                <a class="text-warning" href="{{ route('site.article.full.show', $leading->slug) }}">{{ $leading->title }}</a>
                                            </h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="text-center introduction">
                <button class="btn btn-lg" style="background-color: goldenrod; box-shadow: 0 0 30px goldenrod;">
                    <a class="nav-link ml-4 put-black text-uppercase" href="{{ route('site.french.show') }}">Français</a>
                </button>
            </div>
        </div>
    </section>
    <!---end welcome area--->
    <script type="text/javascript">

        // List of sentences
        const _CONTENT = [
            "Welcome to Industrialising Africa Magazine.",
            "Explore...",
            "Technology,",
            "Assembly,",
            "Logistics,",
            "Manufacturing,",
            "Transport,",
            "Green Energy,",
            "Corporate Finance",
            "and",
            "Small & Medium Enterprises."
        ];

        // Current sentence being processed
        let _PART = 0;

        // Character number of the current sentence being processed
        let _PART_INDEX = 0;

        // Holds the handle returned from setInterval
        var _INTERVAL_VAL;

        // Element that holds the text
        var _ELEMENT = document.querySelector("#text");

        // Implements typing effect
        function Type() {
            var text =  _CONTENT[_PART].substring(0, _PART_INDEX + 1);
            _ELEMENT.innerHTML = text;
            _PART_INDEX++;

            // If full sentence has been displayed then start to delete the sentence after some time
            if(text === _CONTENT[_PART]) {
                clearInterval(_INTERVAL_VAL);
                setTimeout(function() {
                    _INTERVAL_VAL = setInterval(Delete, 50);
                }, 1000);
            }
        }

        // Implements deleting effect
        function Delete() {
            var text =  _CONTENT[_PART].substring(0, _PART_INDEX - 1);
            _ELEMENT.innerHTML = text;
            _PART_INDEX--;

            // If sentence has been deleted then start to display the next sentence
            if(text === '') {
                clearInterval(_INTERVAL_VAL);

                // If last sentence then display the first one, else move to the next
                if(_PART == (_CONTENT.length - 1))
                    _PART = 0;
                else
                    _PART++;
                _PART_INDEX = 0;

                // Start to display the next sentence after some time
                setTimeout(function() {
                    _INTERVAL_VAL = setInterval(Type, 100);
                }, 200);
            }
        }

        // Start the typing effect on load
        _INTERVAL_VAL = setInterval(Type, 100);

    </script>
    <br>

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

    <script>
        let items = document.querySelectorAll('.carousel .carousel-item')

        items.forEach((el) => {
            const minPerSlide = 4
            let next = el.nextElementSibling
            for (var i=1; i<minPerSlide; i++) {
                if (!next) {
                    // wrap carousel by using first child
                    next = items[0]
                }
                let cloneChild = next.cloneNode(true)
                el.appendChild(cloneChild.children[0])
                next = next.nextElementSibling
            }
        })

    </script>
    <!----end multi item carousel---->

    <!----About Section----->
    <section id="about" class="about">
        <div class="container">
            <div class="section-titl text-center">
                <h2><span class="put-gold">About</span> <strong class="text-dark">Us</strong></h2>
            </div>

            <p><strong class="text-dark">Industrialising Africa</strong> Publication, a publication of
                <strong class="text-danger">FirstCode</strong> <strong class="text-warning">Corporation</strong>
                is a part of a compendium of interventions by the organisation to address
                the information gap in the Pan-African industrial sector as a way of catalysing
                synergies and facilitating a robust conversation about industrialisation processes and trade.
                This is intended to contribute in a small way be it may, to the efforts of raising industrial GDP
                in Africa to 130% by 2025 as envisaged or US$ 1.72 trillion and drive Africa’s overall GDP from US$ 2.2
                trillion to US$ 4.6 trillion through synergistic industrialisation and trade within the continent.</p>

            <p> The publication highlights the role of various industrial stakeholders in industrialising Africa and
                also showcases best practices and gold standard case studies on the continent. This information sharing
                platform provided by the Industrialising Africa Publication is designed to catalyse and maintain the
                industrialisation conversation on the African continent in this emergent Industrial Era of the 4th Industrial Revolution.</p>
        </div>
    </section>
    <!--- end about section---->

    <!----Frequently Asked Questions Section---->
    <section id="faq" class="faq section-bg text-center">


            <a href="{{ route('site.about.show') }}">

                <h2 class="text-dark text-center">Frequently Asked Questions - FAQ</h2>
                <button class="btn btn-lg put-gold background-black text-uppercase">Read More</button>
            </a>

    </section>
    <!---- end frequently asked questions section ---->

    <!----editorial article section---->
    @include('includes.editorial')
    <!----end editorial article section---->

    <!----editorial board section---->
    <section>
        <div class="container">
            <h2 class="text-center">Editorial Board and Contacts</h2>
            <p>Industrialising Africa is a publication
                of FirstCode Corporation Inc.
                Revving up Africa’s industrialisation agenda
                and contributing to the realization
                of the <strong class="put-black">AU’s Agenda 2063, ‘The Africa We Want.’</strong></p>

            <div class="row put-black">
                <div class="col-md-4">
                    <h4>Advisory Board</h4>
                    <ul>
                        <li>Dr. Mukhisa Kituyi</li>
                        <li>Prof. Henry Bwisa</li>
                        <li>Prof. David Ogoli</li>
                        <li>Mr. Robert J. Schneck</li>
                        <li>Ambassador Boaz Mbaya</li>
                        <li>Jaytee Kivihya</li>
                        <li>Anna E. Hee</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Editorial Board</h4>
                    <ul class="put-black">
                        <li>Eng. Jorge N. Forester - Editor In-Chief</li>
                        <li>Sande Olocho  	-	Editor</li>
                        <li>E.K. Wamaitha 	-	Finance Manager</li>
                        <li>Ruth Kimani  	-	Administrative Secretary</li>
                        <li>Fahreen Tharani -	Business Liaison Manager</li>
                        <li>Martin Khamala  -	ICT Systems Manager</li>
                        <li>Peter Gachuru 	-	Computer Systems Specialist</li>
                        <li>Natasha Mugo 	 -	Communications Specialist</li>
                        <li>David Obiero  	-	Editorial Designer</li>
                        <li>Philip Kaunda  	-	Graphics Designer</li>
                        <li>Billy Mutai	- Editorial Photography</li>
                    </ul>
                </div>

                <div class="col-md-4 put-black">
                    <h4>Contacts</h4>
                    No. 1688, East Gaoke Rd.<br>
                    Pudong New Area Shanghai<br>
                    Tel: +86 13671830746<br>
                    www.firstcodecorporation.com<br>
                    info@firstcodecorporation.com<br>
                    Tel: +1 360 669 4407 New York<br>
                    +33 651 99 88 20 France<br><br>

                    TATU CITY<br>
                    Tatu Industrial Park<br>
                    Tel: +254 20 8000202<br>
                    Tel: +254 722 444176<br>
                    www.industrialisingafrica.com<br>
                    info@industrialisingafrica.com
                </div>

            </div>
        </div>
    </section>
    <!----end editorial board section---->

@endsection
