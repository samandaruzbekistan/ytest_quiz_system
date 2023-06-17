@extends('user.header')

@section('css')
<link rel="stylesheet" href="./style.css"/>
<!-- 
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    /> -->

  <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css" />

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
 <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    />

      <script
      src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>
<!-- Modal script-->
    <!-- <script type="text/javascript">
      window.onload = function () {
        OpenBootstrapPopup();
      };
      function OpenBootstrapPopup() {
        $("#simpleModal").modal("show");
      }
    </script> -->
     <!-- Modal script-->
    <script type="text/javascript">
      function showModal() {
        $("#simpleModal").modal("show");
      }

      function hideModal() {
        $("#simpleModal").modal("hide");
        localStorage.setItem("modal", true);
      }

      window.onload = function () {
        setTimeout(function () {
          const modal = JSON.parse(localStorage.getItem("modal")) ?? false;
          if (!modal) showModal();
        }, 3000);

        $("#close-button").click(function () {
          hideModal();
        });

        $("#close-button2").click(function () {
          hideModal();
        });
      };
    </script>
<link rel="stylesheet" href="{{ URL::asset('css/hero.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/header.css') }}" />
@endsection

@section('section')
<div id="simpleModal" class="modal modal-ml" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header m-auto">
            <h5 class="modal-title">
              Telegram kanalimizga obuna bo'ling
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body m-auto d-flex">
            <a href="https://t.me/platforma_yongoq">
              <img src="./images/logo-100.png" alt="logo for modal" class="w-75">
            </a>
          </div>
          <div class="modal-footer m-auto">
            <button class="btn btn-lg btn-primary">
              <a href="https://t.me/platforma_yongoq"
                ><i class="fa fa-telegram"></i> Obuna bo'lish</a
              >
            </button>
            <!-- <button type="button" class="btn btn-info" data-dismiss="modal">
              Yopish
            </button> -->
          </div>
        </div>
      </div>>
  </div>
  <div class="hero-content">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div
            class="hero-content-wrap flex flex-column justify-content-center align-items-start"
          >
            <header class="entry-header">
              <h4>Bilimingizni Yongʻoq bilan yanada</h4>
              <h1>mustahkamlang</h1>
            </header>
            <!-- .entry-header -->

            <footer class="entry-footer read-more">
              <a href="{{ route('categories') }}">Boshlash</a>
            </footer>
          </div>
          <!-- .hero-content-wrap -->
        </div>
        <!-- .col -->
      </div>
      <!-- .row -->
    </div>
    <!-- .container -->
  </div>
  <!-- .hero-content-hero-content-overlay -->
</div>
<!-- .hero-content -->

