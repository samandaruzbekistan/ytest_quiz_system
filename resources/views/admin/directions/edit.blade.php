@extends('admin.header')

@section('section')
    <div class="container">
        <form action="{{ route('dir_edit_save') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Nomi</label>
              <input required name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nomi.." value="{{ $dir->name }}">
            </div>
            <input type="hidden" name="id" value="{{ $dir->id }}">
            <hr>
            <label for="exampleInputEmail1">Universitet</label>
            {{-- <h4>Universitet</h4> --}}
            <select class="custom-select" name="uni_id">
              @foreach ($uni as $value)
                @if ($value->id == $dir->university_id)
                  <option selected value="{{ $value->id }}">{{ $value->name }}</option> 
                @else
                  <option value="{{ $value->id }}">{{ $value->name }}</option> 
                @endif
              @endforeach
              </select>
            <hr>
            <label for="exampleInputEmail1">Birinchi fan</label>
            <select class="custom-select" name="first_subject">
              @foreach ($all_subject as $value)
                @if ($value->id == $dir->first_subject_id)
                  <option selected value="{{ $value->id }}">{{ $value->name }}</option> 
                @else
                  <option value="{{ $value->id }}">{{ $value->name }}</option> 
                @endif
              @endforeach
              </select>     
              <hr>
              <label for="exampleInputEmail1">Ikkinchi fan</label>
            <select class="custom-select" name="second_subject">
              @foreach ($all_subject as $value)
                @if ($value->id == $dir->second_subject_id)
                  <option selected value="{{ $value->id }}">{{ $value->name }}</option> 
                @else
                  <option value="{{ $value->id }}">{{ $value->name }}</option> 
                @endif
              @endforeach
            </select>   
            <hr>
            <label for="exampleInputEmail1">Grand</label>
            <input required name="grand" type="text" class="form-control" placeholder="Ball" value="{{ $dir->grand }}">
            <hr>
            <label for="exampleInputEmail1">Kontrakt</label>
            <input required name="kontrakt" type="text" class="form-control" placeholder="Ball" value="{{ $dir->kontrakt }}">
            <hr>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Talim tili</label>
              <select name="lang" class="form-control" id="exampleFormControlSelect1">
                @if ($dir->lang == 'uz')
                <option selected>uz</option>
                <option>ru</option>
                @else
                <option>uz</option>
                <option selected>ru</option>
                @endif
                  
                  
              </select>
          </div>
<hr>
          <div class="form-group">
              <label for="exampleFormControlSelect1">Talim turi</label>
              <select name="type" class="form-control" id="exampleFormControlSelect1">
                @if ($dir->lang == 'uz')
                <option selected value="1">Kunduzgi</option>
                <option value="2">Sirtqi</option>
                @else
                <option value="1">Kunduzgi</option>
                <option selected value="2">Sirtqi</option>
                @endif
                  
                  
              </select>
          </div>
            <br>
            <button type="submit" class="btn btn-primary mt-3">Yuklash</button>
          </form>
    </div>

@endsection
