@extends('admin.header')

@section('section')
    <div class="container-fluid">


        <div class="card shadow mb-4">
            <div class="card-header py-3">Universitetlar ro'yhati </h6>
            </div>
            <div class="card-body">
                <button id="tugma" onclick="openForm()" class="btn btn-primary">Yangi universitet +</button>
                <form id="forma" style="display: none" action="{{ route('new_uni_reg') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-6">
                            <input name="name" type="text" class="form-control" placeholder="Universitet nomi...">
                        </div>
                        <button type="submit" class="btn btn-primary">Kiritish</button>
                    </div>
                </form>
                <div class="table-responsive mt-4">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Universitet nomi</th>
                            <th><i class="fas fa-fw fa-cog"></i></th>
                            <th><i class="fas fa-fw fa-cog"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($uni as $id => $item)
                            <tr>
                                <td>{{ $id+1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td><a class="text-info" href=""><i class="fa fa-eye"></i></a></td>
                                <td>
                                    <form action="{{ route('deleteUni') }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button type="submit" class="btn text-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
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
