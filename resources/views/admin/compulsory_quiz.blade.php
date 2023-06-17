@extends('admin.header')

@section('section')
    <div class="container">
            <h5><i class="text-danger"><b>Savol:</b></i> {{ $quiz->quiz }}</h5>
        @if($quiz->photo != "no_photo")
            <img src="{{ asset('quiz_images/'.$quiz->photo) }}" class="w-50">
        @endif
<hr>
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
    </div>
@endsection
