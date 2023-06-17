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
<link rel="stylesheet" href="{{ URL::asset('information.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/header.css') }}" />
@endsection



@section('section')
<div class="info-container container rounded bg-white payment-container">
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
      @if (empty($pay_system))
          <div class="col-md-5 border-right">
        <div class="p-3 py-5">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-right">To'lovni amalga oshirish</h2>
          </div>
          <div class="row mt-3">
                <div class="col-md-12">
                    <form action="{{ route('order_reg') }}" method="POST" id="forma-input">
                      @csrf
                    <label class="labels">Summani kiritish</label>
                    <input
                      type="number"
                      name="price"
                      class="form-control"
                      placeholder="Summa..."
                    />
                    <button type="submit" class="btn btn-success mt-2">Kiritish</button>
                    </form>
                  </div>
            </div>
          </div>
        </div>
      </div>
      @else
      <div class="col-md-9 border-right p-5" id="money">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Summa qabul qilindi. To'lov tizimini tanlang</h4>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md-2">
            <div class="item-card">
              <div class="item-img">
                <form id="click_form" action="https://my.click.uz/services/pay" method="get" target="_blank">
                    <input type="hidden" name="amount" value="{{ $order->price/100 }}" />
                    <input type="hidden" name="merchant_id" value="11193"/>
                    <input type="hidden" name="merchant_user_id" value="28974"/>
                    <input type="hidden" name="service_id" value="25570"/>
                    <input type="hidden" name="transaction_param" value="{{ $order->phone }}"/>
                    <input type="hidden" name="return_url" value="https://ytest.uz"/>
                    <input type="hidden" name="card_type" value="humo"/>
                    <br>
                  <input type="image" name="submit" src="./images/click-uz-logo.png" class="w-100">
                  </form>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-2">
            <div class="item-card">
              <div class="item-img">
                <form method="POST" action="https://checkout.paycom.uz">
                  <input type="hidden" name="merchant" value="63732d642cfb25761a9ab844"/>
                  <input type="hidden" name="amount" value="{{ $order->price }}"/>
                  <input type="hidden" name="account[phone]" value="{{ $order->phone }}"/>
                  <input type="hidden" name="lang" value="uz"/>
                  <input type="hidden" name="callback" value="https://ytest.uz"/>
                  <input type="hidden" name="callback_timeout" value="100"/>
                  <input type="hidden" name="description" value=""/>
                  <input type="hidden" name="detail" value=""/>
                  <br>
                  <input type="image" name="submit" src="./images/payme-logo.png" class="w-100">
              </form>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-2">
            <div class="item-card">
              <div class="item-img">
                <form method="GET" action="https://www.apelsin.uz/open-service">
                    <input type="hidden" name="serviceId" value="498604619"/>
                    <input type="hidden" name="phone" value="{{ session('user_id') }}"/>
                    <input type="hidden" name="amount" value="{{ $order->price }}"/>
                    <input type="image" name="submit" src="./images/apelsin-logo.png" class="w-100 pt-4 mt-2">
                    </form>
              </div>
            </div> 
          </div>
          {{-- <div class="col-sm-6 col-md-3">
            <div class="item-card">
              <div class="item-img">
                <img
                  src="./images/paynet-uz-removebg-preview.png"
                  alt="paynet"
                  class="w-100 paynet"
                />
              </div>
            </div>
          </div> --}}
          {{-- <div class="col-sm-6 col-md-3">
            <div class="item-card">
              <div class="item-img">
                <a href="https://www.apelsin.uz/open-service?serviceId=498604619&phone=%2B{{ $order->phone }}&amount={{ $order->price }}">
                <img
                  src="../images/apelsin-logo.png"
                  alt="paynet"
                  class="w-100 paynet mt-5 pt-4"
                />
                </a>
              </div>
            </div>
          </div> --}}
        </div>
      </div>
      @endif
      


      
    </div>

    <!-- Money -->
   
      
  
  </div>
  <!-- End info container -->
@endsection