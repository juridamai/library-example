@extends('backend/layout/main')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->


        <div class="row">
            <div class="col-lg-6">
                <h1 class="h3 mb-2 text-gray-800">List Buku</h1>
            </div>
            <div class="col-lg-6 text-right">
                <a class="btn btn-sm btn-primary" href="{{route('book.create')}}"><i class="fa fa-plus"></i> Tambah</a>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Tanggal Terbit</th>
                            <th>Stok</th>
                            <th>Penerbit</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($book as $key => $row)
                            <tr>
                                <td>{{ ($book->currentpage()-1) * $book->perpage() + $key + 1 }}</td>
                                <td>{{$row->code}}</td>
                                <td>{{$row->title}}</td>
                                <td>{{dateFormat($row->date_of_issue)}}</td>
                                <td>{{$row->stock}}</td>
                                <td>{{$row->publisher->name}}</td>
                                <td>
                                    <a href="{{route('book.edit',$row->id)}}" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i> Ubah</a>
                                    <a href="{{route('book.destroy',$row->id)}}" class="btn btn-sm btn-secondary" onclick="return confirm('Anda yakin?')"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$book->links('vendor.pagination.bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>

@endsection