<div class="hero-content-overlay about-section">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div
            class="hero-content-wrap flex flex-column justify-content-center align-items-end"
          >
            <header class="entry-header heading">
              <h2 class="entry-title">
                Oliy ta'lim muassasalariga <br />kirish imtihonlari uchun
                <br />
                maxsus platforma
              </h2>
            </header>
            <!-- .entry-header -->

            <footer class="entry-footer">
              <a href="./about.html" class="text-dark">Batafsil</a>
            </footer>
          </div>
          <!-- .hero-content-wrap -->
        </div>
        <!-- .col -->
      </div>
      <!-- .row -->
    </div>
    <!-- .container -->
  </div>

  <section class="latest-news-events">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <header
            class="heading flex justify-content-between align-items-center"
          >
            <h2 class="entry-title">So'nggi yangiliklar</h2>
            <div class="entry-footer read-more">
              <a href="/news.html">Batafsil</a>
            </div>
          </header>
          <!-- .heading -->
        </div>
        <!-- .col -->

        <div class="col-12 col-lg-6">
          <div class="featured-event-content">
            <figure class="event-thumbnail position-relative m-0">
              <a href="#"
                ><img src="images/milliy-sertifikat.jpg" alt=""
              /></a>
            </figure>
            <!-- .event-thumbnail -->

            <header class="entry-header flex flex-wrap align-items-center">
              <h2 class="entry-title">
                <a href="https://t.me/milliy_sertifikat/5284?single"
                  >Chet tilini bilish darajasini aniqlash test sinovlari
                  bo‘lib o‘tdi</a
                >
              </h2>
              <div class="event-duration">
                <i class="fa fa-calendar"></i>12 noyabr
              </div>
            </header>
            <!-- .entry-header -->
          </div>
          <!-- .featured-event-content -->
        </div>
        <!-- .col -->

        <div class="col-12 col-lg-6 mt-5 mt-lg-0">
          <div
            class="event-content flex flex-wrap justify-content-between align-content-stretch"
          >
            <figure class="event-thumbnail">
              <a href="#"><img src="images/event-2.jpg" alt="" /></a>
            </figure>
            <!-- .course-thumbnail -->

            <div class="event-content-wrap">
              <header class="entry-header">
                <div class="posted-date">
                  <i class="fa fa-calendar"></i> 11.11.2022
                </div>
                <!-- .posted-date -->

                <h2 class="entry-title">
                  <a href="https://t.me/milliy_sertifikat/5271"
                    >Ona tili va adabiyot fanidan milliy sertifikat
                    imtihonlari yanvar oyida o‘tkaziladi</a
                  >
                </h2>
                <!-- .entry-meta -->
              </header>
              <!-- .entry-header -->

              <div class="entry-content" data-maxlength="100">
                <p>
                  Talabgorlarni ro‘yxatga olish 12-noyabrga qadar davom etadi
                  va test sinovlari 4- va 18-dekabr kunlari bo‘lib o‘tadi.
                </p>
              </div>
              <!-- .entry-content -->
            </div>
            <!-- .event-content-wrap -->
          </div>
          <!-- .event-content -->

          <div
            class="event-content flex flex-wrap justify-content-between align-content-lg-stretch"
          >
            <figure class="event-thumbnail">
              <a href="#"><img src="images/event-3.jpg" alt="" /></a>
            </figure>
            <!-- .course-thumbnail -->

            <div class="event-content-wrap">
              <header class="entry-header">
                <div class="posted-date">
                  <i class="fa fa-calendar"></i>12.11.2022
                </div>
                <!-- .posted-date -->

                <h2 class="entry-title">
                  <a href="https://t.me/milliy_sertifikat/5280"
                    >Yangi ishga kirayotgan chet tili o'qituvchilariga B2
                    darajadagi sertifikat talabi 2023/2024 o'quv yilidan
                    kiritiladi</a
                  >
                </h2>
                <!-- .entry-meta -->
              </header>
              <!-- .entry-header -->

              <div class="entry-content" data-maxlength="100">
                <p>
                  Eslatib o'tamiz, 2024/2025 o'quv yilidan maktabdagi har
                  qanday chet tili fani o'qituvchisi B2 darajadagi
                  sertifikatga ega bo'lishi talab etiladi. O'z navbatida C1
                  darajadagi xalqaro sertifikatga ega o'qituvchilar ham ayni
                  vaqtda oylik ish haqlarini 50 foizga oshirish imkoniyatiga
                  ega
                </p>
              </div>
              <!-- .entry-content -->
            </div>
            <!-- .event-content-wrap -->
          </div>
          <!-- .event-content -->
        </div>
        <!-- .col -->
      </div>
      <!-- .row -->
    </div>
    <!-- .container -->
  </section>
  <!-- .latest-news-events -->


@endsection


@push('script')
<script>
    $("#overlay").modal("show");

    setTimeout(function () {
      $("#overlay").modal("hide");
    }, 10000);
  </script>

<script type="text/javascript">
  window.onload = function () {
    OpenBootstrapPopup();
  };
  function OpenBootstrapPopup() {
    $("#simpleModal").modal("show");
  }
</script>
@endpush
