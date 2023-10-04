<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Jeunes visionnaires">
    <meta name="keywords" content="jeunes, droit, entrepreneurs, togo, nuit du droit, avocats">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
      @yield('styles')
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('roots/assets/img/favicon/favicon.ico')}}" />
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('users/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('users/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('users/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('users/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('users/css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('users/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('users/css/style.css')}}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
   

    <!-- Header Section Begin -->
    <header class="header-section header-normal">
        <div class="container">
            <div class="logo">
                <a href="#">
                    <img src="{{asset('users/img/logo.png')}}" alt="" style="width: 100px; height:100px;">
                </a>
            </div>
            <div class="nav-menu">
                <nav class="mainmenu mobile-menu">
                    <ul>
                        <li class="{{isActiveLink(['home'])}}"><a href="{{route('home')}}">Accueil</a></li>
                        <li class="{{isActiveLink(['about'])}}"><a  href="{{route('about')}}">A Propos</a></li>
                        <li class="{{isActiveLink(['speakers'])}}"><a  href="{{route('speakers')}}">Panelistes</a></li>
                        <!--<li><a href="./schedule.html">Schedule</a></li>-->
                        <li class="{{isActiveLink(['events'])}}"><a href="{{route('events')}}">Évènements</a></li>
                        <li class="{{isActiveLink(['contact'])}}"><a  href="{{route('contact')}}">Contact</a></li>
                    </ul>
                </nav>
                <a href="{{route('attend-form')}}" class="primary-btn top-btn"><i class="fa fa-ticket"></i>Participer</a>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header End -->

  
        @yield('content')
          
    <!-- Footer Section Begin -->

    <footer class="footer-section bg-white">
        <div class="container">
            @yield('partners')
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-text">
                        <div class="ft-logo">
                            <a href="#" class="footer-logo"><img src="{{asset('users/img/logo.png')}}" style="width: 200px; height:200px;" alt=""></a>
                        </div>
                        <ul>
                            <li><a href="#">Accueil</a></li>
                            <li><a href="#">Panélistes</a></li>
                            <li><a href="#">Programme</a></li>
                            <li><a href="#">Evènements</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                        <div class="copyright-text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Powered By <i class="fa fa-heart" aria-hidden="true"></i>  <a href="#" target="_blank">BIZIYEE TECHNOLOGIE & COMMUNICATION</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="ft-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href=" https://twitter.com/Nddtogo"><i class="fa fa-twitter"></i></a>
                            <a href=" https://www.linkedin.com/company/la-nuit-du-droit-togo-1er-edition/?viewAsMember=true"><i class="fa fa-linkedin"></i></a>
                            <a href="https://www.instagram.com/la_nuit_du_droit_togo/"><i class="fa fa-instagram"></i></a>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="whatsapp-container">
  <div class="whatsapp-icon">
    <a href="https://wa.me/22890975339" target="_blank">
      <img src="{{asset('users/img/whatsapp.png')}}" alt="WhatsApp" />
    </a>
  </div>
</div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{asset('users/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('users/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('users/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('users/js/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('users/js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('users/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('users/js/main.js')}}"></script>
    @yield('scripts')
</body>

</html>