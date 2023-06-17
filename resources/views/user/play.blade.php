@extends('user.header')

@section('css')
  <link rel="stylesheet" href="{{ URL::asset('css/tests.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection


@section('section')
@if ($exam[0]->science_id == 10)
<input type="hidden" value="{{ $sec = 10800 }}">
    <div class="container mt-lg-5 mb-lg-5 pb-4 pl-lg-5">
        <div class="text-danger" id="timer"></div><h1 class="title">{{ $name }}</h1>
        <form action="{{ route('check_test') }}" id ="myquiz" enctype="multipart/form-data" method="POST">
            @csrf
            <input type="hidden" name="exam_id" value="{{ $exam[0]->id }}">
            <input type="hidden" name="science_id" value="{{ $exam[0]->science_id }}">
            @foreach ($quizzes as $id => $quiz)
                <div id="quiz">
                    <div class="question">
                        <p><b>{{ $id+1 }}.</b> {{ $quiz->quiz }}</p>
                        @if ($quiz->photo != "no_photo")
                            <img id="q2a" src="../quiz_images/{{ $quiz->photo }}" class="w-100"/>
                        @endif
                    </div>

                    @if ($quiz->type == 'close')
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1{{ $id }}">Javobingiz</label>
                                <textarea name="close{{ $id+1 }}" class="form-control" id="exampleFormControlTextarea1{{ $id }}" rows="3">...</textarea>
                            </div>
                            <input type="hidden" name="close_id{{ $id+1 }}" value="{{ $quiz->id }}">
                    @else

                        @foreach ($answers[$id] as $answer)
                            @if ($answer->photo != "no_photo")
                            <label>
                                <input type="radio"  value="{{ $answer->id }}" name="four{{ $id+1 }}" id="q2a"> {{ $answer->answer }} <img src="../answer_images/{{ $answer->photo }}"/>          
                            </label><br>
                            @else
                                <label>
                                    <input type="radio"  value="{{ $answer->id }}" name="four{{ $id+1 }}" id="q3a"> {{ $answer->answer }}
                                </label><br>
                            @endif
                        @endforeach

                    @endif
            @endforeach
                </div>
                <div class="col">
                    <button id="submit" type="submit">Testni yakunlash</button>
                </div>
        </form>
    </div>
@else
<input type="hidden" value="{{ $sec = 9000 }}">
<div class="container mt-lg-5 mb-lg-5 pb-4 pl-lg-5">
    <div class="text-danger"  id="timer"></div><h1 class="title">{{ $name }} </h1>
    <form action="{{ route('check_test') }}" id ="myquiz" enctype="multipart/form-data" method="POST">
        @csrf
        <input type="hidden" name="exam_id" value="{{ $exam[0]->id }}">
        <input type="hidden" name="science_id" value="{{ $exam[0]->science_id }}">
        @foreach ($four_quizzes as $id => $quiz)
            <div id="quiz">
                <div class="question">
                <p><b>{{ $id+1 }}.</b> {{ $quiz->quiz }}</p>
                @if ($quiz->photo != "no_photo")
                    <img id="q2a" src="../quiz_images/{{ $quiz->photo }}" class="w-100"/>
                @endif
                </div>
                @foreach ($four_answers[$id] as $answer)
                    @if ($answer->photo != "no_photo")
                    <label>
                        <input type="radio" value="{{ $answer->id }}" name="four{{ $id+1 }}" id="q2a"> {{ $answer->answer }} <img src="../answer_images/{{ $answer->photo }}"/>          
                      </label><br>
                    @else
                        <label>
                            <input type="radio" value="{{ $answer->id }}" name="four{{ $id+1 }}" id="q3a"> {{ $answer->answer }}
                        </label><br>
                    @endif
                @endforeach
            </div>
        @endforeach


        @foreach ($six_quizzes as $id => $quiz)
            <div id="quiz">
                <div class="question">
                <p><b>{{ $id+33 }}.</b> {{ $quiz->quiz }}</p>
                @if ($quiz->photo != "no_photo")
                    <img id="q2a" src="../quiz_images/{{ $quiz->photo }}" class="w-100"/>
                @endif
                </div>
                @foreach ($six_answers[$id] as $answer)
                    @if ($answer->photo != "no_photo")
                    <label>
                        <input type="radio"  value="{{ $answer->id }}" name="four{{ $id+33 }}" id="q2a"> {{ $answer->answer }} <img src="../answer_images/{{ $answer->photo }}"/>          
                      </label><br>
                    @else
                        <label>
                            <input type="radio"  value="{{ $answer->id }}" name="four{{ $id+33 }}" id="q3a"> {{ $answer->answer }}
                        </label><br>
                    @endif
                @endforeach
            </div>
        @endforeach


        @foreach ($close_quizzes as $id => $quiz)
            <div id="quiz">
                <input type="hidden" name="close_id{{ $id+1 }}" value="{{ $quiz->id }}">
                <div class="question">
                <p><b>{{ $id+36 }}.</b> {{ $quiz->quiz }}</p>
                @if ($quiz->photo != "no_photo")
                    <img id="q2a" src="../quiz_images/{{ $quiz->photo }}" class="w-100"/>
                @endif
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1{{ $id }}">a:</label>
                    <textarea name="a{{ $id+1 }}" class="form-control mb-1" id="exampleFormControlTextarea1{{ $id }}" rows="1"></textarea>
                    <label for="exampleFormControlTextarea12{{ $id }}">b:</label>
                    <textarea name="b{{ $id+1 }}" class="form-control" id="exampleFormControlTextarea12{{ $id }}" rows="1"></textarea>
                </div>
            </div>
        @endforeach
        <div class="col">
            <button id="submit" type="submit">Testni yakunlash</button>
        </div>
    </form>
</div>
    
@endif
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
