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
                    <h6 class="m-0 font-weight-bold text-primary">Gambar Produk</h6>
                    
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
                                    <th>Nama</th>
                                    <th>Gambar</th>
                                    <th style="text-align: center">Tgl Rilis</th>
                                    <th>Klasifikasi</th>
                                    <th>Jenis Gambar</th>
                                    <th>Tipe</th>
                                    <th style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot class="thead-dark">
                                <tr>
                                    <th>Nama</th>
                                    <th>Gambar</th>
                                    <th style="text-align: center">Tgl Rilis</th>
                                    <th>Klasifikasi</th>
                                    <th>Jenis Gambar</th>
                                    <th>Tipe</th>
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
            var url3 = "{{url('gambarproduk/destroy/')}}";
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
            <h5 class="modal-title" id="labelmodalubah">Ubah Data Gambar</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
            </button>
        </div>
        
        <form action="{{url('gambarproduk')}}" class="formubah" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <!-- Form untuk input -->
            @csrf
            <input type="hidden" id="idgambarprodukhidden" name="idgambarprodukhidden" value="">
            <input type="hidden" id="tipeproses" name="tipeproses" value="tambah">
            <input type="hidden" id="gambarlama" name="gambarlama" value="">
                <div class="mb-3 row">
                    <label for="nomerlabel" class="col-sm-4 col-form-label">Nama Gambar</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama_gambar" name="nama_gambar" placeholder="Masukkan Nama Gambar">
                        <div class="invalid-feedback errornama_gambar"></div>
                    </div> 
                </div>
                <!-- Tempat untuk menampilkan gambar yang lama -->
                <div class="mb-3 row">
                    <div class="col-sm-4" id="avatar" name="avatar">
                        <!-- <img src="http://127.0.0.1:8000/gambar/1664705125.jpg" width="150px" height="100px" alt=""> -->
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nomerlabel" class="col-sm-4 col-form-label">Gambar</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="gambar_produk" name="gambar_produk" required>
                        <div class="invalid-feedback errorgambar_produk"></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="lantailabel" class="col-sm-4 col-form-label">Tgl Rilis</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="tgl_rilis" name="tgl_rilis" placeholder="Masukkan Nama Akun, cth: Kas">
                        <div class="invalid-feedback errortgl_rilis"></div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="hargalabel" class="col-sm-4 col-form-label">Klasifikasi</label>
                    <div class="col-sm-8">
                        <!-- Radio Button -->
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="klasifikasi_gambar" id="klasifikasi_gambar" value="internal">
                            <label class="form-check-label" for="flexRadioInternal">
                                Internal
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="klasifikasi_gambar" id="klasifikasi_gambar" value="eksternal">
                            <label class="form-check-label" for="flexRadioEksternal">
                                Eksternal
                            </label>
                        </div>
                        <!--  -->
                    </div>
                </div>

                 <!-- select2 -->
                 <div class="mb-3 row">
                    <label for="lantailabel" class="col-sm-4 col-form-label">Jenis Gambar</label>
                    <div class="col-sm-8">
                        <select id="jenis_gambar" name="jenis_gambar[]" class="form-control" multiple="multiple" style="width:300px">
                            <option value="PNG">PNG</option>
                            <option value="JPG">JPG</option>
                            <option value="JPEG">JPEG</option>
                        </select>
                        <div class="invalid-feedback errorjenis_gambar"></div>
                    </div>
                </div>
                <!-- akhir select2 -->

                <!-- Check Box -->
                <div class="mb-3 row">
                    <label for="hargalabel" class="col-sm-4 col-form-label">Tipe Tas</label>
                    <div class="col-sm-8">
                        <!-- Check Button -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Traveling" id="traveling" name="traveling">
                            <label class="form-check-label" for="flexCheckDefault">
                                Traveling
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Olahraga" id="olahraga" name="olahraga">
                            <label class="form-check-label" for="flexCheckChecked">
                                Olahraga
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="NaikGunung" id="naikgunung" name="tidur">
                            <label class="form-check-label" for="flexCheckChecked">
                                Naik Gunung
                            </label>
                        </div>
                        <!--  -->
                    </div>
                </div>
                <!-- Akhir Check Box -->

            </div>    

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
            </form>
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
              $('#labelmodalubah').html('Tambah Data Gambar Produk');

            // required gambar dihilangkan
            let gbr = document.getElementById('gambar_produk');
            gbr.setAttribute("required", "");

            // centang di checkbox dihilangkan
            document.getElementById("traveling").checked = false;
            document.getElementById("olahraga").checked = false;
            document.getElementById("naikgunung").checked = false;

              url = "{{url('gambarproduk')}}";
            //   $('.formubah').attr('action',url);

            // sebelum menambahkan tag img di dalam container div avatar, dihapus dulu sisa tag yg lama
            var parent = document.querySelector('#avatar');
            if (parent.hasChildNodes()) {
                // It has at least one chile, remove it
                parent.removeChild(parent.lastChild);
            }

              // kosongkan isi dari input form
              $('#nama_gambar').val('');
              $('#tgl_rilis').val('');
              $("#avatar").html('');
              $('#traveling').attr("checked",false);  
              $('#olahraga').attr("checked",false);  
              $('#naikgunung').attr("checked",false);  
              $('#klasifikasi_gambar').attr("checked",false);  
              $('#idgambarprodukhidden').val('');
              $('#tipeproses').val('tambah'); //untuk identifikasi di controller apakah tambah atau update


                var data = {
                    'nama_gambar': $('.nama_gambar').val(),
                    'gambar': $('.gambar').val(),
                    'tgl_rilis': $('.tgl_rilis').val(),
                    'klasifikasi_gambar': $('.klasifikasi_gambar').val(),
                }  
                // console.log(data);
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
                    url: "{{url('gambarproduk')}}",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        // console.log(data);
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

        $('#labelmodalubah').html('Ubah Data Gambar');
        url = "{{url('gambarproduk')}}";
        // $('.formubah').attr('action',url);
        $('#idgambarprodukhidden').val(id);
        $('#tipeproses').val('ubah'); 

        // required gambar dihilangkan
        let gbr = document.getElementById('gambar_produk');
        gbr.removeAttribute('required');

        $('#ubahModal').modal('show');

        var url3 = "{{url('gambarproduk/edit/')}}";
        var url4 = url3.concat("/",id);

        // id dari tag img adalag x-id
        var identifierxid = "x-"+id;
        var dapatkantagimg = document.getElementById(identifierxid).src;
        // console.log(dapatkantagimg);
        // dapatkan posisi karakter dari "/" terakhir dari http://127.0.0.1:8000/gambar/1664705125.jpg
        var n = dapatkantagimg.lastIndexOf("/")
        var res = dapatkantagimg.substring(n+1); //mendapatkan nama file gambar lama dari db 1664705125.jpg
        // console.log(res);

        // sebelum menambahkan tag img di dalam container div avatar, dihapus dulu sisa tag yg lama
        var parent = document.querySelector('#avatar');
        if (parent.hasChildNodes()) {
            // It has at least one chile, remove it
            parent.removeChild(parent.lastChild);
        }
	    

        // menambahkan img
        const image = document.createElement('img')
        var urlgambar = "{{url('gambarproduk/')}}";
        var urlgambarfix = urlgambar.concat("/",res); //menggabungkan url dengan data nama file
        image.src = urlgambarfix
        image.width = "150";
        image.height = "100";
        document.querySelector('#avatar').appendChild(image);

        $.ajax({
            type: "GET",
            url: url4,
            success: function (response) {
                // console.log(response);
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
                    // console.log(response);
                    $('#nama_gambar').val(response.c[0].nama_gambar);
                    // $('#nama_dokumen').val(response.c.nama_dokumen);
                    // $('#gambar_dokumen').val(response.c.gambar_dokumen);
                    $('#tgl_rilis').val(response.c[0].tgl_rilis);
                    // $('#klasifikasi_dokumen').val(response.c.klasifikasi_dokumen);

                    // cek jika klasifikasi dokumen adalah dokumen eksternel maka nilai chekced elemen radio buttonnya di buat true
                    if(response.c[0].klasifikasi_gambar==='eksternal'){
                        document.querySelector('input[name=klasifikasi_gambar][value=eksternal]').checked = true;
                    }else{
                        document.querySelector('input[name=klasifikasi_gambar][value=internal]').checked = true;
                    }
                    
                    $('#gambarlama').val(response.c[0].gambar);

                    // update confirm
                    // console.log(response.c[0].list_dokumen);
                    // split nilai
                    var text = response.c[0].list_gambar;
                    var myArray = text.split(",");
                    $('#jenis_gambar').val(myArray); // Select the option with a value of '1'
                    $('#jenis_gambar').trigger('change'); // Notify any JS components that the value changed

                    // centang di checkbox dihilangkan
                    var text = response.c[0].list_tipe;
                    console.log(text);
                    var myArray = text.split(",");
                    document.getElementById("traveling").checked = false;
                    document.getElementById("olahraga").checked = false;
                    document.getElementById("naikgunung").checked = false;
                    for (let i = 0; i < myArray.length; i++) {
                        // berikan nilai true pada atribut checked
                        document.getElementById(myArray[i].toLowerCase()).checked = true;
                    }
                    
                }
            }
        });
      } 
