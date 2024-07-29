@extends('backend/layout/main')
@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-6">
                <h1 class="h3 mb-2 text-gray-800">List User</h1>
            </div>
            <div class="col-lg-6 text-right">
                <a class="btn btn-sm btn-primary" href="{{route('user.create')}}"><i class="fa fa-plus"></i> Tambah</a>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($user as $key => $row)
                            <tr>
                                <td>{{ ($user->currentpage()-1) * $user->perpage() + $key + 1 }}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>
                                    <a href="{{route('user.edit',$row->id)}}" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i> Ubah</a>
                                    <a href="{{route('user.destroy',$row->id)}}" class="btn btn-sm btn-secondary"
                                       onclick="return confirm('Anda yakin?')">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{$user->links('vendor.pagination.bootstrap-4')}}

                </div>
            </div>
        </div>
    </div>
@endsection
