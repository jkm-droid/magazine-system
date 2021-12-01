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
    <section id="editorial-section">
        <div class="container">

            <h2 class="text-center">Industrialisation Renaissance in Africa, <strong class="put-gold">the hour has come.</strong></h2>
            <p>
            <div  class="mt-2">
                Africa produces what it does not consume and consumes what it doesn’t produce.  Factually interesting. This paradox explains the massive
                levels of poverty and lack of jobs in almost all African countries.</div>
            <div  class="mt-2">
                Industrialisation is the process by which an economy moves from primarily agrarian production to mass produced and technologically
                advanced goods and services. This phase is characterized by exponential leaps in productivity in high volumes of better quality,
                in less time and at much lower cost. In simple terms, this is a period of transformation from an agricultural economy to an urban,
                mass producing economy. Individual manual labor is often replaced by mechanized mass production and craftsmen are replaced by assembly lines.
                It’s never a smooth process but a sure bet to escape poverty and creation of wealth, jobs and more.</div>
            <div  class="mt-2">
                Africa commands a meagre 1.5% share of the global total manufacturing output. This compares badly with Asia & Pacific at 21%,
                East Asia at 17%, Europe at 24% and N. America at 22%.</div>
            <div  class="mt-2">
                Documented statistics shows that approximately 60% of the world’s arable uncultivated land is in Africa. This means that if Africans holds
                their sleeves up, tighten their belts to work the land, mechanize the land, irrigate the land, Africa easily would dictate world food prices.
                In spite of these facts, Africa spends over USD 30 billion annually importing food products that it essentially should be exporting.
                Africa is supposed to be a net food exporter. If nothing is done to remedy this tread, the annual food import bill is expected to expand to
                USD 100billion by 2025.</div>
            <div  class="mt-2">
                In addition, about 30% of global mineral reserves are found in Africa. The continent proven oil reserves constitute 8% of the world stock
                whilst those of natural gas amounts to 7% of global stock. Interesting because in spite of these statistics, Africa is a net importer of
                everything, except Oxygen and raw commodities.</div>
            <div  class="mt-2">
                By 2030, young Africans are expected to make up 42% of the world’s youth and accounts for 75% of those under age 35yrs in Africa. Currently,
                about 226 million youth aged 15 to 24 live in Africa representing nearly 20% of Africa’s population, making up one fifth of the world youth population.
                What a classical, energetic workforce Africa has got!</div>
            <div  class="mt-2">
                To sum it up, Africa has all the ingredients for an industrial takeoff.  Africa needs to link agriculture, industry and service sectors.
                It must focus its energies and resources on one area it has a big potential comparative advantage, Agro-industrialization. Africa needs
                to process everything it produces and moves massive young labor into more productive sectors of the economy, which is manufacturing.
            </div>
            <div  class="mt-2">
                Only then can industrialization percolates and permanently change the economic landscape of this beautiful motherland.  Only then can
                African economies historically driven by unpredictable commodity prices start to stabilize. Only then can Africans exploit the opportunities
                presented by the more recently established African Continent Free Trade Area (AfCFTA). Only then can Africans manage their balance of trade
                and transforms the continent into a place of hope for the Youths and home for the foreign direct investments.</div>
            <div  class="mt-2">
                That time is now, the hour has come for our common dream of an industrialised Africa and walk the Agenda 2063 journey.</div>
            <div  class="mt-2">
                FirstCode Corporation is catalyzing this elusive Africa industrialization dream from multiple positions, from media to technology.
                It always seems impossible, until its done, said Nelson Mandela. The hour has come.</div>

            <div class="text-end">
                Eng. Jorge Forester,<br>
                Editor-In-Chief.
            </div>
            </p>
            <div class="text-center mt-2">
                <button class="btn put-gold" style="background-color: black; box-shadow: 0 0 30px goldenrod;">
                    <a class="nav-link ml-4 put-gold text-uppercase" href="{{ route('show.register') }}">Read Current Edition</a>
                </button>
            </div>
        </div>
    </section>
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
