@extends('admin.header')

@section('section')
    <div class="container-fluid">
@if (session('error_date') == "1")
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Xatolik!</strong> Kiritilgan sana o'tib ketgan.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <form id="forma"action="{{ route('edit_exam_day_reg') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-6">
                            <input type="hidden" name="day_id" value="{{ $exam_day->id }}">
                            <input required name="date" type="date" class="form-control" value="{{ $exam_day->date }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Kiritish</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection



