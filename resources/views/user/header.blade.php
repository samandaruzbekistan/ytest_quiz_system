<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Yong'oq.uz</title>
    <script type="text/javascript">
      window.onload = function () {
        OpenBootstrapPopup();
      };
      function OpenBootstrapPopup() {
        $("#simpleModal").modal("show");
      }
    </script>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" />

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/elegant-fonts.css') }}" />

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/themify-icons.css') }}" />

    @yield('css')

    <!-- Styles -->
    <link rel="stylesheet" href="{{ URL::asset('style.css') }}" />


    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>

   

    <!-- gif script -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <!-- End of Modal script -->
  </head>
  
  <body>
    <!-- Modal section -->
      
      <!-- End of Modal section -->
  
      <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="{{ route('user-home') }}"
          ><img src="../images/logo-100.png" class="w-50"
        /></a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"><i class="fa fa-bars text-dark"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav w-100">
            <li class="nav-item">
              <a
                class="nav-link font-weight-bold text-uppercase"
                href="https://t.me/platforma_yongoq"
                ><i class="fa fa-telegram"></i> Telegram</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link text-white font-weight-bold" href="{{ route('categories') }}"
                >Diagnostik testlar</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link text-white font-weight-bold" href="{{ route('news') }}"
                >Yangiliklar</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link text-white font-weight-bold" href="{{ route('about') }}"
                >Biz haqimizda</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link text-white font-weight-bold" href="{{ route('contact') }}"
                >Aloqa</a
              >
            </li>
          
            
            @if (session('full_name'))
            <li class="nav-item ml-auto">
              
              <a class="nav-link text-dark font-weight-bold" href="#"
              >Balans: {{ session('balans') }} so'm</a>
              
            </li>  
            <li class="nav-item dropdown ml-auto">
              <a
                class="nav-link text-white dropdown-toggle"
                href="#"
                id="navbarDropdownMenuLink"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="fa fa-user-circle"></i> {{ session('full_name') }}
              </a>
              <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="navbarDropdownMenuLink"
              >
                <a
                  class="dropdown-item font-weight-bold"
                  href="{{ route('information') }}"
                  >Ma'lumotlar</a
                >
                <a
                  class="dropdown-item font-weight-bold"
                  href="{{ route('Payment') }}"
                  >Hisobni to'ldirish</a
                >
                <a class="dropdown-item font-weight-bold" href="{{ route('my_results') }}"
                  >Test natijalari</a
                >
                <a class="dropdown-item font-weight-bold" href="{{ route('logout') }}"
                  >Chiqish</a
                >
              </div>
            </li>
            @else
          <!-- Sign-in -->
            <li class="nav-item ml-auto text-white">
              <div class="sign-in  align-content-end">
                <a class="nav-link text-white" href="{{ route('login') }}"
                  ><i class="fa fa-sign-in"> </i> Kirish</a
                >
              </div>
            </li> 
            <!-- End Sign-in -->
            @endif
            
           
          </ul>
        </div>
      </nav>
  







    @yield('section')







    <footer class="site-footer">
      <div class="footer-widgets">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
              <div class="foot-about">
                <a class="foot-logo" href="./index.html"
                  ><img src="../images/logo-100.png" alt=""
                /></a>
              </div>

              <!-- .foot-about -->
            </div>
            <!-- .col -->

            <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
              <div class="foot-contact">
                <h2>Biz bilan bog'lanish</h2>

                <ul>
                  <li>
                    Elektron pochta:
                    <span class="email">yongoqtestuz@gmail.com</span>
                  </li>
                  <li>
                    Telegram admin: <span class="phone"><a class="nav-linkv text-primary" href="https://t.me/ms_adminn">@ms_adminn</a></span>
                  </li>
                  <li>
                    Developed by GOLD APPS™ company
                  </li>
                  <li>
                   Dasturchi: <br> <a class="nav-link text-primary" href="https://instagram.com/samandar_sariboyev">Samandar, Jasurbek, Zuhriddin</a>
                  </li>
                </ul>
              </div>
              <!-- .foot-contact -->
            </div>
            <!-- .col -->

            <div class="col-12 col-md-6 col-lg-3 mt-5 mt-lg-0">
              <div class="quick-links flex flex-wrap">
                <h2 class="w-100">Tezkor linklar</h2>

                <ul class="w-50">
                  <li><a href="{{ route('about') }}">Biz haqimizda </a></li>
                  <li><a href="#">Foydalanish qoidalari</a></li>
                  <li><a href="{{ route('contact') }}">Biz bilan bog'lanish</a></li>
                </ul>
              </div>
              <!-- .quick-links -->
            </div>
            <!-- .col -->

            <div class="col-12 col-md-6 col-lg-3 mt-5 mt-lg-0">
              <div class="follow-us">
                <h2>Obuna bo'ling</h2>
                <ul class="follow-us flex flex-wrap align-items-center">
                  <li>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                  </li>
                  <li>
                    <a href="https://t.me/platforma_yongoq"
                      ><i class="fa fa-telegram"></i
                    ></a>
                  </li>
                  <li>
                    <img
                      class="w-25"
                      src="../images/payme-logo.png"
                      alt="payme-uz"
                    />
                    <img
                      class="m-2 w-25"
                      src="../images/click-uz-logo.png"
                      alt="click-uz"
                    />
                  </li>
                  <li>
                    <img
                      class="w-25"
                      src="../images/paynet-removebg-preview.png"
                      alt="payme-uz"
                    />
                    <img
                      class="m-2 w-50"
                      src="../images/apelsin-logo.png"
                      alt="click-uz"
                    />
                  </li>
                </ul>
              </div>
              <!-- .quick-links -->
            </div>
            <!-- .col -->
          </div>
          <!-- .row -->
        </div>
        <!-- .container -->
      </div>
      <!-- .footer-widgets -->
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
      <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
      <script type="text/javascript" src="{{ URL::asset('js/masonry.pkgd.min.js') }}"></script>
      <script type="text/javascript" src="{{ URL::asset('js/jquery.collapsible.min.js') }}"></script>
      <script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>
     

  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
      
      
      
      @stack('script')




    </body>
  </html>

