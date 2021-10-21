<!-- ======= Footer ======= -->
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
                        <li><i class="bx bx-chevron-right"></i> <a href="#hero">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="https://firstcodecorporation.com/" target="_blank">Firstcode</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="/industrialising-africa">Articles</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Categories</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#about">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#contact">Contacts</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Categories</h4>
                    <ul>
                        @foreach($all_categories as $category)
                            <li>
                                <i class="bx bx-chevron-right"></i>
                                <a  href="{{ route('site.category.all.articles.show', $category->slug) }}">
                                    {{ \Illuminate\Support\Str::upper($category->title) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4 class="put-red" style="color: white;">Join Our Newsletter</h4>
                    <p class="put-gold">Enter your email address to get the latest updates from our team.</p>
                    <form action="" method="post">
                        <input type="email" class="form-control" name="email">
                        <input class="text-uppercase" style="background-color: goldenrod; color: black;" type="submit" value="Subscribe">
                    </form>
                </div>

            </div>
        </div>
    </div>

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
