@extends('user.header')

@section('css')
  <link rel="stylesheet" href="{{ URL::asset('information.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}" />
@endsection
@section('section')
<div class="info-container container rounded bg-white">
    <div class="row">
      <div class="col-md-3 border-right">
        <div
          class="d-flex flex-column align-items-center text-center p-3 py-5"
        >
          <img class="mt-5" width="100px" src="./images/logo-100.png" /><span
            class="font-weight-bold"
            ><a href="./index.html">Ytest.uz</a></span
          ><span class="text-black-50"></span><span> </span>
        </div>
      </div>
      <div class="col-md-5 border-right">
        <div class="p-3 py-5">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Ma'lumotlar</h4>
          </div>
          <div class="row mt-2">
            <div class="col-md-6">
              <label class="labels">Ism</label
              ><input
                type="text"
                class="form-control"
                placeholder="Ism"
                value="{{ $user->full_name }}"
              />
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12">
              <label class="labels">Telefon raqam</label
              ><input
                type="number"
                class="form-control"
                placeholder="Telefon raqam"
                value="{{ $user->phone }}"
              />
            </div>
            <div class="col-md-12">
              <label class="labels">Parol</label
              ><input
                type="password"
                class="form-control"
                placeholder="Parol"
                value=""
              />
            </div>
            <div class="col-md-12">
              <label class="labels">Parolni qayta kiriting</label
              ><input
                type="password"
                class="form-control"
                placeholder="Parolni takrorlang"
                value=""
              />
            </div>

            <div class="mt-5 ml-3 text-center">
              <button class="btn btn-primary" type="button">Saqlash</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Money -->
 
  </div>
@endsection


@push('script')
<script>
  function showcards() {
    var cards = document.getElementById("qism");
    cards.classList.toggle("d-none");
    var cardss = document.getElementById("qism1");
    cardss.classList.toggle("d-block");
  }

    function show_click_payment() {
    var click = document.getElementById("payment_click");
    click.classList.toggle("d-none");
  }

    function show_payme_payment() {
    var payme = document.getElementById("payment_payme");
    payme.classList.toggle("d-none");
  }

    function show_apelsin_payment() {
    var apelsin = document.getElementById("payment_apelsin");
    apelsin.classList.toggle("d-none");
  }

    function show_paynet_payment() {
    var paynet = document.getElementById("payment_paynet");
    paynet.classList.toggle("d-none");
  }
</script>
@endpush