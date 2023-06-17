@extends('admin.header')

@section('section')
    <div class="container-fluid">
        <form method="post" action="{{ route('national_update') }}">
            @csrf
            <div class="form-group">
                <input name="id" type="hidden" value="{{ $subject->id }}">
                <label for="exampleInputEmail1">Fan nomi</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" value="{{ $subject->name }}" aria-describedby="emailHelp" placeholder="Fan nomi">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail12">Fan narxi</label>
                <input name="price" type="number" class="form-control" id="exampleInputEmail12" value="{{ $subject->price }}" aria-describedby="emailHelp" placeholder="Fan narxi">
            </div>
            <input type="submit" value="Yangilash" class="btn btn-primary">
        </form>

    </div>

@endsection

@push('script')
    <script type="text/javascript">
        function openForm() {
            document.getElementById('forma').style.display = "block"
            document.getElementById('tugma').style.display = "none"
        }
    </script>
@endpush

