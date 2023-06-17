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
                            <th>Savol</th>
                            <th><i class="fas fa-fw fa-cog"></i></th>
                            <th><i class="fas fa-fw fa-cog"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($quizzes as $id => $item)
                        <tr>
                            <td>{{ $id+1 }}</td>
                            <td>{{ $item->quiz }}</td>
                            <td><a class="text-info" href="{{ route('compulsory_view',['id' => $item->id]) }}"><i class="fa fa-eye"></i></a></td>
                            <td>
                            <form action="{{ route('compulsory_delete') }}" method="POST">
                                @method('delete')
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="hidden" name="subject_id" value="{{ $subject_id }}">
                                <button type="submit" class="btn text-danger"><i class="fa fa-trash"></i></button>
                            </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="{{ route('new_compulsory_quiz',['subject_id'=>$subject_id]) }}">Yangi savol</a>
                </div>
            </div>
        </div>

    </div>

@endsection
