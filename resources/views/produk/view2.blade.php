<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


@extends('layoutsbootstrap')

@section('konten')
<!-- Begin Page Content -->

@if(isset($status_hapus))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Hapus Data Berhasil',
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        </script>
@endif

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pendapatan (Bulanan)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp 40,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pendapatan (Tahunan)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp 21   5,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Transaksi
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">500</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Perlu Diproses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <!-- Alert success -->
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <!-- Akhir alert success -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12 col-sm-12">
            <div class="card shadow mb-4">
                
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Produk</h6>
                    
                    <!-- Tombol Tambah Data -->
                    <a href="#" class="btn btn-primary btn-icon-split btn-sm tampilmodaltambah" data-toogle="modal" data-target="#ubahModal">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Data</span>
                    </a>
                    <!-- Akghir Tombol Tambah Data -->

                </div>
                <!-- Card Body -->
                <div class="card-body">
                        <div class="chart-area" hidden>
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    <!-- Awal Dari Tabel -->
                    <div class="table-responsive">
                        <!-- Untuk tempat menaruh tabel -->
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th style="text-align: center">Merek</th>
                                    <th>Id Toko</th>
                                    <th style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot class="thead-dark">
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th style="text-align: center">Merek</th>
                                    <th>Id Toko</th>
                                    <th style="text-align: center">Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                
                            </tbody>
                        </table>  
                    </div>
                    <!-- Akhir Dari Tabel -->
                </div>
            </div>
        </div>

        
    </div>

    
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- Modal Delete -->
    <script>
        function deleteConfirm(e){
            var tomboldelete = document.getElementById('btn-delete')  
            id = e.getAttribute('data-id');

            // const str = 'Hello' + id + 'World';
            var url3 = "{{url('produk/destroy/')}}";
            var url4 = url3.concat("/",id);
            // console.log(url4);

            // console.log(id);
            tomboldelete.setAttribute("href", url4); //akan meload kontroller delete

            var pesan = "Data dengan ID <b>"
            var pesan2 = " </b>akan dihapus"
            var res = id;
            document.getElementById("xid").innerHTML = pesan.concat(res,pesan2);

            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {  keyboard: false });
            
            myModal.show();
        
        }
    </script>
    <!-- Logout Delete Confirmation-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="xid"></div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
                
            </div>
            </div>
        </div>
    </div>   
<!-- Akhir Modal Delete -->

