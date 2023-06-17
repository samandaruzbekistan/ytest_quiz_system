@extends('user.header')
@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/tests.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/header.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection
@section('section')
<input type="hidden" value="{{ $sec = 10800 }}">
<div class="container mt-lg-5 mb-lg-5 pb-4 pl-lg-5 bg-light">
   <div class="text-danger" id="timer"></div>
   <h1 class="title">Abiturent uchun dignostik test</h1>
   <form action="{{ route('check_block') }}" id ="myquiz" enctype="multipart/form-data" method="POST">
      @csrf
      <input type="hidden" name="exam_id" value="{{ $exam->id }}">
      <h5 class="text-success">Matematika - majburiy</h5>
      @foreach ($first as $id => $quiz)
        <div id="quiz">
            <div class="question">
                <p><b>{{ $id+1 }}.</b> {{ $quiz->quiz }}</p>
                @if ($quiz->photo != "no_photo")
                <img src="../quiz_images/{{ $quiz->photo }}" class="w-100"/>
                @endif
            </div>
            @foreach ($a1[$id] as $answer)
                @if ($answer->photo != "no_photo")
                    <label>
                    <input type="radio" value="{{ $answer->id }}" name="four{{ $id+1 }}"> {{ $answer->answer }} <img src="../answer_images/{{ $answer->photo }}"/>          
                    </label><br>
                @else
                    <label>
                    <input type="radio" value="{{ $answer->id }}" name="four{{ $id+1 }}"> {{ $answer->answer }}
                    </label><br>
                @endif
            @endforeach
        </div>
      @endforeach
      <h5 class="mt-3 text-success">Tarix - majburiy</h5>
      @foreach ($second as $id => $quiz)
        <div id="quiz">
            <div class="question">
                <p><b>{{ $id+1 }}.</b> {{ $quiz->quiz }}</p>
                @if ($quiz->photo != "no_photo")
                <img src="../quiz_images/{{ $quiz->photo }}" class="w-100"/>
                @endif
            </div>
            @foreach ($a2[$id] as $answer)
                @if ($answer->photo != "no_photo")
                    <label>
                    <input type="radio" value="{{ $answer->id }}" name="four{{ $id+11 }}"> {{ $answer->answer }} <img src="../answer_images/{{ $answer->photo }}"/>          
                    </label><br>
                @else
                    <label>
                    <input type="radio" value="{{ $answer->id }}" name="four{{ $id+11 }}"> {{ $answer->answer }}
                    </label><br>
                @endif
            @endforeach
        </div>
      @endforeach
      <h5 class="mt-3 text-success">Ona tili - majburiy</h5>
      @foreach ($third as $id => $quiz)
        <div id="quiz">
            <div class="question">
                <p><b>{{ $id+1 }}.</b> {{ $quiz->quiz }}</p>
                @if ($quiz->photo != "no_photo")
                <img src="../quiz_images/{{ $quiz->photo }}" class="w-100"/>
                @endif
            </div>
            @foreach ($a3[$id] as $answer)
                @if ($answer->photo != "no_photo")
                    <label>
                    <input type="radio" value="{{ $answer->id }}" name="four{{ $id+21 }}"> {{ $answer->answer }} <img src="../answer_images/{{ $answer->photo }}"/>          
                    </label><br>
                @else
                    <label>
                    <input type="radio" value="{{ $answer->id }}" name="four{{ $id+21 }}"> {{ $answer->answer }}
                    </label><br>
                @endif
            @endforeach
        </div>
      @endforeach
      <h5 class="mt-3 text-success">{{ $name1 }} - tanlov fan</h5>
      @foreach ($four as $id => $quiz)
        <div id="quiz">
            <div class="question">
                <p><b>{{ $id+1 }}.</b> {{ $quiz->quiz }}</p>
                @if ($quiz->photo != "no_photo")
                <img src="../quiz_images/{{ $quiz->photo }}" class="w-100"/>
                @endif
            </div>
            @foreach ($a4[$id] as $answer)
                @if ($answer->photo != "no_photo")
                    <label>
                    <input type="radio" value="{{ $answer->id }}" name="four{{ $id+31 }}"> {{ $answer->answer }} <img src="../answer_images/{{ $answer->photo }}"/>          
                    </label><br>
                @else
                    <label>
                    <input type="radio" value="{{ $answer->id }}" name="four{{ $id+31 }}"> {{ $answer->answer }}
                    </label><br>
                @endif
            @endforeach
        </div>
      @endforeach
      <h5 class="mt-3 text-success">{{ $name2 }} - tanlov fan</h5>
      @foreach ($five as $id => $quiz)
        <div id="quiz">
            <div class="question">
                <p><b>{{ $id+1 }}.</b> {{ $quiz->quiz }}</p>
                @if ($quiz->photo != "no_photo")
                <img src="../quiz_images/{{ $quiz->photo }}" class="w-100"/>
                @endif
            </div>
            @foreach ($a5[$id] as $answer)
                @if ($answer->photo != "no_photo")
                    <label>
                    <input type="radio" value="{{ $answer->id }}" name="four{{ $id+61 }}"> {{ $answer->answer }} <img src="../answer_images/{{ $answer->photo }}"/>          
                    </label><br>
                @else
                    <label>
                    <input type="radio" value="{{ $answer->id }}" name="four{{ $id+61 }}"> {{ $answer->answer }}
                    </label><br>
                @endif
            @endforeach
        </div>
      @endforeach
</div>
<div class="col">
<button id="submit" type="submit">Testni yakunlash</button>
</div>
</form>
</div>
@endsection
@push('script')
<script>
   function formatTime(seconds) {
       var h = Math.floor(seconds / 3600),
           m = Math.floor(seconds / 60) % 60,
           s = seconds % 60;
       if (h < 10) h = "0" + h;
       if (m < 10) m = "0" + m;
       if (s < 10) s = "0" + s;
       return h + ":" + m + ":" + s;
   }
   
   var count = {{ $sec }};
   var counter = setInterval(timer, 1000);
   
   function timer() {
       count--;
       if (count < 0){
           document.getElementById('submit').click();
       }
       document.getElementById('timer').innerHTML = formatTime(count);
   }
</script>
@endpush