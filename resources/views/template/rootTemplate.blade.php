<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>@yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('roots/assets/img/favicon/favicon.ico')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('roots/assets/vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('roots/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('roots/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('roots/assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('roots/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <link rel="stylesheet" href="{{asset('roots/assets/vendor/libs/apex-charts/apex-charts.css')}}" />
    <!-- Helpers -->
    <script src="{{asset('roots/assets/vendor/js/helpers.js')}}"></script>
    
     <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('roots/assets/js/config.js')}}"></script>
  </head>

  <body>
    @if(Session('successMessage'))
            <div aria-live="polite" aria-atomic="true" class="position-relative">
             <div class="toast-container position-absolute top-0 end-0 p-3" style="Z-index:9999">

                <div
                        class="bs-toast toast fade show {{Session('successMessage')?'show':''}}  bg-danger"
                        role="alert"
                        aria-live="assertive"
                        aria-atomic="true"
                        id="deletetoast"
                      >
                        <div class="toast-header">
                          <i class="bx bx-bell me-2"></i>
                          <div class="me-auto fw-semibold">Suppression</div>
                          <small>A l'instant</small>
                          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                         {{Session('successMessage')}}
                        </div>
                      </div>
             </div>
            </div>
            @endif
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="{{route('dashboard')}}" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="{{asset('users/img/logo.png')}}" style="width:100px; height:100px;"/>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item {{isActiveLink(['dashboard'])}}">
              <a href="{{route('dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Tableau de bord</div>
              </a>
            </li>

            <!-- Layouts -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Layouts">Paramètres générale</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item {{isActiveLink(['home-custom'])}}">
                  <a href="{{route('home-custom')}}" class="menu-link">
                    <div data-i18n="Without menu">Accueil</div>
                  </a>
                </li>
                <li class="menu-item {{isActiveLink(['about-custom'])}}">
                  <a href="{{route('about-custom')}}"class="menu-link">
                    <div data-i18n="Without navbar">A propos de NDD</div>
                  </a>
                </li>
                <li class="menu-item {{isActiveLink(['advertises'])}}">
                  <a href="{{route('advertises')}}" class="menu-link">
                    <div data-i18n="Without navbar">Publicités</div>
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Pages</span>
            </li>
            
            <!-- Cards -->
            <li class="menu-item {{isActiveLink(['events-list'])}}">
              <a href="{{route('events-list')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar-event"></i>
                <div data-i18n="Basic">Évènements</div>
              </a>
            </li>
             <li class="menu-item {{isActiveLink(['speakers-list'])}}">
              <a href="{{route('speakers-list')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-voice"></i>
                <div data-i18n="Basic">Panélistes</div>
              </a>
            </li>
             <li class="menu-item {{isActiveLink(['attendees-list'])}}">
              <a href="{{route('attendees-list')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-account"></i>
                <div data-i18n="Basic">Participants</div>
              </a>
            </li>
            <li class="menu-item {{isActiveLink(['partners-list'])}}">
              <a href="{{route('partners-list')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-briefcase"></i>
                <div data-i18n="Basic">Partenaires</div>
              </a>
            </li>
            <li class="menu-item {{isActiveLink(['members-list'])}}">
              <a href="{{route('members-list')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Basic">Membres NDD</div>
              </a>
            </li>
          </br>
            <li class="menu-item">
              <div class="form-check form-switch" style="margin-left:30px;">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{$home->isEnable?'':'checked'}}>
                <label class="form-check-label" for="flexSwitchCheckChecked">Mode maintenance </label>
              </div>
            </li>
           
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">

                <!-- User -->
                @if (Route::has('login') )
                 @auth
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                    <i class='bx bx-user-circle' style="font-size:40px;"></i>
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <i class='bx bx-user-circle' style="font-size:40px;"></i>
                            </div>
                          </div>
                         
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{Auth::user()->name}}</span>
                            <small class="text-muted">{{Auth::user()->email}}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">Mon Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Paramêtres</span>
                      </a>
                    </li>
                    
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{route('log-out')}}">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Déconnexion</span>
                      </a>
                    </li>
                  </ul>
                </li>
                @else
                 <script> window.location.replace('{{ route('login') }}'); </script>
                @endauth
                @endif
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            @yield('content')
            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , POWERED by
                  <a href="https://biziyee.com" target="_blank" class="footer-link fw-bolder"> BIZIYEE TECHNOLOGIE & COMMUNICATION</a>
                </div>
               
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('roots/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('roots/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('roots/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('roots/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('roots/assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('roots/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('roots/assets/js/main.js')}}"></script>
    <script src="{{asset('roots/assets/vendor/libs/datatables/datatables.min.js')}}"></script>

     <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <!-- Page JS -->
    <script src="{{asset('roots/assets/js/dashboards-analytics.js')}}"></script>
    <script src="{{asset('js/axios.js')}}"></script>
   
    @yield('scripts')

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
      $(document).ready(function(){
                 if( $('li').has('.active') ) {

                   $('.active').closest('ul').parent().addClass('open');
                };
                let toast = $('#deletetoast');
				 
              setTimeout(function() {
                toast.hide();
              }, 3000);
              
             })
    </script>
  </body>
</html>