</script>
<!-- Akhir Ketika tombol dengan elemen class bernama  editbtn ditekan -->

<!-- Proses mengisi data pada tabel -->
<script>
        function datagambar(){
            $.ajax(
                {
                    type: "GET",
                    url: "{{url('gambarproduk/fetchgambar')}}",
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        $('tbody').html("");
                        $.each(response.gambar_produk, function (key, item) {
                            var urlgambar = "{{url('gambar/')}}";
                            var urlgambarfix = urlgambar.concat("/",item.gambar);
                            $('tbody').append('<tr>\
                                <td>' + item.nama_gambar + '</td>\
                                <td style="text-align: center"><img width="150px" height="100px" id="x-' + item.id + '" src="' + urlgambarfix + '"></td>\
                                <td style="text-align: center" id="y-' + item.id + '">' + item.tgl_rilis + '</td>\
                                <td>' + item.klasifikasi_gambar + '</td>\
                                <td>' + item.list_gambar + '</td>\
                                <td>' + item.list_tipe + '</td>\
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
            datagambar();
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
                $('.formubah').submit(function(e)
                    {
                        e.preventDefault();
                        const fd = new FormData(this);
                        // console.log(fd);
                            $.ajax(
                                {
                                    type: "post", //isinya post untuk insert dan put untuk delete
                                    url: $(this).attr('action'),
                                    //data: $(this).serialize(),
                                    data: fd,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    dataType: "json",
                                    success: function (response){
                                        console.log(response);
                                        // jika responsenya adalah error
                                        if (response.status == 400) {
                                            if(response.errors.nama_gambar){
                                                $('#nama_gambar').removeClass('is-valid').addClass('is-invalid');
                                                $('.errornama_gambar').html(response.errors.nama_gambar);
                                            }else{
                                                $('#nama_gambar').removeClass('is-invalid').addClass('is-valid');
                                                $('.errornama_gambar').html();
                                            }

                                            if(response.errors.gambar_produk){
                                                $('#gambar_produk').removeClass('is-valid').addClass('is-invalid');
                                                $('.errorgambar_produk').html(response.errors.gambar_produk);
                                            }else{
                                                $('#gambar').removeClass('is-valid').removeClass('is-invalid').addClass('is-valid');
                                                $('.errorgambar').html();
                                            }

                                            if(response.errors.tgl_rilis){
                                                $('#tgl_rilis').removeClass('is-valid').addClass('is-invalid');
                                                $('.errortgl_rilis').html(response.errors.tgl_rilis);
                                            }else{
                                                $('#tgl_rilis').removeClass('is-invalid').addClass('is-valid');
                                                $('.errortgl_rilis').html();
                                            }

                                            if(response.errors.klasifikasi_gambar){
                                                $('#klasifikasi_gambar').removeClass('is-valid').addClass('is-invalid');
                                                $('.errorklasifikasi_gambar').html(response.errors.klasifikasi_gambar);
                                            }else{
                                                $('#klasifikasi_gambar').removeClass('is-invalid').addClass('is-valid');
                                                $('.errorklasifikasi_gambar').html();
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
                                            datagambar(); //refresh data coa

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