@extends('admin.header')

@section('section')
    <div class="container">
        <form action="{{ route('news_reg') }}" accept="image/*" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Sarlavha</label>
              <input required name="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Title..">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Yangilik</label>
                <textarea name="body" required class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="custom-file">
                <input name="photo" required type="file" class="custom-file-inputr" id="customFiler">
                <label class="custom-file-label" for="customFiler">Rasm</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary mt-3">Yuklash</button>
          </form>
    </div>

@endsection
