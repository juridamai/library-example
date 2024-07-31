@extends('backend/layout/main')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->


        <div class="row">
            <div class="col-lg-6">
                <h1 class="h3 mb-2 text-gray-800">List Customer</h1>
            </div>
            <div class="col-lg-6 text-right">
                <a class="btn btn-sm btn-primary" href="{{route('customer.create')}}"><i class="fa fa-plus"></i> Tambah</a>
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
                            <th>Nomor</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($customer as $key => $row)
                            <tr>
                                <td>{{ ($customer->currentpage()-1) * $customer->perpage() + $key + 1 }}</td>
                                <td>{{$row->member_id}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{dateFormat($row->dob)}}</td>
                                <td>
                                    <a href="{{route('customer.edit',$row->id)}}" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i> Ubah</a>
                                    <a href="{{route('customer.destroy',$row->id)}}" class="btn btn-sm btn-secondary"
                                       onclick="return confirm('Anda yakin?')">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$customer->links('vendor.pagination.bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
@endsection
