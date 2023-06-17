@extends('admin.header')

@section('section')
    <form action="{{ route('n_checked') }}" method="post">
        @csrf
        <input type="hidden" name="exam_id" value="{{ $exam_id }}">
        @foreach ($quizzes as $id => $item)
            <b>{{ $item->quiz }}</b>
            <p><b>Javob:</b> {{ $answers[$id]->answer }}</p>
            @if ($answers[$id]->photo != "no_photo")
                <img class="w-75" src="../temp_images/{{ $answers[$id]->photo }}">
            @endif
            <input class="form-control col-3" type="text" name="answer{{ $id }}" placeholder="ball..." value="0"><br>
            <hr>
        @endforeach
        <input type="submit" class="btn btn-primary" value="Tekshirildi">
    </form>

@endsection


