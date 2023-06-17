@extends('user.header')

@section('css')
  <link rel="stylesheet" href="{{ URL::asset('css/result.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}" />
@endsection
@section('section')
<h2 class="text-dark">Test natijasi</h2>
<div class="table-wrapper">
    <table class="fl-table">
        <thead>
        <tr>
          <th>Fan</th>
          <th>Ball</th>
          <th>To'gri javob</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <th>Matematika</th>
                <th>{{ $a1 }}</th>
                <th>{{ $a1/1.1 }} ta</th>
            </tr>
            <tr>
                <th>Tarix</th>
                <th>{{ $a2 }}</th>
                <th>{{ $a2/1.1 }} ta</th>
            </tr>
            <tr>
                <th>Ona tili</th>
                <th>{{ $a3 }}</th>
                <th>{{ $a3/1.1 }} ta</th>
            </tr>
            <tr>
                <th>{{ $exam->s_name_1 }}</th>
                <th>{{ $a4 }}</th>
                <th>{{ $a4/3.1 }} ta</th>
            </tr>
            <tr>
                <th>{{ $exam->s_name_2 }}</th>
                <th>{{ $a5 }}</th>
                <th>{{ $a5/3.2 }} ta</th>
            </tr>
        <tbody>
    </table>
</div>

<div class="table-wrapper">
    <table class="fl-table">
        <tbody>
            <tr>
                <th>Ta'lim turi</th>
                <th>
                    @if ($exam->type == 1)
                        Kunduzgi
                    @else
                        Sirtqi
                    @endif
                </th>
            </tr>
            <tr>
                <th>Ta'lim tili</th>
                <th>
                    @if ($exam->lang == "uz")
                        O'zbek tili
                    @else
                        Rus tili
                    @endif
                </th>
            </tr>
            <tr>
                <th>Umumiy ball</th>
                <th>{{ $exam->total }}</th>
            </tr>
        <tbody>
    </table>
</div>

    <h2 class="text-dark">O'tgan yilgi natija bilan solishtirma</h2>
<div class="table-wrapper">
    <table class="fl-table">
        <thead>
        <tr>
          <th>Yo'nalish</th>
          <th>Grand</th>
          <th>Kontrakt</th>
          <th>Natija</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <th>{!! $exam->dir1 !!}</th>
                <th>{{ $exam->ball1 }}</th>
                <th>{{ $exam->kontrakt1 }}</th>
                <th>{{ $bir }}</th>
            </tr>
            <tr>
                <th>{!! $exam->dir2 !!}</th>
                <th>{{ $exam->ball2 }}</th>
                <th>{{ $exam->kontrakt2 }}</th>
                <th>{{ $ikki }}</th>
            </tr>
            <tr>
                <th>{!! $exam->dir3 !!}</th>
                <th>{{ $exam->ball3 }}</th>
                <th>{{ $exam->kontrakt3 }}</th>
                <th>{{ $uch }}</th>
            </tr>
            <tr>
                <th>{!! $exam->dir4 !!}</th>
                <th>{{ $exam->ball4 }}</th>
                <th>{{ $exam->kontrakt4 }}</th>
                <th>{{ $tort }}</th>
            </tr>
            <tr>
                <th>{!! $exam->dir5 !!}</th>
                <th>{{ $exam->ball5 }}</th>
                <th>{{ $exam->kontrakt5 }}</th>
                <th>{{ $besh }}</th>
            </tr>
        <tbody>
    </table>
</div>
@endsection