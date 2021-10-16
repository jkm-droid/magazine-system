@extends('base.index')

@section('content')
    <!--    welcome area--->
    <section id="hero" class="d-flex align-items-center"  >
        <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                {{--                <div class="col-xl-7 col-lg-9 ">--}}
                {{--                    <h2 class="text-dark">Welcome to</h2>--}}
                {{--                </div>--}}

                <div class="col-xl-7 col-lg-9 text-center">
                    <h1 class="text-dark">Industrialising <span style="color: red;">Africa</span> Magazine</h1>
                    <h3 class="text-danger quote-danger" style="font-style: italic;">
                        <strong>
                            "Ensuring a dynamic information aggregation and information platform for
                            investors, manufacturers, processors and suppliers for the continent of Africa"
                        </strong>
                    </h3>
                    <h2 class="text-dark" id="text"></h2>
                    <div id="cursor"></div>

                </div>
            </div>
            <div class="text-center mt-2">
                <h3><button class="btn btn-lg btn-warning put-red">Get Insights on:</button></h3>
            </div>

            <div class="row icon-boxes">
                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="200">
                    <div class="icon-box bg-warning">
                        <div class="icon text-center"><i class="bx bxs-factory"></i><i class="bx bxs-car-mechanic bx-lg"></i></div>
                        <h4 class="title"><a href="">Manufacturing & Assembly</a></h4>
                        <p class="description">Manufacturing activities are known to boost the overall value generated in a given
                            economy by catalysing more activity along value chains, from the raw materials to the finished products. </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon-box bg-warning">
                        <div class="icon"><i class="bx bxs-ev-station"></i><i class="bx bxs-chip"></i></div>
                        <h4 class="title"><a href="">Energy & Technology</a></h4>
                        <p class="description">Energy is a critical component in the industrialisation process.
                            As Africa boosts its energy potential as a key driver for the industrialisation agenda.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="400">
                    <div class="icon-box bg-warning">
                        <div class="icon"><i class="bx bxs-truck"></i><i class="bx bxs-plane-alt"></i></div>
                        <h4 class="title"><a href="">Logistics and Transport</a></h4>
                        <p class="description">The modernisation of African logistics is one of the most important areas of development on the continent today. </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="500">
                    <div class="icon-box bg-warning">
                        <div class="icon"><i class="bx bxs-coin-stack"></i><i class="bx bxs-business"></i></div>
                        <h4 class="title"><a href="">Corporate Finance & SME's</a></h4>
                        <p class="description">The Bank’s ambition is to help double the industrial GDP by 2025,
                            and by so doing help increase its industrial GDP to US $1.72 trillion.  </p>
                    </div>
                </div>

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
            " Assembly,",
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
    <!----magazine images section------>
    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">

            <div class="text-center">
                <h1 class="mt-0 mb-4" style="color: red;">Magazine</h1>

            </div>
            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="300">

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('/site_images/magazine_cover.jpg') }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Magazine Cover</h4>
                            <div class="portfolio-links">
                                <a href="{{ asset('/site_images/magazine_cover.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1">
                                    <i class="bx bx-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('/site_images/magazine_cover_3.jpg') }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Magazine</h4>
                            <div class="portfolio-links">
                                <a href="{{ asset('/site_images/magazine_cover_3.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
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
                                <a href="{{ asset('/site_images/social_media_flyer.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 2">
                                    <i class="bx bx-plus"></i></a>
                                <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('/site_images/green.jpg') }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Green Energy</h4>
                            <div class="portfolio-links">
                                <a href="{{ asset('/site_images/green.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 2">
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
                                <a href="{{ asset('/site_images/factory.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
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
                                <a href="{{ asset('/site_images/logistics0.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                                <!-- <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-----end magazine images section------>

    <!----multi item carousel--->
    <div class="container text-center mt-4" data-aos="fade-up">
        <h2 class="font-weight-light">
            <strong class="put-red">Explore</strong> <span style="color: grey;">Major Categories</span>
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
                                            <img src="{{ asset('site_images/factory.jpg') }}" class="img-fluid" alt="" >
                                        </a>
                                    </div>
                                    <div class="card-img-overlay"><h2>Assembly</h2></div>
                                </div>
                            </div>
                        </div>
                        @foreach($categories as $category)
                            <div class="carousel-item">
                                <div class="col-md-3">
                                    <a href=" {{ route('site.category.all.articles.show', $category->slug) }}">
                                        <div class="card">
                                            <div class="card-img">
                                                <img src="category_covers/{{ $category->image }}" class="img-fluid" alt="" >
                                            </div>
                                            <div class="card-img-overlay"><h2>{{ $category->title }}</h2></div>
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
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
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
                                        <div class="card-img-overlay">Slide 2</div>
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
                                    <div class="card-img-overlay">Slide 3</div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="{{ asset('site_images/logistics.jpeg') }}" class="img-fluid" alt="" >
                                    </div>
                                    <div class="card-img-overlay">Slide 4</div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="{{ asset('site_images/Port.jpg') }}" class="img-fluid" alt="" >
                                    </div>
                                    <div class="card-img-overlay">Slide 5</div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="{{ asset('site_images/corporate-finance.jpg') }}" class="img-fluid" alt="" >
                                    </div>
                                    <div class="card-img-overlay">Slide 6</div>
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
        <h5 class="mt-2 fw-light">Industrialising Africa Magazine</h5>
    </div>
    <!----end multi item carousel---->

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
                <h2><span style="color: #939328">About</span> <strong class="text-danger">Us</strong></h2>
            </div>

            <p><strong class="text-dark">Industrialising Africa</strong> magazine, a publication of
                <strong class="text-danger">FirstCode</strong> <strong class="text-warning">Corporation</strong>
                is a part of a compendium of interventions by the organisation to address
                the information gap in the Pan-African industrial sector as a way of catalysing
                synergies and facilitating a robust conversation about industrialisation processes and trade.
                This is intended to contribute in a small way be it may, to the efforts of raising industrial GDP
                in Africa to 130% by 2025 as envisaged or US$ 1.72 trillion and drive Africa’s overall GDP from US$ 2.2
                trillion to US$ 4.6 trillion through synergistic industrialisation and trade within the continent.</p>
            <br><br>

            <p> The publication highlights the role of various industrial stakeholders in industrialising Africa and
                also showcases best practices and gold standard case studies on the continent. This information sharing
                platform provided by the Industrialising Africa magazine is designed to catalyse and maintain the
                industrialisation conversation on the African continent in this modern era.</p>
            <br><br>
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
                <h2 class="text-danger">Frequently Asked Questions - FAQ</h2>
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
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">
                            3. How old is Industrialising Africa?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                The idea and concept goes back 5 years but was registered
                                as FirstCode Corporation Ltd. In Kenya at the beginning of 2021.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="300">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">
                            4. Where are your offices?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                FirstCode has two offices, in Shanghai, China and Nairobi, Kenya. Details are provided on our
                                <a href="#contact_us">contacts page.</a>
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="400">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">
                            5. Who are your strategic partners?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                We work closely with the relevant stakeholders in the private sector as well associations
                                and facilitative government agencies in respective countries, including Embassies and
                                High Commissions. We are also working on bolstering partnerships with agencies like UNIDO, UNCTAD,
                                UN-ECA, UNDP and AfCFTA in addition to the regional blocs or COMESA, ECOWAS, Maghreb, EAC and SADC.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="500">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-6" class="collapsed">
                            6. What are your major activities?
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

                    <li data-aos="fade-up" data-aos-delay="600">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-7" class="collapsed">
                            7. Your agenda for Africa is too ambitious, how do you intend achieve it?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-7" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                It has taken time to formalise FirstCode after careful analysis and assessment to
                                identify the specific issues and gaps that the organisiation will address itself to.
                                Our goal is very clear, to ensure that there is a dynamic information aggregation and information platform for investors,
                                manufacturers, processors and suppliers for the continent of Africa. We are doing this by
                                leveraging on the technology tools and reach at our disposal.
                            </p>
                        </div>
                    </li>
                    <li data-aos="fade-up" data-aos-delay="700">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-8" class="collapsed">
                            8. What sets your initiative apart?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-8" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Focus is what sets our initiative apart. We are employing our energies
                                to a specific cause; to maintain a robust conversation and transactional space for
                                the industrialisation story in Africa.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="800">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-9" class="collapsed">
                            9. In how many languages do you disseminate your information?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-9" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                At the present, we are disseminating our information mainly in English.
                                We are making arrangements in due course to also have a department to manage our
                                French speakers on the continent as well.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="900">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-10" class="collapsed">
                            10. How many hard copies of the magazine do you print?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-10" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                We are currently printing 30,000 copies and distributing them through various
                                channels including Embassies and High Commissions based in East Africa.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="1000">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-11" class="collapsed">
                            11. How big or wide is your circulation?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-11" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                We are leveraging on digital technology to reach 350 million people in Africa
                                and Asia with extracts and digital copies of the magazine.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="1100">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-12" class="collapsed">
                            12. Is the publication a monthly or quarterly?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-12" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Industrialising Africa is a quarterly magazine (4 editions a year).
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="1200">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-13" class="collapsed">
                            13. What are your major revenue sources?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-13" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                FirstCode is a private business enterprise registered as a company in Kenya and
                                incorporated in Shanghai, China. The main sources of revenue being individual business
                                investment, strategic partners/sponsors, advertisers and subscriptions.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="1300">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-14" class="collapsed">
                            14. Do you partner with training institutions in the industrial sector?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-14" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Yes, we recognise training institutions as stakeholders in the industrialisation
                                story since they provide training for the manpower that serves in various capacities in the industrial sector.
                                15. Where do you intend to see this initiative five years from now?
                                A robust FirstCode Information Management and Dissemination Centre for Africa.
                                Triple the circulation of the hard copies of the magazine.
                                Stronger online presence and use of the FirstCode Systems App..
                                Regional offices in North, West, Central and Southern Africa.

                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="1400">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-15" class="collapsed">
                            15. Where do you intend to see this initiative five years from now?
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

@endsection
