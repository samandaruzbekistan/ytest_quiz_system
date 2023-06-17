@extends('user.header')

@section('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    />

    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
      integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
      crossorigin="anonymous"
    />
    <script
      src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>
<link rel="stylesheet" href="{{ URL::asset('categories.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/header.css') }}" />
@endsection



@section('section')

<div class="container">
    <div class="row">
      <div class="col-12">
        <div class="breadcrumbs">
          <ul class="flex flex-wrap align-items-center p-0 m-0">
            <li>
              <a href="./index.html"
                ><i class="fa fa-home"></i> Bosh sahifa</a
              >
            </li>
            <li>Biz haqimizda</li>
          </ul>
        </div>
        <!-- .breadcrumbs -->
      </div>
      <!-- .col -->
    </div>
    <!-- .row -->
  </div>
  <!-- .container -->

  <section class="about-section">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-12 align-content-lg-center">
          <header class="heading">
            <h1 class="entry-title">Biz haqimizda</h1>

            <p>
              Yongʻoq.uz platformasi jamoasi 7 yoshdan 70 yoshgacha boʻlgan
              auditoriyani jamlab olishni oʻz oldiga maqsad qilib qoʻygan.
              Yaʼni bogʻcha bolalari, maktab yoshidagi oʻquvchilar,
              abituriyentlar, talaba yoshlar, magistrlar, doktorantlar,
              oʻqituvchilar, ilmiy izlanuvchilar va mustaqil oʻrganuvchilar
              uchun moʻljallangan yirik platforma sifatida faoliyat olib
              boradi. Hozirda platforma orqali abituriyentlar kirish
              imtihonlari formatidagi tayyorgarlik (blok) test topshiriqlarini
              bajarishlari mumkin. Shuningdek, bosqichma bosqich platforma
              barcha yosh doirasidagi obunachilar uchun moʻljallangan testlar,
              video darslar, online kurslar, foto va video materiallar va
              turli xil qoʻllanmalar bilan toʻldirib boriladi.
            </p>
          </header>
          <!-- .heading -->

        
          <!-- .golden-stats -->
        </div>
        <!-- .col -->

        <!-- .col -->
      </div>
      <!-- .row -->
    </div>
    <!-- .container -->
  </section>
@endsection