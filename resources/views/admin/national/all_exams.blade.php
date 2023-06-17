@extends('admin.header')

@section('section')
    <div class="container-fluid">


        <div class="card shadow mb-4">
            <div class="card-header py-3">Milliy sertifikat fanlari ro'yhati </h6>
            </div>
            <div class="card-body">
                <button id="tugma" onclick="openForm()" class="btn btn-primary">Yangi fan +</button>
                <form id="forma" style="display: none" action="{{ route('new-national') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-6">
                            <input required name="name" type="text" class="form-control" placeholder="Fan nomi...">
                        </div>
                        <div class="col-3">
                            <input required name="price" type="number" class="form-control" placeholder="Narxi...">
                        </div> 
                        <button type="submit" class="btn btn-primary">Kiritish</button>
                    </div>
                </form>
                <div class="table-responsive mt-4">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Fan nomi</th>
                            <th>Narxi</th>
                            <th>Savollari</th>
                            <th><i class="fas fa-fw fa-cog"></i></th>
                            <th><i class="fas fa-fw fa-cog"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($subjects))
                        @foreach($subjects as $id => $item)
                            <tr>
                                <td>{{ $id+1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}</td>
                                <th><a href="{{ route('national_view',['id'=>$item->id]) }}"><i class="fas fa-eye"></i></a></th>
                                <td><a href="{{ route('edit_n',['id'=>$item->id]) }}"><i class="fa fa-edit"></i></a></td>
                                <td>
                                    <form action="{{ route('national_delete') }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button type="submit" class="btn text-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
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

