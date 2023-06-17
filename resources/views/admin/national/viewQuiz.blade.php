@extends('admin.header')

@section('section')
    <div class="container">
        <h5><i class="text-danger"><b>Savol:</b></i> {{ $quiz->quiz }}</h5>
        @if($quiz->photo != "no_photo")
            <img src="{{ asset('quiz_images/'.$quiz->photo) }}" class="w-50">
        @endif
        <hr>
        @if($quiz->type == "close")
            <h5><i class="text-danger">To'g'ri javob:</i> {{ $answers[0]->answer }}</h5>
        @elseif($quiz->type == "two")
        <h5><i class="text-danger">Ball 1:</i> {{ $quiz->ball }}</h5>
        <h5><i class="text-danger">Ball 2:</i> {{ $quiz->ball2 }}</h5>
        <h5><i class="text-danger">To'g'ri javob 1:</i> {{ $answers[0]->answer }}</h5>
        <h5><i class="text-danger">To'g'ri javob 2:</i> {{ $answers[1]->answer }}</h5>
        @else
        @foreach($answers as $item)
            @if($item->correct == 1)
                <h5><i class="text-danger"><b>To'gri javob:</b></i> {{ $item->answer }}</h5>
                @if($item->photo != "no_photo")
                    <img src="{{ asset('answer_images/'.$item->photo) }}" class="w-25">
                @endif
            @else
                <h5><i class="text-primary"><b>Noto'gri javob:</b></i> {{ $item->answer }}</h5>
                @if($item->photo != "no_photo")
                    <img src="{{ asset('answer_images/'.$item->photo) }}" class="w-25">
                @endif
            @endif
            <hr>
        @endforeach
        @endif
    </div>
@endsection
