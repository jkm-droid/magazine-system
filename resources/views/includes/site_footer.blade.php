@if(\Illuminate\Support\Facades\Auth::check())
    <!-- ======= Footer ======= -->
    <footer id="footer" class="align-items-baseline">
        <div class="container d-md-flex py-4">

            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    &copy; Copyright <strong style="color: white;"><span>Industrialising Africa</span></strong>. All Rights Reserved
                </div>
            </div>
            <div class="social-links text-center text-md-right pt-3 pt-md-0">
                <a href="https://twitter.com/AfroIndustry" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="https://www.facebook.com/industrialisingafrica" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="https://www.instagram.com/industrialafrica/" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="https://www.linkedin.com/in/industrialising-africa-17b536211/" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                <a href="https://www.youtube.com/c/IndustrialisingAfrica"><i class="bx bxl-youtube"></i></a>
            </div>
        </div>
    </footer><!-- End Footer -->

@else
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <a href="/" class="logo"><img src="{{ asset('site_images/ialogo.png') }}" alt="" class="img-fluid"></a>
                        <p>
                            <strong>Phone:</strong> +254-722-666-747<br>
                            Nairobi, Kenya <br>
                            <strong>Phone:</strong> +1(360)-669-4407<br>
                            New York, USA<br>
                            <strong>Phone:</strong> +86-1367-1830-746<br>
                            Shanghai,China<br>

                            <strong>Emails:</strong><br> info@firstcodecorporation.com<br>
                            info@industrialisingafrica.com
                        </p>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="https://firstcodecorporation.com/" target="_blank">Firstcode</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="https://www.afdb.org/en/topics-and-sectors/topics/industrialization">The African Development Bank’s</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="https://www.un.org/en/observances/africa-industrialization-day">Africa Industrialization Day</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="https://au.int/en/agenda2063/overview">African Union</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="https://au.int/en/cfta">African Union/CFTA</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="https://www.comesa.int/">COMESA</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="https://www.sadc.int/">SADC</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="https://au.int/en/recs/ecowas">ECOWAS</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="https://www.eac.int/">EAC</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="https://unctad.org/">UNCTAD</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="https://www.unido.org/">UNIDO</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Publication Sections</h4>
                        <ul>
                            @if($all_categories->isEmpty())
                                <li><i class="bx bx-chevron-right"></i>
                                    <a  href="#">Corporate Finance</a></li>
                                <li><i class="bx bx-chevron-right"></i>
                                    <a  href="#">Manufacturing</a></li>
                                <li><i class="bx bx-chevron-right"></i>
                                    <a  href="#">Transport & Logistics</a></li>
                                <li><i class="bx bx-chevron-right"></i>
                                    <a  href="#">Green Energy</a></li>
                                <li><i class="bx bx-chevron-right"></i>
                                    <a  href="#">Assembly</a></li>

                            @else
                                @foreach($all_categories as $category)
                                    <li>
                                        <i class="bx bx-chevron-right"></i>
                                        <a  href="{{ route('site.category.all.articles.show', $category->slug) }}">
                                            {{ \Illuminate\Support\Str::upper($category->title) }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4 class="put-red" style="color: white;">Join Our Newsletter</h4>
                        <p class="put-gold">Enter your email address to get the latest updates from our team.</p>
                        <p id="message-box"></p>
                        <form id="subscribe-form">
                            @csrf
                            <input type="email" class="form-control" name="email" id="email">
                            <input class="text-uppercase" style="background-color: goldenrod; color: black;" type="submit" value="join newsletter" id="subscribe-btn">
                        </form>
                    </div>

                </div>
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
                            console.log(response);
                            let content = "";

                            if(response.status === 200){
                                content = '<small class="text-center put-green">' + "You have successfully joined our news letter" + '</small>';
                            }else if(response.status === 202){
                                content = '<small class="text-center put-red">' + response.message['email'] + '</small>';
                            }else{
                                content = '<small class="text-center put-red">' + "Oops! An error occurred." + '</small>';
                            }

                            $("#message-box").html(content);

                        },

                        failure: function (response) {
                            console.log("something went wrong");
                        }
                    });
                }else{
                    let content = '<small class="text-center put-red">' + "Error!Email cannot be empty" + '</small>';
                    $("#message-box").html(content);
                }
            });
            // });

        </script>
        <div class="container d-md-flex py-4">

            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    &copy; Copyright <strong style="color: white;"><span>Industrialising Africa</span></strong>. All Rights Reserved
                </div>
            </div>
            <div class="social-links text-center text-md-right pt-3 pt-md-0">
                <a href="https://twitter.com/AfroIndustry" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="https://www.facebook.com/industrialisingafrica" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="https://www.instagram.com/industrialafrica/" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="https://www.linkedin.com/in/industrialising-africa-17b536211/" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                <a href="https://www.youtube.com/c/IndustrialisingAfrica"><i class="bx bxl-youtube"></i></a>
            </div>
        </div>
    </footer><!-- End Footer -->
@endif
