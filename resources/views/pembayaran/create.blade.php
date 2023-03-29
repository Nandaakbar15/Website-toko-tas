@extends('layoutsbootstrap')

@section('konten')
<!-- Begin Page Content -->
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

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12 col-sm-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pembayaran</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                        <div class="chart-area" hidden>
                            <canvas id="myAreaChart"></canvas>
                        </div>

                    <!-- dapatkan nomor transaksi -->
                    <?php 
                        $no_transaksi = '';
                        $totaltagihan = 0;
                        foreach($keranjang as $k):
                            $no_transaksi = $k->no_transaksi ;
                            $totaltagihan = $totaltagihan + $k->total ;
                        endforeach;
                    ?>

                    <!-- Awal Dari Input Form -->
                    <form action="{{ url('/pembayaran/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="no_transaksi" name="no_transaksi" value="{{$no_transaksi}}">
                        <input type="hidden" id="tipeproses" name="tipeproses" value="tunai">
                        <div class="mb-3"><label for="kodeperusahaanlabel">No Transaksi</label>
                        <input class="form-control form-control-solid" id="kode" name="kode" type="text" value="{{$no_transaksi}}" readonly></div>
                        
                        <div class="mb-3"><label for="namaperusahaanlabel">Isi Keranjang <b>(Rp {{number_format($totaltagihan)}})</b></label>
                            <ul class="list-group">
                            @foreach ($keranjang as $k)
                                <li class="list-group-item">
                                    <b>{{$k->nama_barang}}</b> <br>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <img width="150px" height="150px" id="x-2" src="{{url('barang')}}/{{$k->foto}}" zn_id="79" title alt="ok">
                                        </div>
                                        <div class="col-sm-10" align="left">
                                            <table>
                                                <tr>
                                                    <td>
                                                    Harga per item
                                                    </td>
                                                    <td>=</td>
                                                    <td style="text-align:right">{{number_format($k->harga)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                    Jumlah Barang
                                                    </td>
                                                    <td>=</td>
                                                    <td style="text-align:right">{{number_format($k->jml_barang)}}</td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                     <hr>
                                                    </td>
                                                    
                                                </tr>
                                                <tr> 
                                                    <td>
                                                    Total Harga  
                                                    </td>
                                                    <td>=</td>
                                                    <td style="text-align:right">
                                                        {{number_format($k->total)}}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </li>
                            @endforeach
                            </ul>
                        </div>
                        
                        <div class="mb-3 row">
                            <label for="nomerlabel" class="col-sm-4 col-form-label">Bukti Bayar</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control @error('bukti_bayar') is-invalid @enderror" id="bukti_bayar" name="bukti_bayar" value="{{ old('bukti_bayar') }}">
                                @error('bukti_bayar')
                                    <div>{{ $message }}</div>
                                @enderror
                                
                            </div>
                        </div>    

                        <div class="mb-3 row">
                            <label for="nomerlabel" class="col-sm-4 col-form-label">Tanggal Bayar</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control @error('tgl_bayar') is-invalid @enderror" id="tgl_bayar" name="tgl_bayar" value="{{ old('tgl_bayar') }}">
                                @error('tgl_bayar')
                                    <div>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>  

                        <br>
                        <!-- untuk tombol simpan -->
                        
                        <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Bayar">

                        <!-- untuk tombol batal simpan -->
                        <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/pembayaran/viewkeranjang') }}" role="button">Batal</a>
                        
                    </form>
                    <!-- Akhir Dari Input Form -->
                </div>
            </div>
        </div>

        
    </div>

    
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
@endsection