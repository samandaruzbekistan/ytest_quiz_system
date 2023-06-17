@extends('admin.header')

@section('section')
    <div class="container-fluid">


        <div class="card shadow mb-4">
            <div class="card-header py-3">Milliy sertifikat fanlari ro'yhati </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive mt-4">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>USER ID</th>
                            <th>Fan nomi</th>
                            <th>Ball</th>
                            <th>Tekshirish</th>
                            <th>Umumiy ball</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($exams))
                        @foreach($exams as $id => $item)
                            <tr>
                                <td>{{ $id+1 }}</td>
                                <td>{{ $item->user_id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->ball }}</td>
                                <td><a href="{{ route('admin_check',['exam_id'=> $item->id]) }}"><i class="fa fa-eye"></a></td>
                                <td>{{ $item->total }}</td>
                            </tr>
                        @endforeach

                        </tbody>

                        @endif
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

