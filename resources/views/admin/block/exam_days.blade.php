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
@elseif (session('error_date1') == "1")
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Xatolik!</strong> Oxirgi imtihon vaqti o'tgandan so'ng yangi sana kirita olasiz.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">Tashkillashtirilgan imtihonlar</h6>
            </div>
            <div class="card-body">
                <button id="tugma" onclick="openForm()" class="btn btn-primary">Yangi imtihon +</button>
                <form id="forma" style="display: none" action="{{ route('new-block-day') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-6">
                            <input required name="date" type="date" class="form-control" placeholder="Fan nomi...">
                        </div>
                        <button type="submit" class="btn btn-primary">Kiritish</button>
                    </div>
                </form>
                <div class="table-responsive mt-4">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Imtixon kuni</th>
                            <th>Sotuvlar soni</th>
                            <th>Summa</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($exam_days as $id => $item)
                            <tr>
                                <td>{{ $id+1 }}</td>
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->count }}</td>
                                <td>{{ $item->price }} so'm</td>
                                <td><a href="{{ route('edit_exam_day', ['id' => $item->id]) }}">Edit</a></td>
                            </tr>
                        @endforeach

                        </tbody>

                      
                    </table>

                </div>
            </div>
        </div>

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

