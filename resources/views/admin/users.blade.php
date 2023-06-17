@extends('admin.header')

@section('section')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Majburiy <i class="text-success">@if(!empty(session('name'))) {{ session('name') }}@endif</i> fani savollari</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>F.I.Sh</th>
                            <th>Phone</th>
                            <th>Balans</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $id => $item)
                            <tr>
                                <td>{{ $id+1 }}</td>
                                <td>{{ $item->full_name }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->money }}</td>
                                <td>
                                    <button class="btn btn-primary" id="btn{{ $id+1 }}"  onclick="showForm{{ $id+1 }}()">Edit</button>
                                    <form class="form-inline" action="{{ route('update_money') }}" id="form{{ $id+1 }}" style="display: none" method="POST">
                                        @csrf
                                        <div class="form-group mx-sm-3 mb-2">
                                            <input type="hidden" name="user_id" value="{{ $item->id }}">
                                            <input type="number" class="form-control" name="amount" placeholder="Summa...">
                                            <button type="submit" class="ml-1 btn btn-success"><i class="fa fa-check"></i></button>
                                        </div>
                                    </form>
                                </td> 
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $users->links() !!}
                </div>
            </div>
            
        </div> 
    </div>
    
@endsection

@push('script')
    <script type="text/javascript">
    @foreach ($users as $id => $item)
        function showForm{{ $id+1 }}() {
            document.getElementById('form{{ $id+1 }}').style.display = "block"
            document.getElementById('btn{{ $id+1 }}').style.display = "none"
        }
    @endforeach
    </script>
@endpush
