<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // mengambil data pelanggan
    	$pelanggan = Pelanggan::getPelangganDetail();

        return view('pelanggan/view',
            [
                'pelanggan' => $pelanggan
            ]
        );
    }

    public function fetchpelanggan()
    {
        $pelanggan = Pelanggan::getPelangganDetail();
        return response()->json([
            'pelanggans'=>$pelanggan,
        ]);
    }

    // untuk API view data
    public function view($id)
    {
        // $coa = Coa::getCoaBasedOnIdPerusahaan($id); 
        $pelanggan = Pelanggan::all();
        echo json_encode($pelanggan);    
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
     * @param  \App\Http\Requests\StorePelangganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePelangganRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validator = Validator::make(
            $request->all(),
            [
                'nama_pelanggan' => 'required',
                'alamat_pelanggam' => 'required',
                'kode_pelanggan' => 'required',
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
                Pelanggan::create($request->all());
                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Sukses Input Data',
                    ]
                );
            }else{
                // update ke db
                $pelanggan = Pelanggan::find($request->input('idpelangganhidden'));
            
                // proses update dari inputan form data
                $pelanggan->nama_pelanggan = $request->input('nama_pelanggan');
                $pelanggan->alamat_pelanggam = $request->input('alamat_pelanggam');
                $pelanggan->kode_pelanggan = $request->input('kode_pelanggan');
                $pelanggan->update(); //proses update ke db

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
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelanggan = Pelanggan::find($id);
        if($pelanggan)
        {
            return response()->json([
                'status'=>200,
                'pelanggan'=> $pelanggan,
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
     * @param  \App\Http\Requests\UpdatePelangganRequest  $request
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePelangganRequest $request, Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hapus dari database
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();
        // return redirect()->route('produk')->with('success','Data Berhasil di Hapus');

        // mengambil data produk dan toko dari database
    	$pelanggan = Pelanggan::all();

        return view('pelanggan/view',
            [
                'pelanggan' => $pelanggan,
                'status_hapus' => 'Sukses Hapus'
            ]
        );
    }
}
