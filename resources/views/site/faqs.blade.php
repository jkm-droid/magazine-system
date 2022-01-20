@extends('base.index')

@section('content')
    <!----Frequently Asked Questions Section---->
    <section id="faq" class="faq section-bg">
        <div class="container mt-4" >

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
                                FirstCode has three offices in New York, USA, Shanghai, China and Nairobi, Kenya. Details are provided on our
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

@endsection
