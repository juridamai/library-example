@extends('backend/layout/main')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Form Tambah Buku Baru</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{route('book.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Judul Buku" class="form-control @error('title') is-invalid @enderror" >
                        @error('title')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Terbit</label>
                        <input type="date" name="date_of_issue" value="{{ old('date_of_issue') }}" placeholder="Tanggal Terbit" class="form-control @error('date_of_issue') is-invalid @enderror" >
                        @error('date_of_issue')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stock" value="{{ old('stock') }}" placeholder="Stok" class="form-control @error('stock') is-invalid @enderror" >
                        @error('stock')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Penerbit</label>
                        <select class="form-control @error('publisher_id') is-invalid @enderror" name="publisher_id">
                            @foreach($publisher as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                        @error('publisher_id')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{route('book.index')}}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

@endsection
