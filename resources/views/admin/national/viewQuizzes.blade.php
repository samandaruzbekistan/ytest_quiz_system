@extends('admin.header')

@section('section')
<div class="container-fluid">


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="text-success">{{ $exam->name }}</i> fani savollari</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Savol</th>
                        <th>Savol turi</th>
                        <th>Ball</th>
                        <th><i class="fas fa-fw fa-cog"></i></th>
                        <th><i class="fas fa-fw fa-cog"></i></th>
                        <th><i class="fas fa-fw fa-cog"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quizzes as $id => $item)
                        <tr>
                            <td>{{ $id+1 }}</td>
                            <td>{{ $item->quiz }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->ball }}</td>
                            <td><a class="text-info" href="{{ route('n_quiz_view',['id' => $item->id]) }}"><i class="fa fa-eye"></i></a></td>
                            <td><a class="text-info" href="{{ route('n_quiz_edit',['id' => $item->id]) }}"><i class="fa fa-edit"></i></a></td>
                            <td>
                                <form action="{{ route('n_quiz_delete') }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <input type="hidden" name="subject_id" value="{{ $exam->id }}">
                                    <button type="submit" class="btn text-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <button class="btn btn-primary" id="tugma" onclick="openForm()">Yangi savol</button>
                <a class="btn btn-secondary" style="display: none" id="forma" href="{{ route('new_n_quiz',['id'=>$exam->id,'type'=>'open']) }}">Yangi 4 talik savol</a>
                <a class="btn btn-info" style="display: none" id="forma2" href="{{ route('new_n_quiz',['id'=>$exam->id, 'type'=>'close']) }}">Yangi yopiq savol</a>
                <a class="btn btn-info" style="display: none" id="forma4" href="{{ route('new_n_quiz',['id'=>$exam->id, 'type'=>'two']) }}">Yangi 2 talik savol</a>
                <a class="btn btn-info" style="display: none" id="forma3" href="{{ route('new_n_quiz',['id'=>$exam->id, 'type'=>'six']) }}">Yangi 6 talik savol</a>
            </div>
        </div>
    </div>

</div>
@endsection

@push('script')
    <script type="text/javascript">
        function openForm() {
            document.getElementById('forma').style.display = "inline-block"
            document.getElementById('forma2').style.display = "inline-block"
            document.getElementById('forma3').style.display = "inline-block"
            document.getElementById('forma4').style.display = "inline-block"
            document.getElementById('tugma').style.display = "none"
        }
    </script>
@endpush
