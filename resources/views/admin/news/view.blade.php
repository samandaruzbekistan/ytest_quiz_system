@extends('admin.header')

@section('section')
    <div class="container">
        <h3 class="text-dark">{{ $new->title }}</h3>
        <img src="../news_images/{{ $new->photo }}" class="w-75" alt="Yuklanmagan">
        <p class="text-dark">{{ $new->body }}</p>

    </div>
@endsection
