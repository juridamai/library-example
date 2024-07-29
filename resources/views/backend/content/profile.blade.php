@extends('backend/layout/main')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Profile User</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" value="{{$user->name}}" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" value="{{$user->email}}" class="form-control" readonly>
                </div>

                <a href="{{route('dashboard.index')}}" class="btn btn-secondary">Kembali</a>

            </div>
        </div>
    </div>

@endsection
