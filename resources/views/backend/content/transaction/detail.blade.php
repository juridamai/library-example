@extends('backend/layout/main')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Detail Transaksi</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label">Nama</label>
                    <label class="col-sm-8 col-form-label">{{$transaction->customer->name}}</label>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label">Tanggal</label>
                    <label class="col-sm-8 col-form-label">{{dateFormat($transaction->date)}}</label>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label">Waktu</label>
                    <label class="col-sm-8 col-form-label">{{timeFormat($transaction->date)}}</label>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label">Status</label>
                    <label class="col-sm-8 col-form-label">{{($transaction->status == 1)?"Belum dikembalikan" : "Sudah kembali"}}</label>
                </div>
                <p>&nbsp;</p>
                <h5>Buku yang dipinjam</h5>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Buku</th>
                        <th>Qty</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($transaction->item as $key => $row)
                        <tr>
                            <td>{{$row->book->title}}</td>
                            <td>{{$row->qty}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <p>&nbsp;</p>

                @if($transaction->status == 1)
                    <form action="{{route('transaction.return')}}" method="post" class="d-inline">
                        @csrf
                        <input type="hidden" name="id" value="{{$transaction->id}}">
                        <button type="submit" onclick="return confirm('Anda yakin mengembalikan?')" class="btn btn-sm btn-primary"><i class="fa fa-retweet"></i> Kembalikan</button>
                    </form>
                @endif

                <a href="{{route('transaction.index',$transaction->id)}}" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-circle-left"></i> Kembali</a>

            </div>
        </div>
    </div>

@endsection
