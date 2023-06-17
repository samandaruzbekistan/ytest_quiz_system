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
<link rel="stylesheet" href="{{ URL::asset('sciences.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/header.css') }}" />
@endsection




@section('section')
@if (session('money_error') == "1")
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Xatolik!</strong> Hisobingizda mablag yetarli emas.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


<div class="main-container">
  <div class="heading">
    <h1 class="heading__title">Fanlarni tanlang</h1>
  </div>

  <div class="cards">
    <div class="card w-75 card-1">
      <div class="card__icon"><i class="fa fa-calculator fa-2x"></i></div>
      <h2
        class="card__title mt-3"
        data-toggle="collapse"
        data-target="#collapsemath"
        aria-expanded="false"
        aria-controls="collapsemath"
      >
        MATEMATIKA
      </h2>
      <p class="card__apply">
        @if ($matem == 1)
            @if (($exam->date == date('Y-m-d')) and (date('H') >= 9))
            <a class="card__link text-success" href="{{ route('play',['id' => $matem1->id]) }}"
            >Imtixon boshlash</i
          ></a>
            @else
            <a class="card__link text-success" href="#"
            >Imtixon boshlanish sanasi {{ $exam->date }}</i
          ></a>
            @endif
        @elseif ($matem == 2)
            <a class="card__link text-success" href="#"
            >Imtixon yakunlangan <br> Test natijalari bo'limidan natijangizni ko'ring</i
        ></a>  
        @else
        <button class="btn btn-light" onclick="matem()">Sotib olish {{ $matem1->price }} so'm</button>
        @endif
       
      </p>
      <div class="collapse" id="collapsemath">
        <div class="card__1 card-body">
          <p>
            Ushbu test topshiriqlarida davlat ta’lim standarti va o‘quv
            dasturi asosida matematika fanining quyidagi bo‘limlari qamrab
            olinadi: <br />
            1. Sonlar va amallar <br />
            2. Algebraik shakl almashtirishlar <br />
            3. Tenglama va tengsizliklar <br />
            4. Funksiyalar <br />
            5. Matematik analiz asoslari <br />
            6. Geometriya <br />
            7. To‘plam, mulohazalar, ma’lumotlar tahlili, kombinatorika,
            ehtimollar nazariyasi va modellashtirish <br />
            Topshiriqlar soni – 45 ta (ochiq va yopiq turdagi) <br />
            <span class="text-danger"
              >Ajratilgan vaqt – 150 daqiqa (2 soat-u 30 daqiqa)
            </span>
          </p>
        </div>
      </div>
    </div>
    <div class="card w-75 card-2">
      <div class="card__icon"><i class="fa fa-atom fa-2x"></i></div>
      <h2
        class="card__title mt-3"
        data-toggle="collapse"
        data-target="#fizika"
        aria-expanded="false"
        aria-controls="fizika"
      >
        FIZIKA
      </h2>
      <p class="card__apply">
        @if ($fizika == 1)
            @if (($exam->date == date('Y-m-d')) and (date('H') >= 9))
            <a class="card__link text-success" href="{{ route('play',['id' => $fizika1->id]) }}"
            >Imtixon boshlash</i
        ></a>
            @else
            <a class="card__link text-success" href="#"
            >Imtixon boshlanish sanasi {{ $exam->date }}</i
        ></a>
            @endif
        @elseif ($fizika == 2)
            <a class="card__link text-success" href="#"
            >Imtixon yakunlangan <br> Test natijalari bo'limidan natijangizni ko'ring</i
        ></a>
        @else
        <button class="btn btn-light" onclick="fizika()">Sotib olish {{ $fizika1->price }} so'm</button>
        @endif
      </p>
      <div class="collapse" id="fizika">
        <div class="card__1 card-body">
          <p>
            Ushbu test topshiriqlarida davlat ta’lim standarti va o‘quv
            dasturi asosida fizika fanining quyidagi bo‘limlari qamrab
            olinadi: <br />
            1. Mexanika. <br />
            2. Molekulyar fizika va termodinamika. <br />
            3. Elektr va magnitizm. 4. Optika. Nisbiylik nazariyasi
            asoslari.<br />
            5. Kvant fizikasi. Atom va yadro fizikasi.<br />
            Topshiriqlar soni – 45 ta (ochiq va yopiq turdagi) <br />
            <span class="text-danger"
              >Ajratilgan vaqt – 150 daqiqa (2 soat-u 30 daqiqa)
            </span>
          </p>
        </div>
      </div>
    </div>
    <div class="card w-75 card-3">
      <div class="card__icon"><i class="fa fa-flask fa-2x"></i></div>
      <h2
        class="card__title mt-3"
        data-toggle="collapse"
        data-target="#collapsechemist"
        aria-expanded="false"
        aria-controls="collapsechemist"
      >
        KIMYO
      </h2>
      <p class="card__apply">
        @if ($kimyo == 1)
            @if (($exam->date == date('Y-m-d')) and (date('H') >= 9))
            <a class="card__link text-success" href="{{ route('play',['id' => $kimyo1->id]) }}"
            >Imtixon boshlash</i
        ></a>
            @else
            <a class="card__link text-success" href="#"
            >Imtixon boshlanish sanasi {{ $exam->date }}</i
        ></a>
            @endif
        @elseif ($kimyo == 2)
            <a class="card__link text-success" href="#"
            >Imtixon yakunlangan <br> Test natijalari bo'limidan natijangizni ko'ring</i
        ></a>  
      @else
      <button class="btn btn-light" onclick="kimyo()">Sotib olish {{ $kimyo1->price }} so'm</button>
      @endif
      </p>
      <div class="collapse" id="collapsechemist">
        <div class="card__1 card-body">
          <p>
            Ushbu test topshiriqlarida davlat ta’lim standarti va o‘quv
            dasturi asosida kimyo fanining quyidagi bo‘limlari qamrab
            olinadi: <br />
            1. Umumiy kimyo <br />2. Anorganik kimyo <br />3. Organik kimyo
            4. Laboratoriya mashgʻulotlari Topshiriqlar soni – 45 ta (ochiq
            va yopiq turdagi) <br />
            <span class="text-danger"
              >Ajratilgan vaqt – 150 daqiqa (2 soat-u 30 daqiqa)</span
            >
          </p>
        </div>
      </div>
    </div>
    <div class="card w-75 card-4">
      <div class="card__icon"><i class="fa fa-pagelines fa-2x"></i></div>
      <h2
        class="card__title mt-3"
        data-toggle="collapse"
        data-target="#collapsebio"
        aria-expanded="false"
        aria-controls="collapsebio"
      >
        BIOLOGIYA
      </h2>
      <p class="card__apply">
        @if ($bio == 1)
            @if (($exam->date == date('Y-m-d')) and (date('H') >= 9))
            <a class="card__link text-success" href="{{ route('play',['id' => $bio1->id]) }}"
            >Imtixon boshlash</i
        ></a>
            @else
            <a class="card__link text-success" href="#"
            >Imtixon boshlanish sanasi {{ $exam->date }}</i
        ></a>
            @endif
        @elseif ($bio == 2)
            <a class="card__link text-success" href="#"
            >Imtixon yakunlangan <br> Test natijalari bo'limidan natijangizni ko'ring</i
        ></a>  
        @else
        <button class="btn btn-light" onclick="bio()">Sotib olish {{ $bio1->price }} so'm</button>
        @endif
      </p>
      <div class="collapse" id="collapsebio">
        <div class="card__1 card-body">
          <p>
            Ushbu test topshiriqlarida davlat ta’lim standarti va o‘quv
            dasturi asosida biologiya fanining quyidagi bo‘limlari qamrab
            olinadi: <br />
            1. Tiriklikning xilma-xilligi.<br />
            2. Sitologiya, genetika va seleksiya asoslari.<br />
            3. Tirik organizmlarning umumiy sistematikasi. <br />4. O‘simlik
            va hayvonot dunyosi. 5. Odam organizmi va uning salomatligi.<br />
            6. Hayotning tur va populyatsiya darajasining umumbiologik
            qonuniyatlari. <br />7. Hayotning ekosistema va biosfera
            darajasi umumiy qonuniyatlari, organik olam filogenezi. <br />8.
            Umumbiologik qonuniyatlar asosida masala, misol va topshiriqlar.
            <br />Topshiriqlar soni – 45 ta (ochiq va yopiq turdagi)
            <span class="text-danger"
              >Ajratilgan vaqt – 150 daqiqa (2 soat-u 30 daqiqa)</span
            >
          </p>
        </div>
      </div>
    </div>
    <div class="card w-75 card-5" id="headingFive">
      <div class="card__icon"><i class="fa fa-pencil fa-2x"></i></div>
      <h2
        class="card__title mt-3"
        data-toggle="collapse"
        data-target="#collapseFive"
        aria-expanded="true"
        aria-controls="collapseFive"
      >
        ONA TILI VA ADABIYOT
      </h2>
      <p class="card__apply">
        @if ($onatili == 1)
            @if (($exam->date == date('Y-m-d')) and (date('H') >= 9))
            <a class="card__link text-success" href="{{ route('play',['id' => $onatili1->id]) }}"
            >Imtixon boshlash</i
        ></a>
            @else
            <a class="card__link text-success" href="#"
            >Imtixon boshlanish sanasi {{ $exam->date }}</i
        ></a>
            @endif
        @elseif ($onatili == 2)
            <a class="card__link text-success" href="#"
            >Imtixon yakunlangan <br> Test natijalari bo'limidan natijangizni ko'ring</i
        ></a>  
        @else
        <button class="btn btn-light" onclick="onatili()">Sotib olish {{ $onatili1->price }} so'm</button>
        @endif
      </p>
      <div
        class="collapse"
        id="collapseFive"
        id="collapseFive"
        class="collapse"
        aria-labelledby="headingFive"
        data-parent="#accordion"
      >
        <div class="card__1 card-body">
          <p>
            Ona tili va adabiyoti Test savollari kitobi 3 qismdan iborat:
            1-BO’LIM. 1-20-savollar <br />
            2-BO’LIM. 21-40-savollar <br />3-BO’LIM. 41-52-savollar<br />
            <span class="text-danger">Umumiy vaqt: 3 soat</span>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('script')