<!-- Ubah dan Tambah Data Menggunakan Modal -->
<div class="modal fade" id="ubahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="labelmodalubah">Ubah Data Produk</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
            </button>
        </div>
        
        <div class="modal-body">
            <!-- Form untuk input -->
            <form action="{{url('produk')}}" class="formubahproduk" method="post">
            @csrf
            <input type="hidden" id="idprodukhidden" name="idprodukhidden" value="">
            <input type="hidden" id="tipeproses" name="tipeproses" value="">
                <div class="mb-3 row">
                    <label for="nomerlabel" class="col-sm-4 col-form-label">Toko</label>
                        <div class="col-sm-8">
                            <select class="form-control" aria-label="Default select example" id="id_toko" name="id_toko">
                                @foreach ($toko as $p)
                                    <option value="{{$p->id_toko}}">{{$p->nama_toko}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback errorid_perusahaan"></div>
                        </div>    
                </div>

                <div class="mb-3 row">
                    <label for="nomerlabel" class="col-sm-4 col-form-label">Kode Produk</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="kode_produk" name="kode_produk" placeholder="Masukkan Kode Produk, cth: 111">
                        <div class="invalid-feedback errorkode_produk"></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="lantailabel" class="col-sm-4 col-form-label">Nama Produk</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Masukkan Nama Akun, cth: Tas travel">
                        <div class="invalid-feedback errornama_produk"></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="hargalabel" class="col-sm-4 col-form-label">Merek</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="merek" name="merek" placeholder="Masukkan Merek produk, cth: Adidas">
                        <div class="invalid-feedback errormerek"></div>
                    </div>
                </div>
            </div> 
            

            <div class="modal-footer">
            <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>   
<!-- Akhir Ubah dan Tambah Data Menggunakan Modal -->

<!-- Jquery Proses Ubah / Tambah Data -->
<!-- Modal Tambah Pop Up versi 2 -->

<!-- Ketika tombol dengan elemen id tampilmodaltambah ditekan -->
<script>
      $(function(){
            $('.tampilmodaltambah').on('click', function(){
              // merubah label menjadi Tambah Data Kamar
              $('#labelmodalubah').html('Tambah Data Produk');
              url = "{{url('produk')}}";
              $('.formubahproduk').attr('action',url);
              $('#dcoai').val(12);

              // kosongkan isi dari input form
              $('#kode_produk').val('');
              $('#merek').val('');
              $('#nama_produk').val('');
              $('#idprodukhidden').val('');
              $('#tipeproses').val('tambah'); //untuk identifikasi di controller apakah tambah atau update


                var data = {
                    'kode_produk': $('.kode_akun').val(),
                    'merek': $('.merek').val(),
                    'nama_produk': $('.nama_produk').val(),
                    'id_toko': $('.id_toko').val(),
                }  

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

              $('#ubahModal').modal('show');
              
            //   const id = $(this).data('id');
              $.ajax(
                {
                  
                    type: "post", //isinya put untuk update dan post untuk insert
                    url: "{{url('produk')}}",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        if (response.status == 400) {
                            if(response.errors.kode_produk){
                                $('#kode_produk').removeClass('is-valid').addClass('is-invalid');
                                $('.errorkode_produk').html(response.errors.kode_produk);
                            }else{
                                $('#kode_produk').removeClass('is-invalid').addClass('is-valid');
                                $('.errorkode_produk').html();
                            }

                            if(response.errors.nama_produk){
                                $('#nama_produk').removeClass('is-valid').addClass('is-invalid');
                                $('.errornama_produk').html(response.errors.nama_produk);
                            }else{
                                $('#nama_produk').removeClass('is-valid').removeClass('is-invalid').addClass('is-valid');
                                $('.errornama_produk').html();
                            }

                            if(response.errors.merek){
                                $('#merek').removeClass('is-valid').addClass('is-invalid');
                                $('.errormerek').html(response.errors.merek);
                            }else{
                                $('#merek').removeClass('is-invalid').addClass('is-valid');
                                $('.errormerek').html();
                            }

                            if(response.errors.id_toko){
                                $('#id_toko').removeClass('is-valid').addClass('is-invalid');
                                $('.errorid_toko').html(response.errors.id_toko);
                            }else{
                                $('#id_toko').removeClass('is-invalid').addClass('is-valid');
                                $('.errorid_toko').html();
                            }
                        } else {
                            
                            // munculkan pesan sukses
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.sukses,
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            });
                            
                            // kosongkan form
                            $('#ubahModal').modal('hide');
                            dataproduk(); //refresh data coa
                        }
                    }

                }
              ); 

            });
          }); 
</script>
<!-- Akhir Jquery Proses Ubah / Tambah Data -->

<!-- Ketika tombol dengan elemen class bernama  editbtn ditekan -->
<script>
      function updateConfirm(e){
        id = e.getAttribute('data-id');

        $('#labelmodalubah').html('Ubah Data Produk');
        url = "{{url('produk')}}";
        $('.formubahproduk').attr('action',url);
        $('#idprodukhidden').val(id);
        $('#tipeproses').val('ubah'); 
        $('#ubahModal').modal('show');

        var url3 = "{{url('produk/edit/')}}";
        var url4 = url3.concat("/",id);

         // menambahkan img
         const image = document.createElement('img')
         var urlgambarfix = urlgambar.concat("/",res); //menggabungkan url dengan data nama file
         var urlgambar = "{{url('picture/')}}";
         image.src = urlgambarfix
         image.width = "150";
         image.height = "100";
         document.querySelector('#avatar').appendChild(image);

        $.ajax({
            type: "GET",
            url: url4,
            success: function (response) {
                if (response.status == 404) {
                    // beri alert kalau gagal
                    Swal.fire({
                        title: 'Gagal!',
                        text: response.message,
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    });

                    $('#ubahModal').modal('hide');
                } else {
                    // console.log(response.coa.kode_akun);
                    $('#gambarlama').val(response.c[0].gambar);
                    $('#kode_akun').val(response.produk.kode_produk);
                    $('#nama_akun').val(response.produk.nama_produk);
                    $('#merek').val(response.produk.merek);
                    $('#id_toko').val(response.produk.id_toko);
                    $('#idprodukhidden').val(id)

                    // pastikan form is-invalid dikembalikan ke valid
                    $('#kode_produk').removeClass('is-invalid').addClass('is-valid');;
                    $('.errorkode_produk').html();
                    $('#nama_produk').removeClass('is-invalid').addClass('is-valid');;
                    $('.errornama_produk').html();
                    $('#merek').removeClass('is-invalid').addClass('is-valid');;
                    $('.errormerek').html();
                    $('#id_toko').removeClass('is-invalid').addClass('is-valid');;
                    $('.errorid_toko').html();
                }
            }
        });
      } 
