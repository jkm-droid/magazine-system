@extends('base.index')

@section('content')
    <!--    welcome area--->
    <section id="hero" class="d-flex align-items-center"  >
        <div class="container position-relative">
            <div class="row justify-content-center">

                <div class="col-xl-7 col-md-7 col-lg-9 text-center">
                    <h1 class="text-dark">Industrialising <span  class="put-gold">Africa</span> Magazine</h1>
                    <h3 class="text-danger quote-danger" style="font-style: italic;">

                        "A dynamic information aggregation and dissemination ecosystem catalysing Industrialisation in Africa"

                    </h3>
                    <h2 class="text-dark" id="text"></h2>
                    <div id="cursor"></div>

                </div>
            </div>
            <div class="text-center mt-2">
                <button class="btn btn-lg put-gold" style="background-color: black; box-shadow: 0 0 30px goldenrod;">
                    <a class="nav-link ml-4 put-gold text-uppercase" href="{{ route('show.register') }}">Read Publication Now</a>
                </button>
            </div>

            <div class="row icon-boxes">
                @if($leading_articles)
                    @foreach($leading_articles as $leading)
                        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                            <div class="card icon-box">
                                <a href=" {{ route('site.article.full.show', $leading->slug) }}">

                                    <div class="card-img">
                                        <img src="article_covers/{{ $leading->image }}" class="img-fluid" height="100%" alt="" style="opacity: 0.4;">
                                    </div>
                                    <div class="card-img-overlay" style="padding-top: 20px; padding-bottom: 20px;">
                                        <h5 class="title put-black">{{ $leading->title }}</h5>
                                        <p class="description"> {!! \Illuminate\Support\Str::limit(strip_tags($leading->body), $limit = 150, $end = '...') !!}</p>
                                    </div>

                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <a href="{{ route('show.register') }}">
                            <div class="icon-box">
                                <div class="icon text-center"><i class="bx bxs-factory"></i><i class="bx bxs-car-mechanic bx-lg"></i></div>
                                <h5 class="title text-white">Manufacturing & Assembly</h5>
                                <p class="description">Manufacturing activities boost the overall value generated in a given
                                    economy by catalysing more activity along value chains. </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <a href="{{ route('show.register') }}">
                            <div class="icon-box">
                                <div class="icon"><i class="bx bxs-ev-station"></i><i class="bx bxs-chip"></i></div>
                                <h5 class="title text-white">Energy & Technology</h5>

                                <p class="description">Energy is a critical component in the industrialisation process
                                    a key driver for Africa's industrialisation agenda.</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <a href="{{ route('show.register') }}">
                            <div class="icon-box">
                                <div class="icon"><i class="bx bxs-truck"></i><i class="bx bxs-plane-alt"></i></div>
                                <h5 class="title text-white">Logistics & Transport</h5>
                                <p class="description">The modernisation of African logistics is one of the most important
                                    areas of development on the continent today. </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <a href="{{ route('show.register') }}">
                            <div class="icon-box">
                                <div class="icon"><i class="bx bxs-coin-stack"></i><i class="bx bxs-business"></i></div>
                                <h5 class="title text-white">Corporate Finance & SME's</h5>
                                <p class="description">The Bank’s ambition is to help double the industrial GDP by 2025,
                                    and increase its industrial GDP to US $1.72 trillion.  </p>
                            </div>
                        </a>
                    </div>

                @endif
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
        <h5 class="mb-4 fw-light">Industrialising Africa Magazine</h5>
    </div>
    <!----end multi item carousel---->

    <!----magazine images section------>
    <section id="portfolio" class="portfolio">
        <div class="container">

            <div class="text-center">
                <h2 class="mt-0 mb-4" style="color: goldenrod; font-weight: bold;">Magazine <span class="text-dark">Gallery</span></h2>

            </div>
            <div class="row portfolio-container">

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('/site_images/magazine_cover.jpg') }}" loading="lazy" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Magazine Cover</h4>
                            <div class="portfolio-links">
                                <a href="{{ asset('/site_images/magazine_cover.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="">
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

    <!----About Section----->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2><span class="put-gold">About</span> <strong class="text-dark">Us</strong></h2>
            </div>

            <p><strong class="text-dark">Industrialising Africa</strong> magazine, a publication of
                <strong class="text-danger">FirstCode</strong> <strong class="text-warning">Corporation</strong>
                is a part of a compendium of interventions by the organisation to address
                the information gap in the Pan-African industrial sector as a way of catalysing
                synergies and facilitating a robust conversation about industrialisation processes and trade.
                This is intended to contribute in a small way be it may, to the efforts of raising industrial GDP
                in Africa to 130% by 2025 as envisaged or US$ 1.72 trillion and drive Africa’s overall GDP from US$ 2.2
                trillion to US$ 4.6 trillion through synergistic industrialisation and trade within the continent.</p>

            <p> The publication highlights the role of various industrial stakeholders in industrialising Africa and
                also showcases best practices and gold standard case studies on the continent. This information sharing
                platform provided by the Industrialising Africa magazine is designed to catalyse and maintain the
                industrialisation conversation on the African continent in this modern era.</p>

            <p> The magazine copies are distributed through a variety of channels with a targeted deep reach amongst
                the sectoral decision-makers on the continent and beyond. The publication is distributed through:
            <ul>
                <li>Associations of Manufacturers</li>
                <li>Embassies and</li>
                <li>High Commissions</li>
            </ul>
            to all the 53 Ministries and departments of trade and industry on:
            <ul>
                <li>the African continent</li>
                <li>the African Union</li>
                <li>Financial Institutions</li>
                <li>Supranational Agencies</li>
                <li>Development partners</li>
                <li>key industrial corporate stakeholders as well as</li>
                <li>the main players in the Small and Micro Enterprise (SME) sector and general public.</li>
            </ul>
        </div>
    </section>
    <!--- end about section---->

    <!----Frequently Asked Questions Section---->
    <section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">

            <div class="text-center mb-4">
                <h2 class="text-dark">Frequently Asked Questions - <span class="put-gold">FAQ</span></h2>
            </div>

            <div class="faq-list">
                <ul>
                    <li data-aos="fade-up">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">
                            1. What is Industrialising Africa about?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i>
                        </a>
                        <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                            <p>
                                Industrialising Africa is the media and information dissemination arm of FirstCode Corporation.
                                This includes a magazine that comes in hard copy and as a digital version, website and social media channels.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="100">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">
                            2. What is FirstCode Corporation about?
                            <i class="bx bx-chevron-down icon-show"></i>
                            <i class="bx bx-chevron-up icon-close"></i>
                        </a>
                        <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                FirstCode Corporation is the umbrella body for Industrialising Africa,
                                Africa Industrialisation Awards and FirstCode Systems App.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="200">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">
                            3. Where are your offices?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                FirstCode has two offices in New York, USA, Shanghai, China and Nairobi, Kenya. Details are provided on our
                                <a href="#contact_us">contacts page.</a>
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="300">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">
                            4. Who are your strategic partners?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                We work closely with the relevant stakeholders in the private sector as well associations
                                and facilitative government agencies in respective countries, including Embassies and
                                High Commissions. We are also working on bolstering partnerships with agencies like UNIDO, UNCTAD,
                                UN-ECA, UNDP and AfCFTA in addition to the regional blocs like COMESA, ECOWAS, Maghreb, EAC and SADC.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="400">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-6" class="collapsed">
                            5. What are your major activities?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-6" class="collapse" data-bs-parent=".faq-list">
                            <ul>
                                <li>Publish a quarterly magazine, “Industrialising Africa”</li>
                                <li>Promote stakeholder brands through our various channels</li>
                                <li>Conduct those activities that catalyse and stir the conversation on industrialising Africa</li>
                                <li> Manage the Analytics system for the Africa Industrialisation Awards</li>
                                <li>Manage the FirstCode Systems App</li>
                                <li>Provide Consultancy on matters trade and industrialisation</li>
                            </ul>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="500">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-7" class="collapsed">
                            6. Your agenda for Africa is too ambitious, how do you intend achieve it?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-7" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                It has taken time to formalise FirstCode after careful analysis and assessment to
                                identify the specific issues and gaps that the organisation will address itself to.
                                Our goal is very clear, to ensure that there is a dynamic information aggregation and information platform for investors,
                                manufacturers, processors and suppliers for the continent of Africa. We are doing this by
                                leveraging on the technology tools and reach at our disposal.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="600">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-8" class="collapsed">
                            7. What sets your initiative apart?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-8" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Focus is what sets our initiative apart. We are employing our energies
                                to a specific cause; to maintain a robust conversation and transactional space for
                                the industrialisation story in Africa.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="700">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-9" class="collapsed">
                            8. In how many languages do you disseminate your information?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-9" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                At the present, we are disseminating our information mainly in English.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="800">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-10" class="collapsed">
                            9. How many hard copies of the magazine do you print?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-10" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                We are currently printing 30,000 copies and distributing them through various
                                channels including Embassies and High Commissions based in Africa.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="900">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-11" class="collapsed">
                            10. How big or wide is your circulation?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-11" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                We are leveraging on digital technology to reach 350 million people in Africa
                                and Asia with extracts and digital copies of the magazine.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="1000">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-12" class="collapsed">
                            11. what is the frequency of your publication?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-12" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Industrialising Africa is a quarterly magazine (4 editions a year).
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="1100">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-14" class="collapsed">
                            12. Do you partner with training institutions in the industrial sector?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-14" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Yes, we recognise training institutions as stakeholders in the industrialisation
                                story since they provide training for the manpower that serves in various capacities in the industrial sector.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="1200">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-15" class="collapsed">
                            13. Where do you intend to see this initiative five years from now?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-15" class="collapse" data-bs-parent=".faq-list">

                            <ul>
                                <li>A robust FirstCode Information Management and Dissemination Centre for Africa.</li>
                                <li>Triple the circulation of the hard copies of the magazine.</li>
                                <li>Stronger online presence and use of the FirstCode Systems App..</li>
                                <li> Regional offices in North, West, Central and Southern Africa.</li>
                            </ul>

                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </section>
    <!---- end frequently asked questions section ---->

    <!----editorial section---->
    <section>
        <div class="container">
            <h2>Editorial Board and Contacts</h2>
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
    <!----end editorial section---->

@endsection
