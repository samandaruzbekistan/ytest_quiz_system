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
    <script src="https://code.jivosite.com/widget/XIMrD9mQgD" async></script>
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
              <a href="./"
                ><i class="fa fa-home"></i> Bosh sahifa</a
              >
            </li>
            <li>
              <a href="./contact">Aloqa</a>
            </li>
          </ul>
        </div>
        <!-- .breadcrumbs -->
      </div>
      <!-- .col -->
    </div>
    <!-- .row -->

    <div class="row justify-content-between">
      <!-- .col -->

      <div class="col-12 col-lg-6">
        <div class="contact-form">
          <h3>Xabar qoldirish</h3>

          <form>
            <input type="text" placeholder="Ism" />
            <input type="email" placeholder="Elektron pochta" />
            <input type="text" placeholder="Maqsad" />
            <textarea placeholder="Xabar yozish..." rows="4"></textarea>
            <input type="submit" value="Yuborish" />
          </form>
        </div>
        <!-- .contact-form -->
      </div>
      <!-- .col -->

      <div class="col-12 col-lg-6">
        <div class="contact-info">
          <h3>Aloqa uchun ma'lumotlar</h3>

          <p>
            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
            officia dese mollit anim id est laborum.
          </p>

          <ul class="p-0 m-0">
            <li class="via-contact">
              <a href="https://t.me/platforma_yongoq"
                ><i class="fa fa-telegram"></i> Telegram</a
              >
            </li>
            <li class="via-contact">
              <span
                ><i class="fa fa-envelope text-dark"></i> Bizning elektron pochta:</span
              ><a href="#">yongoqtestuz@gmail.com</a>
            </li>
            <li class="via-contact">
              <span
                ><i class="fa fa-phone text-dark"></i> Ishonch telefoni:</span
              ><a href="#">+998 91 234 56 78</a>
            </li>
          </ul>
        </div>
        <!-- .contact-info -->
      </div>
      <!-- .col -->
    </div>
    <!-- .row -->
  </div>
  <!-- .container -->

@endsection

