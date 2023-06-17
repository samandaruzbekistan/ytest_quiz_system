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
<div class="main-container">
<div class="container-items">
<div class="heading">
<h2 class="heading__title">Kerakli bo'limni tanlang</h2>
</div>
<div class="cards align-content-center">
<div class="card card-1 card-sm m-3">
<a href="{{ route('sciense') }}" class="card__title"><h2>Milliy sertifikat testlari</h2></a>
</div>
<div class="card card-2 card-sm m-3">
    @if (isset($exam))
        @if ($exam->status == 1 )
            <a href="#" class="card__title"><h2>Imtixon yakunlangan</h2></a>
        @elseif (($exam_day->date == date('Y-m-d')) and (date('H') >= 9))
            <a href="{{ route('select_block') }}" class="card__title"><h2>Testni boshlash</h2></a>
        @else
            <a href="#" class="card__title"><h2>Imtihon kuni: {{ $exam_day->date }}</h2></a>
        @endif
    @else
        <a href="#"  class="card__title" ><h2 id="clickable">Block testlar</h2></a>
    @endif
    

</div>
</div>
</div>
</div>

@endsection

@push('script')
<script>
    let on_off = document.querySelector('#clickable');

    on_off.onclick = function() {
        if (confirm("Test narxi {{ $amount }}. Imtihon kuni: {{ $exam_day->date }}. Sotib olasizmi?") == true) {
            window.location= "/block-sale";
        }
    }
</script>

@endpush