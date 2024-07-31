@extends('backend/layout/main')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->


        <div class="row">
            <div class="col-lg-6">
                <h1 class="h3 mb-2 text-gray-800">List Transaksi</h1>
            </div>
            <div class="col-lg-6 text-right">
                <a class="btn btn-sm btn-primary" href="{{route('transaction.create')}}"><i class="fa fa-plus"></i> Tambah</a>
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
                            <th>Customer</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($transaction as $key => $row)
                            <tr>
                                <td>{{ ($transaction->currentpage()-1) * $transaction->perpage() + $key + 1 }}</td>
                                <td>{{$row->customer->name}}</td>
                                <td>{{dateFormat($row->date)}} {{timeFormat($row->date)}}</td>
                                <td>{{dateFormat($row->date_must_return)}}</td>
                                <td>{{($row->status == 1)?"Belum dikembalikan" : "Sudah kembali"}}</td>
                                <td>
                                    <a href="{{route('transaction.detail',$row->id)}}" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i> Detail</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$transaction->links('vendor.pagination.bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
@endsection
