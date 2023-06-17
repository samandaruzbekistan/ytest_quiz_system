@extends('admin.header')

@section('section')
    <div class="container">
        <form action="{{ route('new_direct_reg') }}" method="POST">
            @csrf
            <h4>Yangi yo'nalish</h4>
            <div class="form-group">
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nomi...">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Universitet</label>
                <select name="university_id" class="form-control" id="exampleFormControlSelect1">
                    <option value="0">Tanlanmagan</option>
                    @foreach($uni as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
            <label for="exampleFormControlSelect1">Birinchi fan</label>
            <select name="first_subject" class="form-control" id="exampleFormControlSelect1">
                <option disabled selected value="0">Tanlanmagan</option>
                @foreach($all_subject as $item)
                    <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->lang }})</option>
                @endforeach
            </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Ikkinchi fan</label>
                <select name="second_subject" class="form-control" id="exampleFormControlSelect1">
                    <option disabled selected value="0">Tanlanmagan</option>
                    @foreach($all_subject as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->lang }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="grand" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Grand ball ...">
            </div>
            <div class="form-group">
                <input type="text" name="kontrakt" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Kontrakt ball ...">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Talim tili</label>
                <select name="lang" class="form-control" id="exampleFormControlSelect1">
                    <option>uz</option>
                    <option>ru</option>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Talim turi</label>
                <select name="type" class="form-control" id="exampleFormControlSelect1">
                    <option value="1">Kunduzgi</option>
                    <option value="2">Sirtqi</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Kiritish</button>
        </form>
    </div>

@endsection
