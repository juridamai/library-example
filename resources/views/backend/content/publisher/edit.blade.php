@extends('backend/layout/main')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Form Ubah Penerbit</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{route('publisher.update')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" value="{{$publisher->name}}" class="form-control @error('name') is-invalid @enderror" >
                        @error('name')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="address" value="{{$publisher->address}}" class="form-control @error('address') is-invalid @enderror" >
                        @error('address')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>

                    <input type="hidden" name="id" value="{{$publisher->id}}">
                    <button type="submit" class="btn btn-primary">Ubah</button>

                    <a href="{{route('publisher.index')}}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

@endsection
