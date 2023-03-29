<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Toko;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // mengambil data coa dan perusahaan dari database
    	$produk = Produk::getProdukDetail();
        $toko = Toko::orderBy('nama_toko')->get(); //Project::orderBy('name')->get()

        return view('produk/view2',
            [
                'produk' => $produk,
                'toko' => $toko
            ]
        );
    }

    public function fetchproduk()
    {
        $produk = Produk::getProdukDetail();
        return response()->json([
            'produks'=>$produk,
        ]);
    }

     // untuk API view data
     public function view($id)
     {
         // $coa = Coa::getCoaBasedOnIdPerusahaan($id); 
         $produk = Produk::all();
         echo json_encode($produk);    
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProdukRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProdukRequest $request)
    {
       //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validator = Validator::make(
            $request->all(),
            [
                'kode_produk' => 'required|min:3',
                'nama_produk' => 'required',
                'merek' => 'required',
            ]
        );
        
        if($validator->fails()){
            // gagal
            return response()->json(
                [
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]
            );
        }else{
            // berhasil

            // cek apakah tipenya input atau update
            // input => tipeproses isinya adalah tambah
            // update => tipeproses isinya adalah ubah
            
            if($request->input('tipeproses')=='tambah'){
                // simpan ke db
                Produk::create($request->all());
                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Sukses Input Data',
                    ]
                );
            }else{
                // update ke db
                $produk = Produk::find($request->input('idcoahidden'));
            
                // proses update dari inputan form data
                $produk->kode_produk = $request->input('kode_akun');
                $produk->nama_produk = $request->input('nama_produk');
                $produk->merek = $request->input('merek');
                $produk->id_toko = $request->input('id_toko');
                $produk->update(); //proses update ke db

                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Sukses Update Data',
                    ]
                );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Produk::find($id);
        if($produk)
        {
            return response()->json([
                'status'=>200,
                'produk'=> $produk,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Tidak ada data ditemukan.'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProdukRequest  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hapus dari database
        $produk = Produk::findOrFail($id);
        $produk->delete();
        // return redirect()->route('produk')->with('success','Data Berhasil di Hapus');

        // mengambil data produk dan toko dari database
    	$produk = Produk::all();
        $toko = Toko::orderBy('nama_toko')->get(); //Project::orderBy('name')->get()

        return view('produk/view2',
            [
                'produk' => $produk,
                'toko' => $toko,
                'status_hapus' => 'Sukses Hapus'
            ]
        );
    }
}
