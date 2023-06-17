@extends('admin.header')

@section('section')
    <div class="container-fluid">


        <div class="card shadow mb-4">
            <div class="card-header py-3">Yo'nalishlar ro'yhati </h6>
            </div>
            <div class="card-body">
                <div class="dropdown">
                    <a href="{{ route('new_direct') }}" class="btn btn-primary">Yangi yo'nalish +</a>
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if(!empty(session('uni_id')))
                            @foreach($universities as $item)
                                @if($item->id == session('uni_id'))
                                    <a class="dropdown-item" href="{{ route('directFilter', ['id' => $item->id]) }}"><i class="fa fa-filter"></i> {{ $item->name }}</a>
                                @endif
                            @endforeach
                        @else
                            <i class="fa fa-filter"></i> Barchasi
                            @endif
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach($universities as $item)
                                <a class="dropdown-item" href="{{ route('directFilter', ['id' => $item->id]) }}">{{ $item->name }}</a>
                            @endforeach
                                <a class="dropdown-item" href="{{ route('directions') }}">Barchasi</a>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Yo'nalish nomi</th>
                            <th>Universitet</th>
                            <th>Fanlar</th>
                            <th>Grand</th>
                            <th>Kontrakt</th>
                            <th>Ta'lim tili</th>
                            <th><i class="fas fa-fw fa-cog"></i></th>
                            <th><i class="fas fa-fw fa-cog"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($directions as $id => $item)
                            <tr>
                                <td>{{ $id+1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->uni_name }}</td>
                                <td>1.{{ $item->first_subject_name }} <br> 2.{{ $item->second_subject_name }}</td>
                                <td>{{ $item->grand }}</td>
                                <td>{{ $item->kontrakt }}</td>
                                <td>{{ $item->lang }}</td>
                                <td><a href="{{ route('dir_edit', ['id' => $item->id]) }}"><i class="fa fa-edit"></a></td>
                                <td>
                                    <form action="{{ route('direct_delete') }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button type="submit" class="btn text-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        {{ $directions->links() }}
                    </table>

                </div>
            </div>
        </div>

    </div>

@endsection


