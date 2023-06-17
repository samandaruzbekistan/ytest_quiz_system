@extends('admin.header')

@section('section')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Narxlar</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nomi</th>
                            <th>Narxi</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $price->name }}</td>
                                <td>{{ $price->price }}</td>
                                <td>
                                    <button class="btn btn-primary" id="btn"  onclick="showForm()">Edit</button>
                                    <form class="form-inline" action="{{ route('update_price') }}" id="form" style="display: none" method="POST">
                                        @csrf
                                        <div class="form-group mx-sm-3 mb-2">
                                            <input type="hidden" name="id" value="{{ $price->id }}">
                                            <input type="number" class="form-control" name="amount" placeholder="Summa...">
                                            <button type="submit" class="ml-1 btn btn-success"><i class="fa fa-check"></i></button>
                                        </div>
                                    </form>
                                </td> 
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div> 
    </div>
    
@endsection

@push('script')
    <script type="text/javascript">
        function showForm() {
            document.getElementById('form').style.display = "block"
            document.getElementById('btn').style.display = "none"
        }
    </script>
@endpush
