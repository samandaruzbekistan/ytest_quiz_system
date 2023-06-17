@extends('user.header')

@section('css')
  <link rel="stylesheet" href="{{ URL::asset('css/result.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}" />
@endsection
@section('section')
<h2 class="text-dark">Test natijalari</h2>
<div class="table-wrapper">
    <table class="fl-table">
        <thead>
        <tr>
          <th>Fan nomi</th>
          <th>Sana</th>
          <th>Y<sub>1</sub>(1-32)</th>
          <th>Y<sub>2</sub>(33-35)</th>
          <th>O(36-45)</th>
          <th>Ball</th>
          <th>Foiz</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($results as $item)
        @if ($item->science_id == 10)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->date }}</td>
            <td>{{ $item->ball }}</td>
            <td>{{ $item->six + $item->writing }}</td>
            <td>{{ $item->check_ball }}</td>
            <td>{{ $item->total }}</td>
            <td>{{ $item->total*100/120 }} %</td>
        </tr>
        @else
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->date }}</td>
            <td>{{ $item->ball }}</td>
            <td>{{ $item->six }}</td>
            <td>{{ $item->check_ball }}</td>
            <td>{{ $item->total }}</td>
            <td>{{ $item->total*100/100 }} %</td>
        </tr>
        @endif
        @endforeach
        <tbody>
    </table>
</div>
@endsection