</script>
<!-- Akhir Ketika tombol dengan elemen class bernama  editbtn ditekan -->

<!-- Proses mengisi data pada tabel -->
<script>
        function dataproduk(){
            $.ajax(
                {
                    type: "GET",
                    url: "{{url('produk/fetchproduk')}}",
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        $('tbody').html("");
                        $.each(response.produks, function (key, item) {
                            var urlgambar = "{{url('picture/')}}";
                            var urlgambarfix = urlgambar.concat("/",item.gambar);
                            $('tbody').append('<tr>\
                                <td>' + item.kode_produk + '</td>\
                                <td>' + item.nama_produk + '</td>\
                                <td style="text-align: center">' + item.merek + '</td>\
                                <td>' + item.nama_toko + '</td>\
                                <td style="text-align: center"><a onclick="updateConfirm(this); return false;" href="#" value="' + item.id + '" data-id="' + item.id + '" class="btn btn-success btn-circle editbtn"><i class="fas fa-check"></i></a>\
                                <a onclick="deleteConfirm(this); return false;" href="#" value="' + item.id + '" data-id="' + item.id + '" class="btn btn-danger btn-circle deletebtn"><i class="fas fa-trash"></i></button></td>\
                            \</tr>');
                        });
                    }
                }
            )
        }
        
    </script>
    <script>
        $(document).ready(function(){
            dataproduk();
            }
        );
    </script>
<!-- Akhir mengisi data pada tabel -->

<!-- Ketika tombol submit di form ditekan -->
<script>

        // definisikan tipe method yang berbeda 
        // untuk update=>put (pembedanga adalah inner html pada labelmodalubah berisi Ubah Data Coa)
        // sedangkan untuk input=>post nilai inner html pada labelmodalubah berisi Tambah Data Coa


        $(document).ready(function()
            {   		
                $('.formubahproduk').submit(function(e)
                    {
                        e.preventDefault();
                            $.ajax(
                                {
                                    type: "post", //isinya post untuk insert dan put untuk delete
                                    url: $(this).attr('action'),
                                    data: $(this).serialize(),
                                    dataType: "json",
                                    success: function (response){
                                        // console.log('kssss');
                                        // jika responsenya adalah error
                                        if (response.status == 400) {
                                            if(response.errors.kode_produk){
                                                $('#kode_produk').removeClass('is-valid').addClass('is-invalid');
                                                $('.errorkode_produk').html(response.errors.kode_produk);
                                            }else{
                                                $('#kode_produk').removeClass('is-invalid').addClass('is-valid');;
                                                $('.errorkode_produk').html();
                                            }

                                            if(response.errors.nama_produk){
                                                $('#nama_akun').removeClass('is-valid').addClass('is-invalid');
                                                $('.errornama_produk').html(response.errors.nama_produk);
                                            }else{
                                                $('#nama_produk').removeClass('is-invalid').addClass('is-valid');;
                                                $('.errornama_produk').html();
                                            }

                                            if(response.errors.merek){
                                                $('#merek').removeClass('is-valid').addClass('is-invalid');
                                                $('.errormerek').html(response.errors.merek);
                                            }else{
                                                $('#merek').removeClass('is-invalid').addClass('is-valid');;
                                                $('.errormerek').html();
                                            }

                                            if(response.errors.id_toko){
                                                $('#id_toko').removeClass('is-valid').addClass('is-invalid');
                                                $('.errorid_toko').html(response.errors.id_toko);
                                            }else{
                                                $('#id_toko').removeClass('is-invalid').addClass('is-valid');;
                                                $('.errorid_toko').html();
                                            }

                                        }
                                        else{
                                            // munculkan pesan sukses
                                            Swal.fire({
                                                title: 'Berhasil!',
                                                text: response.sukses,
                                                icon: 'success',
                                                confirmButtonText: 'Ok'
                                            });
                                            
                                            // kosongkan form
                                            $('#ubahModal').modal('hide');
                                            dataproduk(); //refresh data coa

                                        }
                                    },
                                    error: function(xhr, ajaxOptions, thrownError){
                                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                                    } 
                                } 
                            );
                            return false;
                    }
                );
            }
        );
</script>
<!-- Akhir ketika tombol submit di form ditekan -->


@endsection