@extends('backend/layout/main')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Form Ubah Customer</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{route('customer.update')}}" method="post">
                    @csrf


                    <div class="mb-3">
                        <label class="form-label">Nomor Anggota</label>
                        <input type="text" readonly value="{{$customer->member_id}}" placeholder="Nomor Anggota" class="form-control @error('member_id') is-invalid @enderror" >
                        @error('member_id')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" value="{{$customer->name}}" placeholder="Nama" class="form-control @error('name') is-invalid @enderror" >
                        @error('name')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="dob" value="{{$customer->dob}}" placeholder="Tanggal Lahir" class="form-control @error('dob') is-invalid @enderror" >
                        @error('dob')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>


                    <input type="hidden" name="id" value="{{$customer->id}}">
                    <button type="submit" class="btn btn-primary">Ubah</button>

                    <a href="{{route('customer.index')}}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

@endsection