<script>
    function myFunction() {
        var x = document.getElementsByClassName("card");
        if (x.style.display === "none") {
          x.style.display = "block";
        } else {
          x.style.display = "none";
        }
      }
    
    function matem() {
        if (confirm("Test narxi {{ $matem1->price }}. Imtihon kuni: {{ $exam->date }}. Sotib olasizmi?") == true) {
            window.location= "/buy/6";
        }
    }

    function fizika() {
        if (confirm("Test narxi {{ $fizika1->price }}. Imtihon kuni: {{ $exam->date }}. Sotib olasizmi?") == true) {
            window.location= "/buy/7";
        }
    }

    function kimyo() {
        if (confirm("Test narxi {{ $kimyo1->price }}. Imtihon kuni: {{ $exam->date }}. Sotib olasizmi?") == true) {
            window.location= "/buy/8";
        }
    }

    function bio() {
        if (confirm("Test narxi {{ $bio1->price }}. Imtihon kuni: {{ $exam->date }}. Sotib olasizmi?") == true) {
            window.location= "/buy/9";
        }
    }

    function onatili() {
        if (confirm("Test narxi {{ $matem1->price }}. Imtihon kuni: {{ $exam->date }}. Sotib olasizmi?") == true) {
            window.location= "/buy/10";
        }
    }
  </script>
@endpush