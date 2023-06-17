@extends('admin.header')

@section('section')
    <form action="{{ route('new_compulsory_reg') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Fan nomi</label>
            <input required name="name" type="text" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Fan tili</label>
            <select required name="lang" class="form-control" id="exampleFormControlSelect1">
                <option>uz</option>
                <option>ru</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Kiritish</button>
    </form>

@endsection
