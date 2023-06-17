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
<div class="container bg-light mt-3 p-3">
    @if (session('error') == '1')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Xatolik!</strong> Kerakli sozlamalar tanlanmagan.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <form action="{{ route('play_block') }}" method="POST">
        @csrf
        <h4 class="text-center">Ta'lim yo'nalishlarini tanlang</h4>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Ta'lim tili</label>
            </div>
            <select class="custom-select" name="lang" id="inputGroupSelect01">
                <option disabled selected>Tanlash...</option>
                <option value="uz">O'zbek</option>
                <option value="ru">Rus</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect">Ta'lim turi</label>
            </div>
            <select class="custom-select" name="type" id="inputGroupSelect">
                <option disabled selected>Tanlash...</option>
                <option value="1">Kunduzgi</option>
                <option value="2">Sirtqi</option>
            </select>
        </div>
        <div class="form-group">
          <label for="otm1">Birinchi OTM</label>
          <select class="form-control" id="otm1" name="otm1">
            <option value="no" disabled selected>Tanlash...</option>
            @foreach ($uni as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
            <label for="dir1">Birinchi yo'nalish</label>
            <select class="form-control" id="dir1" name="dir1"> 
              <option value="" disabled selected>Tanlash...</option>
            </select>
        </div>
        <hr style="display: none" class="bg-danger">
        <div id="second" class="form-group" style="display: none">
          <label for="otm2">Ikkinchi OTM</label>
          <select class="form-control" id="otm2" name="otm2">
            <option value="" disabled selected>Tanlash...</option>
            @foreach ($uni as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group" style="display: none" id="secondDir">
            <label for="dir2">Ikkinchi yo'nalish</label>
            <select class="form-control" id="dir2" name="dir2"> 
              <option value="" disabled selected>Tanlash...</option>
            </select>
        </div>
        <hr style="display: none" class="bg-danger">
        <div id="third" class="form-group" style="display: none">
            <label for="otm3">Uchinchi OTM</label>
            <select class="form-control" id="otm3" name="otm3">
              <option value="" disabled selected>Tanlash...</option>
              @foreach ($uni as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group" style="display: none" id="thirdDir">
              <label for="dir3">Uchinchi yo'nalish</label>
              <select class="form-control" id="dir3" name="dir3"> 
                <option value="" disabled selected>Tanlash...</option>
              </select>
          </div>
          <hr style="display: none" class="bg-danger">
          <div id="four" class="form-group" style="display: none">
            <label for="otm4">To'rtinchi OTM</label>
            <select class="form-control" id="otm4" name="otm4">
              <option value="" disabled selected>Tanlash...</option>
              @foreach ($uni as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group" style="display: none" id="fourDir">
              <label for="dir4">To'rtinchi yo'nalish</label>
              <select class="form-control" id="dir4" name="dir4"> 
                <option value="" disabled selected>Tanlash...</option>
              </select>
          </div>
          <hr style="display: none" class="bg-danger">
          <div id="five" class="form-group" style="display: none">
            <label for="otm5">Beshinchi OTM</label>
            <select class="form-control" id="otm5" name="otm5">
              <option value="" disabled selected>Tanlash...</option>
              @foreach ($uni as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group" style="display: none" id="fiveDir">
              <label for="dir5">Beshinchi yo'nalish</label>
              <select class="form-control" id="dir5" name="dir5"> 
                <option value="" disabled selected>Tanlash...</option>
              </select>
          </div>
          
          <input type="submit" style="background-color: #2bdd98; color: white" class="btn btn-lg btn-block" value='Imtixonni boshlash'>

      </form>
</div>

@endsection


@push('script')
<script type="text/javascript">
    
    $("#inputGroupSelect01").change(function(){
        $('#second').hide();
        $('#secondDir').hide();
        $('#third').hide();
        $('#thirdDir').hide();
        $('#four').hide();
        $('#fourDir').hide();
        $('#five').hide();
        $('#fiveDir').hide();
        $('.bg-danger').hide();
        $("#dir1").empty();
        $('#dir1').append('<option value="" disabled selected>Tanlash...</option>');
        $.ajax({
            url: "{{ route('add_session') }}?lang=" + $(this).val(),
            method: 'GET',
            success: function(data) {
                if (data.status != 200) 
                    alert('Til tanlamadi. Qayta urining!');
            }
        });
    });

    $("#inputGroupSelect").change(function(){
        $('#second').hide();
        $('#secondDir').hide();
        $('#third').hide();
        $('#thirdDir').hide();
        $('#four').hide();
        $('#fourDir').hide();
        $('#five').hide();
        $('#fiveDir').hide();
        $('.bg-danger').hide();
        $("#dir1").empty();
        $('#dir1').append('<option value="" disabled selected>Tanlash...</option>');
        $.ajax({
            url: "{{ route('add_session') }}?type=" + $(this).val(),
            method: 'GET',
            success: function(data) {
                if (data.status != 200) 
                    alert('Ta\'lim turi tanlamadi. Qayta urining!');
            }
        });
    });

    $("#otm1").change(function(){
        var otmID = this.value;
        $.ajax({
            url: "{{ route('get_dir') }}?otmID=" + $(this).val(),
            method: 'GET',
            success: function(data) {
                $("#dir1").empty();
                $('#dir1').append('<option value="" disabled selected>Tanlash...</option>');
                $.each(data, function(key, value){
                    $('#dir1').append('<option value="' + value.id+ '">' + value.name + '</option>');
                });
            }
        });
    });

    $("#dir1").change(function(){
        var dirID = this.value;
        $('#second').show();
        $('#secondDir').show();
        $('#third').show();
        $('#thirdDir').show();
        $('#four').show();
        $('#fourDir').show();
        $('#five').show();
        $('#fiveDir').show();
        $('.bg-danger').show();
        $.ajax({
            url: "{{ route('set_dir') }}?dirID=" + $(this).val(),
            method: 'GET',
            success: function(data) {
                $("#otm2").empty();
                $('#otm2').append('<option value="" disabled selected>Tanlash...</option>');
                $.each(data, function(key, value){
                    $('#otm2').append('<option value="' + value.id+ '">' + value.name + '</option>');
                });

                $("#otm3").empty();
                $('#otm3').append('<option value="" disabled selected>Tanlash...</option>');
                $.each(data, function(key, value){
                    $('#otm3').append('<option value="' + value.id+ '">' + value.name + '</option>');
                });

                $("#otm4").empty();
                $('#otm4').append('<option value="" disabled selected>Tanlash...</option>');
                $.each(data, function(key, value){
                    $('#otm4').append('<option value="' + value.id+ '">' + value.name + '</option>');
                });

                $("#otm5").empty();
                $('#otm5').append('<option value="" disabled selected>Tanlash...</option>');
                $.each(data, function(key, value){
                    $('#otm5').append('<option value="' + value.id+ '">' + value.name + '</option>');
                });
            }
        });
    });

    $("#otm2").change(function(){
        var otmID = this.value;
        $.ajax({
            url: "{{ route('dirs') }}?otmID=" + $(this).val(),
            method: 'GET',
            success: function(data) {
                $("#dir2").empty();
                $('#dir2').append('<option value="" disabled selected>Tanlash...</option>');
                $.each(data, function(key, value){
                    $('#dir2').append('<option value="' + value.id+ '">' + value.name + '</option>');
                });
            }
        });
    });

    $("#otm3").change(function(){
        var otmID = this.value;
        $.ajax({
            url: "{{ route('dirs') }}?otmID=" + $(this).val(),
            method: 'GET',
            success: function(data) {
                $("#dir3").empty();
                $('#dir3').append('<option value="" disabled selected>Tanlash...</option>');
                $.each(data, function(key, value){
                    $('#dir3').append('<option value="' + value.id+ '">' + value.name + '</option>');
                });
            }
        });
    });

    $("#otm4").change(function(){
        var otmID = this.value;
        $.ajax({
            url: "{{ route('dirs') }}?otmID=" + $(this).val(),
            method: 'GET',
            success: function(data) {
                $("#dir4").empty();
                $('#dir4').append('<option value="" disabled selected>Tanlash...</option>');
                $.each(data, function(key, value){
                    $('#dir4').append('<option value="' + value.id+ '">' + value.name + '</option>');
                });
            }
        });
    });

    $("#otm5").change(function(){
        var otmID = this.value;
        $.ajax({
            url: "{{ route('dirs') }}?otmID=" + $(this).val(),
            method: 'GET',
            success: function(data) {
                $("#dir5").empty();
                $('#dir5').append('<option value="" disabled selected>Tanlash...</option>');
                $.each(data, function(key, value){
                    $('#dir5').append('<option value="' + value.id+ '">' + value.name + '</option>');
                });
            }
        });
    });

    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
@endpush