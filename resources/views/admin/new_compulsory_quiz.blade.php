@extends('admin.header')

@section('section')
    <div class="container">
    <form action="{{ route('new_compulsory_quiz_reg') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Savol</label>
            <textarea name="quiz" class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
            <div class="custom-file mt-1">
                <input name="quiz_photo" type="file" class="custom-file-inputr" id="customFiler">
                <label class="custom-file-label" for="customFiler">Rasm tanlang</label>
            </div>
        </div>
        <input type="hidden" name="subject_id" value="{{ $subject_id }}">
        <div class="form-group">
            <label for="exampleFormControlTextarea1">A variant</label>
            <textarea name="a_answer" class="form-control" id="exampleFormControlTextarea1" rows="1"></textarea>
            <div class="custom-file mt-1">
                <input name="a_photo" type="file" class="custom-file-inputa" id="customFilea">
                <label class="custom-file-label" for="customFilea">Rasm tanlang</label>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">B variant</label>
            <textarea name="b_answer" class="form-control" id="exampleFormControlTextarea1" rows="1"></textarea>
            <div class="custom-file mt-1">
                <input name="b_photo" type="file" class="custom-file-inputb" id="customFileb">
                <label class="custom-file-label" for="customFileb">Rasm tanlang</label>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">C variant</label>
            <textarea name="c_answer" class="form-control" id="exampleFormControlTextarea1" rows="1"></textarea>
            <div class="custom-file mt-1">
                <input name="c_photo" type="file" class="custom-file-inputc" id="customFilec">
                <label class="custom-file-label" for="customFilec">Rasm tanlang</label>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">D variant</label>
            <textarea name="d_answer" class="form-control" id="exampleFormControlTextarea1" rows="1"></textarea>
            <div class="custom-file mt-1">
                <input name="d_photo" type="file" class="custom-file-inputd" id="customFiled">
                <label class="custom-file-label" for="customFiled">Rasm tanlang</label>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">To'g'ri javob</label>
            <select name="correct" class="form-control" id="exampleFormControlSelect1">
                <option>A</option>
                <option>B</option>
                <option>C</option>
                <option>D</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Kiritish</button>
    </form>
    </div>
@endsection
