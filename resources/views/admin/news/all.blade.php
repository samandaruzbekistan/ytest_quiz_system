@extends('admin.header')

@section('section')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">Yangiliklar ro'yhati </h6>
            </div>
            <div class="card-body">
                <div class="dropdown">
                    <a href="{{ route('new_form') }}" class="btn btn-primary">Yangilik qo'shish +</a>
                <div class="table-responsive mt-4">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Sarlavha</th>
                            <th><i class="fas fa-fw fa-cog"></i></th>
                            <th><i class="fas fa-fw fa-cog"></i></th>
                            <th><i class="fas fa-fw fa-cog"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($news as $id => $item)
                            <tr>
                                <td>{{ $id+1 }}</td>
                                <td>{{ $item->title }}</td>
                                <td><a class="text-info" href="{{ route('news_view', ['id' => $item->id]) }}"><i class="fa fa-eye"></i></a></td>
                                <td><a class="text-warning" href="{{ route('news_edit', ['id' => $item->id]) }}"><i class="fa fa-edit"></i></a></td>
                                <td>
                                    <form action="{{ route('news_delete') }}" method="POST">
                                        {{-- @method('delete') --}}
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button type="submit" class="btn text-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        {{ $news->links() }}
                    </table>

                </div>
            </div>
        </div>

    </div>

@endsection


