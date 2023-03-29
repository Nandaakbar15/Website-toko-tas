<!-- Menghubungkan dengan view template layout2 -->
@extends('layout2')

@section('konten')
 
<h1>Data Coa</h1>
 
<ul>
	@foreach($produk as $p)
		<li>{{ "Kode Produk : ". $p->kode_produk . ' | Nama Produk : ' . $p->nama_produk }}</li>
	@endforeach
</ul>
 
@endsection