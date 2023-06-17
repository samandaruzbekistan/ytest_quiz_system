@extends('user.header')

@section('css')
  <link rel="stylesheet" href="{{ URL::asset('css/after_test_res.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}" />
@endsection
@section('section')
<div class="container-res mt-lg-5">
    @if (isset($onatili))
    <div class="content">
        <h3 class="text-bold">O'qib tushunish (1-20) balingiz {{ $e1 }} ball</h3>
        <h3 class="text-bold">Adabiyot (21-40) {{ $e2 }} ball</h3>
        <h3 class="text-bold">Yozma savodxonlik (41-50) {{ $e3 }} ball</h3>
        <h3 class="text-bold">Umumiy ball {{ $max }} dan {{ $e1+$e2+$e3 }} ball </h3>
        <h3 class="text-bold">Natija: {{ number_format(($e1+$e2+$e3)*100/$max,1) }} %</h3>
        <br />    
        <h4>Ona tili fani bo'yicha umumiy natijalar 3 kun ichida eʼlon qilinadi!</h4>
      </div>         
    @else
    <div class="content">
      <h3 class="text-bold">Yopiq test natijalari boʻyicha (1-32) balingiz: {{ $e1 }} ball</h3>
      <h3 class="text-bold">Yopiq test natijalari boʻyicha (33-35) balingiz: {{ $e2 }} ball</h3>
      <h3 class="text-bold">Ochiq test natijalari boʻyicha (36-45) balingiz: {{ $o }} ball</h3>
      <h3 class="text-bold">Umumiy ball {{ $max }} dan {{ $e1+$e2+$o }} ball </h3>
      <h3 class="text-bold">Natija: {{ number_format(($e1+$e2+$o)*100/$max,1) }} %</h3>
      <br />    
      <h4>Ona tili fani bo'yicha umumiy natijalar 3 kun ichida eʼlon qilinadi!</h4>
    </div>         
    @endif
</div>
@endsection


