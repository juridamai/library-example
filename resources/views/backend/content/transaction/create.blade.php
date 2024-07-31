@extends('backend/layout/main')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tambah Peminjaman Buku</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <form id="form-create" action="{{route('transaction.store')}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Pilih Customer:</label>
                            <select name="customer_id" class="form-control">
                                @foreach($customer as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr/>

                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" id="keyword" placeholder="Ketik kode buku disini..." class="form-control">
                        </div>
                    </div>
                    <p>&nbsp;</p>

                    <div class="row">
                        <div class="col-lg-12">
                            <label>Daftar buku yang dipinjam</label>

                            <table class="table" id="myTable">
                                <thead>
                                <tr>
                                    <th scope="col">Judul Buku</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p>&nbsp;</p>

                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="{{route('transaction.index')}}" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-circle-left"></i> Kembali</a>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
        $(function () {
            delInit();

            $('#keyword').keypress(function (e) {
                var key = e.which;
                if(key == 13)  // the enter key code
                {
                    e.preventDefault();
                    var keyword = $(this).val();

                    var url = window.base_url + "/admin/book/detail/" + keyword;

                    $.ajax({
                        type: 'GET',
                        url: url,
                        dataType: 'json',
                        success: function(data)
                        {
                            var rowCount = $('table tbody tr').length;
                            var markup = "<tr>";
                            markup += "<td>" + data['title'] + "</td>";
                            markup += "<td>1</td>";
                            markup += "<td><button type=\"button\" class=\"btn btn-danger btn-sm delete-row float-left\">Hapus</button></td>";
                            markup += "<input type=\"hidden\" name='send[" + (rowCount + 1) + "][book_id]' value='" + data['id'] + "'>";
                            markup += "</tr>";
                            $("table tbody").append(markup);
                            delInit();
                        }
                    });
                }
            });

            function delInit(){
                $(".delete-row").click(function () {
                    console.log("Delete")
                    $(this).parent().parent().remove();
                });
            }
        })


    </script>

@endsection
