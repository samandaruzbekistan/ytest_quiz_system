@extends('admin.header')

@section('section')
    <div class="container">
        <form action="{{ route('news_edit_save') }}" accept="image/*" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Sarlavha</label>
              <input required name="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Title.." value="{{ $new->title }}">
            </div>
            <input type="hidden" name="id" value="{{ $new->id }}">
            <input type="hidden" name="photo_old" value="{{ $new->photo }}">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Yangilik</label>
                <textarea name="body" required class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $new->body }}</textarea>
            </div>
            <div class="custom-file">
                <input name="photo" type="file" class="custom-file-inputr" id="customFiler">
                <label class="custom-file-label" for="customFiler">Yangi rasm *ixtiyoriy</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary mt-3">Yuklash</button>
          </form>
    </div>

@endsection
