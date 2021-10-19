<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <a href="/" class="logo"><img src="{{ asset('site_images/firstcodeLogo.png') }}" alt="" class="img-fluid"></a>
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
                        <li><i class="bx bx-chevron-right text-danger"></i> <a href="#hero">Home</a></li>
                        <li><i class="bx bx-chevron-right text-danger"></i> <a href="/industrialising-africa">Articles</a></li>
                        <li><i class="bx bx-chevron-right text-danger"></i> <a href="#">Categories</a></li>
                        <li><i class="bx bx-chevron-right text-danger"></i> <a href="#about">About us</a></li>
                        <li><i class="bx bx-chevron-right text-danger"></i> <a href="#contact">Contacts</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Categories</h4>
                    <ul>
                        @foreach($all_categories as $category)
                            <li>
                                <i class="bx bx-chevron-right text-danger"></i>
                                <a  href="{{ route('site.category.all.articles.show', $category->slug) }}">
                                    {{ \Illuminate\Support\Str::upper($category->title) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4 class="put-red" style="color: red;">Join Our Newsletter</h4>
                    <p>Get the latest updates from our team</p>
                    <form action="" method="post">
                        <input type="email" class="form-control" name="email">
                        <input style="background-color: red;" type="submit" value="Subscribe">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong style="color: red;"><span>Industrialising Africa</span></strong>. All Rights Reserved
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
    </div>
</footer><!-- End Footer -->
